# from fastapi import  FastAPI, File, UploadFile, HTTPException
# from fastapi.middleware.cors import CORSMiddleware
# from fastapi.responses import JSONResponse
# from pydantic import BaseModel
# import tensorflow as tf
# import numpy as np
# from tensorflow.keras.models import load_model
# model = load_model('modelo_SinapsIA_SIGMOID_2.h5')
# #model.summary()

# app = FastAPI()

# app.add_middleware(
#     CORSMiddleware,
#     allow_origins=["*"],
#     allow_credentials=True,
#     allow_methods=["*"],
#     allow_headers=["*"],
# )


#@app.post("/upload")
#async def create_upload_file(photoInput: UploadFile):
    # #los paso a numpy porque fastapi lee en bytes
   
    # data = np.load(photoInput.file.read())


    # # Pass the NumPy array to the loaded Keras model for inference
    # model_output = model.predict(data)

    # # Promediar todos los números del array de salida del modelo
    # processed_output = np.mean(model_output)

    # # Return the processed output in the JSON response
    # return {"processed_output": processed_output}
                                                                                                                                           


#from fastapi import HTTPException

# @app.post("/upload")
# async def create_upload_file(photoInput: UploadFile):
#     try:
#         photo_bytes = await photoInput.read()

#          # Convert the bytes object to a NumPy array
#         photo_data = np.frombuffer(photo_bytes, np.float32)


#         #los paso a numpy porque fastapi lee en bytes
#         #data = np.load(photoInput.file.read())

#         #model.summary()

#         # Imprimir las dimensiones del array antes de remodelar
#         print("Dimensiones antes de remodelar:", photo_data.shape)

#         # Asegúrate de que la forma del array sea la esperada por el modelo (ajusta las dimensiones según sea necesario)
#         photo_data = np.reshape(photo_data, (1, 224, 224, 3))  # Reemplaza height, width y channels con las dimensiones correctas

#         # Imprimir las dimensiones del array después de remodelar
#         print("Dimensiones después de remodelar:", photo_data.shape)

       
#         # Pass the NumPy array to the loaded Keras model for inference
#         model_output = model.predict(photo_data)

    

#         # Promediar todos los números del array de salida del modelo
#         processed_output = np.mean(model_output)

#         # Return the processed output in the JSON response
#         return {"processed_output": processed_output}
    
#     except Exception as e:
#         raise HTTPException(status_code=500, detail=str(e))
        

# from fastapi import FastAPI, File, UploadFile, HTTPException
# from fastapi.middleware.cors import CORSMiddleware
# import tensorflow as tf
# import numpy as np
# from tensorflow.keras.models import load_model

# # Cargar el modelo
# model = load_model('modelo_SinapsIA_SIGMOID_2.h5')

# app = FastAPI()

# # Configurar middleware CORS
# app.add_middleware(
#     CORSMiddleware,
#     allow_origins=["*"],
#     allow_credentials=True,
#     allow_methods=["*"],
#     allow_headers=["*"],
# )

# # Ruta para manejar la carga de imágenes
# @app.post("/upload")
# async def create_upload_file(photoInput: UploadFile):
#     try:
#         # Leer los bytes de la imagen
#         photo_bytes = await photoInput.read()

#         # Decodificar la imagen y convertirla a un array NumPy con tipo de datos float32
#         img = tf.image.decode_image(photo_bytes, channels=3)
#         img = tf.image.resize(img, [224, 224])
#         img = tf.cast(img, tf.float32)

#         # Agregar una dimensión adicional para que coincida con la forma de entrada del modelo
#         img = tf.expand_dims(img, 0)

#         # Realizar predicciones con el modelo cargado
#         model_output = model.predict(img)

#         # Promediar todos los números del array de salida del modelo
#         processed_output = np.mean(model_output)

#         # Devolver el resultado en formato JSON
#         return {"processed_output": float(processed_output)}
    
#     except Exception as e:
#         raise HTTPException(status_code=500, detail=str(e))

# from fastapi import FastAPI, File, UploadFile, HTTPException
# from fastapi.middleware.cors import CORSMiddleware
# import cv2
# import numpy as np
# from tensorflow.keras.models import load_model

# model = load_model('modelo_SinapsIA_SIGMOID_2.h5')

# app = FastAPI()

# app.add_middleware(
#     CORSMiddleware,
#     allow_origins=["*"],
#     allow_credentials=True,
#     allow_methods=["*"],
#     allow_headers=["*"],
# )

# @app.post("/upload")
# async def create_upload_file(photoInput: UploadFile):
#     try:
#         photo_bytes = await photoInput.read()

#         # Decodificar la imagen con OpenCV
#         image = cv2.imdecode(np.frombuffer(photo_bytes, np.uint8), 1)
        
#         # Asegurarse de que la imagen tiene las dimensiones correctas
#         image = cv2.resize(image, (224, 224))

#         # Agregar una dimensión para coincidir con las expectativas del modelo
#         photo_data = np.expand_dims(image, axis=0)

#         # Realizar la predicción con el modelo
#         model_output = model.predict(photo_data)

#         # Promediar todos los números del array de salida del modelo
#         processed_output = np.mean(model_output)

#         return {"processed_output": float(processed_output)}
    
#     except Exception as e:
#         raise HTTPException(status_code=500, detail=str(e))



# from fastapi import FastAPI, File, UploadFile, HTTPException
# from fastapi.middleware.cors import CORSMiddleware
# import cv2
# import numpy as np
# from tensorflow.keras.models import load_model

# model = load_model('modelo_SinapsIA_SIGMOID_2.h5')

# app = FastAPI()

# app.add_middleware(
#     CORSMiddleware,
#     allow_origins=["*"],
#     allow_credentials=True,
#     allow_methods=["*"],
#     allow_headers=["*"],
# )

# @app.post("/upload")
# async def create_upload_file(photoInput: UploadFile):
#     try:
#         photo_bytes = await photoInput.read()

#         # Decodificar la imagen con OpenCV
#         #image = cv2.imdecode(np.frombuffer(photo_bytes, np.uint8), 1)

#         try:
#             #image = cv2.imdecode(np.frombuffer(photo_bytes, np.uint8), 1)
#             image = cv2.imdecode(photo_bytes, cv2.IMREAD_UNCHANGED)
#         except Exception as decode_error:
#             #print(f"Error decoding image: {decode_error}")
#             raise HTTPException(status_code=400, detail=f"Error decoding image: {decode_error}")

#         if image is None:
#             raise HTTPException(status_code=400, detail="Failed to decode image. Please ensure it is a valid image file.")

#         # Asegurarse de que la imagen tiene las dimensiones correctas
#         if image.shape[:2] != (224, 224):
#             raise HTTPException(status_code=400, detail="Image dimensions are not 224x224. Please resize the image.")

#         # Agregar una dimensión para coincidir con las expectativas del modelo
#         photo_data = np.expand_dims(image, axis=0)

#         # Realizar la predicción con el modelo
#         model_output = model.predict(photo_data)

#         # Promediar todos los números del array de salida del modelo
#         processed_output = np.mean(model_output)

#         return {"processed_output": float(processed_output)}
    
#     except HTTPException as e:
#         raise e
#     except Exception as e:
#         raise HTTPException(status_code=500, detail=str(e))


# from fastapi import FastAPI, File, UploadFile, HTTPException
# from fastapi.middleware.cors import CORSMiddleware
# import cv2
# import numpy as np
# from tensorflow.keras.models import load_model

# model = load_model('modelo_SinapsIA_SIGMOID_2.h5')

# app = FastAPI()

# app.add_middleware(
#     CORSMiddleware,
#     allow_origins=["*"],
#     allow_credentials=True,
#     allow_methods=["*"],
#     allow_headers=["*"],
# )

# @app.post("/upload")
# async def create_upload_file(photoInput: UploadFile):
#     try:
#         photo_bytes = await photoInput.read()

#         # Convertir los bytes a un array de numpy
#         nparr = np.frombuffer(photo_bytes, np.uint8)

#         # Decodificar la imagen con OpenCV
#         image = cv2.imdecode(nparr, cv2.IMREAD_UNCHANGED)

#         if image is None:
#             raise HTTPException(status_code=400, detail="Failed to decode image. Please ensure it is a valid image file.")

#         # Asegurarse de que la imagen tiene las dimensiones correctas
#         if image.shape[:2] != (224, 224):
#             raise HTTPException(status_code=400, detail="Image dimensions are not 224x224. Please resize the image.")

#         # Agregar una dimensión para coincidir con las expectativas del modelo
#         photo_data = np.expand_dims(image, axis=0)

#         # Realizar la predicción con el modelo
#         model_output = model.predict(photo_data)

#         # Promediar todos los números del array de salida del modelo
#         processed_output = np.mean(model_output)

#         return {"processed_output": float(processed_output)}
    
#     except HTTPException as e:
#         raise e
#     except Exception as e:
#         raise HTTPException(status_code=500, detail=str(e))

# from fastapi import FastAPI, File, UploadFile, HTTPException
# from fastapi.middleware.cors import CORSMiddleware
# import cv2
# import numpy as np
# from PIL import Image
# from io import BytesIO
# from tensorflow.keras.models import load_model

# model = load_model('modelo_SinapsIA_SIGMOID_2.h5')

# app = FastAPI()

# app.add_middleware(
#     CORSMiddleware,
#     allow_origins=["*"],
#     allow_credentials=True,
#     allow_methods=["*"],
#     allow_headers=["*"],
# )

# @app.post("/upload")
# async def create_upload_file(photoInput: UploadFile):
#     try:
#         # Obtener los bytes directamente desde el objeto UploadFile
#         photo_bytes = photoInput.file.read()

#         #image = Image.open(BytesIO(photo_bytes))

#         # Decodificar la imagen con OpenCV
#         image = np.frombuffer(photo_bytes, np.uint8)

#         if image is None:
#             raise HTTPException(status_code=400, detail="Failed to decode image. Please ensure it is a valid image file.")

#         # Asegurarse de que la imagen tiene las dimensiones correctas
#         if image.shape[:2] != (224, 224):
#             raise HTTPException(status_code=400, detail=image.shape)

#         # Agregar una dimensión para coincidir con las expectativas del modelo
#         photo_data = np.expand_dims(image, axis=0)

#         # Realizar la predicción con el modelo
#         model_output = model.predict(photo_data)

#         # Promediar todos los números del array de salida del modelo
#         processed_output = np.mean(model_output)

#         return {"processed_output": float(processed_output)}
    
#     except HTTPException as e:
#         raise e
#     except Exception as e:
#         raise HTTPException(status_code=500, detail=str(e))

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

@app.post("/upload")
async def create_upload_file(photoInput: UploadFile):
    try:
        # Obtener los bytes directamente desde el objeto UploadFile
        photo_bytes = await photoInput.read()

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

        return {"processed_output": float(processed_output)}
    
    except HTTPException as e:
        raise e
    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))

