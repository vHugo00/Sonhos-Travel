<?php

	/**
	 * 
	 * Separei o menu do headar.php para que seja
	 * possível reutilizá-lo em outros arquivos.
	 * 
	 */

?>

<nav class="navbar navbar-expand-sm navbar-dark">
	<div class="container" style="flex-wrap: nowrap;align-items: flex-start; padding: 0px 10px;">
		<a class="navbar-brand" href="<?php echo APP_URL; ?>">
			<img src="<?php echo APP_URL; ?>/assets/img/logo-sonhos.png" style=" max-width: 130px; ">
		</a>
		<div style=" display: flex; flex-direction: column; align-items: flex-end; ">
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarsExample03">
				<ul class="navbar-nav me-auto mb-2 mb-sm-0" style=" margin-top: 10px; ">
					<li class="nav-item">
						<a class="nav-link" href="/casais">Encontro de Casais</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/navegando">Navegando com Elas</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/passageiros">Passageiros</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</nav>