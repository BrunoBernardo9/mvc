	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="crossorigin="anonymous"></script>

	<script type="text/javascript" src="<?php echo PATH_URL ?>/assets/js/lib/mask/jquery.mask.min.js?<?php echo filemtime('app/assets/js/lib/mask/jquery.mask.min.js') ?>"></script>

	<script type="text/javascript" src="<?php echo PATH_URL ?>/assets/js/lib/mask/jquery.mask.js?<?php echo filemtime('app/assets/js/lib/mask/jquery.mask.jss') ?>"></script>
  	<!-- UIkit CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.3.7/dist/css/uikit.min.css" />

	<!-- UIkit JS -->
	<script src="https://cdn.jsdelivr.net/npm/uikit@3.3.7/dist/js/uikit.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/uikit@3.3.7/dist/js/uikit-icons.min.js"></script>

	<?php
		if(!empty($js)){
			// Percorre todos os JS da view.
			// Que foram setados no controller.
			foreach($js as $row){
				if(file_exists('app/assets/js/' . $row)){
					$caminho = PATH_URL . '/assets/js/' . $row;
					$version = filemtime('/app/assets/js/' . $row);
					
					echo '<script type="text/javascript" src="'.$caminho.'?v='.$version.'"></script>';
				}
			}
		}
	?>
</body>
</html>