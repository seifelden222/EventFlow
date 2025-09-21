<?php
$url = 'https://via.placeholder.com/640x480.png/008811?text=similique';

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_NOBODY, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
$response = curl_exec($ch);
if ($response === false) {
    echo "cURL error: " . curl_error($ch) . PHP_EOL;
    exit(1);
}
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
$contentLength = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
curl_close($ch);

echo "URL: $url\n";
echo "HTTP: $httpCode\n";
echo "Content-Type: $contentType\n";
echo "Content-Length: $contentLength\n";

return 0;
