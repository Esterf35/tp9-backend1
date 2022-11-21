<?php
// 1) Conexion
// a) realizar la conexion con la bbdd
// b) seleccionar la base de datos a usar
$conexion = mysqli_connect("127.0.0.1","root","");
mysqli_select_db($conexion, "tiendaderopa");

// 2) Almacenamos los datos del envío GET
// a) generar variables para el id a utilizar
$id = $_GET['id'];

// 3) Preparar la orden SQL
// => Selecciona todos los campos de la tabla alumno donde el campo dni sea igual a $dni
// a) generar la consulta a realizar
$consulta = "SELECT * FROM prendas WHERE id=$id";

// 4) Ejecutar la orden y almacenamos en una variable el resultado
// a) ejecutar la consulta
$respuesta = mysqli_query($conexion, $consulta);

// 5) Transformamos el registro obtenido a un array
$datos=mysqli_fetch_array($respuesta);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tienda de Ropa</title>
        <link rel="stylesheet" href="./css/estilos.css">
        <link rel="stylesheet" href="./css/modificar.css">
    </head>
    <body>
        <?php
        // 6) asignamos a diferentes variables los respectivos valores del array $datos.
        $prenda=$datos["prenda"];
        $marca=$datos["marca"];
        $talle=$datos["talle"];
        $precio=$datos["precio"];
        $imagen=$datos['imagen'];?>

<h1>Tienda de Ropa</h1>
    <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
 <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a href="index.html">Inicio</a>
                <a href="listar.php">Volver</a>
            </div>
          </div>
        </div>
      </nav>

     
        <p>INGRESE LOS NUEVOS DATOS DE LA PRENDA</p>
        
        <form action="" method="post" enctype="multipart/form-data">
            <label>Tipo de prenda</label>
            <input type="text" name="prenda" placeholder="Tipo de Prenda" value="<?php echo "$prenda"; ?>"> 
            <label>Marca</label>
            <input type="text" name="marca" placeholder="Marca" value="<?php echo "$marca"; ?>">
            <label>Talle</label>
            <input type="text" name="talle" placeholder="Talle" value="<?php echo "$talle"; ?>">
            <label>Precio</label>
            <input type="text" name="precio" placeholder="Precio" value="<?php echo "$precio"; ?>">
            <label>Imagen</label>
            <input type="file" name="imagen" placeholder="imagen">
            <input type="submit" name="guardar_cambios" value="Guardar Cambios">
            <button type="submit" name="Cancelar" formaction="listar.php">Cancelar</button>
        </form>
        <?php
        // Si en la variable constante $_POST existe un indice llamado 'guardar_cambios' ocurre el bloque de instrucciones.
        if(array_key_exists('guardar_cambios',$_POST)){

            // 2') Almacenamos los datos actualizados del envío POST
            // a) generar variables para cada dato a almacenar en la bbdd
            // Si se desea almacenar una imagen en la base de datos usar lo siguiente:
            // addslashes(file_get_contents($_FILES['ID NOMBRE DE LA IMAGEN EN EL FORMULARIO']['tmp_name']))
                    $prenda=$_POST['prenda'];
                    $marca=$_POST['marca'];
                    $talle=$_POST['talle'];
                    $precio=$_POST['precio'];
                    $imagen=addslashes(file_get_contents($_FILES['imagen']['tmp_name']));

            // 3') Preparar la orden SQL
            // "UPDATE tabla SET campo1='valor1', campo2='valor2', campo3='valor3', campo3='valor3', campo3='valor3' WHERE campo_clave=valor_clave"
            // a) generar la consulta a realizar
             $consulta = "UPDATE prendas SET prenda WHERE id= $id?='$prenda', marca='$marca', talle='$talle', precio='$precio', imagen='$imagen' WHERE id =$id";

             // 4') Ejecutar la orden y actualizamos los datos
             // a) ejecutar la consulta
             mysqli_query($conexion,$consulta);

            // a) rederigir a index
            header('location: listar.php');

        }?>
    </body>
</html>
