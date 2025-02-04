<?php
require '../include/header.php';

?>
<div class="home-content">
<div class="sales-boxes">
<div class="container">
            <header>
                Formulario de Registro
            </header>
        <form action="../../backend/controladores/proveedores.php" method="post">
                    <span class="title">Registrar Proveedor</span>
                    <input type="hidden" name="registrar_proveedor" value="1">
                    <div class="fields">
                        <div class="input-field">
                            <label>Nombre</label>
                            <input type="text" placeholder="Ingresar Nombre" required name="nombre_proveedor">
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