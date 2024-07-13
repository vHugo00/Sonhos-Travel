<?php

    require_once( __DIR__ .'/../config.php');

    sleep(1);
    
    if (empty($_GET['query'])) {
        $stmt = $conn->prepare('SELECT * FROM casal_info ORDER BY created_at DESC LIMIT 10');
        $stmt->execute();
    } else {
        $stmt = $conn->prepare('
            SELECT * FROM casal_info
            WHERE esposo_nome LIKE :query OR esposo_cpf LIKE :query OR esposa_nome LIKE :query OR esposa_cpf LIKE :query  OR casal_email LIKE :query OR casal_cidade LIKE :query
            ORDER BY created_at DESC LIMIT 10');
        $stmt->execute(array('query' => "%" . trim($_GET['query']) . "%"));
    }
    
    $result = "";

    if ($stmt->rowCount() > 0){
        while($r = $stmt->fetch()) {

            $result .= '<tr>';

                $result .= '<td>' . $r['esposo_nome'] . '<br><small>(' . $r['esposo_cpf'] .')</small></td>';
                $result .= '<td>' . $r['esposa_nome'] . '<br><small>(' . $r['esposa_cpf'] .')</small></td>';
                $result .= '<td>' . $r['casal_email'] . '</td>';
                $result .= '<td>' . $r['casal_cidade'] . '</td>';
                $result .= '<td>
                    <a href="#" class="edit-casal-info" data-url="' . $r['url'] . '" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Visualizar">
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
