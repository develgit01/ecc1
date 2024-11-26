from flask import Flask, jsonify, request
import mysql.connector
from mysql.connector import Error

app = Flask(__name__)

# Configuración de la conexión a MySQL
db_config = {
    'user': 'your_username',
    'password': 'your_password',
    'host': 'your_host',
    'database': 'your_database'
}

def get_db_connection():
    try:
        return mysql.connector.connect(**db_config)
    except Error as e:
        app.logger.error(f"Error connecting to MySQL: {e}")
        raise

@app.route('/create_table', methods=['POST'])
def create_table():
    try:
        conn = get_db_connection()
        cursor = conn.cursor()
        cursor.execute('''
            CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL
            )
        ''')
        conn.close()
        return jsonify({'message': 'Table created successfully'}), 200
    except Error as e:
        app.logger.error(f"Error creating table: {e}")
        return jsonify({'message': 'Error creating table'}), 500

@app.route('/add_user', methods=['POST'])
def add_user():
    data = request.json
    name = data.get('name')
    email = data.get('email')

    if not name or not email:
        return jsonify({'message': 'Name and email are required'}), 400

    try:
        conn = get_db_connection()
        cursor = conn.cursor()
        cursor.execute('INSERT INTO users (name, email) VALUES (%s, %s)', (name, email))
        conn.commit()
        conn.close()
        return jsonify({'message': 'User added successfully'}), 200
    except Error as e:
        app.logger.error(f"Error adding user: {e}")
        return jsonify({'message': 'Error adding user'}), 500

@app.route('/get_users', methods=['GET'])
def get_users():
    try:
        conn = get_db_connection()
        cursor = conn.cursor(dictionary=True)
        cursor.execute('SELECT * FROM users')
        users = cursor.fetchall()
        conn.close()
        return jsonify(users), 200
    except Error as e:
        app.logger.error(f"Error fetching users: {e}")
        return jsonify({'message': 'Error fetching users'}), 500

@app.route('/test_db_connection', methods=['GET'])
def test_db_connection():
    try:
        conn = get_db_connection()
        if conn.is_connected():
            conn.close()
            return jsonify({'message': 'Database connection successful'}), 200
    except Error as e:
        app.logger.error(f"Error testing database connection: {e}")
        return jsonify({'message': 'Error testing database connection'}), 500

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=8080)
