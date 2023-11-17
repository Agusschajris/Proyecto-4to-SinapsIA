# SinapsIA
Estamos desarrollando una página web dirigida a neurólogoas especializados en epilepsia para facilitar su trabajo. En ella pueden tener resgistro de sus pacientes y además tiene una IA que integrada que detecta manifestaciones de epilepsia en electroencefalogramas.

## Inteligencia Artificial
La IA está diseñada para analizar archivos .npy con el registro de los electroencefalogramas. No logramos usar un formato de entrada acorde a lo que reciben los médicos dado que la respuesta respecto a los formatos de la fundación que nos estuvo ayudando llegó en un momento que nos hacía imposible adaptar lo que ya teníamos hecho a un formato totalmente nuevo y desconocido para la entrega de proyecto final.

### Dataset
El dataset base utilizado es el [Guinea Bissau and Nigeria Epilepsy Dataset](https://www.kaggle.com/datasets/abhishekinnvonix/epilepsy-guinea-bissau-dataset), el cual fue procesado mayormente en el documento `procesamientoInicialDataset.ipynb`. Luego, el procesamiento continuó en el documento `X_dimensionalReduction.ipynb`, en el que PCA fue aplicado y se reshapeó el dataset para el input del modelo. En el archivo `New data.ipynb` se comenzó a procesar nuevos datos provenientes del dataset [EEG data collected with Emotiv device in people with epilepsy and controls in Guinea-Bissau and Nigeria](https://zenodo.org/records/1252141) (solo la parte de Nigeria)
