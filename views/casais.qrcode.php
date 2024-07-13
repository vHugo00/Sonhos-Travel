<?php

require_once( __DIR__ .'/../includes/config.php'); // Inclui o arquivo de configuração

$url = sanitizeData($_GET['url']); // Recebe a URL, que é uma string única que identifica o casal no banco de dados

// Busca os dados do casal no banco de dados
$casal_info = $conn->prepare('SELECT * FROM casal_info WHERE url = :url LIMIT 1');
$casal_info->execute(array('url' => $url));
$casal = $casal_info->fetch();

// Retorna erro 404, caso não encontre o registro no banco de dados
if ($casal == NULL) {
    http_response_code(404);
    exit();
}

$HideMenu = true; // Oculta o menu
include ( __DIR__ .'/../includes/layout/header.php'); // Inclui o cabeçalho

?>
	<div class="container">
		<div class="pt-5 row">
			<div class="col-md-3">
				<form id="imagem-casal-form" enctype="multipart/form-data">
					<label for="imagem-casal-input" class="photo-icon">
						<img class="img-thumbnail align-items-center d-flex flex-column mb-1" id="imagem-casal" src="<?php echo $casal['foto'] != NULL ? "/casal/" . $casal['url'] . "/foto/" . $casal['foto'] : '/assets/img/placeholder.png'; ?>">
						<small class="text-center">Clique para alterar a foto</small>
					</label>
					<input type="file" id="imagem-casal-input" name="imagem-casal" accept="image/*" style="display: none;">
					<input type="hidden" name="id" value="<?php echo $casal['ID']; ?>">
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
						<h3 class="m-0">Informações do Esposo</h3>
						<div class="form-group col-md-12">
							<label for="esposo-nome">Nome Completo</label>
							<span class="form-control"><?php echo $casal['esposo_nome']; ?></span>
						</div>
						<div class="form-group col-md-6">
							<label for="esposo-cpf">Número do CPF</label>
							<span class="form-control"><?php echo $casal['esposo_cpf']; ?></span>
						</div>
						<div class="form-group col-md-6">
							<label for="esposo-rg">Número do RG</label>
							<span class="form-control"><?php echo $casal['esposo_rg']; ?></span>
						</div>
						<div class="form-group col-md-6">
							<label for="esposo-nascimento">Data de Nascimento</label>
							<span class="form-control"><?php echo date('d/m/Y', strtotime($casal['esposo_nascimento'])); ?></span>
						</div>
						<div class="form-group col-md-6">
							<label for="contato-esposo">Telefone</label>
							<span class="form-control"><?php echo $casal['contato_esposo']; ?></span>
						</div>
					</div>

					<div class="col-md-6 row g-3">
						<h3 class="m-0">Informações da Esposa</h3>
						<div class="form-group col-md-12">
							<label for="esposa-nome">Nome Completo</label>
							<span class="form-control"><?php echo $casal['esposa_nome']; ?></span>
						</div>
						<div class="form-group col-md-6">
							<label for="esposa-cpf">Número do CPF</label>
							<span class="form-control"><?php echo $casal['esposa_cpf']; ?></span>
						</div>
						<div class="form-group col-md-6">
							<label for="esposa-rg">Número do RG</label>
							<span class="form-control"><?php echo $casal['esposa_rg']; ?></span>
						</div>
						<div class="form-group col-md-6">
							<label for="esposa-nascimento">Data de Nascimento</label>
							<span class="form-control"><?php echo date('d/m/Y', strtotime($casal['esposa_nascimento'])); ?></span>
						</div>
						<div class="form-group col-md-6">
							<label for="contato-esposa">Telefone</label>
							<span class="form-control"><?php echo $casal['contato_esposa']; ?></span>
						</div>
					</div>

					<div class="col-md-12">	
						<h3 class="m-0 mt-5">Informações do Casal</h3>
					</div>
					<div class="col-md-6 row g-3">
						<div class="form-group col-md-4">
							<label for="casal-cep" id="cep-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Informe um CEP válido" data-bs-custom-class="custom-tooltip">CEP</label>
							<span class="form-control"><?php echo $casal['casal_cep']; ?></span>
						</div>
						<div class="form-group col-md-8">
							<label for="casal-endereco">Endereço Completo</label>
							<span class="form-control"><?php echo $casal['casal_endereco']; ?></span>
						</div>
						<div class="form-group col-md-6">
							<label for="casal-estado">Estado</label>
							<span class="form-control"><?php echo $casal['casal_estado']; ?></span>
						</div>
						<div class="form-group col-md-6">
							<label for="casal-cidade">Cidade</label>
							<span class="form-control"><?php echo $casal['casal_cidade']; ?></span>
						</div>
						<div class="form-group col-md-12">
							<label for="casal-emergency1">Contatos de Emergência</label>
							<span class="form-control">
								<?php
									echo $casal['casal_emergency1']; 
									echo !empty($casal['casal_emergency2']) ? " / " . $casal['casal_emergency2'] : "";
								?>
							</span>
						</div>
					</div>

					<div class="col-md-6 row g-3">
						<div class="form-group col-md-12">
							<label for="casal-endereco">Cabine</label>
							<span class="form-control"><?php echo $casal['cabine']; ?></span>
						</div>
						<div class="form-group col-md-12">
							<label for="casal-email">E-mail</label>
							<span class="form-control"><?php echo $casal['casal_email']; ?></span>
						</div>
						<div class="form-group col-md-6">
							<label for="data-compra">Data de Compra</label>
							<span class="form-control"><?php echo date('d/m/Y', strtotime($casal['data_compra'])); ?></span>
						</div>
						<div class="form-group col-md-6">
							<label for="casal-casamento">Aniversário de Casamento</label>
							<span class="form-control"><?php echo date('d/m/Y', strtotime($casal['casal_casamento'])); ?></span>
						</div>
					</div>
					<div class="col-md-12 row g-3">
						<div class="form-group col-md-12">
							<label for="casal-comentarios">Comentários</label>
							<span name="casal-comentarios" class="form-control" style="min-height: 80px; height: fit-content">
							<?php echo $casal['casal_comentarios']; ?>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php

include_once( __DIR__ .'/../includes/layout/footer.php');

?>