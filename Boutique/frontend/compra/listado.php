<?php
require '../include/header.php';
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

include '../../backend/db.php';

$consulta = $conn->query("SELECT compras.*, productos.nombre, proveedores.nombre_proveedor FROM compras
                            JOIN productos ON productos.id_producto = compras.id_producto
                            JOIN proveedores ON proveedores.id_proveedor = compras.id_proveedor
                            WHERE compras.estado=1");
$consulta->execute();

$compras = $consulta->fetchAll(PDO::FETCH_OBJ);

?>
<div class="home-content">
    <div class="sales-boxes">
        <table id="kt_datatable_zero_configuration" class="recent-sales">
        <h2 class="table-title">Listado de Compras</h2>
            <a href="./nuevo.php" class="btn-registro">
            <i class="bi bi-plus" ></i>Registrar 
            </a>
            <thead>
                <tr align="left">
                    <th>N°</th>
                    <th>producto</th>
                    <th>Proveedor</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Gasto Total</th>
                    <th>Fecha</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($compras as $compra): ?>
                    <tr>
                        <td><?= $compra->id_compras ?></td>
                        <td><?= $compra->nombre ?></td>
                        <td><?= $compra->nombre_proveedor ?></td>
                        <td><?= $compra->cantidad ?></td>
                        <td><?= number_format($compra->precio_compra,0,',','.') ?> Gs.</td>
                        <td><?= number_format($compra->total_pagar, 0,',','.') ?> Gs.</td>
                        <td><?= $compra->fecha_compra ?></td>
                        <td>
                            <a class="submitBotonEditar" href="./editar.php?id=<?=$compra->id_compras ?>">
                                Editar
                            </a>
                        </td>
                        <td>
                            <form action="../../backend/controladores/compra.php" method="post">
                                <input type="hidden" name="id_compras" value="<?=$compra->id_compras?>">
                                <input type="hidden" name="eliminar_compra" value="1">
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