<?php

require_once( __DIR__ .'/../includes/config.php'); // Inclui o arquivo de configuração

$url = sanitizeData($_GET['url']); // Recebe a URL, que é uma string única que identifica o registro no banco de dados

// Busca os dados do registro no banco de dados
$navegando_info = $conn->prepare('SELECT * FROM navegando WHERE url = :url LIMIT 1');
$navegando_info->execute(array('url' => $url));
$navegando = $navegando_info->fetch();

// Retorna erro 404, caso não encontre o registro no banco de dados
if ($navegando == NULL) {
    http_response_code(404);
    exit();
}

$HideMenu = true; // Oculta o menu
include ( __DIR__ .'/../includes/layout/header.php'); // Inclui o cabeçalho

?>

<div class="container">
    <div class="pt-5 row">
        <div class="col-md-3">
            <form id="imagem-navegando-form" enctype="multipart/form-data">
                <label for="imagem-navegando-input" class="photo-icon">
                    <img class="img-thumbnail align-items-center d-flex flex-column mb-1" id="imagem-navegando" src="<?php echo $navegando['foto'] != NULL ? "/navegando/" . $navegando['url'] . "/foto/" . $navegando['foto'] : '/assets/img/placeholder.png'; ?>">
                    <small class="text-center">Clique para alterar a foto</small>
                </label>
                <input type="file" id="imagem-navegando-input" name="imagem-navegando" accept="image/*" style="display: none;">
                <input type="hidden" name="id" value="<?php echo $navegando['ID']; ?>">
            </form>
            <div class="login-notices-wrapper">
                <small>
                    <div id="feedback-alert" class="" role="alert"></div>
                </small>
            </div>
        </div>
        <div class="col-md-9 default-form default-edit">
            <div class="row justify-content-between">
                <div class="col-md-6 row g-3">
                    <h3 class="m-0">Documentos Necessários</h3>
                    <div class="form-group col-md-12">
                        <label for="nome">Nome</label>
                        <span class="form-control"><?php echo $navegando['nome']; ?></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="cpf">CPF</label>
                        <span class="form-control"><?php echo $navegando['cpf']; ?></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="rg">RG</label>
                        <span class="form-control"><?php echo $navegando['rg']; ?></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="data-nasc">Data de Nascimento</label>
                        <span class="form-control"><?php echo $navegando['data_nasc']; ?></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="local-nasc">Local de Nascimento</label>
                        <span class="form-control"><?php echo $navegando['local_nasc']; ?></span>
                    </div>
                </div>

                <div class="col-md-6 row g-3">
                    <h3 class="m-0">Informações de Contato</h3>
                    <div class="form-group col-md-4">
                        <label for="navegando-cep" id="cep-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Informe um CEP válido" data-bs-custom-class="custom-tooltip" aria-describedby="tooltip763046">CEP</label>
                        <span class="form-control"><?php echo $navegando['cep']; ?></span>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="endereco">Endereço</label>
                        <span class="form-control"><?php echo $navegando['endereco']; ?></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="cidade">Cidade</label>
                        <span class="form-control"><?php echo $navegando['cidade']; ?></span>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="estado">Estado</label>
                        <span class="form-control"><?php echo $navegando['estado']; ?></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">E-mail</label>
                        <span class="form-control"><?php echo $navegando['email']; ?></span>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="emergency1">Contato de Emergência 1</label>
                        <span class="form-control">
								<?php
									echo $navegando['emergency1']; 
									echo !empty($navegando['emergency2']) ? " / " . $navegando['emergency2'] : "";
								?>
						</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

include_once( __DIR__ .'/../includes/layout/footer.php'); // Inclui o rodapé

?>