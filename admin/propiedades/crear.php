<?php 
// base de datos

require '../../includes/config/database.php';

// se recibe el parametro de la conceccion a la base de daatos
$db = conectarDb();

//Consulta a la base de datos
$consulta = "SELECT id, nombre, apellido FROM vendedores";
$resultado = mysqli_query($db, $consulta);
// $f = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

        // echo '<pre>';
        // var_dump($_POST);
        // echo '</pre>';

//Arreglo con mensajes de error
$errores = [];

$titulo          = "";
$precio          = "";
$descripcion     = "";
$habitaciones    = "";
$wc              = "";
$estacionamiento = "";
$vendedor        = "";
$imagen = "";
$creado          = date('Y-m-d');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

        echo '<pre>';
        var_dump($_POST);
        echo '</pre>';

        $titulo          = mysqli_real_escape_string($db, $_POST['titulo']);
        $precio          = mysqli_real_escape_string($db, $_POST['precio']);
        $descripcion     = mysqli_real_escape_string($db, $_POST['descripcion']);
        $habitaciones    = mysqli_real_escape_string($db, $_POST['habitaciones']);
        $wc              = mysqli_real_escape_string($db, $_POST['wc']);
        $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
        $vendedor        = mysqli_real_escape_string($db, $_POST['vendedor']);

        //Asignamos files a una variable
        $imagen = $_FILES['imagen'];

        var_dump($imagen['name']);

        if( !$titulo ){
                $errores[] = "Debes agregar un titulo";
        }

        if( !$precio ){
                $errores[] = "El precio es obligatorio";
        }

        if( strlen( $descripcion ) < 50 ) {
                $errores[] = "La decripcion es obligatori y debe tener por lo menos 50 caracteres";
        }

        if( !$habitaciones ){
                $errores[] = "El numero de habitaciones es obligatorio";
        }

        if( !$wc ){
                $errores[] = "El numero de baños es obligatorio";
        }

        if( !$estacionamiento ){
                $errores[] = "El numero de estacionamiento es obligatorio";
        }

        if( !$vendedor ){
                $errores[] = "Elige un vendedor";
        }

        if( !$imagen['name'] ){
                $errores[] = "La imagen es obligatoria";
        }

        //validar por tamanio (100kb maximo)
        // $medida = 1000 * 100;
        // if($imagen['size'] > $medida) {
        //         $errores[] = "La imagen es muy pesada";
        // }

        // echo '<pre>';
        // var_dump($errores);
        // echo '</pre>';

        // Se revisa que el array de errores este vacio
        if(empty($errores)){

                //Subida de archivos
                //Crear un carpeta
                $carpetaImagenes = "../../imagenes";

                if(!is_dir($carpetaImagenes)){
                    mkdir($carpetaImagenes);
                }

                //Generar nombre de imagen unico
                $nombreimagen = md5(uniqid(rand(), true));

                //Subir la imagen
                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . "/milaneso" . $nombreimagen . ".jpg");

                //INSERTAR EN LA BASE DE DATOS
                $sql = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, fecha_creacion, vendedorid) 
                VALUES ('$titulo', '$precio', '$nombreimagen', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedor')";

                //echo de la variable $sql
                // echo $sql;

                mysqli_query($db, $sql);
        }
        

}

require '../../includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
        <h1>Crear</h1>
        <a href="../" class="boton boton-verde">Volver</a>

        <?php foreach( $errores as $error): ?>
                <div class="alerta error">
                        <?php echo $error ?>
                </div>
        <?php endforeach ?>

        <form action="" method="POST" class="formulario" enctype="multipart/form-data">
                <fieldset>
                        <legend>Informacion General</legend>
                        <label for="titulo">Titulo</label>
                        <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>">

                        <label for="precio">Precio</label>
                        <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">

                        <label for="imagen">Imagen:</label>
                        <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                        <label for="descripcion">Descripcion:</label>
                        <textarea id="descripcion" name="descripcion" cols="30" rows="10"><?php echo $descripcion; ?></textarea>
                </fieldset>
                <fieldset>
                        <legend>Informacion de la propiedad</legend>

                        <label for="habitaciones">Habitaciones</label>
                        <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej:3" min="1" max="9" value="<?php echo $habitaciones; ?>">

                        <label for="wc">Baños</label>
                        <input type="number" id="wc" name="wc" placeholder="Ej:3" min="1" max="9" value="<?php echo $wc; ?>">

                        <label for="estacionamiento">Estacionamiento</label>
                        <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej:3" min="1" max="9" value="<?php echo $estacionamiento; ?>">
                </fieldset>
                <fieldset>
                        <legend>Vendedor</legend>
                        <select name="vendedor">
                                <option value="">>--Selecione--<</option>
                                <?php while( $vendedores = mysqli_fetch_assoc($resultado) ): ?>
                                        <option <?php echo $vendedor === $vendedores['id'] ? 'selected' : ''; ?>  value="<?php echo $vendedores['id']; ?>"><?php echo $vendedores['nombre'] . " " . $vendedores['apellido'];?></option>
                                <?php endwhile; ?>
                        </select>
                </fieldset>

                <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
</main>

<?php 
incluirTemplate('footer');
?>