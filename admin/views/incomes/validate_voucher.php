<?php
require_once('../../includes/load.php'); // Asegúrate de incluir la conexión a la base de datos

if (isset($_POST['n_voucher'])) {
    $num_voucher = $_POST['n_voucher'];

    // Llama a la función para verificar si el voucher existe
    $voucher = find_incomes_by_voucher($num_voucher);

    if ($voucher) {
        // Si el voucher ya existe, devolver un mensaje de error
        echo json_encode(['status' => 'exists', 'message' => 'El número de comprobante ya está registrado.']);
    } else {
        // Si no existe, devolver un estado de éxito
        echo json_encode(['status' => 'ok', 'message' => 'El número de comprobante está disponible.']);
    }
}
