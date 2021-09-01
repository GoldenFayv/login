import sqlite3

conn = sqlite3.connect('database.db', check_same_thread = True)
cursor = conn.cursor()

cursor.execute(
    """
    CREATE TABLE Users(
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username text NOT NULL,
        password text NOT NULL,
        DevName text
    );
    """
)

conn.commit()
cursor.close()
conn.close()