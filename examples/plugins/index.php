<?php

require "vendor/autoload.php";

$lib = new \Library\Library();

echo json_encode($lib->messages(), JSON_PRETTY_PRINT);
