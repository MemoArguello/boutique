<?php
require '../include/header.php';

include '../../backend/db.php';

$id_proveedor = $_GET["id"];

$consulta = $conn->query("SELECT * FROM proveedores WHERE id_proveedor =" . $id_proveedor);
$consulta->execute();

$proveedor = $consulta->fetch(PDO::FETCH_OBJ);
?>
<div class="home-content">
    <div class="sales-boxes">
        <div class="container">
            <header>
                Formulario de Edicion
            </header>
            <form action="../../backend/controladores/proveedores.php" method="post">
                <input type="hidden" name="editar_proveedor" value="1">
                <input type="hidden" name="id_proveedor" value="<?= $proveedor->id_proveedor ?>">
                <div class="fields">
                    <div class="input-field">
                        <label>Nombre</label>
                        <input type="text" placeholder="Ingresar Nombre" required name="nombre_proveedor" value="<?= $proveedor->nombre_proveedor ?>">
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
</div>
<?php
require '../include/futer.php';

?>