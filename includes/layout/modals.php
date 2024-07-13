<?php

	/**
	 * 
	 * Contém os modais.
	 * É necessário declarar a variável
	 * correspondente ao modal que deseja utilizar. 
	 * 
	 */


	if (isset($qrcodeModal)) { ?>
	<div class="modal fade" id="qrcode-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
                <div class="modal-header pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5 pt-1">
                    <h1 class="modal-title fs-5 text-center mb-4">Os dados foram salvos!</h1>
                    <div class="">
                        <p>O QR Code abaixo foi gerado com as informações do casal.</p>
                        <img id="qrcode" class="img-responsive img-thumbnail" src="">
                    </div>
					<div class="mt-3">
						<a href="" class="btn btn-sm opacity-75 text-white download-btn"><i class="fa fa-qrcode"></i> BAIXAR QR CODE</a href="">
					</div>
                </div>
				<!-- <div class="modal-footer">
					<button type="button" class="btn btn-md btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Understood</button>
				</div> -->
			</div>
		</div>
	</div>
	<?php } ?>

	<?php if (isset($casalInfoModal)) { ?>
	<div class="modal fade" id="casal-info-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
			<div class="modal-content">
                <div class="modal-header pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5 pt-1">
                    <h4 class="modal-title text-center mb-4">Dados do Casal</h4>

					<div class="row">
						<div class="col-md-3">
							<form id="imagem-casal-form" enctype="multipart/form-data">
								<label for="imagem-casal-input" class="photo-icon">
									<img class="img-thumbnail align-items-center d-flex flex-column mb-1" id="imagem-casal" src="/assets/img/placeholder.png">
									<small class="text-center">Clique para alterar a foto</small>
								</label>
								<input type="file" id="imagem-casal-input" name="imagem-casal" accept="image/*" style="display: none;">
								<input type="hidden" name="id" id="imagem-casal-id" value="">
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
									<h6 class="m-0">Informações do Esposo</h6>
									<div class="form-group col-md-12">
										<label for="esposo-nome">Nome Completo</label>
										<span id="esposo_nome" class="form-control"></span>
									</div>
									<div class="form-group col-md-6">
										<label for="esposo-cpf">Número do CPF</label>
										<span id="esposo_cpf" class="form-control"></span>
									</div>
									<div class="form-group col-md-6">
										<label for="esposo-rg">Número do RG</label>
										<span id="esposo_rg" class="form-control"></span>
									</div>
									<div class="form-group col-md-6">
										<label for="esposo-nascimento">Data de Nascimento</label>
										<span id="esposo_nascimento" class="form-control"></span>
									</div>
									<div class="form-group col-md-6">
										<label for="contato_esposo">Telefone</label>
										<span id="contato_esposo" class="form-control"></span>
									</div>
								</div>

								<div class="col-md-6 row g-3">
									<h6 class="m-0">Informações da Esposa</h6>
									<div class="form-group col-md-12">
										<label for="esposa-nome">Nome Completo</label>
										<span id="esposa_nome" class="form-control"></span>
									</div>
									<div class="form-group col-md-6">
										<label for="esposa-cpf">Número do CPF</label>
										<span id="esposa_cpf" class="form-control"></span>
									</div>
									<div class="form-group col-md-6">
										<label for="esposa-rg">Número do RG</label>
										<span id="esposa_rg" class="form-control"></span>
									</div>
									<div class="form-group col-md-6">
										<label for="esposa-nascimento">Data de Nascimento</label>
										<span id="esposa_nascimento" class="form-control"></span>
									</div>
									<div class="form-group col-md-6">
										<label for="contato-esposa">Telefone</label>
										<span id="contato_esposa" class="form-control"></span>
									</div>
								</div>

								<div class="col-md-12">	
									<h6 class="m-0 mt-5">Informações do Casal</h6>
								</div>
								<div class="col-md-6 row g-3">
									<div class="form-group col-md-4">
										<label for="casal-cep" id="cep-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Informe um CEP válido" data-bs-custom-class="custom-tooltip">CEP</label>
										<span id="casal_cep" class="form-control"></span>
									</div>
									<div class="form-group col-md-8">
										<label for="casal-endereco">Endereço Completo</label>
										<span id="casal_endereco" class="form-control"></span>
									</div>
									<div class="form-group col-md-6">
										<label for="casal-estado">Estado</label>
										<span id="casal_estado" class="form-control"></span>
									</div>
									<div class="form-group col-md-6">
										<label for="casal-cidade">Cidade</label>
										<span id="casal_cidade" class="form-control"></span>
									</div>
									<div class="form-group col-md-12">
										<label for="casal-emergency1">Contatos de Emergência</label>
										<span id="casal_emergency" class="form-control">
										</span>
									</div>
								</div>

								<div class="col-md-6 row g-3">
									<div class="form-group col-md-12">
										<label for="casal-endereco">Cabine</label>
										<span id="casal_endereco" class="form-control"></span>
									</div>
									<div class="form-group col-md-12">
										<label for="casal-email">E-mail</label>
										<span id="" class="form-control"></span>
									</div>
									<div class="form-group col-md-6">
										<label for="data-compra">Compra</label>
										<span id="data_compra" class="form-control"></span>
									</div>
									<div class="form-group col-md-6">
										<label for="casal-casamento">Casamento</label>
										<span id="casal_casamento" class="form-control"></span>
									</div>
								</div>
								<div class="col-md-12 row g-3">
									<div class="form-group col-md-12">
										<label for="casal-comentarios">Comentários</label>
										<span id="casal_comentarios" class="form-control" style="min-height: 80px; height: fit-content">
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer p-4">
					<a href="" class="btn btn-md btn-primary float-end mx-1 mt-3" id="edit-link" target="_blank">
						<i class="fa fa-edit"></i> Editar
					</a>
					<button class="btn btn-md btn-danger float-end mx-1 mt-3" id="delete-link" data-url="">
						<i class="fa fa-trash-alt"></i> Excluir
					</button>
					<button class="btn btn-md btn-secondary float-end mx-1 mt-3 download-btn" data-url="">
						<i class="fa fa-qrcode"></i> QRCode
					</button>
					<a href="" class="btn btn-md btn-secondary float-end mx-1 mt-3" id="contract-link" target="_blank">
						<i class="fa fa-file-alt"></i> Contrato
					</a>
					<button type="button" class="btn btn-md btn-dark float-end mx-1 mt-3" data-bs-dismiss="modal">
						<i class="fa fa-times"></i> Fechar
					</button>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>

	<?php if (isset($navegandoInfoModal)) { ?>
	<div class="modal fade" id="navegando-info-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
			<div class="modal-content">
                <div class="modal-header pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5 pt-1">
                    <h4 class="modal-title text-center mb-4"></h4>

					<div class="row">
						<div class="col-md-3">
							<form id="imagem-navegando-form" enctype="multipart/form-data">
								<label for="imagem-navegando-input" class="photo-icon">
									<img class="img-thumbnail align-items-center d-flex flex-column mb-1" id="imagem-navegando" src="/assets/img/placeholder.png">
									<small class="text-center">Clique para alterar a foto</small>
								</label>
								<input type="file" id="imagem-navegando-input" name="imagem-navegando" accept="image/*" style="display: none;">
								<input type="hidden" name="id" value="" id="imagem-navegando-id">
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
										<span class="form-control" id="nome"></span>
									</div>
									<div class="form-group col-md-6">
										<label for="cpf">CPF</label>
										<span class="form-control" id="cpf"></span>
									</div>
									<div class="form-group col-md-6">
										<label for="rg">RG</label>
										<span class="form-control" id="rg"></span>
									</div>
									<div class="form-group col-md-6">
										<label for="data-nasc">Data de Nascimento</label>
										<span class="form-control" id="data_nasc"></span>
									</div>
									<div class="form-group col-md-6">
										<label for="local-nasc">Local de Nascimento</label>
										<span class="form-control" id="local_nasc"></span>
									</div>
								</div>

								<div class="col-md-6 row g-3">
									<h3 class="m-0">Informações de Contato</h3>
									<div class="form-group col-md-4">
										<label for="navegando-cep" id="cep-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Informe um CEP válido" data-bs-custom-class="custom-tooltip" aria-describedby="tooltip763046">CEP</label>
										<span class="form-control" id="cep"></span>
									</div>
									<div class="form-group col-md-8">
										<label for="endereco">Endereço</label>
										<span class="form-control" id="endereco"></span>
									</div>
									<div class="form-group col-md-4">
										<label for="cidade">Cidade</label>
										<span class="form-control" id="cidade"></span>
									</div>
									<div class="form-group col-md-2">
										<label for="estado">Estado</label>
										<span class="form-control" id="estado"></span>
									</div>
									<div class="form-group col-md-6">
										<label for="email">E-mail</label>
										<span class="form-control" id="email"></span>
									</div>
									<div class="form-group col-md-12">
										<label for="emergency1">Contatos de Emergência</label>
										<span class="form-control" id="emergency"></span>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
				<div class="modal-footer p-4">
					<a href="" class="btn btn-md btn-primary float-end mx-1 mt-3" id="edit--link" target="_blank">
						<i class="fa fa-edit"></i> Editar
					</a>
					<button class="btn btn-md btn-danger float-end mx-1 mt-3" id="delete--link" data-url="">
						<i class="fa fa-trash-alt"></i> Excluir
					</button>
					<button class="btn btn-md btn-secondary float-end mx-1 mt-3 download-btn" data-url="">
						<i class="fa fa-qrcode"></i> QRCode
					</button>
					<a href="" class="btn btn-md btn-secondary float-end mx-1 mt-3" id="contract--link" target="_blank">
						<i class="fa fa-file-alt"></i> Contrato
					</a>
					<button type="button" class="btn btn-md btn-dark float-end mx-1 mt-3" data-bs-dismiss="modal">
						<i class="fa fa-times"></i> Fechar
					</button>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>