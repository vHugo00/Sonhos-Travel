<?php 

    require ('../config.php');

    $url = $_GET['url'];

    $stmt = $conn->prepare("SELECT * FROM casal_info WHERE url = :url LIMIT 1");
    $stmt->bindParam(':url', $url);
    $stmt->execute();

    $stmt = $stmt->fetch();

    $feedback = array(
        'success' => true,
        'url' =>  APP_URL . "/qr/" . $stmt['url'],
        'id' => $stmt['ID'],
        'foto' => $stmt['foto'] != NULL ? "/casal/" . $stmt['url'] . "/foto/" . $stmt['foto'] : '/assets/img/placeholder.png',
        'esposo_nome' => $stmt['esposo_nome'],
        'esposa_nome' => $stmt['esposa_nome'],
        'esposo_cpf' => $stmt['esposo_cpf'],
        'esposa_cpf' => $stmt['esposa_cpf'],
        'esposo_rg' => $stmt['esposo_rg'],
        'esposa_rg' => $stmt['esposa_rg'],
        'esposo_nascimento' => date('d/m/Y', strtotime($stmt['esposo_nascimento'])),
        'esposa_nascimento' => date('d/m/Y', strtotime($stmt['esposa_nascimento'])),
        'contato_esposo' => $stmt['contato_esposo'],
        'contato_esposa' => $stmt['contato_esposa'],
        'casal_email' => $stmt['casal_email'],
        'casal_cidade' => $stmt['casal_cidade'],
        'casal_estado' => $stmt['casal_estado'],
        'casal_endereco' => $stmt['casal_endereco'],
        'casal_cep' => $stmt['casal_cep'],
        'casal_emergency' => $stmt['casal_emergency1'] . " / " . $stmt['casal_emergency2'],
        'data_compra' => date('d/m/Y', strtotime($stmt['data_compra'])),
        'casal_casamento' => date('d/m/Y', strtotime($stmt['casal_casamento'])),
        'casal_comentarios' => $stmt['casal_comentarios'],
    );

    echo json_encode($feedback);

?>