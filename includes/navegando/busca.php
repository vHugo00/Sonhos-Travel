<?php

    require_once( __DIR__ .'/../config.php');

    sleep(1);
    
    if (empty($_GET['query'])) {
        $stmt = $conn->prepare('SELECT * FROM navegando ORDER BY created_at DESC LIMIT 10');
        $stmt->execute();
    } else {
        $stmt = $conn->prepare('
            SELECT * FROM navegando
            WHERE nome LIKE :query OR cpf LIKE :query OR email LIKE :query OR cidade LIKE :query
            ORDER BY created_at DESC LIMIT 10');
        $stmt->execute(array('query' => "%" . trim($_GET['query']) . "%"));
    }
    
    $result = "";

    if ($stmt->rowCount() > 0){
        while($r = $stmt->fetch()) {

            $result .= '<tr>';

                $result .= '<td>' . $r['nome'] . '</td>';
                $result .= '<td>' . $r['cpf'] . '</td>';
                $result .= '<td>' . $r['email'] . '</td>';
                $result .= '<td>' . $r['cidade'] . '</td>';
                $result .= '<td>
                    <a href="#" class="edit-navegando-info" data-url="' . $r['url'] . '" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Visualizar">
                        <i class="fas fa-eye"></i>
                    </a>
                </td>';
            
            $result .= '</tr>';
        }

    } else {
            
        $result = '<tr><td colspan="5">Sem resultados para a busca</td></tr>';
    
    }

    $feedback = array('result' => $result);
    echo json_encode($feedback);
