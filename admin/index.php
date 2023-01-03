<?php
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
                        <tr>
                           <td>1</td>
                           <td>Casa Meca</td>
                           <td><img src="../imagenes/milaneso0e2e4b1d25ea9009ade5f362cd9debed.jpg" alt="Elabb"></td>
                           <td></td>
                           <td></td>     
                        </tr>
                </tbody>
        </table>

</main>

<?php 
incluirTemplate('footer');
?>