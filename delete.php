<?php
require 'config.php';
require 'dao/vagaDaoMysql.php';

$vagaDao = new VagaDaoMysql($pdo);

$id = filter_input(INPUT_GET, 'id');
if($id) {
    $vagaDao->deleteVaga($id);
}