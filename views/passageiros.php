<?php

require_once( __DIR__ .'/../includes/config.php'); // Inclui o arquivo de configuração

// Busca os dados no DB para popular as tabelas
$casal_info = $conn->prepare('SELECT * FROM casal_info ORDER BY created_at DESC LIMIT 10');
$casal_info->execute();
$casal = $casal_info->fetchAll();

if ($casal == NULL) {
    http_response_code(404);
    exit();
}

// Busca os dados no DB para popular as tabelas
$navegando_info = $conn->prepare('SELECT * FROM navegando ORDER BY created_at DESC LIMIT 10');
$navegando_info->execute();
$navegando = $navegando_info->fetchAll();

if ($navegando == NULL) {
    http_response_code(404);
    exit();
}

include ( __DIR__ .'/../includes/layout/header.php');

?>

	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h4 class="float-start">Encontro de Casais</h4>
			</div>
			<div class="col-md-6">
				<input type="text" class="form-control mb-3 search-input" id="busca-passageiros" name="q" placeholder="Buscar por CPF...">
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-page-passageiros table-striped table-dark text-start" id="table-passageiros">
					<thead>
						<tr>
							<th scope="col">Esposo</th>
							<th scope="col">Esposa</th>
							<th scope="col">E-mail do Casal</th>
							<th scope="col">Cidade</th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody id="list-passageiros">
						<?php foreach ($casal as $c) { ?>
						<tr>
							<td><?php echo $c['esposo_nome']; ?><br><small>(<?php echo $c['esposo_cpf']; ?>)</small></td>
							<td><?php echo $c['esposa_nome']; ?><br><small>(<?php echo $c['esposa_cpf']; ?>)</small></td>
							<td><?php echo $c['casal_email']; ?></td>
							<td><?php echo $c['casal_cidade']; ?></td>
							<td>
								<a href="#" class="edit-casal-info" data-url="<?php echo $c['url'] ?>" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Visualizar">
									<i class="fas fa-eye"></i>
								</a>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>

		<div class="my-5">&nbsp;</div>

		<div class="row mt-5">
			<div class="col-md-6">
				<h4 class="float-start">Navegando com Elas</h4>
			</div>
			<div class="col-md-6">
				<input type="text" class="form-control mb-3 search-input" id="busca-navegando" name="q" placeholder="Buscar por CPF...">
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-page-passageiros table-striped table-dark text-start" id="table-navegando">
					<thead>
						<tr>
							<th scope="col">Nome</th>
							<th scope="col">CPF</th>
							<th scope="col">E-mail</th>
							<th scope="col">Cidade</th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody id="list-navegando">
						<?php foreach ($navegando as $n) { ?>
						<tr>
							<td><?php echo $n['nome']; ?></td>
							<td><?php echo $n['cpf']; ?></td>
							<td><?php echo $n['email']; ?></td>
							<td><?php echo $n['cidade']; ?></td>
							<td>
								<a href="#" class="edit-navegando-info" data-url="<?php echo $n['url'] ?>" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Visualizar">
									<i class="fas fa-eye"></i>
								</a>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

<?php

$casalInfoModal = $navegandoInfoModal = true; // Inclui os modais QR Code e de Detalhes
include_once( __DIR__ .'/../includes/layout/modals.php'); // Inclui o arquivo que contém os modais
include_once( __DIR__ .'/../includes/layout/footer.php'); // Inclui o rodapé

?>