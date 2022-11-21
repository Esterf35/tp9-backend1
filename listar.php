<!DOCTYPE html>
<html lang="en">
<head>
   
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estilos.css">
    <title>Document</title>
</head>
<body>
    <h1>Tienda de ropa</h1>
    <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a href="index.html">Inicio</a>
                <a href="agregar.html">Agregar ropa</a>
            </div>
          </div>
        </div>
      </nav>
    
    <table border="1">
    <tr>
        <th>ID</th>
        <th>TIPO DE PRENDA</th>
        <th>MARCA</th>
        <th>TALLE</th>
        <th>PRECIO</th>
        <th>IMAGEN</th>
        <th>EDITAR</th>
        <th>BORRAR</th>
    </tr>
    <?php
    // 1) Conexion
    $conexion = mysqli_connect("127.0.0.1", "root", "");
    mysqli_select_db($conexion, "tiendaderopa");
 // 2) Preparar la orden SQL
    // Sintaxis SQL SELECT
    // SELECT * FROM nombre_tabla
    // => Selecciona todos los campos de la siguiente tabla
    // SELECT campos_tabla FROM nombre_tabla
    // => Selecciona los siguientes campos de la siguiente tabla
    $consulta='SELECT * FROM prendas';

  // 3) Ejecutar la orden y obtenemos los registros
    $datos= mysqli_query($conexion, $consulta);

    
// 4) Mostrar los datos del registro
while ($reg =mysqli_fetch_array($datos)) { ?>
    <tr>
    <td><?php echo $reg['id']; ?></td>
    <td><?php echo $reg['prenda']; ?></td>
    <td><?php echo $reg['marca']; ?></td>
    <td><?php echo $reg['talle']; ?></td>
    <td><?php echo $reg['precio']; ?></td>
    <td><img src="data:image/png;base64, <?php echo base64_encode($reg['imagen'])?>" alt="" width="100px" height="100px"></td>
    <td><a href="modificar.php?id=<?php echo $reg['id'];?>">Editar</a></td>
    <td><a href="borrar.php?id=<?php echo $reg['id'];?>">Borrar</a></td>
    </tr>
<?php } ?>
</table>

</body>
</html>