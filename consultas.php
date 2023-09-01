<?php
include("conexion.php");
//Datos de entrada almacenados en variables
$nitocc = $_POST['nitocc'];
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$fechaingreso = $_POST['fechaingreso'];
$cupocredito = $_POST['cupocredito'];
//Manejo de archivos
$nombre_foto = $_FILES['foto']['name'];//Nombre de la foto
$ruta = $_FILES['foto']['tmp_name'];//Ruta o path del archivo
$foto = 'imagenes/'.$nombre_foto; //Ruta y el nombre del archivo

$sqlactualizar = "UPDATE tbdcliente SET nombre = '$nombre', direccion = '$direccion', telefono = '$telefono', fechaingreso = '$fechaingreso', cupocredito = '$cupocredito', foto = '$foto' WHERE nitocc = '$nitocc' ";
$sqlbuscar = "SELECT nitocc FROM tbdcliente WHERE nitocc = '$nitocc'";
$sqleliminar = "DELETE FROM tbdcliente WHERE nitocc = '$nitocc'";

if(isset($_POST['guardar'])){
    //Verificar que no exista valores duplicados para el campo de Nit o CC
    if($resultado = mysqli_query($conexion, $sqlbuscar)){
        $nroregistros = mysqli_num_rows($resultado);
        if($nroregistros>0){
            echo "<script>alert('Ese Nit o CC ya existe !!')</script>";
        }else{
            copy($ruta,  $foto);  //Guarda el archivo en una ruta especifica 
            mysqli_query($conexion, "INSERT INTO tbdcliente (nitocc, nombre, direccion, telefono, fechaingreso, cupocredito, foto) VALUES ('$nitocc','$nombre', '$direccion', '$telefono', '$fechaingreso', '$cupocredito', '$foto')");
            echo "Datos guardados correctamente";
        }
    }
}
if(isset($_POST['actualizar'])){
    copy($ruta,  $foto); //Guarda el archivo en una ruta especifica 
    mysqli_query($conexion,$sqlactualizar );
    echo "Datos actualizados correctamente";
}

if(isset($_POST['eliminar'])){
    mysqli_query($conexion, $sqleliminar);
    echo "Datos eliminados correctamente";
}





?>