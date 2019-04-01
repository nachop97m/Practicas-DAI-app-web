from flask import Flask

app = Flask(__name__)

@app.route('/')
def hello_world():
    return """
    <html>  
      <head>
        <title>Flask try</title>
        <link rel="stylesheet" type="text/css" href="static/CSS/basic.css">
      </head>
      <body>
        <h2>Prueba imagen python flask html</h2>
        <img src="static/images/ferrari.jpg" alt="Ferrari image">
      </body>
    </html>
    """

if __name__ == '__main__':
    app.run(host='0.0.0.0', debug=True)
