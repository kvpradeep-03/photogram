<?php

require_once 'libs/load.php';

$api = new API();
try {
    $api->processApi();
} catch (Exception $e) {
    $api->die($e);
}
