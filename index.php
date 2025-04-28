<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comentario = htmlspecialchars($_POST['comentario']);
    
    // Validar si se subió una imagen
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        $nombreArchivo = $_FILES['foto']['name'];
        $tmpArchivo = $_FILES['foto']['tmp_name'];
        $carpetaDestino = 'uploads/';

        // Crear la carpeta si no existe
        if (!is_dir($carpetaDestino)) {
            mkdir($carpetaDestino, 0755, true);
        }

        $rutaFinal = $carpetaDestino . uniqid() . '-' . basename($nombreArchivo);

        if (move_uploaded_file($tmpArchivo, $rutaFinal)) {
            echo "Reporte recibido con éxito.<br>";
            echo "Comentario: " . $comentario . "<br>";
            echo "Foto guardada en: " . $rutaFinal;
        } else {
            echo "Error al subir la imagen.";
        }
    } else {
        echo "No se subió ninguna imagen o hubo un error.";
    }
} else {
    echo "Acceso no permitido.";
}
?>