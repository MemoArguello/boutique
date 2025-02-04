<?php
require '../include/header.php';
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

include '../../backend/db.php';

$consulta = $conn->query("SELECT usuarios.*, cargo.descripcion FROM usuarios
                        JOIN cargo ON cargo.id=usuarios.id_cargo 
                        WHERE usuarios.estado=1");
$consulta->execute();

$usuarios = $consulta->fetchAll(PDO::FETCH_OBJ);

?>
<div class="home-content">
    <div class="sales-boxes">
        <table id="kt_datatable_zero_configuration" class="recent-sales">
        <h2 class="table-title">Listado de Usuarios</h2>
            <a href="./nuevo.php" class="btn-registro">
            <i class="bi bi-plus" ></i>Registrar 
            </a>
            <thead>
                <tr align="left">
                    <th>N°</th>
                    <th>Correo</th>
                    <th>Nombre de Usuario</th>
                    <th>Cargo</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= $usuario->id_usuario ?></td>
                        <td><?= $usuario->correo ?></td>
                        <td><?= $usuario->usuario ?></td>
                        <td><?= $usuario->descripcion ?></td>
                        <td>
                            <a class="submitBotonEditar" href="./editar.php?id=<?=$usuario->id_usuario ?>">
                                Editar
                            </a>
                        </td>
                        <td>
                            <form action="../../backend/controladores/usuarios.php" method="post">
                                <input type="hidden" name="id_usuario" value="<?=$usuario->id_usuario?>">
                                <input type="hidden" name="eliminar_usuario" value="1">
                                <button type="submit" class="submitBotonEliminar">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
require '../include/futer.php';

?>