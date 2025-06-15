<?php
require 'vendor/autoload.php';

\Midtrans\Config::$serverKey = getenv('MIDTRANS_SERVER_KEY');
\Midtrans\Config::$isProduction = false; // Ubah ke true jika produksi
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

// Ambil parameter dari request
$params = json_decode(file_get_contents("php://input"), true);

try {
    $snapToken = \Midtrans\Snap::getSnapToken($params);
    echo json_encode(['snap_token' => $snapToken]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
