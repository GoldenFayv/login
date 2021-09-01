from flask import Flask, render_template, request, redirect, url_for, session, flash, g
import model

app = Flask(__name__)

app.secret_key = 'jjeo20ilmlwk'

username = ''
user = model.check_users()


@app.route('/', methods = ['GET'])
def home():
    if 'username' in session:
        g.user = session['username']
        return render_template('home2.html')
    return render_template('NotInSession.html')
    



@app.route('/signup', methods = ["GET", "POST"])
def signup():
    if request.method == "GET":
        if "username" in session:
            flash("Already logged in")
            return render_template("signup.html")
        return render_template("signup.html")
    else:
        uname = request.form["username_sign"]
        pword = request.form["password_sign"]
        confirm_pword = request.form["cpassword_sign"]
        dev = request.form["devName_sign"]
        if confirm_pword == pword: 
            if dev == "Golden".lower():  
                flash(model.signup(uname, pword))
                # model.signup(uname, pword)
                return redirect(url_for("home"))
            # else:
            return render_template("signup.html", msg = "Wrong Dev Name")
        return render_template("signup.html", msg = "Password doesn't match")


@app.route('/login', methods = ["GET", "POST"])
def login():
    if request.method == "GET":
        if 'username' in session:
            flash("Already logged in")
        return render_template("login.html")
    else:
        session.pop('username', None)
        uname = request.form["u_login"]
        pword = request.form["p_login"]
        db_password = model.check_password(uname)
        db_username = model.check_username(uname)
        if pword == db_password and uname == db_username: 
            session['username'] = request.form['u_login']
            return render_template("home2.html", msg = model.display_user_in_session(uname))
        else:
            return render_template("login.html", msg = "Wrong username/password")



@app.route('/getsession')
def get_session():
    if 'username' in session:
        return session['username']
    return redirect(url_for("login"))


@app.route('/logout')
def logout():
    session.pop('username', None)
    flash("Logged out successfully")
    return redirect(url_for("login"))

@app.before_request
def before_request():
    g.username = None
    if 'username' in session:
        g.username = session['username']






if __name__ == '__main__':
    app.run(port=7000, debug=True)
