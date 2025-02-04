<?php
require '../include/header.php';
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

include '../../backend/db.php';

$consulta = $conn->query("SELECT * FROM cliente WHERE estado=1");
$consulta->execute();

$clientes = $consulta->fetchAll(PDO::FETCH_OBJ);

?>
<div class="home-content">
    <div class="sales-boxes">
        <table id="kt_datatable_zero_configuration" class="recent-sales">
        <h2 class="table-title">Listado de Cliente</h2>
            <a href="./nuevo.php" class="btn-registro">
            <i class="bi bi-plus" ></i>Registrar 
            </a>
            <thead>
                <tr align="left">
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Ciudad</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td><?= $cliente->cedula ?></td>
                        <td><?= $cliente->nombre ?></td>
                        <td><?= $cliente->id_ciudad ?></td>
                        <td>
                            <a class="submitBotonEditar" href="../cliente/editar_cliente.php?id=<?=$cliente->id_cliente ?>">
                                Editar
                            </a>
                        </td>
                        <td>
                            <form action="../../backend/controladores/cliente.php" method="post">
                                <input type="hidden" name="id_cliente" value="<?=$cliente->id_cliente?>">
                                <input type="hidden" name="eliminar_cliente" value="1">
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