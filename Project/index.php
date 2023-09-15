<?php include("db_connection.php") ?>

<?php include("includes/header.php") ?>
    
<div class="container p-4">
    
<div class="col-md-4">

    <?php if(isset($_SESSION['message'])) { ?>
    <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['message'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php session_unset(); }?>

        <div class="card card-body">
            <form action="insert.php" method="POST">
                <div class="form-group" class="mb-3">
                    <input type="text" name="titulo" class="form-control" placeholder="titulo" autofocus>
                </div>
                <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" rows="3" class="form-control" required></textarea>
                </div>
                <div class="mb-3">
                <label for="estado">Estado:</label>
                <select id="estado" name="estado" class="form-control">
                    <option value="pendiente" selected>Pendiente</option>
                    <option value="cancelada">Cancelada</option>
                    <option value="terminada">Terminada</option>
                </div>
                <div>
                    <input type="submit" class="btn btn-primary btn-block" name="insert" value="Guardar">
                </div>
            </form>        
        </div>

    </div>

    <div class="col-md-8">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Descripción</th>
                    <th>Eestado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM tareas";
                $result_tarea = mysqli_query($conn, $query);

                while($row = mysqli_fetch_array($result_tarea)){ ?>
                    <tr>
                        <td><?php echo $row['titulo'] ?></td>
                        <td><?php echo $row['descripcion'] ?></td>
                        <td><?php echo $row['estado'] ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['id']?>" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                            </svg>
                            </a>
                            <a href="delete.php?id=<?php echo $row['id']?>" class="btn btn-danger" value="Delete">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-archive" viewBox="0 0 16 16">
                            <path d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1V2zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5H2zm13-3H1v2h14V2zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                            </svg>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php include("includes/footer.php") ?>

