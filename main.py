

from fastapi import FastAPI, UploadFile, HTTPException
from fastapi.middleware.cors import CORSMiddleware
import numpy as np
#from PIL import Image
from io import BytesIO
from tensorflow.keras.models import load_model

model = load_model('modelo_SinapsIA_SIGMOID_2.h5')

app = FastAPI()

app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_credentials=True,
    allow_methods=["*"],
     allow_headers=["*"],
)

@app.get("/")
async def a ():
    return ("hello fastapi")


@app.post("/upload/")
async def create_upload_file(inputDoc: UploadFile):
    try:
        # Obtener los bytes directamente desde el objeto UploadFile
        photo_bytes = await inputDoc.read()

        # Cargar el archivo Numpy directamente
        photo_data = np.load(BytesIO(photo_bytes))

        # Asegurarse de que las dimensiones del array sean las esperadas por el modelo
        #if photo_data.shape != (224, 224, 3):
        #    raise HTTPException(status_code=400, detail=photo_data.shape)

        # Agregar una dimensión para coincidir con las expectativas del modelo
        #photo_data = np.expand_dims(photo_data, axis=0)

        # Realizar la predicción con el modelo
        model_output = model.predict(photo_data)

        # Promediar todos los números del array de salida del modelo
        processed_output = np.mean(model_output)

        porcentaje= np.mean(processed_output) * 100

        return {"processed_output": float(porcentaje)}
    
    except HTTPException as e:
        raise e
    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))

