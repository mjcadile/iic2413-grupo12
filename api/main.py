from flask import Flask, render_template, request, abort, json
from pymongo import MongoClient
import pandas as pd
import matplotlib.pyplot as plt
import os

# Para este ejemplo pediremos la id
# y no la generaremos automáticamente
USER_KEYS = ['uid', 'name', 'last_name',
            'occupation', 'follows', 'age']

USER = "grupo12"
PASS = "grupo12"
DATABASE = "grupo12"

# El cliente se levanta en la URL de la wiki
# URL = "mongodb://grupo12:grupo12@gray.ing.puc.cl/grupo12"
URL = f"mongodb://{USER}:{PASS}@gray.ing.puc.cl/{DATABASE}"
client = MongoClient(URL)

# Utilizamos la base de datos del grupo
db = client["grupo12"]

# Seleccionamos la collección de usuarios y mensajes
usuarios = db.users
mensajes = db.messages

'''
Usuarios:
    "uid": <id del usuario>,
    "name": <nombre>,
    "description": <descripción del usuario>,
    "age": <edad>

Mensajes:
    "date": <fecha del mensaje>,
    "lat": <latitud>,
    "long": <longitud>,
    "message": <mensaje>,
    "mid": <id del mensaje>,
    "receptant": <id del receptor>,
    "sender": <id del emisor>
'''

# Iniciamos la aplicación de flask
app = Flask(__name__)

@app.route("/")
def home():
    '''
    Página de inicio
    '''
    return "<h1>¡API Grupo12-19!</h1>"


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
    print(uid1, uid2)

    if uid1 is None or uid2 is None:
        # Omitir el _id porque no es json serializable
        resultados = list(mensajes.find({}, {"_id": 0}))
        return json.jsonify(resultados)
    mensajes_uid1 = list(mensajes.find({"sender": uid1, "receptant": uid2}, 
                                       {"_id": 0}))
    mensajes_uid2 = list(mensajes.find({"sender": uid2, "receptant": uid1}, 
                                       {"_id": 0}))
    print(mensajes_uid1, mensajes_uid2)
    if mensajes_uid1 or mensajes_uid2:
        return json.jsonify(mensajes_uid1 + mensajes_uid2)
    return "<h2>No hay mensajes intercambiados entre los id dados</h2>"


@app.route("/users/<int:uid>")
def get_user(uid):
    '''
    Obtiene el usuario de id entregada junto con sus mensajes
    '''
    user = list(usuarios.find({"uid": uid}, {"_id": 0}))
    mensajes_user = list(mensajes.find({"sender": uid}, {"_id": 0}))
    if user:
        return json.jsonify(user + mensajes_user)
    return "<h2>Usuario no encontrado, intente con otro id</h2>"


@app.route("/messages/<int:mid>")
def get_message(mid):
    '''
    Obtiene el mensaje de id entregada
    '''
    mensaje = list(mensajes.find({"mid": mid}, {"_id": 0}))
    if mensaje:
        return json.jsonify(mensaje)
    return "<h2>Mensaje no encontrado, intente con otro id</h2>"


@app.route("/users", methods=['POST'])
def create_user():
    '''
    Crea un nuevo usuario en la base de datos
    Se  necesitan todos los atributos de model, a excepcion de _id
    '''

    # En este caso nos entregarán la id del usuario,
    # Y los datos serán ingresados como json
    # Body > raw > JSON en Postman
    data = {key: request.json[key] for key in USER_KEYS}

    # El valor de result nos puede ayudar a revisar
    # si el usuario fue insertado con éxito
    result = usuarios.insert_one(data)

    return json.jsonify({'success': True, 'message': 'Usuario con id 1 creado'})


@app.route("/test")
def test():
    # Obtener un parámero de la URL
    # Ingresar desde Params en Postman
    # O agregando ?name=... a URL
    param = request.args.get('name', False)
    print("URL param:", param)

    # Obtener un header
    # Ingresar desde Headers en Postman
    param2 = request.headers.get('name', False)
    print("Header:", param2)

    # Obtener el body
    # Ingresar desde Body en Postman
    body = request.data
    print("Body:", body)

    return f'''
            OK
            <p>parámetro name de la URL: {param}<p>
            <p>header: {param2}</p>
            <p>body: {body}</p>
            '''
            
if __name__ == "__main__":
    #app.run()
    app.run(debug=True) # Para debuggear!
# ¡Mucho ánimo y éxito! ¡Saludos! :D
