<?php

    require_once( __DIR__ .'/../config.php');

    $url = $_GET['url'];

    $casal_info = $conn->prepare('DELETE FROM navegando WHERE url = :url');
    $casal_info->execute(array('url' => $url));
    $casal = $casal_info->fetch();

    $feedback = array(
        'success' => true,
        'message' => 'Excluído com sucesso!',
    );

    ECHO json_encode($feedback);

?>