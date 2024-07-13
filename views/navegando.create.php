<?php

include_once( __DIR__ .'/../includes/layout/header.php'); // Inclui o cabeçalho

?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form id="navegando-form" class="default-form" action="/navegando/salvar-dados/">
                <div class="row justify-content-between">
                    <div class="col-md-6 row g-3">
                        <h3 class="m-0">Documentos Necessários</h3>
                        <div class="form-group col-md-12">
                            <label for="nome">Nome</label>
                            <input type="text" name="nome" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cpf">CPF</label>
                            <input type="text" name="cpf" class="form-control cpf" placeholder="000.000.000-00">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="rg">RG</label>
                            <input type="text" name="rg" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="data-nasc">Data de Nascimento</label>
                            <input type="date" name="data-nasc" class="form-control" data-id=>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="local-nasc">Local de Nascimento</label>
                            <input type="text" name="local-nasc" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6 row g-3">
                        <h3 class="m-0">Informações de Contato</h3>
                        <div class="form-group col-md-3">
                            <label for="casal-cep" id="cep-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Informe um CEP válido" data-bs-custom-class="custom-tooltip" aria-describedby="tooltip763046">CEP</label>
                            <input type="text" name="cep" class="form-control cep" placeholder="00000-000">
                        </div>
                        <div class="form-group col-md-9">
                            <label for="endereco">Endereço</label>
                            <input type="text" name="endereco" class="form-control endereco">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="cidade">Cidade</label>
                            <input type="text" name="cidade" class="form-control cidade">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="estado">Estado</label>
                            <input type="text" name="estado" class="form-control estado">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="form-group col-md-6 mt-3">
                            <label for="emergency1">Contato de Emergência 1</label>
                            <input type="text" name="emergency1" class="form-control phone">
                        </div>
                        <div class="form-group col-md-6 mt-3">
                            <label for="emergency2">Contato de Emergência 2</label>
                            <input type="text" name="emergency2" class="form-control phone">
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
include (__DIR__ .'/../includes/layout/modals.php'); // Inclui o arquivo que contém os modais
include_once( __DIR__ .'/../includes/layout/footer.php'); // Inclui o rodapé

?>