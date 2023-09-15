<?php
include("db_connection.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $estado_query = "SELECT estado FROM tareas WHERE id = '$id'";
    $estado_result = mysqli_query($conn, $estado_query);

    if (!$estado_result) {
        die("Query Failed");
    }

    $row = mysqli_fetch_assoc($estado_result);
    $estado = $row['estado'];

    if ($estado === 'terminada') {
        $delete_query = "DELETE FROM tareas WHERE id = '$id'";
        $delete_result = mysqli_query($conn, $delete_query);

        if (!$delete_result) {
            die("Delete Query Failed");
        }

        $_SESSION['message'] = "Registro eliminado";
        $_SESSION['message_type'] = 'danger';
        header("Location: index.php");
    } else {
        $_SESSION['message'] = "No puedes eliminar una tarea que no está en estado 'terminada'";
        $_SESSION['message_type'] = 'warning';
        header("Location: index.php");
    }
}
?>