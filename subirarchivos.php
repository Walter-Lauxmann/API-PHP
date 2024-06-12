<?php
// Definimos los encabezados para poder recibir archivos
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requested-With');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

$mensaje = '';
$nombre = '';

if (                                             // si
        isset($_FILES) &&                        // está seteado $_FILES Y
        isset($_FILES['imagen']) &&              // está seteado $_FILES['imagen'] Y
        !empty($_FILES['imagen']['name'] &&      // NO está vacío $_FILES['imagen']['name'] Y
        !empty($_FILES['imagen']['tmp_name']))   // NO está vacío $_FILES['imagen']['tmp_name']
        ) {
        //Hemos recibido el fichero
        //Comprobamos que es un fichero subido por PHP, y no hay inyección por otros medios
        if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {     // si está subido el archivo $_FILES['imagen']['tmp_name'])
            $tmp_nombre = $_FILES['imagen']['tmp_name'];           // Guardamos el nombre temporal en $tmp_nombre
            $nombre = $_FILES['imagen']['name'];                   // Guardamos el nombre en $nombre
            $destino = './img/productos/'.$nombre;                                      // Guardamos la ruta en $destino

            if (move_uploaded_file($tmp_nombre, $destino)) {     // Si podemos mover el archivo
                $mensaje = "Fichero subido correctamente a: ".$destino;
                //$valores['imagen'] = $nombre;                  // Guardamos en el atributo "imagen" el nombre del archivo
            } else {                                             // sino
                $mensaje = "Error: No se ha podido mover el fichero enviado a la carpeta de destino";
                unlink(ini_get('upload_tmp_dir').$_FILES['imagen']['tmp_name']);  // Eliminamos el archivo temporal subido
            }  
        } else {                                                 // sino
            $mensaje = "Error: El fichero encontrado no fue procesado por la subida correctamente";
        }         
    }
    echo json_encode(array(
        'mensaje' => $mensaje,
        'nombre' => $nombre
    ));
?>