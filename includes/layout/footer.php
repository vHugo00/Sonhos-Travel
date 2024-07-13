<?php

	/**
	 * 
	 * Este é o arquivo de rodapé para o layout.
	 * Também contém as chamadas para os arquivos js.
	 * O objetivo é evitar a repetição do mesmo código em todos
	 * os arquivos e facilitar a manutenção.
	 * 
	 * 
	 */

?>

<footer class="footer mt-auto py-3">
	<div class="container">
	  <div class="col-md-12">
		<div class="col-md-12">
		  <p class="mb-0">Todos os direitos reservados © 2024 </p>
		</div>
	  </div>
	</div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src="<?php echo APP_URL; ?>/assets/script.js"></script>
</body>
</html>

<?php
ob_end_flush();
?>