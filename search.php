<?php
require 'config.php';

// arquivo aonde busca o registro de usuários.
$pesq = filter_input(INPUT_POST, 'palavra');

if($pesq) {
    $sql = $pdo->prepare("SELECT * FROM vagas_users WHERE titulo LIKE :titulo");
    $sql->bindValue(':titulo', '%'. $pesq. '%');
    $sql->execute();
    
    if($sql->rowCount() > 0 ) {
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}

header("Content-Type: application/json");
echo json_encode($data);
exit;








