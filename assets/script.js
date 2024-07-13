$(document).ready(function () {

    $('#casais-form').on('submit', function(event) {
        event.preventDefault();

		$('#feedback-alert').removeClass('success error').hide()

        var isValid = true;
        var messages = [];

        function hasMoreThanOneWord(value) {
            return value.trim().split(/\s+/).length > 1;
        }

        function isValidFormat(value, regex) {
            return regex.test(value);
        }

        var esposoNome = $('input[name="esposo-nome"]').val();
        var esposoCpf = $('input[name="esposo-cpf"]').val();
        var esposoRg = $('input[name="esposo-rg"]').val();
        var esposoNascimento = $('input[name="esposo-nascimento"]').val();
        var contatoEsposo = $('input[name="contato-esposo"]').val();
        var esposaNome = $('input[name="esposa-nome"]').val();
        var esposaCpf = $('input[name="esposa-cpf"]').val();
        var esposaRg = $('input[name="esposa-rg"]').val();
        var esposaNascimento = $('input[name="esposa-nascimento"]').val();
        var contatoEsposa = $('input[name="contato-esposa"]').val();
        var casalEndereco = $('input[name="casal-endereco"]').val();
        var casalCep = $('input[name="casal-cep"]').val();
        var casalCidade = $('input[name="casal-cidade"]').val();
        var casalEstado = $('input[name="casal-estado"]').val();
        var casalEmail = $('input[name="casal-email"]').val();
        var casalEmergency1 = $('input[name="casal-emergency1"]').val();
        var dataCompra = $('input[name="data-compra"]').val();
        var casalCasamento = $('input[name="casal-casamento"]').val();
        var pagamento = $('input[name="pagamento"]').val();

        // Validar os campos
        if (!esposoNome || !hasMoreThanOneWord(esposoNome)) {
            isValid = false;
            messages.push("Informe o Nome Completo do Esposo.");
        } else if (!esposoCpf || !isValidFormat(esposoCpf, /^\d{3}\.\d{3}\.\d{3}\-\d{2}$/)) {
            isValid = false;
            messages.push("CPF do Esposo inválido.");
        } else if (!esposoRg) {
            isValid = false;
            messages.push("RG do Esposo inválido.");
        } else if (!esposoNascimento) {
            isValid = false;
            messages.push("Informe corretamente a Data de Nascimento do Esposo.");
        } else if (!contatoEsposo) {
            isValid = false;
            messages.push("Informe corretamente o Telefone do Esposo.");
        } else if (!esposaNome || !hasMoreThanOneWord(esposaNome)) {
            isValid = false;
            messages.push("Informe o Nome Completo da Esposa.");
        } else if (!esposaCpf || !isValidFormat(esposaCpf, /^\d{3}\.\d{3}\.\d{3}\-\d{2}$/)) {
            isValid = false;
            messages.push("CPF da Esposa inválido.");
        } else if (!esposaRg) {
            isValid = false;
            messages.push("RG da Esposa inválido.");
        } else if (!esposaNascimento) {
            isValid = false;
            messages.push("Informe corretamente a Data de Nascimento da Esposa.");
        } else if (!contatoEsposa) {
            isValid = false;
            messages.push("Informe corretamente o Telefone da Esposa.");
        } else if (!casalEndereco || !hasMoreThanOneWord(casalEndereco)) {
            isValid = false;
            messages.push("Informe o Endereço Completo.");
        } else if (!casalCep || !isValidFormat(casalCep, /^\d{5}\-\d{3}$/)) {
            isValid = false;
            messages.push("CEP inválido.");
        } else if (!casalCidade) {
            isValid = false;
            messages.push("Informe corretamente a Cidade.");
        } else if (!casalEstado) {
            isValid = false;
            messages.push("Informe corretamente o Estado.");
        } else if (!casalEmail) {
            isValid = false;
            messages.push("Informe corretamente o E-mail.");
        } else if (!casalEmergency1) {
            isValid = false;
            messages.push("Informe corretamente o Contato de Emergência 1.");
        } else if (!dataCompra) {
            isValid = false;
            messages.push("Informe corretamente a Data de Compra.");
        } else if (!casalCasamento) {
            isValid = false;
            messages.push("Informe corretamente o Aniversário de Casamento.");
        } else if (!pagamento) {
            isValid = false;
            messages.push("Selecione uma forma de pagamento.");
        }

        if (!isValid) {
            $('#feedback-alert').removeClass('success error').addClass('error').html(messages).show();
        } else {

            var formData = new FormData(this);
            console.log(formData);

            $.ajax({
                url: '/casais/salvar-dados/',
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (feedback) {
                    console.log(feedback);
                    if (feedback.success) {

                        var qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' + feedback.url;
                        
                        $('#qrcode').attr('src', qrCodeUrl);
                        $('#qrcode-modal').modal('show');
                        $('.download-btn').data('url', feedback.url);
                        if (!feedback.keep_enabled) {
                            $('input, textarea, select, button').prop('disabled', true);
                            $('.download-btn, .btn-close').removeAttr('disabled');
                        }

                    } else {
                        $('#feedback-alert').removeClass('success error').addClass('error').html(feedback.message).show();
                    }
                },
                error: function() {
                    $('#feedback-alert').removeClass('success error').addClass('error').html("Erro na comunicação com o servidor.").show();
                }
            });
        }
    });

    $(document).on('click', '.download-btn', function(event) {
        event.preventDefault();

        var button = $(this);
        var icon = button.find('i');
        var url = button.data('url');
        var qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' + url;

        // Troca as classes do ícone para indicar carregamento
        icon.removeClass('fa-qrcode').addClass('fa-circle-notch fa-spin');

        fetch(qrCodeUrl)
            .then(response => response.blob())
            .then(blob => {
                var link = document.createElement('a');
                link.href = URL.createObjectURL(blob);
                link.download = 'qrcode.png';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                URL.revokeObjectURL(link.href);

                icon.removeClass('fa-circle-notch fa-spin').addClass('fa-qrcode');
            })
            .catch(error => {
                console.error('Erro ao baixar o QR Code:', error);
                icon.removeClass('fa-circle-notch fa-spin').addClass('fa-qrcode');
            });
    });

    $('#navegando-form').on('submit', function(event) {
        event.preventDefault();

		$('#feedback-alert').removeClass('success error').hide()

        var isValid = true;
        var messages = [];

        function hasMoreThanOneWord(value) {
            return value.trim().split(/\s+/).length > 1;
        }

        function isValidFormat(value, regex) {
            return regex.test(value);
        }

        var nome = $('input[name="nome"]').val();
        var cpf = $('input[name="cpf"]').val();
        var rg = $('input[name="rg"]').val();
        var dataNasc = $('input[name="data-nasc"]').val();
        var localNasc = $('input[name="local-nasc"]').val();
        var cep = $('input[name="cep"]').val();
        var endereco = $('input[name="endereco"]').val();
        var cidade = $('input[name="cidade"]').val();
        var estado = $('input[name="estado"]').val();
        var email = $('input[name="email"]').val();
        var emergency1 = $('input[name="emergency1"]').val();
        var pagamento = $('input[name="pagamento"]').val();

        if (!nome || !hasMoreThanOneWord(nome)) {
            isValid = false;
            messages.push("Informe o Nome Completo.");
        } else if (!cpf || !isValidFormat(cpf, /^\d{3}\.\d{3}\.\d{3}\-\d{2}$/)) {
            isValid = false;
            messages.push("CPF inválido.");
        } else if (!rg) {
            isValid = false;
            messages.push("RG inválido.");
        } else if (!dataNasc) {
            isValid = false;
            messages.push("Informe corretamente a Data de Nascimento.");
        } else if (!localNasc) {
            isValid = false;
            messages.push("Informe corretamente o Local de Nascimento.");
        } else if (!cep || !isValidFormat(cep, /^\d{5}\-\d{3}$/)) {
            isValid = false;
            messages.push("CEP inválido.");
        } else if (!endereco || !hasMoreThanOneWord(endereco)) {
            isValid = false;
            messages.push("Informe o Endereço.");
        } else if (!cidade) {
            isValid = false;
            messages.push("Informe corretamente a Cidade.");
        } else if (!estado) {
            isValid = false;
            messages.push("Informe corretamente o Estado.");
        } else if (!email) {
            isValid = false;
            messages.push("Informe corretamente o Email.");
        } else if (!emergency1) {
            isValid = false;
            messages.push("Informe corretamente o Contato de Emergência 1.");
        } else if (!pagamento) {
            isValid = false;
            messages.push("Selecione uma forma de pagamento.");
        }

        if (!isValid) {
            $('#feedback-alert').removeClass('success error').addClass('error').html(messages).show();
        } else {

            var formData = new FormData(this);
            console.log(formData);

            $.ajax({
                url: '/navegando/salvar-dados/',
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (feedback) {
                    console.log(feedback);
                    if (feedback.success) {
                        
                        $('#qrcode').attr('src', 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' + feedback.url);
                        $('#qrcode-modal').modal('show');
                        $('.download-btn').data('url', feedback.url);
                        $('input, textarea, select, button').prop('disabled', true);
                        $('.download-btn, .btn-close').removeAttr('disabled');

                    } else {
                        $('#feedback-alert').removeClass('success error').addClass('error').html(feedback.message).show();
                    }
                },
                error: function() {
                    $('#feedback-alert').removeClass('success error').addClass('error').html("Erro na comunicação com o servidor.").show();
                }
            });
        }
    });

    $("#imagem-casal-input").on("change", function () {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return;
    
        if (/^image/.test(files[0].type)) {
            var reader = new FileReader();
            reader.readAsDataURL(files[0]);
    
            reader.onload = function () {

                $("#imagem-casal").attr('src', this.result);
    
                var UpdateImgForm = document.getElementById('imagem-casal-form');
                var formData = new FormData(UpdateImgForm);
    
                $.ajax({
                    url: "/casais/alterar-foto/",
                    type: "POST",
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function (feedback) {
                        console.log(feedback);
                        if (feedback.success) {
                            $('#feedback-alert').removeClass('success error').addClass('success').html(feedback.msg).show();
                        } else {
                            $('#feedback-alert').removeClass('success error').addClass('error').html(feedback.msg).show();
                        }
                    },
                });
            }
        }
    });

    $("#imagem-navegando-input").on("change", function () {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return;
    
        if (/^image/.test(files[0].type)) {
            var reader = new FileReader();
            reader.readAsDataURL(files[0]);
    
            reader.onload = function () {

                $("#imagem-navegando").attr('src', this.result);
    
                var UpdateImgForm = document.getElementById('imagem-navegando-form');
                var formData = new FormData(UpdateImgForm);
    
                $.ajax({
                    url: "/navegando/alterar-foto/",
                    type: "POST",
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function (feedback) {
                        console.log(feedback);
                        if (feedback.success) {
                            $('#feedback-alert').removeClass('success error').addClass('success').html(feedback.msg).show();
                        } else {
                            $('#feedback-alert').removeClass('success error').addClass('error').html(feedback.msg).show();
                        }
                    },
                });
            }
        }
    });

    $(document).on('click', '.edit-casal-info', function(event) {
        
        event.preventDefault();
        var url = $(this).data('url');

        $.ajax({
            url: "/casais/buscar-dados/?url=" + url,
            type: "GET",
            data: { url: url },
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (feedback) {
                console.log(feedback);
                if (feedback.success) {

                    $('#esposo_nome').html('').html(feedback.esposo_nome);
                    $('#esposa_nome').html('').html(feedback.esposa_nome);
                    $('#esposo_cpf').html('').html(feedback.esposo_cpf);
                    $('#esposa_cpf').html('').html(feedback.esposa_cpf);
                    $('#esposo_rg').html('').html(feedback.esposo_rg);
                    $('#esposa_rg').html('').html(feedback.esposa_rg);
                    $('#esposo_nascimento').html('').html(feedback.esposo_nascimento);
                    $('#esposa_nascimento').html('').html(feedback.esposa_nascimento);
                    $('#contato_esposo').html('').html(feedback.contato_esposo);
                    $('#contato_esposa').html('').html(feedback.contato_esposa);
                    $('#casal_email').html('').html(feedback.casal_email);
                    $('#casal_cidade').html('').html(feedback.casal_cidade);
                    $('#casal_estado').html('').html(feedback.casal_estado);
                    $('#casal_endereco').html('').html(feedback.casal_endereco);
                    $('#casal_cep').html('').html(feedback.casal_cep);
                    $('#casal_emergency').html('').html(feedback.casal_emergency);
                    $('#data_compra').html('').html(feedback.data_compra);
                    $('#casal_casamento').html('').html(feedback.casal_casamento);
                    $('#casal_comentarios').html('').html(feedback.casal_comentarios);
                    $('#casal_comentarios').html('').html(feedback.casal_comentarios);
                    $('#imagem-casal').attr('src', feedback.foto);
                    $('#edit-link').attr('href', '/casais/editar/' + url);
                    $('#delete-link').attr('data-url', url);
                    $('#contract-link').attr('href', '/casais/contrato/' + url);
                    $('#imagem-casal-id').val(feedback.id);
                    $('.download-btn').attr('data-url', feedback.url);
                    
                    $('#casal-info-modal').modal('show');

                } else {

                    $('#feedback-alert').removeClass('success error').addClass('error').html(feedback.msg).show();

                }
            },
        });

    });

    $(document).on('click', '.edit-navegando-info', function(event) {
        
        event.preventDefault();
        var url = $(this).data('url');

        $.ajax({
            url: "/navegando/buscar-dados/?url=" + url,
            type: "GET",
            data: { url: url },
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (feedback) {
                console.log(feedback);
                if (feedback.success) {
                    
                    $('#foto').html('').html(feedback.foto);
                    $('#nome').html('').html(feedback.nome);
                    $('#cpf').html('').html(feedback.cpf);
                    $('#rg').html('').html(feedback.rg);
                    $('#data_nasc').html('').html(feedback.data_nasc);
                    $('#local_nasc').html('').html(feedback.local_nasc);
                    $('#email').html('').html(feedback.email);
                    $('#cidade').html('').html(feedback.cidade);
                    $('#estado').html('').html(feedback.estado);
                    $('#endereco').html('').html(feedback.endereco);
                    $('#cep').html('').html(feedback.cep);
                    $('#emergency').html('').html(feedback.emergency);
                    $('#imagem-navegando-id').val(feedback.id);
                    $('#imagem-navegando').attr('src', feedback.foto);
                    $('#edit--link').attr('href', '/navegando/editar/' + url);
                    $('#delete--link').attr('data-url', url);
                    $('#contract--link').attr('href', '/navegando/contrato/' + url);

                    $('.download-btn').attr('data-url', feedback.url);
                    $('#navegando-info-modal').modal('show');

                } else {

                    $('#feedback-alert').removeClass('success error').addClass('error').html(feedback.msg).show();

                }
            },
        });

    });

    $('#busca-passageiros').on('input propertychange', function () {
        event.preventDefault();
    
        clearTimeout(this.interval);
        this.interval = setTimeout((
            makeASearch
        ), 1000);
    
        function makeASearch() {

            console.log('Searching...');
    
            var list = document.getElementById('list-passageiros');
            var rows = '';
            for (var i = 0; i < 8; i++) {
                rows += '<tr><td class="placeholder-glow"><span class="placeholder w-100"></span></td><td class="placeholder-glow"><span class="placeholder w-100"></span></td><td class="placeholder-glow"><span class="placeholder w-100"></span></td><td class="placeholder-glow"><span class="placeholder w-100"></span></td><td class="placeholder-glow"><span class="placeholder w-100"></span></td></tr>';
            }

            $(list).html('');
            $(list).html(rows);
            
            var query = $('#busca-passageiros').val();
                
            $.ajax({
                url: "/casais/busca/?query=" + query,
                type: "GET",
                data: { query: query },
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (feedback) {
                    if (feedback.status == 0) {
                        alert('Erro');
                    } else {                    
                        var list = document.getElementById('list-passageiros');
                        $(list).html('');
                        $(list).html(feedback.result);
                    }
                }
            });
        }
    
        return false;
    });

    $('#busca-navegando').on('input propertychange', function () {
        event.preventDefault();
    
        clearTimeout(this.interval);
        this.interval = setTimeout((
            makeASearch
        ), 1000);
    
        function makeASearch() {

            console.log('Searching...');
    
            var list = document.getElementById('list-navegando');
            var rows = '';
            for (var i = 0; i < 8; i++) {
                rows += '<tr><td class="placeholder-glow"><span class="placeholder w-100"></span></td><td class="placeholder-glow"><span class="placeholder w-100"></span></td><td class="placeholder-glow"><span class="placeholder w-100"></span></td><td class="placeholder-glow"><span class="placeholder w-100"></span></td><td class="placeholder-glow"><span class="placeholder w-100"></span></td></tr>';
            }

            $(list).html('');
            $(list).html(rows);
            
            var query = $('#busca-navegando').val();
                
            $.ajax({
                url: "/navegando/busca/?query=" + query,
                type: "GET",
                data: { query: query },
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (feedback) {
                    if (feedback.status == 0) {
                        alert('Erro');
                    } else {                    
                        var list = document.getElementById('list-navegando');
                        $(list).html('');
                        $(list).html(feedback.result);
                    }
                }
            });
        }
    
        return false;
    });

    $('#delete-link').on('click', function () {
        event.preventDefault();
        var url = $(this).data('url');

        $.ajax({
            url: "/casais/excluir/" + url,
            type: "GET",
            data: {},
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (feedback) {
                if (feedback.success) {
                    location.reload();
                } else {
                    $('#feedback-alert').removeClass('success error').addClass('error').html(feedback.msg).show();
                }
            }
        });
    
    });

    $('#delete--link').on('click', function () {
        event.preventDefault();
        var url = $(this).data('url');

        $.ajax({
            url: "/navegando/excluir/" + url,
            type: "GET",
            data: {},
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (feedback) {
                if (feedback.success) {
                    location.reload();
                } else {
                    $('#feedback-alert').removeClass('success error').addClass('error').html(feedback.msg).show();
                }
            }
        });
    
    });

	$('.cep').on('blur', function () {

		var cep = $(this).val().replace(/\D/g, '');
		const tooltip = bootstrap.Tooltip.getInstance('#cep-label');

		if (cep.length != 8) {
			tooltip.show();
			return;
		}

		$.getJSON('https://viacep.com.br/ws/' + cep + '/json/', function (data) {
			if (!("erro" in data)) {
				tooltip.hide();
				$('.endereco').val(data.logradouro);
				$('.cidade').val(data.localidade);
				$('.estado').val(data.uf);
			} else {
				tooltip.show();
			}
		});

	});

    $('.cpf').mask('000.000.000-00', { reverse: false });
	$('.rg').mask('00.000.000-0');
	$('.cep').mask('00000-000');
	$('.phone').mask('(00) 0 0000-0000');

	const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
	const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

    $('.pagamento-select').on('change', function() {
        var selectedOption = $(this).val();
        $('.pagamento-input').val(selectedOption);
    });

});