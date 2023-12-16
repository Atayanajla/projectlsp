<?php

// Mengambil URL dari parameter query string
$url = isset($_GET['url']) ? $_GET['url'] : '';

if (empty($url)) {
    // Jika URL tidak disertakan, kirim respons error
    http_response_code(400);
    echo json_encode(['error' => 'URL not provided']);
    exit;
}

// Inisialisasi cURL
$ch = curl_init();

// Set URL dan opsi cURL
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

// Eksekusi cURL dan ambil respons
$response = curl_exec($ch);

// Ambil informasi tentang respons HTTP
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// Tutup koneksi cURL
curl_close($ch);

// Setel header respons sesuai dengan respons asli
header('Content-Type: application/json');
http_response_code($httpCode);

// Kembalikan respons ke klien
echo $response;

?>