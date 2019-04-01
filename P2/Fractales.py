from flask import Flask
from flask import request
from PIL import Image

app = Flask(__name__)

def renderizaMandelbrot(x1, y1, x2, y2, ancho, iteraciones, nombreFicheroPNG):
	# drawing area
	xa = x1
	xb = x2
	ya = y1 + 0.000001
	yb = y2
	maxIt = iteraciones
	# image size
	imgx = ancho
	imgy = int(abs (y2 - y1) * ancho / abs(x2 - x1));
	
	image = Image.new("RGB", (imgx, imgy))

	for y in range(imgy):
		zy = y * (yb - ya) / (imgy - 1)  + ya
		for x in range(imgx):
			zx = x * (xb - xa) / (imgx - 1)  + xa
			z = zx + zy * 1j
			c = z
			for i in range(maxIt):
				if abs(z) > 2.0: break 
				z = z * z + c

			if (i >= maxIt):
				image.putpixel((x, y), (0, 0, 0))
			else:
				image.putpixel((x, y), (i % 4 * 64, i % 8 * 32, i % 16 * 16))

	image.save(nombreFicheroPNG, "PNG")


@app.route('/fractales',methods=['GET'])
def fractal():

    #try:
        x1 = int(request.args.get('x1'))
        y1 = int(request.args.get('y1'))
        x2 = int(request.args.get('x2'))
        y2 = int(request.args.get('y2'))
        px = int(request.args.get('px'))

        renderizaMandelbrot(x1, y1, x2, y2, px, 100, 'static/images/mandel.png')

        return """
        <html>  
          <head>
            <title>Flask mandelbrot</title>
            <link rel="stylesheet" type="text/css" href="/static/CSS/basic.css">
          </head>
          <body>
            <h2>Fractal resultante: </h2>
            <img src="/static/images/mandel.png">
          </body>
        </html>
        """

    #except:
        #return """
        """<html>  
          <head>
            <title>Flask mandelbrot form</title>
            <link rel="stylesheet" type="text/css" href="/static/CSS/basic.css">
          </head>
          <body>
            <h2>Rellene los datos sobre el fractal</h2>
            <form action="/fractales" method="get">
                <label for="x1">x1</label>
                <input type="number" id="x1" name="x1"><br/>
                <label for="y1">y1</label>
                <input type="number" id="y1" name="y1"><br/>
                <label for="x2">x2</label>
                <input type="number" id="x2" name="x2"><br/>
                <label for="y2">y2</label>
                <input type="number" id="y2" name="y2"><br/>
                <label for="pixeles">Pixeles</label>
                <input type="number" id="px" name="px"><br/>
                <input type="submit" value="Enviar" />
            </form>
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
