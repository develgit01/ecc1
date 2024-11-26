import sqlite3

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
    show_table_data()
