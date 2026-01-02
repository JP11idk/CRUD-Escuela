<html lang="en">
<head>
    <title>Lista Alumnos</title>
</head>
<body>

<?php
    include 'conexion.php';
    $sql="SELECT * FROM alumnos";
    $resultado=mysqli_query($conexion,$sql);
?>
<!--Alerta de actualización exitosa -->
<?php
if (isset($_GET['ok']) && $_GET['ok'] == 1) {
    echo "<script language= 'JavaScript'>  alert('Alumno actualizado correctamente'); </script>";
}
?>
    <h1>Lista de Alumnos</h1>
    <a href="agregar.php">Nuevo Alumno</a><br>
    <table>
        <th>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Matricula</th>
                <th>Acciones</th>
            </tr>
        </th>
        <tbody>
            <?php
                while($fila=mysqli_fetch_assoc($resultado)){
            ?>
            <tr>
                <td> <?php echo $fila['id'] ?> </td>
                <td> <?php echo $fila['nombre'] ?></td>
                <td> <?php echo $fila['matricula'] ?></td>
                <td>
                    
                    <!--Vinculo para Editar-->
                    <?php echo "<a href='editar.php?id=".$fila['id']."'>Editar</a> "; ?>
                    <?php echo " | "; ?>
                    <!--Vinculo para Eliminar-->
                    <?php echo "<a href=''>Eliminar</a> "; ?>
                </td> 
            </tr>
            <?php
                }
            ?>
        </tbody>
    <table>
    <?php
        mysqli_close($conexion);
    ?>
</body>
</html>