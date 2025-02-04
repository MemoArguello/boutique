<?php
require '../include/header.php';
include '../../backend/db.php';

$id_compra = $_GET["id"];

$consulta = $conn->query("SELECT * FROM compras WHERE id_compras =" . $id_compra);
$consulta->execute();

$compras = $consulta->fetch(PDO::FETCH_OBJ);

?>
<div class="home-content">
    <div class="sales-boxes">
        <div class="container">
            <header>
                Formulario de Edicion
            </header>
            <form action="../../backend/controladores/compra.php" method="post">
                <span class="title">Información de la Compra</span>
                <input type="hidden" name="editar_compra" value="1">
                <input type="hidden" name="id_compras" value="<?=$compras->id_compras?>">
                <div class="fields">
                    <div class="input-field">
                        <label>Seleccionar Producto</label>
                        <select name="id_producto" id="">
                        <?php
                            $query = $conn->query('SELECT * FROM productos WHERE estado=1');
                            $productos=$query->fetchAll(PDO::FETCH_OBJ);
                            foreach ($productos as $producto) {
                                $selected= ($producto->id_producto == $compras->id_producto) ? 'selected' : '';
                                echo "<option value='" . $producto->id_producto ."'$selected>". $producto->nombre . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input-field">
                        <label>Seleccionar Proveedor</label>
                        <select name="id_proveedor" id="">
                            <?php
                            $query = $conn->query('SELECT * FROM proveedores where estado=1');
                            $proveedor=$query->fetchAll(PDO::FETCH_OBJ);
                            foreach ($proveedor as $proveedores) {
                                $selected= ($proveedores->id_proveedor == $compras->id_proveedor) ? 'selected' : '';
                                echo "<option value='" . $proveedores->id_proveedor ."'$selected>". $proveedores->nombre_proveedor . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input-field">
                        <label> Cantidad </label>
                        <input type="text" placeholder="Ingresar Cantidad" required name="cantidad" value="<?=$compras->cantidad?>">
                    </div>
                    <div class="input-field">
                        <label>Precio de Compra</label>
                        <input type="number" placeholder="Ingresar Precio" required name="precio_compra" value="<?=$compras->precio_compra?>">
                    </div>
                </div>
                <div class="fields">

                </div>
                <div class="buttons">
                    <button type="submit">
                        <span class="btnText">Guardar</span>
                    </button>
                    <a href="./listado.php" class="backBtn">
                            <span class="btnText">Volver</span>
                        </a>
                </div>
            </form>
        </div>
    </div>
    </form>
</div>
</div>
</div>
<?php
require '../include/futer.php';

?>