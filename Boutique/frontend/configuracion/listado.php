<?php
require '../include/header.php';
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

include '../../backend/db.php';

$consulta = $conn->query("SELECT * FROM datos_empresa WHERE estado=1");
$consulta->execute();

$configuracion = $consulta->fetchAll(PDO::FETCH_OBJ);

?>
<div class="home-content">
    <div class="sales-boxes">
        <table id="kt_datatable_zero_configuration" class="recent-sales">

            <thead>
                <tr align="left">
                    <th>N</th>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($configuracion as $registro): ?>
                    <tr>
                        <td><?= $registro->id_datos ?></td>
                        <td><?= $registro->nombre_empresa ?></td>
                        <td><?= $registro->imagen_url ?></td>
                        <td>
                            <a class="submitBotonEditar" href="../configuracion/editar_datos.php?id=<?=$registro->id_datos ?>">
                                Editar
                            </a>
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