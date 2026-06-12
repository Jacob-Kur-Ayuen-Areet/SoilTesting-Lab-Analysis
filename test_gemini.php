<?php
// Read API key from .env
$env = file_get_contents(__DIR__ . '/.env');
preg_match('/GEMINI_API_KEY=(.+)/', $env, $m);
$apiKey = trim($m[1] ?? '');

echo "Testing key: " . substr($apiKey, 0, 20) . "..." . PHP_EOL;

$models = [
    'gemini-2.0-flash',
    'gemini-1.5-flash',
    'gemini-1.5-flash-8b',
];

foreach ($models as $model) {
    $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";
    $payload = json_encode(['contents' => [['parts' => [['text' => 'Say OK']]]]]);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $resp = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    echo PHP_EOL . "=== {$model} ===" . PHP_EOL;
    echo "HTTP: {$httpCode}" . PHP_EOL;

    if ($curlError) {
        echo "cURL Error: {$curlError}" . PHP_EOL;
        continue;
    }

    $data = json_decode($resp, true);
    if (isset($data['error'])) {
        $code = $data['error']['code'] ?? '?';
        $msg  = $data['error']['message'] ?? '?';
        echo "API Error [{$code}]: " . substr($msg, 0, 150) . PHP_EOL;
    } elseif (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
        echo "✅ SUCCESS: " . $data['candidates'][0]['content']['parts'][0]['text'] . PHP_EOL;
    } else {
        echo "Raw: " . substr($resp, 0, 200) . PHP_EOL;
    }
}
