<?php
require '../include/header.php';

include '../../backend/db.php';

$id_cliente = $_GET["id"];

$consulta = $conn->query("SELECT * FROM cliente WHERE id_cliente =" . $id_cliente);
$consulta->execute();

$clientes = $consulta->fetch(PDO::FETCH_OBJ);

?>
<div class="home-content">
    <div class="sales-boxes">
        <div class="container">
            <header>
                Formulario de Edicion
            </header>
            <form action="../../backend/controladores/cliente.php" method="post">
                <span class="title">Registrar Cliente</span>
                <input type="hidden" name="actualizar_cliente" value="1">
                <input type="hidden" required name="id_cliente" value="<?= $clientes->id_cliente ?>">
                <div class="fields">
                    <div class="input-field">
                        <label> Cedula/RUC</label>
                        <input type="text" placeholder="Ingresar Cedula" required name="cedula" value="<?= $clientes->cedula ?>">
                    </div>
                    <div class="input-field">
                        <label>Nombre</label>
                        <input type="text" placeholder="Ingresar Nombre" required name="nombre" value="<?= $clientes->nombre ?>">
                    </div>
                    <div class="input-field">
                        <label>Ciudad</label>
                        <input type="text" placeholder="Ingresar Ciudad" required name="id_ciudad" value="<?= $clientes->id_ciudad ?>">
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