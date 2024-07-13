<?php

    require ('../config.php');

    $feedback = [
        'message'   => "",
        'success'   => true,
        'url'       => ""
    ];

    if (isset($_POST['url'])) {
        $action = 'update';
        $feedback['keep_enabled'] = true;
    } else {
        $action = 'insert';
        $feedback['keep_enabled'] = false;
    }

    $nome = sanitizeData($_POST['nome']);
    $cpf = sanitizeData($_POST['cpf']);
    $rg = sanitizeData($_POST['rg']);
    $data_nasc = sanitizeData($_POST['data-nasc']);
    $local_nasc = sanitizeData($_POST['local-nasc']);
    $cep = sanitizeData($_POST['cep']);
    $endereco = sanitizeData($_POST['endereco']);
    $cidade = sanitizeData($_POST['cidade']);
    $estado = sanitizeData($_POST['estado']);
    $email = sanitizeData($_POST['email']);
    $pagamento = sanitizeData($_POST['pagamento']);
    $emergency1 = sanitizeData($_POST['emergency1']);
    $emergency2 = sanitizeData($_POST['emergency2']);


    if ($action == 'update') {

        $url = sanitizeData($_POST['url']);
        $stmt = $conn->prepare("UPDATE navegando SET url = :url, nome = :nome, cpf = :cpf, rg = :rg, data_nasc = :data_nasc, local_nasc = :local_nasc, cep = :cep, endereco = :endereco, cidade = :cidade, estado = :estado, email = :email, emergency1 = :emergency1, emergency2 = :emergency2 WHERE url = :url");

    } else if ($action == 'insert') {

        $url = strtoupper(randStr(1, 'A')) . randStr(5, 'A');
        $stmt = $conn->prepare("INSERT INTO navegando (url, nome, cpf, rg, data_nasc, local_nasc, cep, endereco, cidade, estado, email, pagamento, emergency1, emergency2) VALUES (:url, :nome, :cpf, :rg, :data_nasc, :local_nasc, :cep, :endereco, :cidade, :estado, :email, :pagamento, :emergency1, :emergency2)");

        $stmt->bindParam(':pagamento', $pagamento);

    }
    
    $stmt->bindParam(':url', $url);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':cpf', $cpf);
    $stmt->bindParam(':rg', $rg);
    $stmt->bindParam(':data_nasc', $data_nasc);
    $stmt->bindParam(':local_nasc', $local_nasc);
    $stmt->bindParam(':cep', $cep);
    $stmt->bindParam(':endereco', $endereco);
    $stmt->bindParam(':cidade', $cidade);
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':emergency1', $emergency1);
    $stmt->bindParam(':emergency2', $emergency2);


    if ($stmt->execute()) {

        if ($action == 'insert') {
            $id = $conn->lastInsertId();
            $stmt = $conn->prepare("SELECT url FROM navegando WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $feedback['url'] = APP_URL . "/qr/" .  $stmt->fetch(PDO::FETCH_ASSOC)['url'];
         
        } else {

            $feedback['url'] = APP_URL . "/qr/" . $url;

        }
        
    }

    echo json_encode($feedback);
    
?>
