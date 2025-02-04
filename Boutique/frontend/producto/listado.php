<?php
require '../include/header.php';
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

include '../../backend/db.php';

$consulta = $conn->query("SELECT productos.*, categoria.descripcion, proveedores.nombre_proveedor FROM productos 
                        JOIN categoria ON categoria.id_categoria = productos.categoria 
                        JOIN proveedores ON proveedores.id_proveedor = productos.id_proveedor
                        WHERE productos.estado=1");
$consulta->execute();

$productos = $consulta->fetchAll(PDO::FETCH_OBJ);

?>
<div class="home-content">
    <div class="sales-boxes">
        <table id="kt_datatable_zero_configuration" class="recent-sales">
        <h2 class="table-title">Listado de Productos</h2>
            <a href="./nuevo.php" class="btn-registro">
            <i class="bi bi-plus" ></i>Registrar 
            </a>
            <thead>
                <tr align="left">
                    <th>N°</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Categoria</th>
                    <th>Stock</th>
                    <th>Proveedor</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?= $producto->id_producto ?></td>
                        <td><?= $producto->nombre ?></td>
                        <td><?= number_format($producto->precio,0,',','.') ?> Gs.</td>
                        <td><?= $producto->descripcion ?></td>
                        <td><?= $producto->stock ?></td>
                        <td><?= $producto->nombre_proveedor?></td>
                        <td>
                            <a class="submitBotonEditar" href="./editar.php?id=<?=$producto->id_producto ?>">
                                Editar
                            </a>
                        </td>
                        <td>
                            <form action="../../backend/controladores/productos.php" method="post">
                                <input type="hidden" name="id_producto" value="<?=$producto->id_producto?>">
                                <input type="hidden" name="eliminar_producto" value="1">
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