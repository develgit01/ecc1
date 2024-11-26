import sqlite3

def create_database():
    # Conectar a la base de datos SQLite (o crearla si no existe)
    conn = sqlite3.connect('database.db')
    cursor = conn.cursor()

    # Crear la tabla users
    cursor.execute('''
        CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY,
            name TEXT NOT NULL,
            age INTEGER NOT NULL
        )
    ''')

    # Insertar algunos datos de ejemplo
    cursor.execute('INSERT INTO users (name, age) VALUES ("Alice", 30)')
    cursor.execute('INSERT INTO users (name, age) VALUES ("Bob", 25)')
    cursor.execute('INSERT INTO users (name, age) VALUES ("Charlie", 35)')

    # Guardar los cambios y cerrar la conexión
    conn.commit()
    conn.close()


def show_table_data():
    # Conectar a la base de datos SQLite
    conn = sqlite3.connect('database.db')
    cursor = conn.cursor()

    # Ejecutar una consulta para obtener los datos de la tabla
    cursor.execute('SELECT * FROM users')
    rows = cursor.fetchall()

    # Mostrar los datos
    for row in rows:
        print(row)

    # Cerrar la conexión
    conn.close()

if __name__ == "__main__":
    create_database()
    show_table_data()
