<?php
foreach ($alertas as $key => $mensajes) {
    foreach ($mensajes as $mensaje) {
?>
        <div class="alerta <?php echo $key;?>">
            <p><?php echo $mensaje; ?></p>
        </div>
<?php
    }
}
?>