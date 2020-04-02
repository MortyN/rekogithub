<?php require_once __DIR__ . '/../access/src/autoload.php';
$siteKey = '6LdwzeUUAAAAALPDLyDOm1qRsZx-VWmPhgAwgFgt';
$secret = '6LdwzeUUAAAAAASNXh9LqUch-41b7jSmLE1ZgYco';

if ($siteKey == '' && is_readable(__DIR__ . '/capConfig.php')) {
    $config = include __DIR__ . '/config.php';
    $siteKey = $config['v2-standard']['site'];
    $secret = $config['v2-standard']['secret'];
}
?>