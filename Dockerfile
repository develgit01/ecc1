# Usar una imagen base oficial de Python
FROM python:3.9-slim

# Establecer el directorio de trabajo en el contenedor
WORKDIR /app

# Copiar los archivos de la aplicación al contenedor
COPY . /app

# Instalar virtualenv y crear un entorno virtual
RUN pip install virtualenv
RUN virtualenv venv

# Activar el entorno virtual y actualizar pip
RUN . venv/bin/activate && pip install --upgrade pip

# Instalar las dependencias
RUN . venv/bin/activate && pip install --no-cache-dir -r requirements.txt

# Exponer el puerto en el que la aplicación Flask correrá
EXPOSE 5000

# Comando para ejecutar la aplicación Flask
CMD ["./venv/bin/python", "app.py"]
