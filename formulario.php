<?php
include("conexion.php"); //Incluimos el archivo de conexion y asi podemos usar las variables creadas en ese documento 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
        $nitocc = ""; 
        $nombre = ""; 
        $direccion = ""; 
        $telefono = ""; 
        $fechaingreso = ""; 
        $cupocredito = ""; 
        $foto = "";
        if(isset($_POST['buscar'])){
            $nitoccbuscar = $_POST['nitoccbus'];
            $consulta = $conexion -> query("select * from tbdcliente where nitocc='$nitoccbuscar'");
            while($resultadoconsulta = $consulta -> fetch_array()){
                $nitocc = $resultadoconsulta[0];
                $nombre = $resultadoconsulta[1];
                $direccion = $resultadoconsulta[2];
                $telefono = $resultadoconsulta[3];
                $fechaingreso = $resultadoconsulta[4];
                $cupocredito = $resultadoconsulta[5];
                $foto = $resultadoconsulta[6];
            }
        }
 ?>
    <center>
        <h2>Manipulacion de datos con PHP</h2>
        <form action="formulario.php" method="post" >
            <label for="">Buscar:</label>
            <input type="text" name="nitoccbus" id="" placeholder="Buscar Cliente">
            <input type="submit" value="Buscar" name="buscar">
            <input type="submit" value="Listar todos los clientes" name="listar">
        </form>  
            <hr>
            <form action="consultas.php" method="POST" enctype="multipart/form-data">
            <label for="">Nit o CC</label>
            <input type="text" name="nitocc" id="" placeholder="Ingrese el nit o la cc del nuevo cliente" value="<?php echo $nitocc;?>">
            <br><br>
            <label for="">Nombres:</label>
            <input type="text" name="nombre" id="" placeholder="Ingrese el nombre completo" value="<?php echo $nombre;?>">
            <br><br>
            <label for="">Direccion:</label>
            <input type="text" name="direccion" id="" placeholder="Ej: Cll 32 # 52-41" value="<?php echo $direccion;?>">
            <br><br>
            <label for="">Telefono:</label>
            <input type="number" name="telefono" id="" placeholder="Ej: 311-147-4789" value="<?php echo $telefono;?>">
            <br><br>
            <label for="">Fecha de ingreso:</label>
            <input type="date" name="fechaingreso" id="" value="<?php echo $fechaingreso;?>">
            <br><br>
            <label for="">Cupo de credito:</label>
            <input type="number" name="cupocredito" id="" placeholder="$ Valor en pesos(COP)" value="<?php echo $cupocredito;?>">
            <br><br>
            <label for="">Subir foto:</label>
            <input type="file" name="foto" id="">
            <br><br>
            <label for="">Foto:</label>
            <img src="<?php echo $foto;?>" alt="" width="80" height="80">
            <br><br>
            <input type="submit" value="Nuevo Cliente" name="guardar">
            <input type="submit" value="Actualizar cliente" name="actualizar">
            <input type="submit" value="Eliminar cliente" name="eliminar">
            </form>
    </center>
    <?php
    if(isset($_POST['listar'])){
        echo "<center>
        <table border='3'>
        <tr>
        <th>Nit o CC</th>
        <th>Nombre</th>
        <th>Direccion</th>
        <th>Telefono</th>
        <th>Fecha de ingreso</th>
        <th>Cupo del credito</th>
        <th>Foto del cliente</th>
        </tr>";
        $buscar = $conexion -> query("select * from tbdcliente");
        while($resultado = $buscar -> fetch_array()){
            $nitocc = $resultado[0];
            $nombre = $resultado[1];
            $direccion = $resultado[2];
            $telefono = $resultado[3];
            date_default_timezone_set('America/Bogota');
            $fechaingreso = date("d-m-y", strtotime($resultado[4]));
            $cupocredito = number_format($resultado[5]);
            $foto = $resultado[6];
            echo "<tr>
                    <td>$nitocc</td>
                    <td>$nombre</td>
                    <td>$direccion</td>
                    <td>$telefono</td>
                    <td>$fechaingreso</td>
                    <td>$cupocredito</td>
                    <td>
                        <img src='$foto' width='30%' height='30%'>
                    </td>
            </tr>";
        }
        echo "</table> </center>";
    }
    
    ?>
</body>
</html>