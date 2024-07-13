<?php 

    require ('../config.php');

    $url = $_GET['url'];

    $stmt = $conn->prepare("SELECT * FROM navegando WHERE url = :url LIMIT 1");
    $stmt->bindParam(':url', $url);
    $stmt->execute();

    $stmt = $stmt->fetch();

    $feedback = array(
        'success' => true,
        'url' =>  APP_URL . "/qr/" . $stmt['url'],
        'id' => $stmt['ID'],
        'foto' => $stmt['foto'] != NULL ? "/navegando/" . $stmt['url'] . "/foto/" . $stmt['foto'] : '/assets/img/placeholder.png',
        'nome' => $stmt['nome'],
        'cpf' => $stmt['cpf'],
        'rg' => $stmt['rg'],
        'data_nasc' => date('d/m/Y', strtotime($stmt['data_nasc'])),
        'local_nasc' => $stmt['local_nasc'],
        'email' => $stmt['email'],
        'cidade' => $stmt['cidade'],
        'estado' => $stmt['estado'],
        'endereco' => $stmt['endereco'],
        'cep' => $stmt['cep'],
        'emergency' => $stmt['emergency1'] . " / " . $stmt['emergency2']
    );

    echo json_encode($feedback);

?>