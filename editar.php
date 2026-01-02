<?php
include 'conexion.php';
$errores = [];
?>

<html lang="en">
<head>
    <title>Editar</title>
</head>
<body>
    <?php
        if(isset($_POST['guardar'])){
            #Acción que ocurre al precionar el boton de actualizar
            $id = intval($_POST['id']);

            $nombre = trim($_POST['nombre']);
            $matricula = trim($_POST['matricula']);

            #Mensajes de error
            if ($nombre =='') {
                $errores[] = "El nombre no puede estar vacío";
            }
            
            if ($matricula == '') {
                $errores[] = "La matricula no puede estar vacía";
            }
            if(strlen($matricula) > 10) {
                $errores[] = "La matricula no puede tener mas de 10 caracteres";
            }
            if (strlen($nombre) > 50) {
                $errores[] = "El nombre es demaciado largo";
            }
            #Actualizar si no hay errores
            if (empty($errores)){
                $stmt = $conexion -> prepare("UPDATE alumnos SET nombre= ?, matricula= ? WHERE id = ?");
                $stmt -> bind_param('ssi', $nombre, $matricula, $id);
                $stmt -> execute();

                header("Location: index.php?ok=1");
            exit;
            }
            
        }else{
            #Acción que ocurre si no se preciona el boton de actualizar

            #Verificación de que se recibe el ID
            if (!isset($_GET['id'])) {
                echo "ID no recibido";
                exit;
            }
            $id = intval($_GET['id']);
            $stmt = $conexion ->prepare ("SELECT nombre,matricula FROM alumnos Where id = ?");
            $stmt -> bind_param('i', $id);
            $stmt -> execute();

            $resultado = $stmt -> get_result();
            $fila = $resultado -> fetch_assoc();

            #Verificación de que el registro existe
            if($fila){
                $nombre = $fila["nombre"];
                $matricula = $fila["matricula"];
            }else{
                echo " No existe o no se encontró al alumno".$id;
                exit;
            }
        }
    ?>
    <h1> Editar alumno</h1>

    <!--Mostrar errores-->
   <?php
   if (isset($_POST['guardar']) && !empty($errores)){
        echo "<script>";
        foreach ($errores as $error){
            echo "alert('".addslashes($error)."');";
        }
        echo "</script>";
    }
    ?>
    <form action = "<?=$_SERVER['PHP_SELF']?>" method= "post">
        <!--Realizar envio del formulario en el mismo archivo-->
        <label> Nombre: </label>
        <input type= "text" name = "nombre" value = "<?php echo $nombre; ?>"> <br>
        <label> Matricula: </label>
        <input type= "text" name = "matricula"value= "<?php echo $matricula; ?>"> <br>

        <input type= "hidden" name = "id"value= "<?php echo $id; ?>">

        <input type= "submit" name = "guardar" value = "Actualizar">
        <a href= "index.php"> Regresar </a>
    </form>
    <?php
        mysqli_close($conexion);
    ?>
</body>
</html>