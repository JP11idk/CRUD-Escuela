<html lang="en">
<head>
    <title>Agregar</title>
</head>
<body>
    <?php
        if(isset($_POST['guardar'])){
            $nombre=$_POST['nombre'];
            $matricula=$_POST['matricula'];

            require_once ("conexion.php");
            $sql= "insert into alumnos (nombre, matricula)
            values ('".$nombre."', '".$matricula."')";
            $resultado = mysqli_query($conexion, $sql);

            #Mensaje de confirmación con javascript al momento de agregar un nuevo alumno
            if($resultado){
                echo "<script language = 'JavaScript'> 
                        alert('El Alumno se agregó correctamente');
                        location.assign('index.php');
                    </script>";
            }else{
                echo "<script language = 'JavaScript'> 
                        alert('Error al intentar agregar al alumno');
                        location.assign('index.php');
                    </script>";
            }
            mysqli_close($conexion);

        }else{

        }
    ?>

    <h1> Agregar nuevo alumno</h1>
    
    <form action = "<?=$_SERVER['PHP_SELF']?>" method= "post">
        <!--Realizar envio del formulario en el mismo archivo-->
        <label> Nombre: </label>
        <input type= "text" name = "nombre" required><br>
        <label> Matricula: </label>
        <input type= "text" name = "matricula" required><br>
        <input type= "submit" name = "guardar" value = "Agregar">
        <a href= "index.php"> Regresar </a>
    </form>
</body>
</html>