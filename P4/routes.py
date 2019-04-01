from flask import Flask, render_template, redirect, url_for, request, session
from pickleshare import *

app = Flask(__name__,template_folder='./templates')
app.secret_key = '0987654321'


@app.route('/',methods=['GET'])
def user():

    if 'user' in session:
        session.clear()

    return render_template('index.html')

@app.route('/login',methods = ['POST'])
def login():

    db = PickleShareDB('/vagrant/Practicas/P4/p4.db')
    
    user = request.form['user']
    pwd = request.form['pwd']

    if user in db:

        if pwd == db[user]['pwd']:
        
            session['user'] = user
            session['pagina1'] = 'models'
            session['pagina2'] = 'modelx'
            session['pagina3'] = 'model3'
            session['pagina1text'] = 'TESLA MODEL S'
            session['pagina2text'] = 'TESLA MODEL X'
            session['pagina3text'] = 'TESLA MODEL 3'

            return redirect(url_for('users',user = user, session = session))

        else:

            return render_template('index.html')

    else:
        return render_template('index.html')

@app.route('/register',methods = ['POST'])
def register():

    db = PickleShareDB('/vagrant/Practicas/P4/p4.db')
    user = request.form['user']
    name = request.form['nm']
    pwd = request.form['pwd']
    ct = request.form['ct']
    models = request.form['models']

    if user in db:
        return redirect(url_for('user'))

    else:

        db[user] = { 'user': user, 'name':name, 'pwd': pwd, 'ct': ct, 'models': models }
        
        session['user'] = user
        session['pagina1'] = 'models'
        session['pagina2'] = 'modelx'
        session['pagina3'] = 'model3'
        session['pagina1text'] = 'TESLA MODEL S'
        session['pagina2text'] = 'TESLA MODEL X'
        session['pagina3text'] = 'TESLA MODEL 3'

        return redirect(url_for('users',user = user, session = session))

@app.route('/alter',methods = ['POST'])
def alter():

    user = session['user']
    name = request.form['nm']
    pwd = request.form['pwd']
    ct = request.form['ct']
    models = request.form['models']

    db = PickleShareDB('/vagrant/Practicas/P4/p4.db')
    db[user] = { 'user': user, 'name': name, 'pwd': pwd, 'ct': ct, 'models': models }
    
    session['user'] = user
    session['pagina1'] = 'models'
    session['pagina2'] = 'modelx'
    session['pagina3'] = 'model3'
    session['pagina1text'] = 'TESLA MODEL S'
    session['pagina2text'] = 'TESLA MODEL X'
    session['pagina3text'] = 'TESLA MODEL 3'

    return redirect(url_for('users',user = user, session = session))

@app.route('/profile/<user>')
def profile(user):

    db = PickleShareDB('/vagrant/Practicas/P4/p4.db')
    
    if 'user' in session:
        usern = db[user]['user']
        nm = db[user]['name']
        pwd = db[user]['pwd']
        ct = db[user]['ct']
        models = db[user]['models']

        return render_template('profile.html',user = usern, name = nm, pwd = pwd, ct = ct, models = models)

    else:
        return redirect (url_for('user'))

@app.route('/users/<user>')
def users(user):

    if 'user' in session:
        if session['user'] == user:
            session['pagina3'] = session['pagina2']
            session['pagina2'] = session['pagina1']
            session['pagina1'] = 'users'
            session['pagina3text'] = session['pagina2text']
            session['pagina2text'] = session['pagina1text']
            session['pagina1text'] = 'INICIO: ' + user

    return render_template('user.html', user = user, session=session)

if __name__ == '__main__':
    app.run(host='0.0.0.0', debug=True)
