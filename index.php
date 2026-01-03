<html lang="en">
<head>
    <title>Lista Alumnos</title>
</head>
<body>

<?php
    require_once 'conexion.php';
    $sql="SELECT * FROM alumnos";
    $resultado=mysqli_query($conexion,$sql);
?>
<!--Mensaje de Eliminación exitosa-->
<?php
    if (isset($_GET['msg']) && $_GET['msg'] === 'eliminado') {
        echo "<script language= 'JavaScript'>alert('Alumno eliminado correctamente');</script>";
    }
?>
<!--Alerta de actualización exitosa-->
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
                    
                    <!--Botón para Editar($_GET)-->
                    <form action="editar.php" method="GET" style="display:inline; margin-right:6px;">
                        <input type="hidden" name="id" value="<?= $fila['id'] ?>">
                            <button type="submit">Editar</button>
                    </form>

                    <!--Botón para Eliminar($_POST(-->
                    <form action="eliminar.php" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $fila['id'] ?>">
                            <button type="submit"
                                onclick="return confirm('¿Seguro que quieres eliminar este alumno?');">
                                Eliminar
                            </button>
                    </form>
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