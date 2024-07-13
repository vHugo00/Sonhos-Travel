<?php

require ('../config.php');

if (isset($_FILES['imagem-casal'])){
    
    $id = intval($_POST['id']);

    # Recebe e trata a foto.
    if(isset($_FILES['imagem-casal']) && $_FILES['imagem-casal']['size'] > 0){
        
        $filetypes = array('png', 'jpeg', 'jpg', 'webp', 'gif', 'bmp');
        $image_filetype_array = explode('.', $_FILES['imagem-casal']['name']);
        $filetype = strtolower(end($image_filetype_array));

        # Valida se a extensão do arquivo é aceita.
        if (in_array($filetype, $filetypes) == false){
            $feedback = array('success' => false, 'type' => 'error', 'msg' => 'A foto precisa estar em formato JPEG ou PNG.', 'title' => "Formato Incorreto");
            echo json_encode($feedback);
            exit; 
        }

        # Renomeia e Faz o upload do arquivo.
        $new_name = sha1(date("Ymd-His")) . '.' . $filetype;
        $dir = '../../uploads/';
        if (move_uploaded_file($_FILES['imagem-casal']['tmp_name'], $dir . $new_name)){

            $casal_info = $conn->prepare('SELECT foto FROM casal_info WHERE ID = :ID LIMIT 1');
            $casal_info->execute(array('ID' => $id));
            $casal = $casal_info->fetch();
            $foto = $casal['foto'];
            
            if ($foto != 'placeholder.jpg' && $foto != 'placeholder.png' && $foto != NULL && !(empty($foto))){
                @unlink($dir . $foto);
            }

            $update_product_img = $conn->prepare('UPDATE casal_info SET foto = :foto WHERE ID = :ID');
            $update_product_img->execute(array('foto' => $new_name, 'ID' => $id));

            $feedback = array(
                'success' => true,
                'msg' => 'Imagem Atualizada!'
            );

        } else {
            $feedback = array('success' => false, 'msg' => 'Erro ao fazer upload da foto. Tente novamente. [1]');
            echo json_encode($feedback);
            exit;
        }

    } else {
        $feedback = array('success' => false, 'msg' => 'Erro ao fazer upload da foto. Tente novamente. [3]');
        echo json_encode($feedback);
        exit;
    }

    echo json_encode($feedback);
    exit;
        
} else {
    $feedback = array('success' => false, 'msg' => 'Erro ao fazer upload da foto. Tente novamente. [2]');
    echo json_encode($feedback);
    exit;
}

?>