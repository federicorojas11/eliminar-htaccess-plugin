<?php
/*
Plugin Name: Eliminar Archivos .htaccess
Plugin URI: https://github.com/federicorojas11/eliminar-htaccess-plugin
Description: Plugin personalizado para eliminar archivos .htaccess creados en cierta fecha. La eliminación se ejecuta con la activación del plugin
Version: 1.0.0
Author: Federico Rojas
*/

function eliminar_archivos_htaccess() {
    $directorio_base = new RecursiveDirectoryIterator(ABSPATH);
    $archivos = new RecursiveIteratorIterator($directorio_base);
    $patron = '/^.+\/\.htaccess$/i';
    $archivos_htaccess = new RegexIterator($archivos, $patron, RecursiveRegexIterator::GET_MATCH);

    $fecha_limite = strtotime('2023-01-01');

    foreach ($archivos_htaccess as $archivo) {
        $ruta_archivo = $archivo[0];
        if (is_file($ruta_archivo)) {
            $fecha_modificacion = filemtime($ruta_archivo);
            if ($fecha_modificacion == $fecha_limite) {
                $resultado = unlink($ruta_archivo);
                if ($resultado) {
                    echo 'Se ha eliminado el archivo: ' . $ruta_archivo . '<br>';
                } else {
                    echo 'Error al eliminar el archivo: ' . $ruta_archivo . '<br>';
                }
            }
        }
    }
}

add_action('init', 'eliminar_archivos_htaccess');