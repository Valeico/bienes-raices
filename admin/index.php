<?php

// importar la condicion
require '../includes/config/database.php';
$db = conectarDb();

// escribir el query
$query = "SELECT id, titulo, imagen, precio FROM propiedades";

// consultar la bd
$resultado = mysqli_query($db, $query);

$mensaje = '';
if(isset($_GET['mensaje'])){
        $mensaje = $_GET['mensaje'];
}
require '../includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
        <h1>Administrador de bienes raices</h1>
        <?php if($mensaje){ ?>
           <p><?php  echo $mensaje ?></p>
        <?php  } ?>
        <a href="propiedades/crear.php" class="boton boton-verde">Nueva propiedad</a>

        <table class="propiedades">
                <thead>
                        <th>ID</th>
                        <th>TITULO</th>
                        <th>IMAGEN</th>
                        <th>PRECIO</th>
                        <th>ACCIONES</th>
                </thead>
                <tbody>
                        <?php while($propiedad = mysqli_fetch_assoc($resultado)): ?>
                        <tr>
                           <td><?php echo $propiedad['id'] ?></td>
                           <td><?php echo $propiedad['titulo'] ?></td>
                           <td><img src="../imagenes/<?php echo $propiedad['imagen'] ?>.png" alt="Elabb" class="imagen-tabla"></td>
                           <td>$2000000</td>
                           <td>
                                <a href="#" class="boton-rojo-block">Actualizar</a>
                                <a href="#" class="boton-amarillo-block">Eliminar</a>
                           </td>   
                        </tr>
                        <?php endwhile; ?>
                </tbody>
        </table>

</main>

<?php 
incluirTemplate('footer');
?>