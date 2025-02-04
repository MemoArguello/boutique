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
</head>

<body>
  <!-- Header -->
  <header class="header">
    <nav class="nav">
      <a href="#" class="nav_logo"><?= $datos->nombre_empresa ?></a>
      <ul class="nav_items">
        <li class="nav_item">
          <a href="#" class="nav_link">Home</a>
          <a href="#" class="nav_link">Product</a>
          <a href="#" class="nav_link">Services</a>
          <a href="#" class="nav_link">Contact</a>
        </li>
      </ul>
      <button class="button" id="form-open">Iniciar Sesión</button>
    </nav>
  </header>
  <!-- Home -->
  <section class="home">
  <div class="flex flex-col items-center justify-center h-screen text-center">
  <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">We invest in the world’s potential</h1>
      <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-200">Here at Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.</p>
      <a href="#" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
        Learn more
        <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
        </svg>
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
  <section class="products">
    <h2 class="section_title">Nuestros Productos</h2>
    <div class="products_container">
    <?php foreach ($productos as $producto): ?>

      <div class="product_card">
        <img src="../backend/controladores/<?=$producto->imagen_url ?>" alt="Producto 1">
        <h3><?= $producto->nombre ?></h3>
        <p class="price">$15.99</p>
        <button class="button">Agregar al carrito</button>
      </div>

      <?php endforeach; ?>

    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.1/dist/flowbite.min.js"></script>

  <script src="js/script.js"></script>
</body>

</html>