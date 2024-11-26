from flask import Flask, jsonify, request
import mysql.connector

app = Flask(__name__)

# Configuración de la conexión a MySQL
db_config = {
    'user': 'your_username',
    'password': 'your_password',
    'host': 'your_host',
    'database': 'your_database'
}

def get_db_connection():
    return mysql.connector.connect(**db_config)

@app.route('/create_table', methods=['POST'])
def create_table():
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

@app.route('/add_user', methods=['POST'])
def add_user():
    data = request.json
    name = data.get('name')
    email = data.get('email')

    if not name or not email:
        return jsonify({'message': 'Name and email are required'}), 400

    conn = get_db_connection()
    cursor = conn.cursor()
    cursor.execute('INSERT INTO users (name, email) VALUES (%s, %s)', (name, email))
    conn.commit()
    conn.close()
    return jsonify({'message': 'User added successfully'}), 200

@app.route('/get_users', methods=['GET'])
def get_users():
    conn = get_db_connection()
    cursor = conn.cursor(dictionary=True)
    cursor.execute('SELECT * FROM users')
    users = cursor.fetchall()
    conn.close()
    return jsonify(users), 200

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=8080)
