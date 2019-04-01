from flask import Flask

app = Flask(__name__)


@app.route('/user/<nombre>',methods=['GET'])
def user(nombre):
    return """
    <html>  
      <head>
        <title>Flask try</title>
        <link rel="stylesheet" type="text/css" href="/static/CSS/basic.css">
      </head>
      <body>
        <h2>Estas viendo el contenido de """ + nombre + """</h2>
        <img src="/static/images/"""+ nombre +""".jpg" alt=\" """+ nombre +' image'+"""\" width="1200">
      </body>
    </html>
    """


@app.errorhandler(404)
def page_not_found(error):
    return """
    <html>  
      <head>
        <title>Flask try</title>
        <link rel="stylesheet" type="text/css" href="/static/CSS/basic.css">
      </head>
      <body>
        <h2>Error 404: Page Not Found</h2>
      </body>
    </html>
    """



if __name__ == '__main__':
    app.run(host='0.0.0.0', debug=True)
