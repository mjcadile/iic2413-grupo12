# gunicorn-flask-pipenv-sample

## Para correr

### Windows con una sola version de python, Ubuntu 18.04+

```bash
pip install pipenv
```

### Otros

```bash
pip3 install pipenv
```

Abrimos nuevamente la consola

#### Crear entorno

```bash
pipenv install
```


### Entrar al entorno virtual
```bash
pipenv shell
```
Si estas en windows 
```
python main.py
```

Cualquier otro sistema operativo
```
gunicorn main:app --workers=3 --reload
```

## Otras observaciones

La aplicacion funciona cuando se entregan inputs en tipo JSON, es decir un diccionario con el formato que se indica en el enunciado. No funciona con inputs como los que venian en los casos de prueba. Por ejemplo si tenemos:
{
    "desired": ["Hola amigo m´ıo", "Cu´anto tiempo ha pasado"],
    "required": ["Vamos a robar", "Robar una pintura"],
    "forbidden": ["broma", "trollear"],
    "userId": 5
}
ese caso va a funcionar, en cambio si viene de la siguiente manera no funciona:
{\n\t"desired": ["Hola amigo mío", "Cuánto tiempo ha pasado"],\n\t"required": ["Vamos a robar", "Robar una pintura"],\n\t"forbidden": ["broma", "trollear"],\n\t"userId": 5\n}