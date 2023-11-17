from fastapi import FastAPI, File, UploadFile, HTTPException
from fastapi.responses import JSONResponse
from tensorflow.keras.models import load_model
import numpy as np
import pandas as pd

app = FastAPI()
model = load_model('modelo_SinapsIA.h5')

@app.post("/predict")
async def predecir(file: UploadFile = UploadFile(...)):
    try:

        # Guardar temporalmente el archivo
        file_path = f"/ruta/a/carpeta/temporal/{file.filename}"
        with open(file_path, "wb") as temp_file:
            temp_file.write(file.file.read())
        # Cargar el archivo y realizar la predicción
        datos = np.load(file_path)
        prediction = model.predict(np.array([datos])) 


        # Interpretar la predicción (ajustar según la salida de tu modelo)
        diagnosis = "Epilepsia" if prediction[0][0] > 0.5 else "No Epilepsia"

        return JSONResponse(content={"diagnosis": diagnosis})

    except Exception as e:
        # Manejar cualquier error y devolver una respuesta adecuada
        raise HTTPException(status_code=500, detail=str(e))