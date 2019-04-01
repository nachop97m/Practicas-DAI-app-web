
<?php


function headHTML(){
echo <<< HTML
<!DOCTYPE html>
<html>
<head>
    
    <meta charset="utf-8">
    <meta name="author" content="Juanma y Nacho">
    <meta name="keywords" content="html, universidad, programacion, musica, Ozuna">
    <title>OZUNA</title>
    <link rel="icon" sizes="any" href="imagenes/rgs.jpg">
    <link rel="stylesheet" href="Principal.css">
	
</head>

<body>

HTML;
    
    
}



function headerHTML(){
echo <<< HTML

    <header>

        <img id="imgTitulo" src="imagenes/ozuna-odisea-the-album-preview.jpg">


        <nav id="nav1">

            <ul id="listaHori">
                
                <li> 
                    <a href="index.php?p=0"> Informacion del Artista</a>
                </li>

                <li> 
                    <a href="index.php?p=1" > Conciertos </a>

                </li>

                <li>
                    <h1>OZUNA</h1>
                </li>

                <li>
                    <a href="index.php?p=2"> Discografia </a>
                </li>

                   <li id="linktienda">
                    <a href="index.php?p=3"> Tienda </a>
HTML;

                    
            
echo <<< HTML
                    
                </li>
                
                
                

            </ul>


        </nav>

    </header>

HTML;
    
}

function loginHTML2(){
    
    
    
    
    if (isset($_SESSION['usuario'])){
echo <<< HTML
        
        <a href='index.php' id ="1"> Logout </a>
HTML;
    
    }else{
echo <<< HTML
        
        <a href='index.php?p=5' id="2"> Login </a>
HTML;
    }
    
    
    
        
        
}

function cerrarSesion(){
    
    
    
    
    
}


function mainPrincipalInformacionHTML(){
    
echo <<< HTML
    
    <main>
    <h2 id="tituloPagina"> Informacion del Artista</h2>
    
    <nav>
    <ul>
    
HTML;
   
            require_once("credenciales.php");
            $db= mysqli_connect(DB_HOST,DB_USER,DB_PASSWD,DB_DATABASE);
     
            if ($db){
                
                $tam=mysqli_query($db,"SELECT count(id) FROM informacionArtista");
                
                $tam=mysqli_fetch_array($tam);
                
                for ($i = 1; $i <= $tam['count(id)']; $i++) {
                    
                    $res1= mysqli_query($db,"SELECT indice FROM informacionArtista WHERE id= '$i' ");
                    if ($res1){
                        
                        
                        $tupla1=mysqli_fetch_array($res1);
                        $in='#'.$i;
                    
                        echo "
                        
                            <li> 
                                <a href='$in'> {$tupla1['indice']} </a>            
                            </li>
           
                        ";
                        
                    }
        
                    
                }
                
               
            }


    
echo "<article>";       
            
            if ($db){
                
                $tam=mysqli_query($db,"SELECT count(id) FROM informacionArtista");
                
                $tam=mysqli_fetch_array($tam);
                
                
                for ($i = 1; $i <= $tam['count(id)']; $i++) {
                    
                    $res1= mysqli_query($db,"SELECT titulo,texto FROM informacionArtista WHERE id= '$i' ");
                    if ($res1){
                
                        $tupla1=mysqli_fetch_array($res1);
echo <<< HTML
                        
                        <section id="$i">
            
                            <h3>{$tupla1['titulo']}</h3>

                            <p>{$tupla1['texto']}</p>
                
                        </section>
                        
                        
HTML;
                    }
                }
            }
    
    
            mysqli_close($db);
    

echo  " </article> </main>";
               
}




function mainPrincipalConciertosHTML(){
echo <<< HTML
 <main>


        <h2 id="tituloPagina"> Conciertos Pasados</h2>

        <nav>
        <ul>
            
HTML;
    
    
            require_once("credenciales.php");
            $db= mysqli_connect(DB_HOST,DB_USER,DB_PASSWD,DB_DATABASE);
     
            if ($db){
                
                $tam=mysqli_query($db,"SELECT count(id) FROM conciertos");
                
                $tam=mysqli_fetch_array($tam);
                
                for ($i = 1; $i <= $tam['count(id)']; $i++) {
                    
                    $res1= mysqli_query($db,"SELECT indice FROM conciertos WHERE id= '$i' ");
                    if ($res1){
                        
                        
                        $tupla1=mysqli_fetch_array($res1);
                        $in='#section'.$i;
                    
                        echo "
                        
                            <li> 
                                <a href='$in'> {$tupla1['indice']} </a>            
                            </li>
           
                        ";
                        
                    }
        
                    
                }
                
               
            }
    
echo "<article>";  
    
    
            if ($db){
                
                $tam=mysqli_query($db,"SELECT count(id) FROM conciertos");
                
                $tam=mysqli_fetch_array($tam);
                
                
                for ($i = 1; $i <= $tam['count(id)']; $i++) {
                    $in='section'.$i;
                    $res1= mysqli_query($db,"SELECT titulo,texto,imagen FROM conciertos WHERE id= '$i' ");
                    if ($res1){
                
                        $tupla1=mysqli_fetch_array($res1);
echo <<< HTML
                        
                        <section id="$in">
            
                            <h3>{$tupla1['titulo']}</h3>

                            <p>{$tupla1['texto']}</p>
                            <img src="{$tupla1['imagen']}" >
                
                        </section>
                        
                        
HTML;
                    }
                }
            }
    
    
    
    
    mysqli_close($db);
    
echo "</article></main>";
}


function mainPrincipalTiendaHTML(){
      
    require_once("credenciales.php");
    $db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_DATABASE);
    
    $result = mysqli_query($db, "SELECT id, nombre FROM productos"); 

echo <<< HTML
 <main>


        <h2 id="tituloPagina"> Discos del artista disponibles</h2>

        <nav>

            <ul>
HTML;
            while ($row = mysqli_fetch_row($result)){
                
                echo "<li>"; 
                echo "<a href=\"#{$row[0]}\" > {$row[1]}</a>";
                echo "</li>";
                
            }
    
echo <<< HTML
             </ul>

        </nav>

        <article>

HTML;
    
        $result = mysqli_query($db, "SELECT id, nombre, precio, imagen, enlace FROM productos");
    
        while ($row = mysqli_fetch_row($result)){
            
            echo "<section id = \"{$row[0]}\">";
               
            echo "<h3>{$row[1]}</h3>";
            echo "<img src=\"{$row[3]}\">";
            echo "<a href=\"{$row[4]}\" > Comprar: {$row[2]} euros</a>";

            echo "</section>";
        
        }
            
echo <<< HTML

        </article>

 </main>
    
HTML;
    
}



function mainTiendaFormulario($disco){
echo <<< HTML

<main>
	
        
    
        <form action="procesarTienda.php" method="post">


        <fieldset>
            <legend> Datos del Disco </legend>
            <br><input type="text" name="disco" value="$disco" /><br>
            
        </fieldset>
    
        <fieldset>
            <legend> Datos del comprador</legend>
        
            <br> Nombre <br>
            <input type="text" name="nombre" />
        
            <br>Apellidos: <br>
            <input type="text " name="apellidos" />
            
            <br>Email <br>
            <input type="email" name="email" />
            
            <br>Telefono <br>
            <input type="tel" name="telefono" />
        
            <br>Dirección Envio<br>
            <input type="text" name="direccionEnvio" />
        
        </fieldset>
        
        
        <fieldset>
            <legend> Tipo de Pago </legend>
            
            <br> Modo de pago: <br>
                <input type="radio" name="tipoPago" value="tarjetaDeCredito" />
                Tarjeta de Credito <br>
                <input type="radio" name="tipoPago" value="reembolso" />
                Reembolso <br>
            
            
                <br>Elije el tipo de tarjeta:<br>
                <input type="radio" name="metodo" value="visa" />
                Visa <br>

                <input type="radio" name="metodo" value="mastercard" />
                Mastercard <br>
                
                Numero tarjeta: <br>
                <input type="text" name="numeroTarjeta" />
		
                <br>Fecha de Caducidad (mm/yyyy): <br>
                <input type="text" name="fechaCaducidad" />
            
                <br>Codigo CVC: <br>
                <input type="text" name="codigoCVC" />
            
            
        </fieldset>
        

            
            <br><br>
            <input type="submit"  value="Realizar suscripción" />
            <input type="reset" value="Limpiar valores" />
            
            
        </form>
                
</main>

HTML;
    

}



function mainPrincipalDiscografiaHTML(){
echo <<< HTML
 <main>

        <h2 id="tituloPagina"> Discografia</h2>

        <nav>

            <ul>
HTML;
            
           
            require_once("credenciales.php");
            $db= mysqli_connect(DB_HOST,DB_USER,DB_PASSWD,DB_DATABASE);
     
            if ($db){
                
                $tam=mysqli_query($db,"SELECT count(id) FROM discografia");
                
                $tam=mysqli_fetch_array($tam);
                
                for ($i = 1; $i <= $tam['count(id)']; $i++) {
                    $res1= mysqli_query($db,"SELECT titulo FROM discografia WHERE id= '$i' ");
                    if ($res1){
                        $in='#s'.$i;
                        $tupla1=mysqli_fetch_array($res1);
echo <<< HTML
                        
                        <li>
                            <a href='$in'> {$tupla1['titulo']} </a>
                        </li>
                        
                        
HTML;
                    }
                    
                }
                
                
                
            }
    
echo "<article id='imagenes'>";
    
        if ($db){
            
            $tam=mysqli_query($db,"SELECT count(id) FROM discografia");
                
            $tam=mysqli_fetch_array($tam);
                
            
            for ($i = 1; $i <= $tam['count(id)']; $i++) {
                $in='s'.$i;
                $res1= mysqli_query($db,"SELECT texto,imagen FROM discografia WHERE id= '$i' ");
                if ($res1){
                
                        $tupla1=mysqli_fetch_array($res1);
echo <<< HTML
                        
                        <section id="$in">
            
                            <img src="{$tupla1['imagen']}">
                            

                            <p>{$tupla1['texto']}</p>
                
                        </section>
                        
                        
HTML;
                    }
                }
            
        }
    
            
mysqli_close($db);
echo "</article> </main>";
}


function loginHTML(){
echo <<< HTML
 

    <main>
        <ul>
            <li> 
                <a href="index.php?p=6" > Administrador </a>
            </li>
            
            <li>
                <a href="index.php?p=50" > Gestor de compras </a>
            </li>
        
        </ul>
    
    </main>
    
HTML;
}



function asideHTML(){
echo <<< HTML

    <aside>

        <h2 id="event">ODISEA World Tour 2018</h2>
        <section id="evt">
            <img src="imagenes/muf.jpg" alt="MUF2018 - Torremolinos, Malaga" width="300">
        </section>
        <table id="eventTabla" border="1">
            <tr id="tabind">
                <th>Fechas</th>
                <th>Pais</th>
            </tr>
            <tr id="prow">
                <td id="cell1">16 Junio</td>
                <td id="cellr">Republica Dominicana</td>
            </tr>
            <tr id="irow">
                <td id="cell1">30 de Junio</td>
                <td id="cellr">Costa Rica</td>
            </tr>
            <tr id="prow">
                <td id="cell1">10 Julio - 8 Agosto</td>
                <td id="cellr">Europa</td>
            </tr>            
            <tr id="irow">
                <td id="cell1">7 Septiembre - 18 Noviembre</td>
                <td id="cellr">EEUU</td>
            </tr>
            <tr id="prow">
                <td id="cell1">22 Noviembre - 9 Diciembre</td>
                <td id="cellr">Mexico</td>
            </tr>

        </table>

    </aside>


HTML;

}

function footerHTML(){
echo <<< HTML
    <footer>

        <nav id="nav3">

            <ul id="listaHori">
                <li> 
                    (C) Juan Manuel Lopez Castro
                </li>

                <li> 
                    (C) Ignacio Pineda Mochon

                </li>

                <li>
                <a href=""> 3 </a>
                </li>

                <li>
                <a href=""> 4 </a>
                </li>
                
                <li>
                <a href=""> 5 </a>
                </li>

             </ul>

        </nav>


    </footer>

</body>
</html>




HTML;
    
}



function administradorHTML(){
echo <<< HTML

<main>
<form action="index.php?p=7" method="post">
            
            <fieldset>
        
                <legend> Identifiquese</legend>
                <label> Usuario </label><br>
                <input type="text" name="usuario"> <br>
                <label> Clave </label> <br>
                <input type="password" name="pwd"> <br>
                
                
                <input type="submit" name="login" value="Login">
            
        
        
            </fieldset>
           
        </form>

</main>
HTML;
    
    
}

function opccionesAdminHTML($usuario,$clave){

    
    $existe=comprobarAdmin($usuario,$clave);
    
    if ($existe){
        session_start();
        $_SESSION["usuario"]=$usuario;
        loginHTML2();
        
        
echo <<< HTML
   
<main>        
        
        <li> <a href="index.php?p=8">  Editar informacion del artista</a></li>
        <li> <a href="index.php?p=10"> Editar la discografia del grupo </a></li>    
        <li> <a href="index.php?p=11"> Editar los conciertos del grupo </a></li>       
        <li> <a href="index.php?p=12"> Editar usuarios </a></li>
        <li> <a href="index.php?p=13"> Visualizar log de la aplicación </a></li>
        <li> <a href="index.php?p=31"> Crear copia de seguridad</a></li>
        <li> <a href="index.php?p=33"> Restaurar copia de seguridad</a></li>
        <li> <a href="index.php?p=35"> Borrar base de datos</a></li>
</main>
        
        
HTML;
        
        
        
        
    }
        
    else{
        

        header("Refresh: 3; url=index.php?p=5");
        echo "contraseña incorrecta, redirigiendo en 3 segundos";
        
        
        
    }
        
            
            

}


function comprobarAdmin($usuario,$clave){
    
            require_once("credenciales.php");
            $db= mysqli_connect(DB_HOST,DB_USER,DB_PASSWD,DB_DATABASE);
            
            if ($db){
       
                $nombre= $usuario;
                $res=mysqli_query($db,"SELECT login,password FROM usuarios WHERE login= '$nombre' ");
                
                if ($res){
                
                    $tupla=mysqli_fetch_array($res);
                    
                    
                    if ($clave == $tupla['password']){
                        
                        
                        $admin=mysqli_query($db,"SELECT tipo FROM usuarios WHERE login= '$nombre' ");
                        $tupla=mysqli_fetch_array($admin);
                        if ( $tupla[0] == 1){
                            
                            
                            $fecha=getdate();
                            $fecha1=$fecha['year'] .'-' .$fecha['mon'] . '-' .$fecha['mday']. ' ' .$fecha['hours']. ':' .$fecha['minutes'] . ':' .$fecha['seconds'];
                            
                            $estado=1;
                            
                            mysqli_query($db,"INSERT INTO log (login,fecha,estado) VALUES('$nombre','$fecha1','$estado')") ;
                            mysqli_close($db);
                            return true;
                            

                        }
                    }else{
                        
                        
                        $fecha=getdate();
                $fecha1=$fecha['year'] .'-' .$fecha['mon'] . '-' .$fecha['mday']. ' ' .$fecha['hours']. ':' .$fecha['minutes'] . ':'    .$fecha['seconds'];                
                $estado=0;
                            
                mysqli_query($db,"INSERT INTO log (login,fecha,estado) VALUES('$usuario','$fecha1','$estado')") ;
                mysqli_close($db);
                        
                        
                        
                        
                    }
                }
            }
            
    
            
            return false;
    
    
    
}



function modificarUsuariosHTML(){
    
   
            
            require_once("credenciales.php");
            $db= mysqli_connect(DB_HOST,DB_USER,DB_PASSWD,DB_DATABASE);
        
            
        
            if ($db){
                
                $res=mysqli_query($db,"SELECT * from usuarios");
                
                if ($res){
                    
                    //si hay alguna tupla
                    if (mysqli_num_rows($res) > 0){
                        
                        echo "<h2> Lista de usuarios de la base de datos </h2>
                        <main>
                        <table>
  	
		                  
		                  <tr>
			             <th>NOMBRE</th>
			             <th>APELLIDOS</th>
			             <th>TELEFONO</th>
			             <th>EMAIL</th>
			             <th>LOGIN</th>
			             <th>PASSWORD</th>
                         <th>TIPO</th>
		                  </tr>
		                  

                        ";
                        while ($row=mysqli_fetch_array($res)){
                            
                                echo "<tr>";
	                            echo"<td>{$row['nombre']}</td>";
                                echo"<td>{$row['apellidos']}</td>";
                                echo"<td>{$row['telefono']}</td>";
                                echo"<td>{$row['email']}</td>";
                                echo"<td>{$row['login']}</td>";
                                echo"<td>{$row['password']} </td>";
                                echo"<td>{$row['tipo']}</td>";
                                echo "</tr>";
                                
	                           
                            
                            }
                

                        echo "
                       
                        </table>";
                        
                        
                        modificarUsuarios();
                        mysqli_close($db);
                        
                    }else{
                        
                        echo "No hay ningun usuario en la base de datos";
                        
                    }
                    
                    
                    
                    
                    
                    
                }else{
                    
                    header("Refresh: 3; url=paginaInicio.php");
                    echo "Algo ha fallado,redirigiendo en 3 segundo";
                }
                
                
                
            }else{
                
                
                header("Refresh: 3; url=paginaInicio.php");
                echo "fallo en la conexion a la base de datos";
                
            }
        
  
    
}

function modificarUsuarios(){
echo <<< HTML

    
        
        
    <form action="index.php?p=30" method="post">
    
    
        <fieldset>
            
            
            <legend> Datos del usuario</legend>
            
            
            
            <br><label>Nombre </label><br>
            <input type="text" name="nombre" />
            
            <br><label> Apellidos</label><br>
            <input type="text" name="apellidos" />
            
            <br><label> Correo </label><br>
            <input type="email" name="email" />
            
            
            <br><label>Login </label><br>
            <input type="text" name="login" />
            
            <br><label> Clave </label><br>
            <input type="password" name="password" />
            
            
            <br><label> Telefono </label><br>
            <input type="text" name="telefono" />
            
            <br><label> 
            
            <br><label> Tipo </label><br>
            <input type="text" name="tipo" placeholder="1->administrador/2->gestor de compras" />
    
        
        </fieldset>
    
        
        
        
        <br><br>
		<input type="submit" value="Seguir" />
		<input type="reset" value="Limpiar valores" />
    

    
    
    
    </form>
    
    
    </main>



HTML;
    
}


function mostrarlogHTML(){
    
   
            
            require_once("credenciales.php");
            $db= mysqli_connect(DB_HOST,DB_USER,DB_PASSWD,DB_DATABASE);
        
            
        
            if ($db){
                
                $res=mysqli_query($db,"SELECT * from log");
                
                if ($res){
                    
                    //si hay alguna tupla
                    if (mysqli_num_rows($res) > 0){
                        
                        echo "<h2> Log de la aplicacion </h2>";
                        
                        echo "<ul>";
                        for($i=0;$i<mysqli_num_rows($res);$i++){
                            
                            $tupla=mysqli_fetch_array($res);
                            echo "<li>";
                                echo $tupla['login'],"  ",$tupla['fecha'],"     ", $tupla['estado'];
                            echo "</li>";
                            
                            
                        }
                        
                        echo "</ul>";
                        
                        mysqli_close($db);
                        
                    }else{
                        
                        echo "No hay log de la aplicacion";
                        
                    }
                    
                    
                    
                    
                    
                    
                }else{
                    
                    header("Refresh: 3; url=index.php?p=0");
                    echo "Algo ha fallado,redirigiendo en 3 segundo";
                }
                
                
                
            }else{
                
                
                header("Refresh: 3; url=index.php?p=0");
                echo "fallo en la conexion a la base de datos";
                
            }
        
  
    
}


function editarInfoArtistaHTML(){
    
echo <<< HTML
    
    <main>
    <h2 id="tituloPagina"> Informacion del Artista</h2>
    
    <nav>
    <ul>
    
HTML;
    
    
   
            require_once("credenciales.php");
            $db= mysqli_connect(DB_HOST,DB_USER,DB_PASSWD,DB_DATABASE);
     
            if ($db){
                
                $tam=mysqli_query($db,"SELECT count(id) FROM informacionArtista");
                
                $tam=mysqli_fetch_array($tam);
                
                for ($i = 1; $i <= $tam['count(id)']; $i++) {
                    
                    $res1= mysqli_query($db,"SELECT indice FROM informacionArtista WHERE id= '$i' ");
                    if ($res1){
                        
                        
                        $tupla1=mysqli_fetch_array($res1);
                        $in='#'.$i;
                    
                        echo "
                        
                            <li> 
                                <a href='$in'> {$tupla1['indice']} </a>  
                                <a href='index.php?p=14&id=$i' > Borrar </a>
                                <a href='index.php?p=15&id=$i' > Editar </a>
                            </li>
           
                        ";
                        
                    }
        
                    
                }
                
                echo "
                    
                    <li>
                        <a href='index.php?p=17&id={$tam['count(id)']}'> Añadir seccion </a>
                    <li>                
                
                ";
                
               
            }
    
        


    
echo "<article>";       
            
            if ($db){
                
                $tam=mysqli_query($db,"SELECT count(id) FROM informacionArtista");
                
                $tam=mysqli_fetch_array($tam);
                
                
                for ($i = 1; $i <= $tam['count(id)']; $i++) {
                    
                    $res1= mysqli_query($db,"SELECT titulo,texto FROM informacionArtista WHERE id= '$i' ");
                    if ($res1){
                
                        $tupla1=mysqli_fetch_array($res1);
echo <<< HTML
                        
                        <section id="$i">
            
                            <h3>{$tupla1['titulo']}</h3>

                            <p>{$tupla1['texto']}</p>
                
                        </section>
                        
                        
HTML;
                    }
                }
            }
    
            mysqli_close($db);
    

echo  " </article> </main>";
               
}


function borrarInformacionArtista($id){
    
    require_once("credenciales.php");
    $db= mysqli_connect(DB_HOST,DB_USER,DB_PASSWD,DB_DATABASE);
    
    if ($db){
    
        $res=mysqli_query($db,"DELETE from informacionArtista WHERE id='$id'");
            
        
        if ($res){
            
            $res1=mysqli_query($db,"UPDATE informacionArtista SET id=id-1 WHERE id >'$id' ") ;
            
            
            
            header("Refresh: 3; url=index.php?p=8");
            echo "
                
                <main>
                seccion borrada con exito
                </main>";
        }
            
    }
      
    mysqli_close($db);
    
    
    
}

function añadirEdicionLog($nombreTabla){
    
    
    
    
}


function modificarInfoArtista($id){
    
    require_once("credenciales.php");
    $db= mysqli_connect(DB_HOST,DB_USER,DB_PASSWD,DB_DATABASE);
    
    if ($db){
    
        $res=mysqli_query($db,"SELECT * from informacionArtista WHERE id='$id'");
            
        
        if ($res){
            
            $tupla=mysqli_fetch_array($res);
        }
            
    }
      
    mysqli_close($db);    
    
        
echo <<< HTML
<main>
        <form action="index.php?p=16&id=$id" method="post" id="formulario">
    
    
        <fieldset>
            
            
            <legend> Datos para modificar </legend>
            
            <br><label>Titulo del indice</label><br>
            <input type="text" value="{$tupla['indice']}" name="indice" />
            
            <br><label> Titulo del texto</label><br>
            <input type="text" value="{$tupla['titulo']}" name="titulo" />
            
            <br><label> Texto </label><br>
            <textarea rows="30" cols="70" name ="texto" form="formulario"> {$tupla['texto']}</textarea>
            
        </fieldset>
        
            
    
        
        
        
        <br><br>
		<input type="submit" value="Seguir" />
		<input type="reset" value="Limpiar valores" />
    

    
    
    
        </form>
        </main>

HTML;
    
}




function editarInformacionArtista($id){
    
    require_once("credenciales.php");
    $db= mysqli_connect(DB_HOST,DB_USER,DB_PASSWD,DB_DATABASE);
    
    if ($db){
        
        $indice=$_POST["indice"];
        $titulo=$_POST["titulo"];
        $texto=$_POST["texto"];
       
                
        $res=mysqli_query($db,"UPDATE informacionArtista SET indice='$indice',titulo='$titulo',texto='$texto' WHERE id='$id' ") ;
        
        if ($res){
           
            header("Refresh: 3; url=index.php?p=8");
            echo "
                <main>
                seccion editada con exito
                </main>";
            
            
        }
        
    }
    
    
    
}


function añadirInformacion($id){
echo <<< HTML

<main>
        <form action="index.php?p=18&id=$id" method="post" id="formulario">
    
    
        <fieldset>
            
            
            <legend> Datos para modificar </legend>
            
            <br><label>Titulo del indice</label><br>
            <input type="text" name="indice" />
            
            <br><label> Titulo del texto</label><br>
            <input type="text" name="titulo" />
            
            <br><label> Texto </label><br>
            <textarea rows="30" cols="70" name ="texto" form="formulario"> </textarea>
            
        </fieldset>
        
            
    
        
        
        
        <br><br>
		<input type="submit" value="Seguir" />
		<input type="reset" value="Limpiar valores" />
    

    
    
    
        </form>
        </main>
HTML;
    
    
    
    
}

function añadirDatos($id){
    
    
    require_once("credenciales.php");
    $db= mysqli_connect(DB_HOST,DB_USER,DB_PASSWD,DB_DATABASE);
 
    if ($db){
        
        $id=$id+1;
        $indice=$_POST["indice"];
        $titulo=$_POST["titulo"];
        $texto=$_POST["texto"];
       
                
        $res=mysqli_query($db,"INSERT INTO informacionArtista (id,indice,titulo,texto) VALUES('$id','$indice','$titulo','$texto')") ;
        
        if ($res){
            
            header("Refresh: 3; url=index.php?p=8");
            echo "
                <main>
                seccion añadida con exito
                </main>";
            
            
        }
        
    }
    
   
    
    
}




function editarDiscografia(){
echo <<< HTML
 <main>

        <h2 id="tituloPagina"> Discografia</h2>

        <nav>

            <ul>
HTML;
            
           
            require_once("credenciales.php");
            $db= mysqli_connect(DB_HOST,DB_USER,DB_PASSWD,DB_DATABASE);
     
            if ($db){
                
                $tam=mysqli_query($db,"SELECT count(id) FROM discografia");
                
                $tam=mysqli_fetch_array($tam);
                
                for ($i = 1; $i <= $tam['count(id)']; $i++) {
                    $res1= mysqli_query($db,"SELECT titulo FROM discografia WHERE id= '$i' ");
                    if ($res1){
                        $in='#s'.$i;
                        $tupla1=mysqli_fetch_array($res1);
echo <<< HTML
                        
                        <li>
                            <a href='$in'> {$tupla1['titulo']} </a>
                            <a href='index.php?p=19&indice=$i' > Borrar </a>
                            <a href='index.php?p=20&indice=$i' > Editar </a> 
                        </li>
                        
                        
HTML;
                    }
                    
                }
                echo "
                    <li>
                        <a href='index.php?p=21&indice=$i '> Añadir </a>
                    </li>
                
                ";
                
                
                
            }
    
echo "<article id ='imagenes'>";
    
        if ($db){
            
            $tam=mysqli_query($db,"SELECT count(id) FROM discografia");
                
            $tam=mysqli_fetch_array($tam);
                
                
            for ($i = 1; $i <= $tam['count(id)']; $i++) {
                $in='s'.$i;
                $res1= mysqli_query($db,"SELECT texto,imagen FROM discografia WHERE id= '$i' ");
                if ($res1){
                
                        $tupla1=mysqli_fetch_array($res1);
echo <<< HTML
                        
                        <section id="$in">
            
                            <img src="{$tupla1['imagen']}">
                            

                            <p>{$tupla1['texto']}</p>
                
                        </section>
                        
                        
HTML;
                    }
                }
            
        }
    
            
mysqli_close($db);
echo "</article> </main>";
}
    

function añadirDiscoBase(){
echo <<< HTML
<main>
<form action="index.php?p=22" method="post" id="formulario">
    
    
        <fieldset>
            
            
            <legend> Datos para añadir </legend>
            
            <br><label>Titulo del indice</label><br>
            <input type="text" name="titulo" />
            
            <br><label> Ruta de la imagen</label><br>
            <input type="text" name="imagen" />
            
            <br><label> Texto </label><br>
            <textarea rows="30" cols="70" name ="texto" form="formulario"> </textarea>
            
        </fieldset>
        
            
    
        
        
        
        <br><br>
		<input type="submit" value="Seguir" />
		<input type="reset" value="Limpiar valores" />
    

    
    
    
        </form>

</main>
HTML;

    
    
}

function añadirBase(){
    
    
    require_once("credenciales.php");
    $db= mysqli_connect(DB_HOST,DB_USER,DB_PASSWD,DB_DATABASE);
 
    if ($db){
        
        
        $tam=mysqli_query($db,"SELECT count(id) FROM discografia");
        $tam=mysqli_fetch_array($tam);
        
        $id=$tam['count(id)'];
        $id=$id+1;
        $imagen=$_POST["imagen"];
        $titulo=$_POST["titulo"];
        $texto=$_POST["texto"];
       
                
        $res=mysqli_query($db,"INSERT INTO discografia (id,titulo,imagen,texto) VALUES('$id','$titulo','$imagen','$texto')") ;
        
        if ($res){
            
            header("Refresh: 3; url=index.php?p=10");
            echo "
                <main>
                seccion añadida con exito
                </main>";
            
            
        }
        
    }
    
    
    
}


function borrarDisco($id){
    
    require_once("credenciales.php");
    $db= mysqli_connect(DB_HOST,DB_USER,DB_PASSWD,DB_DATABASE);
    
    if ($db){
    
        $res=mysqli_query($db,"DELETE from discografia WHERE id='$id'");
            
        
        if ($res){
            
            $res1=mysqli_query($db,"UPDATE discografia SET id=id-1 WHERE id >'$id' ") ;
            
            header("Refresh: 3; url=index.php?p=10");
            echo "
                <main>
                seccion borrada con exito
                </main>";
        }
            
    }
      
    mysqli_close($db);
    
    
    
}


function editarDisco($id){
    
 require_once("credenciales.php");
    $db= mysqli_connect(DB_HOST,DB_USER,DB_PASSWD,DB_DATABASE);
    
    if ($db){
    
        $res=mysqli_query($db,"SELECT * from discografia WHERE id='$id'");
            
        
        if ($res){
            
            $tupla=mysqli_fetch_array($res);
        }
            
    }
      
    mysqli_close($db);    
    
        
echo <<< HTML
<main>
        <form action="index.php?p=23&id=$id" method="post" id="formulario">
    
    
        <fieldset>
            
            
            <legend> Datos para modificar </legend>
            
            <br><label>Titulo </label><br>
            <input type="text" value="{$tupla['titulo']}" name="titulo" />
            
            <br><label> Ruta de la imagen</label><br>
            <input type="text" value="{$tupla['imagen']}" name="imagen" />
            
            <br><label> Texto </label><br>
            <textarea rows="30" cols="70" name ="texto" form="formulario"> {$tupla['texto']}</textarea>
            
        </fieldset>
        
            
    
        
        
        
        <br><br>
		<input type="submit" value="Seguir" />
		<input type="reset" value="Limpiar valores" />
    

    
    
    
        </form>
</main>


HTML;
    
    
    
}


function editarDiscoBase($id){
    
    
    require_once("credenciales.php");
    $db= mysqli_connect(DB_HOST,DB_USER,DB_PASSWD,DB_DATABASE);
    
    if ($db){
        
        $imagen=$_POST["imagen"];
        $titulo=$_POST["titulo"];
        $texto=$_POST["texto"];
       
                
        $res=mysqli_query($db,"UPDATE discografia SET imagen='$imagen',titulo='$titulo',texto='$texto' WHERE id='$id' ") ;
        
        if ($res){
            
            header("Refresh: 3; url=index.php?p=10");
            echo "
                <main>
                seccion editada con exito
                </main>";
            
            
        }
        
    }
    
    mysqli_close($db);
    
    
    
    
    
}

function editarConciertos(){
 echo <<< HTML
 <main>


        <h2 id="tituloPagina"> Conciertos Pasados</h2>

        <nav>
        <ul>
            
HTML;
    
    
            require_once("credenciales.php");
            $db= mysqli_connect(DB_HOST,DB_USER,DB_PASSWD,DB_DATABASE);
     
            if ($db){
                
                $tam=mysqli_query($db,"SELECT count(id) FROM conciertos");
                
                $tam=mysqli_fetch_array($tam);
                
                for ($i = 1; $i <= $tam['count(id)']; $i++) {
                    
                    $res1= mysqli_query($db,"SELECT indice FROM conciertos WHERE id= '$i' ");
                    if ($res1){
                        
                        
                        $tupla1=mysqli_fetch_array($res1);
                        $in='#section'.$i;
                    
                        echo "
                        
                            <li> 
                                <a href='$in'> {$tupla1['indice']} </a> 
                                <a href='index.php?p=24&id=$i' > Editar </a>
                                <a href='index.php?p=25&id=$i' > Eliminar </a>
                            </li>
           
                        ";
                        
                    }
        
                    
                }
                
                    echo"
                        <li>
                            <a href='index.php?p=26&id=$i'> Añadir </a>
                        </li>
                    ";
                
               
            }
    
echo "<article>";  
    
    
            if ($db){
                
                $tam=mysqli_query($db,"SELECT count(id) FROM conciertos");
                
                $tam=mysqli_fetch_array($tam);
                
                
                for ($i = 1; $i <= $tam['count(id)']; $i++) {
                    $in='section'.$i;
                    $res1= mysqli_query($db,"SELECT titulo,texto,imagen FROM conciertos WHERE id= '$i' ");
                    if ($res1){
                
                        $tupla1=mysqli_fetch_array($res1);
echo <<< HTML
                        
                        <section id="$in">
            
                            <h3>{$tupla1['titulo']}</h3>

                            <p>{$tupla1['texto']}</p>
                            <img src="{$tupla1['imagen']}" >
                
                        </section>
                        
                        
HTML;
                    }
                }
            }
    
    
    
    
    mysqli_close($db);
    
echo "</article></main>";   
    
    
    
    
}
    
    
function añadirConcierto(){

echo <<< HTML
<main>
<form action="index.php?p=27" method="post" id="formulario">
    
    
        <fieldset>
            
            
            <legend> Datos para añadir </legend>
            
            <br><label>Titulo del indice</label><br>
            <input type="text" name="indice" />
            
            <br><label>Titulo del texto</label><br>
            <input type="text" name="titulo" />
            
            <br><label> Texto </label><br>
            <textarea rows="30" cols="70" name ="texto" form="formulario"> </textarea>
            
            <br><label> Ruta de la imagen</label><br>
            <input type="text" name="imagen" />
            
            
            
        </fieldset>
        
            
    
        
        
        
        <br><br>
		<input type="submit" value="Seguir" />
		<input type="reset" value="Limpiar valores" />
    

    
    
    
        </form>

</main>
HTML;
    
    
    
    
}

function añadirConciertoBase(){
    
    require_once("credenciales.php");
    $db= mysqli_connect(DB_HOST,DB_USER,DB_PASSWD,DB_DATABASE);
 
    if ($db){
        
        
        $tam=mysqli_query($db,"SELECT count(id) FROM conciertos");
        $tam=mysqli_fetch_array($tam);
        
        $id=$tam['count(id)'];
        $id=$id+1;
        $imagen=$_POST["imagen"];
        $titulo=$_POST["titulo"];
        $texto=$_POST["texto"];
        $indice=$_POST["indice"];
       
                
        $res=mysqli_query($db,"INSERT INTO conciertos (id,indice,titulo,texto,imagen) VALUES('$id','$indice','$titulo','$texto','$imagen')") ;
        
        if ($res){
            
            header("Refresh: 3; url=index.php?p=11");
            echo "
                <main>
                seccion añadida con exito
                </main>";
            
            
        }
        
    }
    
    
    
}


function eliminarConcierto($id){
    
    
    require_once("credenciales.php");
    $db= mysqli_connect(DB_HOST,DB_USER,DB_PASSWD,DB_DATABASE);
    
    if ($db){
    
        $res=mysqli_query($db,"DELETE from conciertos WHERE id='$id'");
            
        
        if ($res){
            
            $res1=mysqli_query($db,"UPDATE conciertos SET id=id-1 WHERE id >'$id' ") ;
            
            header("Refresh: 3; url=index.php?p=11");
            echo "
                <main>
                seccion borrada con exito
                </main>";
        }
            
    }
      
    mysqli_close($db);
    
    
    
}

function modificarConcierto($id){
    
    require_once("credenciales.php");
    $db= mysqli_connect(DB_HOST,DB_USER,DB_PASSWD,DB_DATABASE);
    
    if ($db){
    
        $res=mysqli_query($db,"SELECT * from conciertos WHERE id='$id'");
            
        
        if ($res){
            
            $tupla=mysqli_fetch_array($res);
            
        }
            
    }
      
    mysqli_close($db);     
    
    
    
echo <<< HTML

<main>
<form action="index.php?p=29&id=$id" method="post" id="formulario">
    
    
        <fieldset>
            
            
            <legend> Datos para modificar </legend>
            
            <br><label>Titulo del indice</label><br>
            <input type="text" value = {$tupla['indice']} name="indice" />
            
            <br><label>Titulo del texto</label><br>
            <input type="text" value = {$tupla['titulo']} name="titulo" />
            
            <br><label> Texto </label><br>
            <textarea rows="30" cols="70" name ="texto"  form="formulario">  {$tupla['texto']} </textarea>
            
            <br><label> Ruta de la imagen</label><br>
            <input type="text"  value = {$tupla['imagen']} name="imagen" />
            
            
            
        </fieldset>
        
            
    
        
        
        
        <br><br>
		<input type="submit" value="Seguir" />
		<input type="reset" value="Limpiar valores" />
    

    
    
    
        </form>
</main>
HTML;
}

function modificarConciertoBase($id){
    
    require_once("credenciales.php");
    $db= mysqli_connect(DB_HOST,DB_USER,DB_PASSWD,DB_DATABASE);
    
    if ($db){
        
        $imagen=$_POST["imagen"];
        $titulo=$_POST["titulo"];
        $texto=$_POST["texto"];
        $indice=$_POST["indice"];
        
        
                
        $res=mysqli_query($db,"UPDATE conciertos SET imagen='$imagen',titulo='$titulo',texto='$texto',indice='$indice' WHERE id='$id' ") ;
        
        if ($res){
            
            header("Refresh: 3; url=index.php?p=11");
            echo "
                <main>
                seccion editada con exito
                </main>";
            
            
        }
        
    }
    
    mysqli_close($db);
    
    
    
    
    
}


function modificarUsuarioBase(){
    
    
    
    require_once("credenciales.php");
    $db= mysqli_connect(DB_HOST,DB_USER,DB_PASSWD,DB_DATABASE);
    
    if ($db){
        
        $nombre=$_POST["nombre"];
        $apellidos=$_POST["apellidos"];
        $email=$_POST["email"];
        $login=$_POST["login"];
        $password=$_POST["password"];
        $telefono=$_POST["telefono"];
        $tipo=$_POST["tipo"];
        
        
                
        $res=mysqli_query($db,"UPDATE usuarios SET nombre='$nombre',apellidos='$apellidos',email='$email',login='$login', password='$password', telefono='$telefono', tipo='$tipo' WHERE login='$login' ") ;
        
        if ($res){
            
            header("Refresh: 3; url=index.php?p=12");
            echo "
                <main>
                usuario modificado con exito
                </main>";
            
            
        }
        
    }
    
    mysqli_close($db);
    
    
    
    
}

function DB_backup($db){
    
    // Obtener listado de tablas
    $tablas = array();
    $result = mysqli_query($db,'SHOW TABLES');
    while ($row = mysqli_fetch_row($result))
        $tablas[] = $row[0];
    
    // Salvar cada tabla
    $salida = '';
    foreach ($tablas as $tab) {
        $result = mysqli_query($db,'SELECT * FROM '.$tab);
        $num = mysqli_num_fields($result);
        $salida .= 'DROP TABLE '.$tab.';';
        $row2 = mysqli_fetch_row(mysqli_query($db,'SHOW CREATE TABLE '.$tab));
        $salida .= "\n\n".$row2[1].";\n\n"; // row2[0]=nombre de tabla
        
        while ($row = mysqli_fetch_row($result)) {
            $salida .= 'INSERT INTO '.$tab.' VALUES(';
            for ($j=0; $j<$num; $j++) {
                $row[$j] = addslashes($row[$j]);
                $row[$j] = preg_replace("/\n/","\\n",$row[$j]);
                if (isset($row[$j]))
                    $salida .= '"'.$row[$j].'"';
                else
                    $salida .= '""';
                if ($j < ($num-1)) $salida .= ',';
            }
            $salida .= ");\n";
        }
        $salida .= "\n\n\n";
    }
    
    
    echo $salida;
    
    
}



function crearCopia(){

    
        require_once("credenciales.php");
        $db= mysqli_connect(DB_HOST,DB_USER,DB_PASSWD,DB_DATABASE);
    
        if (!is_string($db)) {
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="db_backup.sql"');
            echo DB_backup($db);



    
    
        }
    
}


function opcionesGestorHTML($usuario, $pwd){
    
    $existe = comprobarGestor($usuario, $pwd);
    
    if ($existe){   
        session_start();
        $_SESSION["usuario"]=$usuario;
        loginHTML2();
        
        echo "<main>";
        
        
        opcionesGestor();

        echo "</main>";
        
    }
    
    
    else{
        
        gestorHTML();
        
    }
    
}



function opcionesGestor(){
echo <<< HTML
            
                <li>
                    <a href="index.php?p=52"> Consultar peticiones de compra</a>
                </li>
                
                <li>
                    <a href="index.php?p=54"> Consultar historico de compras</a>
                </li>
                
                <li>
                    <a href="index.php?p=55"> Editar productos</a>
                </li>
        
HTML;
    
}




function comprobarGestor($usuario, $pwd){
    
    require_once("credenciales.php");
    $db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_DATABASE);
    
    if($db){
        
        $nombre = $usuario;
        $resultado = mysqli_query($db, "SELECT login, password FROM usuarios WHERE login='$nombre'");
        
        if($resultado){
            
            $tupla = mysqli_fetch_array($resultado);
            
            $fecha=getdate();
            $fecha1=$fecha['year'] .'-' .$fecha['mon'] . '-' .$fecha['mday']. ' ' .$fecha['hours']. ':' .$fecha['minutes'] . ':' .$fecha['seconds'];
            
            if($pwd == $tupla['password']){

                $gestor = mysqli_query ($db, "SELECT tipo FROM usuarios WHERE login='$nombre'");
                $tupla = mysqli_fetch_array($gestor);
                
                if( $tupla[0] == 2){

                    
                    
                    
                    $estado=1;
                    mysqli_query($db,"INSERT INTO log (login,fecha,estado) VALUES('$nombre','$fecha1','$estado')") ;
                    return true;
                    
                    mysqli_close($db);
                    
                    
                }
                
                else{
                    
                    echo "Error. ";
                    
                }
                
                
            }else{
                $estado=0;
                mysqli_query($db,"INSERT INTO log (login,fecha,estado) VALUES('$nombre','$fecha1','$estado')") ;
                
                
            }
            
            
        }
        
        
    }
    
    return false;
    
}




function consultarPeticionesHTML(){

    require_once("credenciales.php");
    $db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_DATABASE);
    
    $result = mysqli_query($db, "SELECT * FROM ventas WHERE checked='0'"); 

    echo "<main>";
    echo "<table border = '1'> \n"; 
    echo "<tr><td>ID</td><td>Checked</td><td>Aceptado</td><td>Disco</td><td>Nombre</td><td>Apellidos</td><td>Email</td><td>Telefono</td><td>Direccion</td><td>Metodo de pago</td><td>N-tarjeta</td><td>Caducidad</td><td>CV</td><td>Gestor</td><td>Fecha</td><td>Texto Email</td></tr> \n"; 
    
    while ($row = mysqli_fetch_row($result)){

       echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td><td>$row[6]</td><td>$row[7]</td><td>$row[8]</td><td>$row[9]</td><td>$row[10]</td><td>$row[11]</td><td>$row[12]</td><td>$row[13]</td><td>$row[14]</td><td>$row[15]</td></tr> \n"; 

    }
        
    echo "</table> \n";
    echo "<br>";
    
echo <<< HTML

        <form action="index.php?p=53" method="post">

        <fieldset>

            <legend> Procesar ventas</legend>
            <label> Indique las ventas (id) que se aceptaran (separadas por espacios). * implica aceptarlas todas</label>
            <input type="text" name="aceptar"><br>
            <label> Indique las ventas (id) que se denegaran (separadas por espacios). * implica denegarlas todas</label>
            <input type="text" name="denegar"><br>

            <input type="submit" name="procesar" value="Procesar">

        </fieldset>

        </form>
    
HTML;
        
        echo "<br>";
        opcionesGestor();
        echo "</main>";
    

    
}





function procesarPeticionesHTML($aceptar, $denegar){
    
    require_once("credenciales.php");
    $db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_DATABASE);
    
    $acc = explode(" ", $aceptar);
    $den = explode(" ", $denegar);
    
    if ($acc[0] == "*"){

        $result = mysqli_query($db, 'UPDATE ventas SET checked="1", aceptado="1" WHERE checked="0"'); 
        
    }
    
    else{
        
        foreach ($acc as $valor) {
            $result = mysqli_query($db, "UPDATE ventas SET checked='1', aceptado='1' WHERE id={$valor}");
        }
        
    }
        
    if ($den[0] == "*"){

        $result = mysqli_query($db, 'UPDATE ventas SET checked="1", aceptado="0" WHERE checked="0"'); 
        
    }
    
    else{

        foreach ($den as $valor) {
            $result = mysqli_query($db, "UPDATE ventas SET checked='1', aceptado='0' WHERE id={$valor}");
        }
        
    }
        
    echo "<main>";
    opcionesGestor();
    echo "</main>";
    
}




function consultarHistoricoHTML(){

    require_once("credenciales.php");
    $db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_DATABASE);
    
    $result = mysqli_query($db, "SELECT disco, precio, aceptado, textoemail, login FROM ventas, productos WHERE ventas.disco=productos.nombre ORDER BY aceptado, fechapedido"); 

    echo "<main>";
    echo "<table border = '1'> \n"; 
    echo "<tr><td>Disco</td><td>Precio</td><td>Aceptado</td><td>Texto Email</td><td>gestor</td></tr> \n"; 
    
    while ($row = mysqli_fetch_row($result)){

       echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td></tr> \n"; 

    }
        
    echo "</table> \n";
    echo "<br>";
    opcionesGestor();
    echo "</main>";
    

    
}


function editarProductosHTML(){

    require_once("credenciales.php");
    $db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_DATABASE);
    
    $result = mysqli_query($db, "SELECT id, nombre, precio FROM productos"); 

    echo "<main>";
    echo "<table border = '1'> \n"; 
    echo "<tr><td>ID</td><td>Nombre</td><td>Precio</td></tr> \n"; 
    
    while ($row = mysqli_fetch_row($result)){

       echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td></tr> \n"; 

    }
        
    echo "</table> \n";
    echo "<br>";

echo <<< HTML

        <form action="index.php?p=56" method="post">

        <fieldset>

            <legend> Cambiar Precio Producto</legend>
            <label> Indique el id del producto</label>
            <input type="number" name="id"><br>
            <label> Indique el nuevo precio</label>
            <input type="number" name="precio"><br>

            <input type="submit" name="procesar" value="Procesar">

        </fieldset>

        </form>
    
HTML;
    
    echo "<br>";
    
    opcionesGestor();
    echo "</main>";
       
}



function cambiarPrecioProductosHTML($id, $precio){

    require_once("credenciales.php");
    $db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_DATABASE);
    
    $result = mysqli_query($db, "UPDATE productos SET precio={$precio} WHERE id={$id}"); 
    
    echo "<br>";
    opcionesGestor();
    echo "</main>";
    
}



function gestorHTML(){ 
echo <<< HTML
    <main>
        
        <form action="index.php?p=51" method="post">

        <fieldset>

            <legend> Identifiquese (gestor de compras)</legend>
            <label> Nombre de Usuario</label>
            <input type="text" name="usuario"><br>
            <label> Contraseña</label>
            <input type="password" name="pwd"><br>

            <input type="submit" name="login" value="Login">

        </fieldset>

        </form>
        
    </main>

HTML;

}


function DB_restore($db,$f){
    
    mysqli_query($db,'SET FOREIGN_KEY_CHECKS=0');
    $result = mysqli_query($db,'SHOW TABLES');
    while ($row = mysqli_fetch_row($result))
        mysqli_query($db,'DELETE * FROM '.$row[0]);
        
    $error = '';
    $sql = file_get_contents($f);
    $queries = explode(';',$sql);
    foreach ($queries as $q) {
        if (!mysqli_query($db,$q))
            $error .= mysqli_error($db);
    }
    mysqli_query($db,'SET FOREIGN_KEY_CHECKS=1');
    
    
    
}


function restaurarCopia(){
   
    if (isset($_POST['submit'])){
        
        $f=$_POST["archivo"];
        
        require_once("credenciales.php");
        $db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_DATABASE);
        $error=DB_restore($db,$f);
        
    }
    
    if (isset($error) )
        echo $error;
    else
        echo "Base de datos restaurada correctamente";
     
    
    
    
    
    
}

function formuRestaurarCopia(){
echo <<< HTML
<main>
<form action="index.php?p=34" method="post" >
<p>Archivo:
<input type="text" name="archivo" />
<br>
<input type="submit" value="Enviar" name='submit'/>
</p>
</form>
</main>

HTML;
    
    
}


function borrarBase(){
    
   
    
    require_once("credenciales.php");
    $db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_DATABASE);

    
    $result = mysqli_query($db,'SHOW TABLES');
    while ($row = mysqli_fetch_row($result)){
        
        if ($row[0]== "uusarios"){
            
            $res=mysqli_query($db,'DELETE FROM '.$row[0] .'WHERE login != admin');
        
            
        }else{
            
            $res=mysqli_query($db,'DELETE FROM '.$row[0]);
          
   
        }
        
        
        
        
    }
    
    
   
    header("Refresh: 3; url=index.php?p=0");
    echo "
                <main>
                base de datos borrada
                </main>";
        
    
    
    
    
    
    
    
    
    
}








?>
