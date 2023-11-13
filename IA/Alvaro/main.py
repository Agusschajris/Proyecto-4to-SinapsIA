#importo lo que necesito de la libreria
from fastapi import FastAPI
import numpy as np
#importo libreria que lee los archivos
from fastapi import FastAPI, File, UploadFile, HTTPException
from io import BytesIO
#creamos la app
app=FastAPI()
#definimos la ruta 
@app.get('/')
#la primera respuesta que recibirá el usuario (permite alprograma iniciar una tarea de larga duración y seguir respondiendo a otros eventos)
async def predict(file: UploadFile = File(...)):
#fastapi maneja los archivos como bytes para facilitar el procesamiento
    # Lee el contenido del archivo como bytes
    file_content = await file.read()

    # Convierte los bytes a un array NumPy
    # se utiliza para crear un objeto similar a un archivo en memoria a partir de los bytes del contenido del archivo que se ha leído.
    np_array = np.load(BytesIO(file_content))
    
    return {"filename": file.name,  "arrayshape":  np_array.shape}