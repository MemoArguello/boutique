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
            <form action="../../backend/controladores/productos.php" method="post" enctype="multipart/form-data">
                <span class="title">Información del Producto</span>
                <input type="hidden" name="registrar_producto" value="1">
                <div class="fields">
                    <div class="input-field">
                        <label> Nombre del Producto</label>
                        <input type="text" placeholder="Ingresar Nombre" required name="nombre">
                    </div>
                    <div class="input-field">
                        <label>Precio de Venta</label>
                        <input type="number" placeholder="Ingresar Precio" required name="precio">
                    </div>
                    <div class="input-field">
                        <label>Precio de Compra</label>
                        <input type="number" placeholder="Ingresar Precio" required name="precio_compra">
                    </div>
                    <div class="input-field">
                        <label>Stock</label>
                        <input type="number" placeholder="Ingresar Stock" required name="stock">
                    </div>
                    <div class="input-field">
                        <label>Imagen</label>
                        <input type="file" placeholder="Ingresar Stock" required name="imagen_url">
                    </div>
                    <div class="input-field">
                        <label>Categoria del Producto</label>
                        <select name="categoria" id="">
                        <?php
                            $query = $conn->query('SELECT * FROM categoria WHERE estado=1');
                            $categorias=$query->fetchAll(PDO::FETCH_OBJ);
                            foreach ($categorias as $categoria) {
                                echo "<option value='" . $categoria->id_categoria ."'>". $categoria->descripcion . "</option>";
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
                            $query = $conn->query('SELECT * FROM proveedores where estado=1');
                            $proveedor=$query->fetchAll(PDO::FETCH_OBJ);
                            foreach ($proveedor as $proveedores) {
                                echo "<option value='" . $proveedores->id_proveedor ."'>". $proveedores->nombre_proveedor . "</option>";
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