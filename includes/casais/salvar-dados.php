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

    $esposo_nome = sanitizeData($_POST['esposo-nome']);
    $esposo_cpf = sanitizeData($_POST['esposo-cpf']);
    $esposo_rg = sanitizeData($_POST['esposo-rg']);
    $esposo_nascimento = sanitizeData($_POST['esposo-nascimento']);
    $contato_esposo = sanitizeData($_POST['contato-esposo']);
    $esposa_nome = sanitizeData($_POST['esposa-nome']);
    $esposa_cpf = sanitizeData($_POST['esposa-cpf']);
    $esposa_rg = sanitizeData($_POST['esposa-rg']);
    $esposa_nascimento = sanitizeData($_POST['esposa-nascimento']);
    $contato_esposa = sanitizeData($_POST['contato-esposa']);
    $casal_endereco = sanitizeData($_POST['casal-endereco']);
    $cabine = sanitizeData($_POST['cabine']); 
    $casal_cep = sanitizeData($_POST['casal-cep']);
    $casal_cidade = sanitizeData($_POST['casal-cidade']);
    $casal_estado = sanitizeData($_POST['casal-estado']);
    $casal_email = sanitizeData($_POST['casal-email']);
    $casal_emergency1 = sanitizeData($_POST['casal-emergency1']);
    $casal_emergency2 = sanitizeData($_POST['casal-emergency2']);
    $data_compra = sanitizeData($_POST['data-compra']);
    $casal_casamento = sanitizeData($_POST['casal-casamento']);
    $casal_comentarios = sanitizeData($_POST['casal-comentarios']);
    $pagamento = sanitizeData($_POST['pagamento']);

    if ($action == 'update') {

        $url = sanitizeData($_POST['url']);
        $stmt = $conn->prepare("UPDATE casal_info SET esposo_nome = :esposo_nome, url = :url, esposo_cpf = :esposo_cpf, esposo_rg = :esposo_rg, esposo_nascimento = :esposo_nascimento, contato_esposo = :contato_esposo, esposa_nome = :esposa_nome, esposa_cpf = :esposa_cpf, esposa_rg = :esposa_rg, esposa_nascimento = :esposa_nascimento, contato_esposa = :contato_esposa, casal_endereco = :casal_endereco, cabine = :cabine, casal_cep = :casal_cep, casal_cidade = :casal_cidade, casal_estado = :casal_estado, casal_email = :casal_email, casal_emergency1 = :casal_emergency1, casal_emergency2 = :casal_emergency2, data_compra = :data_compra, casal_casamento = :casal_casamento, casal_comentarios = :casal_comentarios WHERE url = :url");

    } else if ($action == 'insert') {

        $url = strtolower(randStr(1, 'A')) . randStr(5, 'A');
        $stmt = $conn->prepare("INSERT INTO casal_info (esposo_nome, url, esposo_cpf, esposo_rg, esposo_nascimento, contato_esposo, esposa_nome, esposa_cpf, esposa_rg, esposa_nascimento, contato_esposa, casal_endereco, cabine, casal_cep, casal_cidade, casal_estado, casal_email, casal_emergency1, casal_emergency2, data_compra, casal_casamento, casal_comentarios, pagamento ) VALUES (:esposo_nome, :url, :esposo_cpf, :esposo_rg, :esposo_nascimento, :contato_esposo, :esposa_nome, :esposa_cpf, :esposa_rg, :esposa_nascimento, :contato_esposa, :casal_endereco, :cabine, :casal_cep, :casal_cidade, :casal_estado, :casal_email, :casal_emergency1, :casal_emergency2, :data_compra, :casal_casamento, :casal_comentarios, :pagamento)");

        $stmt->bindParam(':pagamento', $pagamento);

    }

    $stmt->bindParam(':esposo_nome', $esposo_nome);
    $stmt->bindParam(':url', $url);
    $stmt->bindParam(':esposo_cpf', $esposo_cpf);
    $stmt->bindParam(':esposo_rg', $esposo_rg);
    $stmt->bindParam(':esposo_nascimento', $esposo_nascimento);
    $stmt->bindParam(':contato_esposo', $contato_esposo);
    $stmt->bindParam(':esposa_nome', $esposa_nome);
    $stmt->bindParam(':esposa_cpf', $esposa_cpf);
    $stmt->bindParam(':esposa_rg', $esposa_rg);
    $stmt->bindParam(':esposa_nascimento', $esposa_nascimento);
    $stmt->bindParam(':contato_esposa', $contato_esposa);
    $stmt->bindParam(':casal_endereco', $casal_endereco);
    $stmt->bindParam(':cabine', $cabine);
    $stmt->bindParam(':casal_cep', $casal_cep);
    $stmt->bindParam(':casal_cidade', $casal_cidade);
    $stmt->bindParam(':casal_estado', $casal_estado);
    $stmt->bindParam(':casal_email', $casal_email);
    $stmt->bindParam(':casal_emergency1', $casal_emergency1);
    $stmt->bindParam(':casal_emergency2', $casal_emergency2);
    $stmt->bindParam(':data_compra', $data_compra);
    $stmt->bindParam(':casal_casamento', $casal_casamento);
    $stmt->bindParam(':casal_comentarios', $casal_comentarios);

    if ($stmt->execute()) {

        if ($action == 'insert') {

            $id = $conn->lastInsertId();
            $stmt = $conn->prepare("SELECT url FROM casal_info WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $feedback['url'] = APP_URL . "/qr/" .  $stmt->fetch(PDO::FETCH_ASSOC)['url'];
            
        } else {

            $feedback['url'] = APP_URL . "/qr/" . $url;

        }
        
    }

        echo json_encode($feedback);

?>
