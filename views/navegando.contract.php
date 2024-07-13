<?php

// Inclui o arquivo de configuração
require_once( __DIR__ .'/../includes/config.php');

// Recebe a URL, que é uma string única que identifica o casal no banco de dados
$url = sanitizeData($_GET['url']);

// Busca os dados do casal no banco de dados
$navegando = $conn->prepare('SELECT * FROM navegando WHERE url = :url LIMIT 1');
$navegando->execute(array('url' => $url));
$navegando = $navegando->fetch();

// Retorna erro 404, caso não encontre o registro no banco de dados
if ($navegando == NULL) {
    http_response_code(404);
    exit();
}

$contrante = array(
    'nome' => $navegando['nome'],
    'cpf' => $navegando['cpf'],
    'endereco' => $navegando['endereco'] . ', ' . $navegando['cidade'] . ' - ' . $navegando['estado'] . ', CEP ' . $navegando['cep']
);

$pagamento = $navegando['pagamento'];
$date = date('d \d\e M \d\e Y', strtotime($navegando['created_at']));

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato</title>
    <link rel="stylesheet" href="<?php echo APP_URL; ?>/assets/fonts/fontawesome/css/all.min.css">
    <style>
        body {
            width: 21cm;
            height: 29.7cm;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            line-height: 1.5;
            background-color: gray;
        }
        .page {
            width: 100%;
            height: 100%;
            display: flex;
            box-sizing: border-box;
            page-break-after: always;
            background-color: white;
            margin: 25px;
            overflow: hidden;
            flex-direction: column;
            justify-content: space-between;
            background-image: url('/assets/img/contratos/navegando/bg.png');
            background-position: center;
            background-repeat: no-repeat;
            box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
        }
        img {
            max-width: 100%;
            height: auto;
        }

        .header .header-img {
            display: block;
            margin: 0 auto;
        }

        .page .header {
            display: flex;
            background-color: #C1175A;
            height: 2.6cm;
            align-items: center;
        }

        .page .body {
            position: relative;
            padding: 1cm 2cm 0cm 2cm;
            height: 23.7cm;
        }
        
        .page .footer {
            display: flex;
            position: relative;
            height: 5cm;
            align-items: flex-end;
        }

        .page .footer .contact {
            display: flex;
            position: relative;
            height: 2.2cm;
            background-color: #C1175A;
            border-radius: 80px 0 0 80px;
            width: calc(100% - 180px);
            margin-bottom: 40px;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.1em;
        }

        h1 {
            font-weight: bold;
        }

        h1, p {
            font-size: 12pt;
        }
        
        .mb0 {
            margin-bottom: 0;
        }

        .mt0 {
            margin-top: 0;
            text-align: justify;
        }

        .b {
            font-weight: bold;
        }

        @media print {
            body {
                background-color: white;
            }

            body * {
                visibility: hidden;
            }
            .page, .page * {
                visibility: visible;
            }
            .page {
                /* position: absolute;
                top: 0;
                left: 0; */
                margin: 0;
                box-shadow: none !important;
            }
        }
    </style>
    <script>
        window.onload = function() {
            
            const printOptions = {
                margin: 0,
                printBackground: true,
            };

            window.print();
            
        }
    </script>
</head>
<body>
    <div class="page">
        <div class="header">
            <img class="header-img" src="/assets/img/logo-sonhos.png" style="width: 180px;">
        </div>
        <div class="body">
    
            <h1>CONTRATO DE PARTICIPAÇÃO EM PROGRAMA DE IMERSÃO</h1>
            
            <p class="mb0 b">CLÁUSULA PRIMEIRA</p>
            <p class="mt0">O presente Contrato de Prestação de Serviços é celebrado entre a Agência de Viagens SONHOS TRAVEL LTDA, pessoa jurídica de direito privado, inscrita no CNPJ/MF sob o n° 26.981.905/0001-83, com endereço comercial sito à Comendador Ayrton Plaisant n° 99, Centro, CEP: 84010-550, Ponta Grossa - PR, doravante denominada CONTRATADA, e de outro lado, o CONTRATANTE, cujos dados estão descritos a seguir:</p>

            <p class="mb0 b">1. PARTES</p>
            <p class="mt0">Contratante: <?php echo $contrante['nome']; ?>, CPF <?php echo $contrante['cpf']; ?>, residente no(a) <?php echo $contrante['endereco']; ?>.</p>
            <p>Contratada: SONHOS TRAVEL LTDA, CNPJ 26.981.905/0001-83, Comendador Ayrton Plaisant n° 99, Centro, CEP: 84010-550, Ponta Grossa - PR.</p>

            <p class="mb0 b">2. OBJETO DO CONTRATO</p>
            <p class="mt0">O presente contrato tem como objeto a participação do Contratante no programa de imersão Encontro de Casais em Alto Mar, oferecido pela Contratada, conforme descrito no site oficial <?php echo APP_URL; ?>, durante o período de <?php echo INICIO; ?> a <?php echo TERMINO; ?>.</p>

            <p class="mb0 b">3. VALOR E FORMA DE PAGAMENTO</p>
            <p class="mt0">O valor total do programa é de R$ <?php echo VALOR; ?>, a ser pago da seguinte forma:<br>
            À vista, por meio de: <br>
            (<?php echo $pagamento == 'pix' ? 'X' :  '&nbsp;&nbsp;'; ?>) Pix <br>
            (<?php echo $pagamento == 'boleto' ? 'X' :  '&nbsp;&nbsp;'; ?>) boletos bancários ou <br>
            (<?php echo $pagamento == 'credito' ? 'X' :  '&nbsp;&nbsp;'; ?>) cartão de crédito, ou <br>
            (<?php echo $pagamento == NULL || $pagamento == 'outro' ? 'X' :  '&nbsp;&nbsp;'; ?>) outra forma de pagamento que permanecerá em sua posse</p>

            <p class="mb0 b">4. DIREITO DE CANCELAMENTO E DEVOLUÇÃO</p>
            <p class="mt0">4.1. O Contratante terá o prazo de 7 (sete) dias corridos, contados a partir da data de confirmação da inscrição, para cancelar sua participação no programa e solicitar a devolução integral do valor pago.</p>

        </div>
        <div class="footer">
            <div class="logo">
                <img src="/assets/img/contratos/navegando/logo.png">
            </div>
            <div class="contact">
                <span><i class="fab fa-instagram"></i>&nbsp;@sonhostravelviagem</span>
                <span><i class="fab fa-facebook-square"></i>&nbsp;www.sonhostravelviagem.com.br</span>
            </div>
        </div>
    </div>
    <div class="page">
        <div class="header">
            <img class="header-img" src="/assets/img/logo-sonhos.png" style="width: 180px;">
        </div>
        <div class="body">
    
            4.2. Para exercer o direito de cancelamento, o Contratante deverá enviar uma solicitação por escrito para o e-mail [E-mail da Empresa] dentro do prazo estabelecido no item 4.1.
            <br>
            4.3. Após o recebimento da solicitação de cancelamento, a Contratada terá um prazo de até 30 (trinta) dias para realizar a devolução do valor pago ao Contratante.
            <br>
            4.4. Passado o prazo de 7 (sete) dias corridos mencionados no item 4.1, o Contratante não terá mais direito à devolução do valor pago, mesmo que decida desistir do programa antes do seu término.
            </p>

            <p class="mb0 b">5. OBRIGAÇÕES DA CONTRATADA</p>
            <p class="mt0">5.1. Oferecer todas as atividades, materiais e suporte necessários para a execução do programa de imersão conforme descrito no site oficial.
            <br>
            5.2. Comunicar com antecedência qualquer alteração na programação ou no conteúdo do programa.
            </p>

            <p class="mb0 b">6. OBRIGAÇÕES DO CONTRATANTE</p>
            <p class="mt0">6.1. Participar ativamente de todas as atividades propostas no programa de imersão.
            <br>    
            6.2. Cumprir com os pagamentos conforme estabelecido no item 3 deste contrato.</p>

            <p class="mb0 b">7. DISPOSIÇÕES GERAIS</p>
            <p class="mt0">7.1. O presente contrato é regido pelas leis brasileiras.
            <br>
            7.2. Fica eleito o foro da comarca de Ponta Grossa, Paraná, para dirimir quaisquer questões oriundas deste contrato.
            <br>
            E por estarem assim justos e contratados, assinam o presente instrumento em duas vias de igual teor e forma, juntamente com duas testemunhas.</p>

            <br>
            <p class="mb0">Ponta Grossa, <?php echo $date; ?>.</p>

            <p class="mb0">___________________________________________<br>Contratante</p>
            <p class="mb0">___________________________________________<br>Representante da Contratada</p>

        </div>
        <div class="footer">
            <div class="logo">
                <img src="/assets/img/contratos/navegando/logo.png">
            </div>
            <div class="contact">
                <span><i class="fab fa-instagram"></i>&nbsp;@sonhostravelviagem</span>
                <span><i class="fab fa-facebook-square"></i>&nbsp;www.sonhostravelviagem.com.br</span>
            </div>
        </div>
    </div>
    <div class="page">
        <div class="header">
            <img class="header-img" src="/assets/img/logo-sonhos.png" style="width: 180px;">
        </div>
        <div class="body">
    
            <img class="sec-img" src="/assets/img/contratos/casais/img-sec.png">

            <p class="mb0">___________________________________________<br>Testemunha 1 - Nome e Assinatura<br></p>
            <p class="mb0">___________________________________________<br>Testemunha 2 - Nome e Assinatura</p>

        </div>
        <div class="footer">
            <div class="logo">
                <img src="/assets/img/contratos/navegando/logo.png">
            </div>
            <div class="contact">
                <span><i class="fab fa-instagram"></i>&nbsp;@sonhostravelviagem</span>
                <span><i class="fab fa-facebook-square"></i>&nbsp;www.sonhostravelviagem.com.br</span>
            </div>
        </div>
    </div>
</body>
</html>
