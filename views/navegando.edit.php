<?php

require_once( __DIR__ .'/../includes/config.php'); // Inclui o arquivo de configuração

$url = sanitizeData($_GET['url']); // Recebe a URL, que é uma string única que identifica o registro no banco de dados

// Busca os dados do registro no banco de dados
$navegando = $conn->prepare('SELECT * FROM navegando WHERE url = :url LIMIT 1');
$navegando->execute(array('url' => $url));
$nav = $navegando->fetch();

// Retorna erro 404, caso não encontre o registro no banco de dados
if ($nav == NULL) {
    http_response_code(404);
    exit();
}

// Inclui o cabeçalho
include ( __DIR__ .'/../includes/layout/header.php');
?>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <form id="imagem-navegando-form" enctype="multipart/form-data">
                <label for="imagem-navegando-input" class="photo-icon">
                    <img class="img-thumbnail align-items-center d-flex flex-column mb-1" id="imagem-navegando" src="<?php echo $nav['foto'] != NULL ? "/navegando/" . $nav['url'] . "/foto/" . $nav['foto'] : '/assets/img/placeholder.png'; ?>">
                    <small class="text-center">Clique para alterar a foto</small>
                </label>
                <input type="file" id="imagem-navegando-input" name="imagem-navegando" accept="image/*" style="display: none;">
                <input type="hidden" name="id" value="<?php echo $nav['ID']; ?>">
            </form>
        </div>
        <div class="col-md-9 default-form default-edit">
            <form id="navegando-form" class="default-form" action="/navegando/salvar-dados/">
                <div class="row justify-content-between">
                    <div class="col-md-6 row g-3">
                        <h3 class="m-0">Documentos Necessários</h3>
                        <div class="form-group col-md-12">
                            <label for="nome">Nome</label>
                            <input type="text" name="nome" class="form-control" value="<?php echo $nav['nome']; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cpf">CPF</label>
                            <input type="text" name="cpf" class="form-control cpf" placeholder="000.000.000-00" value="<?php echo $nav['cpf']; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="rg">RG</label>
                            <input type="text" name="rg" class="form-control" value="<?php echo $nav['rg']; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="data-nasc">Data de Nascimento</label>
                            <input type="date" name="data-nasc" class="form-control" value="<?php echo $nav['data_nasc']; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="local-nasc">Local de Nascimento</label>
                            <input type="text" name="local-nasc" class="form-control" value="<?php echo $nav['local_nasc']; ?>">
                        </div>
                    </div>

                    <div class="col-md-6 row g-3">
                        <h3 class="m-0">Informações de Contato</h3>
                        <div class="form-group col-md-3">
                            <label for="casal-cep" id="cep-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Informe um CEP válido" data-bs-custom-class="custom-tooltip" aria-describedby="tooltip763046">CEP</label>
                            <input type="text" name="cep" class="form-control cep" placeholder="00000-000"  value="<?php echo $nav['cep']; ?>">
                        </div>
                        <div class="form-group col-md-9">
                            <label for="endereco">Endereço</label>
                            <input type="text" name="endereco" class="form-control endereco"  value="<?php echo $nav['endereco']; ?>">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="cidade">Cidade</label>
                            <input type="text" name="cidade" class="form-control cidade"  value="<?php echo $nav['cidade']; ?>">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="estado">Estado</label>
                            <input type="text" name="estado" class="form-control estado" value="<?php echo $nav['estado']; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $nav['email']; ?>">
                        </div>
                        <div class="form-group col-md-6 mt-3">
                            <label for="emergency1">Contato de Emergência 1</label>
                            <input type="text" name="emergency1" class="form-control phone" value="<?php echo $nav['emergency1']; ?>">
                        </div>
                        <div class="form-group col-md-6 mt-3">
                            <label for="emergency2">Contato de Emergência 2</label>
                            <input type="text" name="emergency2" class="form-control phone"  value="<?php echo $nav['emergency2']; ?>">
                        </div>
                    </div>
                </div>

                <div class="login-notices-wrapper">
                    <div id="feedback-alert" class="" role="alert"></div>
                </div>

                <div class="d-grid gap-2">
                    <input type="hidden" name="url" value="<?php echo $nav['url'] ?>">
					<button type="submit" class="mb-5 mt-4 btn btn-primary btn-block" id="btnGenerate" style="height: 50px;"><i class="fa fa-qrcode"></i> Gerar QR Code</button>
				</div>
            </form>
        </div>
    </div>
</div>

<?php

$qrcodeModal = true; // Inclui o modal de QR Code nesta página
include (__DIR__ .'/../includes/layout/modals.php'); // Inclui o arquivo que contém os modais
include_once( __DIR__ .'/../includes/layout/footer.php'); // Inclui o rodapé

?>