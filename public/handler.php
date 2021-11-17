<?php

require_once '../vendor/autoload.php';
require_once '../functions.php';

$response = [
    'isError' => false,
    'errorMessage' => "",
    'data' => []
];

$domain = $_POST['domain'];
$login = $_POST['login'];
$password = $_POST['password'];

try {
    $url = \Otis22\VetmanagerUrl\url($domain);
    $token = \Otis22\VetmanagerToken\Token(
        \Otis22\VetmanagerToken\credentials(
            $login, $password, "vmmobilka"
        ),
        $domain
    );
    $db = db();
    $query = "SELECT * FROM credentials WHERE api_token='{$token->asString()}' AND url='{$url->asString()}'";
    $creds = $db->query($query);
    if (!$creds->fetchAll()) {
        $db->query("insert into credentials (api_token, url)
        VALUES (\"{$token->asString()}\", \"{$url->asString()}\");");
    }
    $response['data']['link'] = buildAppUrl(md5($token->asString().$url->asString()));
} catch (\Exception $e) {
    $response['isError'] = true;
    $response['errorMessage'] = $e->getMessage();
}

echo json_encode($response);

