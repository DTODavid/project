<?php
include("db_connection.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM tareas WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $titulo = $row['titulo'];
        $descripcion = $row['descripcion'];
        $estado = $row['estado'];
    }
}

if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $newTitulo = $_POST['titulo'];
    $newDescripcion = $_POST['descripcion'];
    $newEstado = $_POST['estado'];

    // Verificar si el estado es 'pendiente' o 'cancelada' antes de realizar la actualización
    if ($estado === 'pendiente' || $estado === 'cancelada') {
        $query = "UPDATE tareas SET titulo='$newTitulo', descripcion='$newDescripcion', estado='$newEstado' WHERE id='$id'";
        mysqli_query($conn, $query);

        $_SESSION['message'] = "Actualización realizada";
        $_SESSION['message_type'] = 'warning';
        header("Location: index.php");
    } else {
        $_SESSION['message'] = "No puedes editar una tarea que no está en estado 'pendiente' o 'cancelada'";
        $_SESSION['message_type'] = 'danger';
        header("Location: index.php");
    }
}
?>

<?php include("includes/header.php") ?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card-body">
                <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST">
                    <div class="form-group">
                        <input type="text" name="titulo" value="<?php echo $titulo; ?>" class="form-control" placeholder="Nuevo título">
                    </div>
                    <div class="form-group">
                        <textarea name="descripcion" class="form-control" placeholder="Nueva descripción"><?php echo $descripcion; ?></textarea>
                    </div>
                    <div class="form-group">
                        <input type="text" name="estado" value="<?php echo $estado; ?>" class="form-control" placeholder="Nuevo estado (pendiente o cancelada)">
                    </div>
                    <button class="btn btn-primary" name="update">
                        Guardar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php") ?>
