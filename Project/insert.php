<?php 
    include("db_connection.php");

    if (isset($_POST['insert'])) {
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $estado = $_POST['estado'];

        $query = "INSERT INTO tareas (titulo, descripcion, estado) VALUES ('$titulo', '$descripcion', '$estado')";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Insert Query Failed");
        }

        $_SESSION['message'] = "Registro insertado";
        $_SESSION['message_type'] = 'success';

        // Redirigir a la página principal después de realizar la inserción
        header("Location: index.php");
    }
?>
