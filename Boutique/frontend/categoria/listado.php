<?php
require '../include/header.php';
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

include '../../backend/db.php';

$consulta = $conn->query("SELECT * FROM categoria WHERE estado=1");
$consulta->execute();

$categoria = $consulta->fetchAll(PDO::FETCH_OBJ);

?>
<div class="home-content">
    <div class="sales-boxes">
        <table id="kt_datatable_zero_configuration" class="recent-sales box">
            <h2 class="table-title">Listado de Categorias</h2>
            <a href="./nuevo.php" class="btn-registro">
                <i class="bi bi-plus"></i>Registrar
            </a>
            <thead>
                <tr align="left">
                    <th>N</th>
                    <th>Nombre</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categoria as $registro): ?>
                    <tr>
                        <td><?= $registro->id_categoria ?></td>
                        <td><?= $registro->descripcion ?></td>
                        <td>
                            <a class="submitBotonEditar" href="../categoria/editar_categoria.php?id=<?= $registro->id_categoria ?>">
                                Editar
                            </a>
                        </td>
                        <td>
                            <form action="../../backend/controladores/categoria.php" method="post">
                                <input type="hidden" name="id_categoria" value="<?=$registro->id_categoria?>">
                                <input type="hidden" name="eliminar_categoria" value="1">
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