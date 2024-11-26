from flask import Flask
import mysql.connector

app = Flask(__name__)

# Configuración de la conexión a MySQL
db_config = {
    'user': 'root',
    'password': 'example',
    'host': 'db',
    'database': 'test_db'
}

@app.route('/')
def hello_world():
    try:
        connection = mysql.connector.connect(**db_config)
        cursor = connection.cursor()
        cursor.execute("SELECT 1")
        cursor.close()
        connection.close()
        return 'Hello, World! MySQL is connected.'
    except mysql.connector.Error as err:
        return f'Error: {err}'

if __name__ == '__main__':
    app.run(host='0.0.0.0')
