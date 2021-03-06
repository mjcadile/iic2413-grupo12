from flask import Flask, render_template, request, abort, json
from pymongo import MongoClient, ASCENDING
import pandas as pd
import matplotlib.pyplot as plt
import os

# Para este ejemplo pediremos la id
# y no la generaremos automáticamente

USER = "grupo12"
PASS = "grupo12"
DATABASE = "grupo12"

MSG_KEYS = ["message", "sender", "receptant", "lat", "long", "date"]
TXT_KEYS = ["desired", "required", "forbidden", "userId"]

# El cliente se levanta en la URL de la wiki
# URL = "mongodb://grupo12:grupo12@gray.ing.puc.cl/grupo12"
URL = f"mongodb://{USER}:{PASS}@gray.ing.puc.cl/{DATABASE}"
client = MongoClient(URL)

# Utilizamos la base de datos del grupo
db = client["grupo12"]


# Seleccionamos la collección de usuarios y mensajes // creamos el indice en mensajes
usuarios = db.users
mensajes = db.messages

# Iniciamos la aplicación de flask
app = Flask(__name__)

@app.route("/")
def home():
    '''
    Página de inicio
    '''
    return "<h1>¡Bienvenido a la API del Grupo 12-19!</h1>"


@app.route("/users")
def get_users():
    '''
    Obtiene todos los usuarios
    '''
    # Omitir el _id porque no es json serializable
    resultados = list(usuarios.find({}, {"_id": 0}))
    return json.jsonify(resultados)


@app.route("/messages")
def get_messages():
    '''
    Obtiene todos los mensajes
    Si se reciben parámetros, entonces se obtienen todos 
    los mensajes mandados por los dos ids dados
    '''
    uid1 = request.args.get('id1', default=None, type=int)
    uid2 = request.args.get('id2', default=None, type=int)

    if (uid1 is None) or (uid2 is None):
        # Omitir el _id porque no es json serializable
        resultados = list(mensajes.find({}, {"_id": 0}))
        return json.jsonify(resultados)
    mensajes_uid1 = list(mensajes.find({"sender": uid1, "receptant": uid2}, 
                                       {"_id": 0}))
    mensajes_uid2 = list(mensajes.find({"sender": uid2, "receptant": uid1}, 
                                       {"_id": 0}))
    #print(mensajes_uid1, mensajes_uid2)
    if mensajes_uid1 or mensajes_uid2:
        return json.jsonify(mensajes_uid1 + mensajes_uid2)
    return json.jsonify({"error": f"No hay mensajes entre los usuarios {uid1} y {uid2}"})


@app.route("/users/<int:uid>")
def get_user(uid):
    '''
    Obtiene el usuario de id entregada junto con sus mensajes
    '''
    user = list(usuarios.find({"uid": uid}, {"_id": 0}))
    mensajes_user = list(mensajes.find({"sender": uid}, {"_id": 0}))
    if user:
        return json.jsonify(user + mensajes_user)
    return json.jsonify({"error": "Usuario no encontrado, intente con otro id"})


@app.route("/messages/<int:mid>")
def get_message(mid):
    '''
    Obtiene el mensaje de id entregada
    '''
    mensaje = list(mensajes.find({"mid": mid}, {"_id": 0}))
    if mensaje:
        return json.jsonify(mensaje)
    return json.jsonify({"error": "Mensaje no encontrado, intente con otro id"})


@app.route("/text-search")
def text_search():
    try:
        data = dict(json.loads(request.data))
    except:
        # si no se manda body ocurre un error
        # entonces mandamos todos los mensajes
        resultados = list(mensajes.find({}, {"_id": 0}))
        return json.jsonify(resultados)

    if not data:
        #  retornamos todos los mensajes
        resultados = list(mensajes.find({}, {"_id": 0}))
        return json.jsonify(resultados)

    userId = 0

    busqueda = ""

    for key in list(data.keys()):
        if key == "desired":
            desired = data["desired"]  # lista con palabras que se quieren buscar
            if len(desired) > 0:
                for frase in desired:
                    busqueda += frase  # agregamos las palabras solo separadas por espacios (buscamos ocurrencia de una o la otra, o ambas)
                    busqueda += " "
            elif  len(data.keys()) == 1:
                return json.jsonify(resultados)

        elif key == "required": 
            required = data["required"]  # lista con palabras que tienen que estar presentes
            for frase in required:
                modificada = "\"{}\"".format(frase)
                busqueda += modificada  # agregamos frases que si o si deben estar en la busqueda
                busqueda += " "
        elif key == "forbidden": 
            forbidden = data["forbidden"]  # lista con palabras que no pueden estar
            for frase in forbidden:
                busqueda += "-" + frase  # agregamos frases que no pueden estar en la busqueda
                busqueda += " "
        elif key == "userId":
            userId = int(data["userId"])  # entero con el id de usuario

    busqueda = busqueda[:-1]  # sacamos espacio del final
    mensajes.create_index([("message", "text")]) # se crea el indice
    
    if len(list(data.keys())) == 1 and list(data.keys())[0] == "forbidden":
        men = list(mensajes.find({}, {"_id": 0}))
        busqueda = busqueda.replace('-', '').replace('\"','').split()
        mensajes_forbidden = list()
        for mensje in men:
            aux = True
            for palabra in busqueda:
                if palabra in mensje["message"]:
                    aux = False
                    break
            if aux:
                mensajes_forbidden.append(mensje)
        if mensajes_forbidden:
            return json.jsonify(mensajes_forbidden)
        return json.jsonify({"error": "Solo se entregaron palabras prohibidas, no se ha podido hacer la busqueda."})

    if userId == 0:
        #  retornamos el text-search pero para cualquier usuario
        mensajes_busqueda = list(mensajes.find({"$text": {"$search": busqueda}}, {"_id": 0}))
        if mensajes_busqueda:
            return json.jsonify(mensajes_busqueda)
        return json.jsonify({"error": "No se encontraron referencias a lo solicitado"})
    else:
        #  retornamos el text-search pero para el usuario indicado
        #  mensajes_filter_user = mensajes.find({"sender": userId}, {"_id": 0})

        mensajes_busqueda = list(mensajes.find({"$text": {"$search": busqueda}}, {"_id": 0}))
        
        lista_especifica = []
        if list(data.keys()) == ['userId']:
            mensajes_busqueda = list(mensajes.find({}, {"_id": 0}))
        for msn in mensajes_busqueda:
            if int(msn["sender"]) == userId:
                lista_especifica.append(msn)
        if lista_especifica:
            return json.jsonify(lista_especifica)
        return json.jsonify({"error": "No se encontraron referencias a lo solicitado"})


@app.route("/messages", methods=['POST'])
def receive_message():
    
    if request.json is None:
        return json.jsonify({"error": "inserte un mensaje para agregar"})

    data = {key: request.json[key] for key in MSG_KEYS}
    count = mensajes.count_documents({})

    # venga o no el parametro mid en el json, se agrega igual o se cambia
    data["mid"] = count + 1

    if len(data.keys()) == (len(MSG_KEYS) + 1):
        #estan todos los atributos
        result = mensajes.insert_one(data)
        if result:
            msj = "El mensaje se inserto correctamente"
            success = True
        else:
            msj = "No se ha podido insertar el mensaje"
            success = False
        return json.jsonify({"success": success, "log": msj})
    else:
        faltantes = []
        for key in MSG_KEYS:
            if key not in data.keys():
                faltantes.append(key)
        msj = "Faltan atributos para poder agregar el mensaje correctamente: {}".format(faltantes)
        success = False
        return json.jsonify({"success": success, "log": msj})


@app.route("/message/<int:id>", methods=['DELETE'])
def delete_message(id):
    result = mensajes.delete_one({"mid": int(id)})
    if not result:
        msj = "El id no existe. No se ha podido borrar el mensaje"
        success = False
    else:
        msj = "Se ha borrado correctamente el mensaje"
        success = True

    return json.jsonify({"success": success, "log": msj})


if __name__ == "__main__":
    #app.run()
    app.run(debug=True) # Para debuggear!
# ¡Mucho ánimo y éxito! ¡Saludos! :D

