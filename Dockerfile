# Usar una imagen base de Python
FROM python:3.9-slim

# Establecer el directorio de trabajo en el contenedor
WORKDIR /app

# Copiar el script de Python al contenedor
COPY show_table_data.py .

# Copiar la base de datos SQLite al contenedor
COPY database.db .

# Instalar las dependencias necesarias (si las hay)
# RUN pip install -r requirements.txt

# Ejecutar el script de Python
CMD ["python", "show_table_data.py"]
