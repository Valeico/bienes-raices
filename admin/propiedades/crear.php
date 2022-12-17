<?php 
// base de datos

require '../../includes/config/database.php';

$db = conectarDb();

// var_dump($db);

require '../../includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
        <h1>Crear</h1>
        <a href="../" class="boton boton-verde">Volver</a>
        <form action="" class="formulario">
                <fieldset>
                        <legend>Informacion General</legend>
                        <label for="titulo">Titulo</label>
                        <input type="text" id="titulo" placeholder="Titulo Propiedad">

                        <label for="precio">Precio</label>
                        <input type="number" id="precio" placeholder="Precio Propiedad">

                        <label for="imagen">Imagen:</label>
                        <input type="file" id="precio" accept="image/jpeg, image/png">

                        <label for="descripcion">Descripcion:</label>
                        <textarea id="descripcion" cols="30" rows="10"></textarea>
                </fieldset>
                <fieldset>
                        <legend>Informacion de la propiedad</legend>

                        <label for="habitaciones">Habitaciones</label>
                        <input type="number" id="habitaciones" placeholder="Ej:3" min="1" max="9">

                        <label for="banios">Baños</label>
                        <input type="number" id="banios" placeholder="Ej:3" min="1" max="9">

                        <label for="estacionamiento">Estacionamiento</label>
                        <input type="number" id="estacionamiento" placeholder="Ej:3" min="1" max="9">
                </fieldset>
                <fieldset>
                        <legend>Vendedor</legend>
                        <select>
                                <option value="Juan">Juan</option>
                                <option value="Karen">Karen</option>
                        </select>
                </fieldset>

                <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
</main>

<?php 
incluirTemplate('footer');
?>