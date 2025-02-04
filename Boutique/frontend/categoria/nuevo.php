<?php
require '../include/header.php';

?>
<div class="home-content">
<div class="sales-boxes">
<div class="container">
            <header>
                Formulario de Registro
            </header>
        <form action="../../backend/controladores/categoria.php" method="post">
                    <span class="title">Registrar Categorias</span>
                    <input type="hidden" name="registrar_categoria" value="1">
                    <div class="fields">
                        <div class="input-field">
                            <label>Nombre</label>
                            <input type="text" placeholder="Ingresar Nombre" required name="descripcion">
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