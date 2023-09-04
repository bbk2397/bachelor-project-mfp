<?php
	$created_message = 'created_message';
	if ( isset( $_SESSION[$created_message] ) and !(isset($_POST['text']) or isset($_POST['tag_number']) or isset($_POST['text_number']) or isset($_POST['problem_number']) or isset($_POST['solution_number']) and isset($_POST['create']) ) ) {
?>
		<div class="alert alert-success" role="alert">
				<?=$_SESSION[ $created_message ];?>
		</div>
<?php
		unset( $_SESSION[ $created_message ] );
	}
?>

<?php
	$deleted_message = 'deleted_message';
	if ( isset( $_SESSION[ $deleted_message ] ) and !(isset($_POST['text']) or isset($_POST['tag_number']) or isset($_POST['text_number']) or isset($_POST['problem_number']) or isset($_POST['solution_number']) and isset($_POST['delete']) ) ) {
?>
		<div class="alert alert-danger" role="alert">
				<?=$_SESSION[ $deleted_message ];?>
		</div>
<?php
		unset( $_SESSION[ $deleted_message ] );
	}
?>

<?php
	$updated_message = 'updated_message';
	if ( isset( $_SESSION[ $updated_message ] ) and !(isset($_POST['text']) or isset($_POST['tag_number']) or isset($_POST['text_number']) or isset($_POST['problem_number']) or isset($_POST['solution_number'])  and isset($_POST['update']) ) ) {
?>
		<div class="alert alert-info" role="alert">
				<?=$_SESSION[ $updated_message ];?>
		</div>
<?php
		unset( $_SESSION[ $updated_message ] );
	}
?> 
