<?php
/*
 Plugin Name: Distancia Fila Paneles Fotovoltaicos
 Description: Este plugin calcula la distancia mínima entre filas de paneles solares fotovoltaicos para que no les afecten sombras entre ellos. Para utilizarlo se usará en shotcode [distancia_paneles]
 Version: 1.0
 Author: Alberto NÚÑEZ
 Author URI: https://webficina.es
 License: GPLv2 o posterior
 Text Domain: Calculadora de orientación de paneles solares fotovoltaicos
 */

 // Agregar estilos CSS al encabezado
function distancia_paneles_enqueue_styles() {
    wp_enqueue_style('distancia-paneles-styles', plugin_dir_url(__FILE__) . 'style.css');
}
add_action('wp_enqueue_scripts', 'distancia_paneles_enqueue_styles');

// Agregar scripts JS al pie de página
function distancia_paneles_enqueue_scripts() {
    wp_enqueue_script('distancia-paneles-script', plugin_dir_url(__FILE__) . 'app.js', array(), '1.0', true);
}
add_action('wp_enqueue_scripts', 'distancia_paneles_enqueue_scripts');

// Función para mostrar el formulario de suma
function distancia_paneles_form() {
    ob_start();
    ?>
    <div class="dist-panel-contenedor">
        <div class="dist-panel-logo">
            <img src="<?php echo plugin_dir_url(__FILE__) . 'img/logo-blanco-autoconsumoweb.png'; ?>" alt="Logo Autoconsumoweb">
            <p class="dist-panel-text-logo">Autoconsumoweb</p>
        </div>
        <h2 class="dist-panel-titulo">Distancia entre filas de Paneles solares fotovoltaicos</h2>
        <img src="<?php echo plugin_dir_url(__FILE__) . 'img/distribucion-paneles-solares.jpg'; ?>" alt="esquema distribución paneles solares" class="dist-panel-imagen-distribucion">
        <div class="dist-panel-contenedor-formulario">
            <form action="" class="dist-panel-formulario" id="dist-panel-formulario">
                <div class="dist-panel-form-ciudad">
                    <p class="dist-panel-tag">Introduce el nombre de la ciudad</p>
                    <input type="text" name="nombre-ciudad" id="dist-panel-nombre" class="dist-panel-nombre" placeholder="Ciudad" required>
                </div>
                <div class="dist-panel-form-latitud">
                    <p class="dist-panel-tag">Introduce la Latitud de la ciudad</p>
                    <p class="dist-panel-tag-lat">Grados</p>
                    <input type="number" name="latitud" id="dist-panel-latitud-grados" class="dist-panel-latitud-grados" placeholder="Latitud-Grados" required>
                    <p class="dist-panel-tag-lat">Minutos</p>
                    <input type="number" name="latitud" id="dist-panel-latitud-minutos" class="dist-panel-latitud-minutos" placeholder="Latitud-Minutos" required>
                </div>
                <div class="dist-panel-form-altura">
                    <p class="dist-panel-tag">Introduce la altura (L) del Panel Fotovoltaico</p>
                    <p class="dist-panel-tag-mini">Recuerda de que la altura (L) del panel va a ser distinta si lo instalas en vertical que en horizontal</p>
                    <img src="<?php echo plugin_dir_url(__FILE__) . 'img/altura-panel-fotovoltaico.jpg'; ?>" alt="imagen de altura de panel según su instalación" class="dist-panel-altura-panel">
                    <p class="dist-panel-tag-altura">Altura L en mm.</p>
                    <input type="number" name="altura" id="dist-panel-altura" class="dist-panel-altura" placeholder="Altura del panel" required>
                </div>
                <div class="dist-panel-boton">
                    <button type="submit" id="dist-panel-btn" class="dist-panel-btn">Calcular Distancia</button>
                </div>
            </form>
            <div class="dist-panel-resultados dist-panel-resultados-display" id="dist-panel-resultados">

            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('distancia_paneles', 'distancia_paneles_form');