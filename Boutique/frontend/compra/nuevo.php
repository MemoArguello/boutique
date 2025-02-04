<?php
require '../include/header.php';
include '../../backend/db.php';

?>
<div class="home-content">
    <div class="sales-boxes">
        <div class="container">
            <header>
                Formulario de Registro
            </header>
            <form action="../../backend/controladores/compra.php" method="post">
                <span class="title">Información de la Compra</span>
                <input type="hidden" name="registrar_compra" value="1">
                <div class="fields">
                    <div class="input-field">
                        <label>Seleccionar Producto</label>
                        <select name="id_producto" id="">
                        <?php
                            $query = $conn->query('SELECT * FROM productos WHERE estado=1');
                            $productos=$query->fetchAll(PDO::FETCH_OBJ);
                            foreach ($productos as $producto) {
                                echo "<option value='" . $producto->id_producto ."'>". $producto->nombre . "</option>";
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
                                echo "<option value='" . $proveedores->id_proveedor ."'>". $proveedores->nombre_proveedor . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input-field">
                        <label> Cantidad </label>
                        <input type="text" placeholder="Ingresar Cantidad" required name="cantidad">
                    </div>
                    <div class="input-field">
                        <label>Precio de Compra</label>
                        <input type="number" placeholder="Ingresar Precio" required name="precio_compra">
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