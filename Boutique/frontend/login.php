<?php
session_start();
$direccion = 'http://localhost/boutique/frontend/inicio/inicio.php';

if (isset($_SESSION['id_usuario'])) {
  header("location:" . $direccion);
}

include '../backend/db.php';
/** Consulta de datos de la empresa*/
$id_datos = 1;
$consulta_datos = $conn->query("SELECT * FROM datos_empresa WHERE id_datos =" . $id_datos);
$consulta_datos->execute();

$datos = $consulta_datos->fetch(PDO::FETCH_OBJ);
/** Consulta de datos de la empresa*/

/** Consulta de productos*/
$consulta = $conn->query("SELECT productos.*, categoria.descripcion, proveedores.nombre_proveedor FROM productos 
                        JOIN categoria ON categoria.id_categoria = productos.categoria 
                        JOIN proveedores ON proveedores.id_proveedor = productos.id_proveedor
                        WHERE productos.estado=1");
$consulta->execute();

$productos = $consulta->fetchAll(PDO::FETCH_OBJ);
/** Consulta de productos*/
?>
<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Iniciar Sesión</title>
  <link rel="stylesheet" href="./css/login.css" />
  <!-- Unicons -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
  <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.1/dist/flowbite.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
  <!-- Header -->
  <!-- Header -->
  <header class="header">
    <nav class="nav">
      <div class="nav_logo">
        <img src="../backend/controladores/<?= $datos->imagen_url ?>" alt="" class="logo_img">
        <a href="#" class="nav_logo_text"><?= $datos->nombre_empresa ?></a>
      </div>

      <button class="menu-toggle" id="menu-toggle">
        ☰
      </button>

      <ul class="nav_items" id="nav-menu">
        <li class="nav_item"><a href="#" class="nav_link">Inicio</a></li>
        <li class="nav_item"><a href="#productos" class="nav_link">Productos</a></li>
        <li class="nav_item"><a href="#" class="nav_link">Información</a></li>
        <li class="nav_item"><a href="#" class="nav_link">Contacto</a></li>
        <li class="nav_item">
          <button class="button" id="form-open">Iniciar Sesión</button>
        </li>
      </ul>
    </nav>
  </header>

  <!-- Home -->
  <section class="home">

    <div class="titulo-home">
      <h1 class="titulo-grande"><?= $datos->nombre_empresa ?></h1>
      <p class="bg-black bg-opacity-30 mb-6 text-lg font-normal text-gray-200 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-200">Descubrí las últimas tendencias en moda con prendas únicas, tenemos todo lo que necesitás para lucir increíble en cualquier ocasión.</p>
      <a href="#productos" type="button" class="text-white bg-[#FF9119] hover:bg-[#FF9119]/80 focus:ring-4 focus:outline-none focus:ring-[#FF9119]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:hover:bg-[#FF9119]/80 dark:focus:ring-[#FF9119]/40 me-2 mb-2">
        Ver Catalogo
      </a>
    </div>


    <div class="form_container">
      <i class="uil uil-times form_close"></i>
      <!-- Login From -->
      <div class="form login_form">
        <form action="../backend/validar.php" method="post">
          <h2>Iniciar Sesión</h2>
          <div class="input_box">
            <input type="email" placeholder="Ingresar email" required name="correo" />
            <i class="uil uil-envelope-alt email"></i>
          </div>
          <div class="input_box">
            <input type="password" placeholder="Ingresar contraseña" required name="codigo" />
            <i class="uil uil-lock password"></i>
            <i class="uil uil-eye-slash pw_hide"></i>
          </div>
          <input type="submit" class="button" value="Ingresar">
        </form>
      </div>

      <!-- Signup From 
        <div class="form signup_form">
          <form action="#">
            <h2>Signup</h2>
            <div class="input_box">
              <input type="email" placeholder="Enter your email" required />
              <i class="uil uil-envelope-alt email"></i>
            </div>
            <div class="input_box">
              <input type="password" placeholder="Create password" required />
              <i class="uil uil-lock password"></i>
              <i class="uil uil-eye-slash pw_hide"></i>
            </div>
            <div class="input_box">
              <input type="password" placeholder="Confirm password" required />
              <i class="uil uil-lock password"></i>
              <i class="uil uil-eye-slash pw_hide"></i>
            </div>
            <button class="button">Signup Now</button>
            <div class="login_signup">Already have an account? <a href="#" id="login">Login</a></div>
          </form>
        </div>
        -->
    </div>

  </section>
  <section class="products" id="productos">
    <h2 class="titulo-segundo">Mas Vendidos</h2>
    <div class="products_container">
      <?php foreach ($productos as $producto): ?>

        <div class="product_card">
          <img src="../backend/controladores/<?= $producto->imagen_url ?>" alt="Producto 1">
          <h3><?= $producto->nombre ?></h3>
          <p class="price"><?= number_format($producto->precio, 0, ',', '.') ?> Gs.</p>
          <button class="button">Agregar al carrito</button>
        </div>

      <?php endforeach; ?>

    </div>
  </section>

  <section class="products" id="productos">

    <h2 class="titulo-segundo">Nuestros Productos</h2>
    <div class="products_container">
      <?php foreach ($productos as $producto): ?>

        <div class="product_card">
          <img src="../backend/controladores/<?= $producto->imagen_url ?>" alt="Producto 1">
          <h3><?= $producto->nombre ?></h3>
          <p class="price"><?= number_format($producto->precio, 0, ',', '.') ?> Gs.</p>
          <button class="button">Agregar al carrito</button>
        </div>

      <?php endforeach; ?>

    </div>
  </section>
  <section class="home">
    <div class="titulo-home">

      <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Get back to growth with <span class="text-blue-600 dark:text-blue-500">the world's #1</span> CRM.</h1>
      <p class="text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400">Here at Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.</p>
    </div>
  </section>


  <script src="js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.1/dist/flowbite.min.js"></script>
  <script>
    document.getElementById("menu-toggle").addEventListener("click", function() {
      document.getElementById("nav-menu").classList.toggle("active");
    });
  </script>
</body>

<footer>
    <div class="footerContainer">
        <div class="socialIcons">
            <a href=""><i class="fa-brands fa-facebook"></i></a>
            <a href=""><i class="fa-brands fa-instagram"></i></a>
            <a href=""><i class="fa-brands fa-twitter"></i></a>
            <a href=""><i class="fa-brands fa-google-plus"></i></a>
            <a href=""><i class="fa-brands fa-youtube"></i></a>
        </div>
        <div class="footerNav">
            <ul><li><a href="">Inicio</a></li>
                <li><a href="">Información</a></li>
                <li><a href="">Productos</a></li>
                <li><a href="">Contactos</a></li>
            </ul>
        </div>
        
    </div>
    <div class="footerBottom">
        <p>Copyright &copy;2025; Diseñado por <span class="designer">Nicoletta</span></p>
    </div>
</footer>



</html>
