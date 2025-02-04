<?php
require '../include/header.php';
include '../../backend/db.php';

$id = $_GET["id"];

$consulta = $conn->query("SELECT * FROM productos WHERE id_producto =" . $id);
$consulta->execute();

$productos = $consulta->fetch(PDO::FETCH_OBJ);
?>
<div class="home-content">
    <div class="sales-boxes">
        <div class="container">
            <header>
                Formulario de Registro
            </header>
            <form action="../../backend/controladores/productos.php" method="post">
                <span class="title">Información del Producto</span>
                <input type="hidden" name="editar_producto" value="1">
                <input type="hidden" required name="id_producto" value="<?=$productos->id_producto?>">
                <div class="fields">
                    <div class="input-field">
                        <label> Nombre del Producto</label>
                        <input type="text" placeholder="Ingresar Nombre" required name="nombre" value="<?=$productos->nombre?>">
                    </div>
                    <div class="input-field">
                        <label>Precio de Venta</label>
                        <input type="number" placeholder="Ingresar Precio" required name="precio"value="<?=$productos->precio?>">
                    </div>
                    <div class="input-field">
                        <label>Precio de Compra</label>
                        <input type="number" placeholder="Ingresar Precio" required name="precio_compra"value="<?=$productos->precio_compra?>">
                    </div>
                    <div class="input-field">
                        <label>Stock</label>
                        <input type="number" placeholder="Ingresar Stock" required name="stock"value="<?=$productos->stock?>">
                    </div>
                    <div class="input-field">
                        <label>Categoria del Producto</label>
                        <select name="categoria" id="">
                        <?php
                            $query = $conn->query('SELECT * FROM categoria WHERE estado=1');
                            $categorias=$query->fetchAll(PDO::FETCH_OBJ);
                            foreach ($categorias as $categoria) {
                                $selected= ($categoria->id_categoria == $productos->categoria) ? 'selected' : '';
                                echo "<option value='" . $categoria->id_categoria ."'$selected>". $categoria->descripcion . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="fields">
                    <div class="input-field">
                        <label>Proveedor del Producto</label>
                        <select name="id_proveedor" id="">
                            <?php
                            $query = $conn->query('SELECT * FROM proveedores WHERE estado=1');
                            $proveedor=$query->fetchAll(PDO::FETCH_OBJ);
                            foreach ($proveedor as $proveedores) {
                                $selected= ($proveedores->id_proveedor == $productos->id_proveedor) ? 'selected' : '';
                                echo "<option value='" . $proveedores->id_proveedor ."'$selected>". $proveedores->nombre_proveedor . "</option>";
                            }
                            ?>
                        </select>
                    </div>
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