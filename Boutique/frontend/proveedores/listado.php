<?php
require '../include/header.php';
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

include '../../backend/db.php';

$consulta = $conn->query("SELECT * FROM proveedores WHERE estado=1");
$consulta->execute();

$proveedores = $consulta->fetchAll(PDO::FETCH_OBJ);

?>
<div class="home-content">
    <div class="sales-boxes">
        <table id="kt_datatable_zero_configuration" class="recent-sales box">
        <h2 class="table-title">Listado de Proveedores</h2>
            <a href="./nuevo.php" class="btn-registro">
            <i class="bi bi-plus" ></i>Registrar 
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
                <?php foreach ($proveedores as $proveedor): ?>
                    <tr>
                        <td><?= $proveedor->id_proveedor ?></td>
                        <td><?= $proveedor->nombre_proveedor ?></td>
                        <td>
                            <a class="submitBotonEditar" href="../proveedores/editar_proveedor.php?id=<?=$proveedor->id_proveedor ?>">
                                Editar
                            </a>
                        </td>
                        <td>
                            <form action="../../backend/controladores/proveedores.php" method="post">
                                <input type="hidden" name="id_proveedor" value="<?=$proveedor->id_proveedor?>">
                                <input type="hidden" name="eliminar_proveedor" value="1">
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