<?php
    require_once 'conexion.php';
    
    if (!isset($_POST['id'])) {
        header("Location: index.php");
    exit;
    }

    $id = intval($_POST['id']);
    $sql = "DELETE FROM alumnos WHERE id = ?";
    $stmt = mysqli_prepare($conexion,$sql);
    mysqli_stmt_bind_param($stmt,'i', $id);
    $resultado = mysqli_stmt_execute($stmt);

    if ($resultado){
        header("Location: index.php?msg=eliminado");
        exit;
    }else{
        echo "<script> alert('Error al eliminar el alumno');</script>";
    }
?>