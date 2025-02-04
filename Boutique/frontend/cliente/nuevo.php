<?php
require '../include/header.php';

?>
<div class="home-content">
    <div class="sales-boxes">
        <div class="container">
            <header>
                Formulario de Registro
            </header>
            <form action="../../backend/controladores/cliente.php" method="post">
                <span class="title">Información del Cliente</span>
                <input type="hidden" name="registrar_cliente" value="1">
                <div class="fields">
                    <div class="input-field">
                        <label> Cedula/RUC</label>
                        <input type="text" placeholder="Ingresar Cedula" required name="cedula">
                    </div>

                    <div class="input-field">
                        <label>Ciudad</label>
                        <input type="text" placeholder="Ingresar Ciudad" required name="id_ciudad">
                    </div>

                    <div class="input-field">
                        <label>Nombre</label>
                        <input type="text" placeholder="Ingresar Nombre" required name="nombre">
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