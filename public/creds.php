<?php

require_once '../functions.php';

if (!$_GET['token']) {
    die("Токен не передан");
}

$result = [
    'error' => false,
    'errorMessage' => "",
    'data' => []
];
try {
    $db = db();
    $creds = $db->query("SELECT * FROM credentials WHERE md5(CONCAT(api_token, url))='{$_GET['token']}'");
    $result['data'] = $creds->fetchAll()[0];
} catch (\Exception $exception) {
    $result['error'] = true;
    $result['errorMessage'] = $exception->getMessage();
}

echo json_encode($result);