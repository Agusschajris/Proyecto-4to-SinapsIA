# SinapsIA
Estamos desarrollando una página web dirigida a neurólogos especializados en epilepsia para facilitar su trabajo. En ella pueden tener resgistro de sus pacientes y además tiene una IA que integrada que detecta manifestaciones de epilepsia en electroencefalogramas.

### Integrantes y roles
- Agustina Schajris Garati (**Inteligencia artificial** - dataset y modelo)
- Álvaro Saravia (**Inteligencia artificial** - conexión del modelo con el back)
- Emma Killian (**Front-End y diseño**)
- Jano Portnoi (**Back-End**)

## Inteligencia Artificial
La IA está diseñada para analizar archivos .npy con el registro de los electroencefalogramas. No logramos usar un formato de entrada acorde a lo que reciben los médicos dado que la respuesta respecto a los formatos de la fundación que nos estuvo ayudando llegó en un momento que nos hacía imposible adaptar lo que ya teníamos hecho a un formato totalmente nuevo y desconocido para la entrega de proyecto final.

### Dataset
El dataset base utilizado es el [Guinea Bissau and Nigeria Epilepsy Dataset](https://www.kaggle.com/datasets/abhishekinnvonix/epilepsy-guinea-bissau-dataset), el cual fue procesado mayormente en el documento `procesamientoInicialDataset.ipynb`. Luego, el procesamiento continuó en el documento `X_dimensionalReduction.ipynb`, en el que PCA (análisis de componentes principales) fue aplicado y se reshapeó el dataset para el input del modelo. En el archivo `New data.ipynb` se comenzó a procesar nuevos datos provenientes del dataset [EEG data collected with Emotiv device in people with epilepsy and controls in Guinea-Bissau and Nigeria](https://zenodo.org/records/1252141) (solo la parte de Nigeria), sin embargo, a falta de tiempo, estos datos no se pudieron incluir en el dataset final. Dado el tamaño del dataset final, este no se encuentra subido a GitHub. Está guardado en una computadora del colegio (pesa 43GB).

### Modelo
El modelo es una red neuronal convolucional (CNN) de clasificación binaria. Esta hecha a partir de un modelo base ResNet-50 que además está preentrenado, y a la salida de este agrequé capas densas para que se ajustara a mis datos y devolviera un output conveniente para nuestra tarea. La salida consta de una neurona y su función de activación es la función sigmoide, la cual nos permite aproximaciones con porcentajes (mientras la salida se parece más a `0`, significa que hay menos probabilidades de tener epilepsia; si la salida se parece más a `1`, hay más probabilidades de tener epilepsia). Tensorflow fue la herramienta principal para el desarrollo de esta red neuronal. El armado del modelo y su entrenamiento y evaluación se encuentran en el archivo `MODELO FINAL.ipynb`

![Arquitectura del modelo](https://github.com/Agusschajris/Proyecto-4to-SinapsIA/blob/main/IA/Agus/Captura%20de%20pantalla%202023-11-22%20111647.png) 

### Conexión del modelo con el back
avaro saravia 


## Front-End y diseño


## Back-End
