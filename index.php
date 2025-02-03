<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styles.css">
        <!-- importamos la biblioteca de bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <title>Tarea 9 DWES</title>
    </head>
    <body>
        <div class="container mt-4">
            <h2 class="text-center mb-4">List of your new favourite series</h2>
            <div class="row">
                <?php
/**
 * Función que obtien y muestra una lista de series americanas con algunos de sus datos
 * haciendo uso de la API TvMaze
 * 
 * @param no recibe nada por parámetro
 * 
 * @return void no retorna ningún dato, sino imprime unas tarjetas HTML con la info de cada serie
 * 
 */
                function mostrarSeries(){
                //url a la que vamos a solicitar datos
                //en este caso es una API tvmaze
                $url = "https://api.tvmaze.com/shows";
                //obtenemos los datos de la url, los datos nos vienen en formato JSON
                $resultado = file_get_contents($url);
                //convertimos los datos del fomrato JSON a un array PHP, parametro true para indicar que va a ser un array asociativo
                $datos = json_decode($resultado, true);
                //recorremos el array y en cada iteracionn
                foreach ($datos as $movie) {
                    //unimos los elemtos del array genres en una cadena para poder luego mostrarlos
                    $generos = implode(', ', $movie["genres"]);
                    ?>
                <!-- Creaos un div de tipo tarjeta usando la biblioteca bootstrap -->
                    <div class="col-md-3 mb-3">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <!-- Como titulo de la tarjeta se imprime el valor de la clave "name" del array movie -->
                                <h5 class="card-title text-info" ><?php echo $movie["name"]; ?></h5>
                                <!-- aqui se imprime el valor de la clave "id" del array movie -->
                                <h6 class="card-subtitle mb-2 text-muted">Post ID: <?php echo $movie["id"]; ?></h6>
                                <!-- aqui se imprime el valor de la clave "language" del array movie -->
                                <h6 class="card-subtitle mb-2 text-muted">Language: <?php echo $movie["language"]; ?></h6>
                                <!-- aqui se imprime el valor de la variable "generos" con almacena una cadena con los genereos -->
                                <h6 class="card-subtitle mb-2 text-muted">Genre: <?php echo $generos ?></h6>
                                <!-- aqui se imprime la url de la imagen de tamaño medio -->
                                <img src="<?php echo $movie["image"]["medium"]; ?>" class="card-img-top">
                                <!-- aqui se imprime la sinopsis de la serie -->
                                <!-- con strip_tags se ha eliminado cualquier etiqueta html -->
                                <p class="card-text truncate-summary"><?php echo strip_tags($movie["summary"]); ?></p>
                                <!-- aqui colocamos un boton que nos lleve al sitio oficial de cada series -->
                                <a href="<?php echo $movie["officialSite"]; ?>" class="btn btn-primary">Go to offical page</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                }
                mostrarSeries();
                ?>
            </div>
        </div>

    </body>
</html>
