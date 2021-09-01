# from os import name
import sqlite3




def signup(username, password):
	connection = sqlite3.connect('database.db', check_same_thread = False)
	corsor = connection.cursor()
	corsor.execute("SELECT password FROM Users WHERE username = '{username_x}'".format(username_x = username))
	x = corsor.fetchone()


	if x is None:
		corsor.execute("INSERT INTO Users(username, password)VALUES('{user_name}', '{pass_word}')".format(user_name = username, pass_word = password))
		connection.commit()
		corsor.close()
		connection.close()
		return "Successfully signed up"
	else:
		return "User already exist"
		
	


def check_password(user_name):
	connection = sqlite3.connect('database.db', check_same_thread = False)
	corsor = connection.cursor()
	corsor.execute("SELECT password FROM Users WHERE username = '{user}'".format(user = user_name))
	pword = corsor.fetchone()[0]

	connection.commit()
	corsor.close()
	connection.close()
	return pword



def check_username(user_name):
	connection = sqlite3.connect('database.db', check_same_thread = False)
	corsor = connection.cursor()
	corsor.execute("SELECT username FROM Users WHERE username = '{user}'".format(user = user_name))
	user = corsor.fetchone()[0]

	connection.commit()
	corsor.close()
	connection.close()
	return user





def check_users():
	connection = sqlite3.connect('database.db', check_same_thread = False)
	corsor = connection.cursor()
	corsor.execute("SELECT username FROM Users ORDER BY id;")
	db_users = corsor.fetchall()
	users = []

	for x in range(len(db_users)):
		person = db_users[x][0]
		users.append(person)

	connection.commit()
	corsor.close()
	connection.close()
	return users


def display_user_in_session(user):
	connection = sqlite3.connect('database.db', check_same_thread = False)
	corsor = connection.cursor()
	corsor.execute("SELECT username FROM Users WHERE username = '{user}'".format(user = user))
	display = corsor.fetchone()[0]

	connection.commit()
	corsor.close()
	connection.close()
	display_message = "Welcome back, {username}".format(username = user)
	return display_message
