<!DOCTYPE html>
<html lang="en">
<head>
	<title>
		<?php
			require_once 'constants.php';
			require_once $TAB_TITLE_PATH;
			echo $TAB_TITLE;
		?>
	</title>
	<?php
		echo $JS;
	?>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link rel="shortcut icon" href="/favicon.ico">
  	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
</head>
<body class="container-fluid">
	<?php
		header('Location: '.$PAGES_MEMORIZATION_AND_FORGETTING_PREVENTION_FRONTEND);
	?>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
</body>
</html>
