<?php
require '../include/header.php';
include '../../backend/db.php';

$id_datos = $_GET["id"];

$consulta = $conn->query("SELECT * FROM datos_empresa WHERE id_datos =" . $id_datos);
$consulta->execute();

$datos = $consulta->fetch(PDO::FETCH_OBJ);
?>
<div class="home-content">
    <div class="sales-boxes">
        <div class="container">
            <header>
                 Editar Datos de la Empresa 
            </header>
            <form action="../../backend/controladores/datos.php" method="post">
                        <input type="hidden" name="editar_datos" value="1">
                        <input type="hidden" name="id_datos" value="<?= $datos->id_datos ?>">
                        <div class="fields">
                            <div class="input-field">
                                <label>Nombre</label>
                                <input type="text" placeholder="Ingresar Nombre" required name="nombre_empresa" value="<?= $datos->nombre_empresa ?>">
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