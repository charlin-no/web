<?php
require 'conexion.php'; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $temaFavorito = $_POST['tema-favorito'] ?? '';
    $utilidad = $_POST['utilidad'] ?? '';
    $comentarios = $_POST['comentarios'] ?? '';

    if (!empty($temaFavorito) && !empty($utilidad)) {
        try {
            // Preparar la sentencia SQL para insertar en la tabla
            $sql = "INSERT INTO respuestas (tema_favorito, utilidad, comentarios) VALUES (:tema, :utilidad, :comentarios)";
            $stmt = $pdo->prepare($sql);

            // Ejecutar la sentencia con parámetros
            $stmt->execute([
                ':tema' => $temaFavorito,
                ':utilidad' => $utilidad,
                ':comentarios' => $comentarios
            ]);

            echo "<script>alert('¡Encuesta enviada correctamente!'); window.location.href = 'gracias.html';</script>";
            exit;
        } catch (PDOException $e) {
            echo "Error al guardar la encuesta: " . $e->getMessage();
        }
    } else {
        echo "Por favor, completa todos los campos obligatorios.";
    }
} else {
    echo "Método no permitido.";
}
?>