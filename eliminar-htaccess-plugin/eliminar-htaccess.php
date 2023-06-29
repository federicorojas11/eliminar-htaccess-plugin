<?php
/*
Plugin Name: Eliminar Archivos .htaccess
Plugin URI: https://github.com/federicorojas11/eliminar-htaccess-plugin
Description: Plugin personalizado para eliminar archivos .htaccess creados en cierta fecha. La eliminación se ejecuta con la activación del plugin
Version: 1.0.0
Author: Federico Rojas
*/

function eliminar_archivos_htaccess() {
    $archivos_htaccess = glob(ABSPATH . '**/.htaccess', GLOB_NOSORT);

    if ($archivos_htaccess) {
        $fecha_objetivo = strtotime('2023-02-14'); // Modificar esta fecha con la fecha deseada

        foreach ($archivos_htaccess as $archivo) {
            if (is_file($archivo) && filemtime($archivo) === $fecha_objetivo) {
                unlink($archivo);
            }
        }
    }
}
add_action('init', 'eliminar_archivos_htaccess');