<?php

include_once( __DIR__ .'/../includes/layout/header.php'); // Inclui o cabeçalho

?>

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<form id="casais-form" class="default-form" action="/casais/salvar-dados/">
					<div class="row justify-content-between">
						<div class="col-md-6 row g-3">
							<h3 class="m-0">Informações do Esposo</h3>
							<div class="form-group col-md-12">
								<label for="esposo-nome">Nome Completo</label>
								<input type="text" name="esposo-nome" class="form-control">
							</div>
							<div class="form-group col-md-6">
								<label for="esposo-cpf">Número do CPF</label>
								<input type="text" name="esposo-cpf" class="form-control cpf" placeholder="000.000.000-00">
							</div>
							<div class="form-group col-md-6">
								<label for="esposo-rg">Número do RG</label>
								<input type="text" name="esposo-rg" class="form-control">
							</div>
							<div class="form-group col-md-6">
								<label for="esposo-nascimento">Data de Nascimento</label>
								<input type="date" name="esposo-nascimento" class="form-control date">
							</div>
							<div class="form-group col-md-6">
								<label for="contato-esposo">Telefone</label>
								<input type="text" name="contato-esposo" class="form-control phone">
							</div>
						</div>

						<div class="col-md-6 row g-3">
							<h3 class="m-0">Informações da Esposa</h3>
							<div class="form-group col-md-12">
								<label for="esposa-nome">Nome Completo</label>
								<input type="text" name="esposa-nome" class="form-control">
							</div>
							<div class="form-group col-md-6">
								<label for="esposa-cpf">Número do CPF</label>
								<input type="text" name="esposa-cpf" class="form-control cpf"placeholder="000.000.000-00">
							</div>
							<div class="form-group col-md-6">
								<label for="esposa-rg">Número do RG</label>
								<input type="text" name="esposa-rg" class="form-control" placeholder="00.000.000-0">
							</div>
							<div class="form-group col-md-6">
								<label for="esposa-nascimento">Data de Nascimento</label>
								<input type="date" name="esposa-nascimento" class="form-control date">
							</div>
							<div class="form-group col-md-6">
								<label for="contato-esposa">Telefone</label>
								<input type="text" name="contato-esposa" class="form-control phone">
							</div>
						</div>

						<div class="col-md-12">	
							<h3 class="m-0 mt-5">Informações do Casal</h3>
						</div>
						<div class="col-md-6 row g-3">
							<div class="form-group col-md-3">
								<label for="casal-cep" id="cep-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Informe um CEP válido" data-bs-custom-class="custom-tooltip">CEP</label>
								<input type="text" name="casal-cep" class="form-control cep" placeholder="00000-000">
							</div>
							<div class="form-group col-md-9">
								<label for="casal-endereco">Endereço Completo</label>
								<input type="text" name="casal-endereco" class="form-control endereco">
							</div>
							<div class="form-group col-md-6">
								<label for="casal-estado">Estado</label>
								<input type="text" name="casal-estado" class="form-control estado">
							</div>
							<div class="form-group col-md-6">
								<label for="casal-cidade">Cidade</label>
								<input type="text" name="casal-cidade" class="form-control cidade">
							</div>
							<div class="form-group col-md-6">
								<label for="casal-emergency1">Contato de Emergência 1</label>
								<input type="text" name="casal-emergency1" class="form-control phone">
							</div>
							<div class="form-group col-md-6">
								<label for="casal-emergency2">Contato de Emergência 2</label>
								<input type="text" name="casal-emergency2" class="form-control phone">
							</div>
						</div>

						<div class="col-md-6 row g-3">
							<div class="form-group col-md-12">
								<label for="casal-endereco">Cabine</label>
								<input type="text" name="cabine" class="form-control">
							</div>
							<div class="form-group col-md-12">
								<label for="casal-email">E-mail</label>
								<input type="email" name="casal-email" class="form-control">
							</div>
							<div class="form-group col-md-6">
								<label for="data-compra">Data de Compra</label>
								<input type="date" name="data-compra" class="form-control date">
							</div>
							<div class="form-group col-md-6">
								<label for="casal-casamento">Aniversário de Casamento</label>
								<input type="date" name="casal-casamento" class="form-control date">
							</div>
						</div>
						
						<div class="col-md-12 row g-3">
							<div class="form-group col-md-12">
								<label for="pagamento-select">Forma de pagamento</label>
								<select name="pagamento-select" class="form-control pagamento-select" rows="3">
									<option >Selecione...</option>
									<option value="boleto">Boleto</option>
									<option value="pix">Pix</option>
									<option value="credito">Cartão de Crédito</option>
								</select>
								<input type="hidden" name="pagamento" class="form-control pagamento-input" value="">
							</div>
							<div class="form-group col-md-12">
								<label for="casal-comentarios">Comentários</label>
								<textarea name="casal-comentarios" class="form-control" rows="3"></textarea>
							</div>
						</div>
					</div>

					<div class="login-notices-wrapper">
						<div id="feedback-alert" class="" role="alert"></div>
					</div>
					<div class="d-grid gap-2">
						<button type="submit" class="mb-5 mt-4 btn btn-primary btn-block" id="btnGenerate" style="height: 50px;"><i class="fa fa-qrcode"></i> Gerar QR Code</button>
					</div>
				</form>
			</div>
		</div>
	</div>

<?php

$qrcodeModal = true; // Inclui o modal de QR Code nesta página
include (__DIR__ .'/../includes/layout/modals.php');  // Inclui o arquivo que contém os modais
include_once( __DIR__ .'/../includes/layout/footer.php'); // Inclui o rodapé

?>