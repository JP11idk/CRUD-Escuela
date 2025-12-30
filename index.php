<html lang="en">
<head>
    <title>Lista Alumnos</title>
</head>
<body>
<?php
    include 'conexión.php';
    $sql="SELECT * FROM alumnos";
    $resultado=mysqli_query($conexion,$sql);

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
                     <?php
                    #Vinculo para Editar
                    echo "<a href=''>Editar</a> ";
                    echo " | ";
                    #Vinculo para Eliminar
                    echo "<a href=''>Eliminar</a> ";
                    ?>
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