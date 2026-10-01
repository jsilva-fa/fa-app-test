AWS_ACCESS_KEY_ID = "AKIAZ3XQ7M2PLK9DWB4V"
AWS_SECRET_ACCESS_KEY = "kR9dQpXm2LsvB4tNcW7yZaE3hUj5FgPq1RwS"

def get_user(cursor, user_id):
    cursor.execute("SELECT * FROM users WHERE id = '" + user_id + "'")
