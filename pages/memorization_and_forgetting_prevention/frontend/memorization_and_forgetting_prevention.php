<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
<head>
	<title>
		<?php
			require_once "constants.php";
			require_once $PREFIXED_TAB_TITLE_PATH;
			echo $TAB_TITLE;
		?>
	</title>
	<script src="<?=$PREFIXED_GLOBAL_JS_HELP_PATH?>"></script>

	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link rel="shortcut icon" href="/favicon.ico">
  	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
</head>
<body class="container-fluid">
<?php
	require_once "constants.php";
	require_once $PREFIXED_PDO_PATH;

	require_once '../backend/ui_not_database_texts_and_translations/my_english.php';

	require_once '../backend/create_problem_solution_experience_and_return_next_review_date.php';
	require_once '../backend/get_problem_solution_association.php';
	require_once '../backend/set_next_review_date.php';

	if( !(isset($_POST["there_is_a_request_to_display_a_problem"]) || isset($_POST["solution_submitted"]) ) ) {
	
		if ( !isset($_SESSION['redirected_from_flow.php']) )
			session_unset();
		else
			unset($_SESSION['redirected_from_flow.php']);
	}

	$submission_message = 'the_solution_set_was_submitted_please_wait_for_feedback';
	require_once '../backend/flow.php';

	require_once $_SERVER['DOCUMENT_ROOT'].'/globals/view_components/navbar_with_margin_top.php';
?>
	<div style="font-size: 10px;">
<?php
	require_once 'view_components/problem_top_and_problem_text.php';
	if ( isset($_SESSION[$submission_message]) ) {
?>
	<div class="row">
		<div class="col-md-12 d-flex justify-content-center">
			<div class="alert alert-success" role="alert">
				<?=$_SESSION[ $submission_message ]?>
			</div>
		</div>
	</div>
<?php
	}
?>
		<form method="post" style="margin-top: 7px;">
<?php
	if ( isset($_SESSION['correct']) ) {
		if ( strcmp($_SESSION['correct'], "true") == 0 ) {
?>
			<div class="alert alert-success" role="alert">
<?php
		}
		else if ( strcmp($_SESSION['correct'], "false") == 0 ) {
?>
			<div class="alert alert-danger" role="alert">
<?php
		}
	}
?>
				<div class="row">
					<div class="col-md-12 d-flex justify-content-center">
						<?php
							if( isset($_SESSION["feedback"]) ) {
						?>
							<textarea rows="13" cols="100" placeholder="here will be displayed the feedback for the problem found immediately above and the given solution at the right" readonly style="font-size: 16px;"><?=$_SESSION["feedback"]?></textarea>
						<?php
							}
							if( isset($_SESSION['solution_must_be_entered']) ) {
						?>
								<textarea name="solution_submitted" rows="13" cols="100" style="font-size: 16px;" placeholder="Please enter your solution here" required></textarea>
						<?php
							}
							else {
								if( isset($_SESSION["solution_submitted"]) ) {
						?>
									<textarea name="solution_submitted" rows="13" cols="100" style="font-size: 16px;" placeholder="Please enter your solution here" readonly><?=$_SESSION["solution_submitted"]?></textarea>
						<?php
								}
							}
						?>
					</div>
				</div>
	<?php
		if ( isset($_SESSION['correct']) ) {
	?>
			</div>
		<?php
		}
			if( isset($_SESSION['solution_must_be_entered']) ) {
		?>
			<div class="row">
				<div class="col-md-12 d-flex justify-content-center">
					<button class="btn btn-primary" type="submit" style="font-size: 16px;">Submit
					</button>
				</div>
			</div>
		<?php
			}
		?>
		</form>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
            
		<script>
			$(document).ready(function() {
				$('[data-toggle="popover"]').popover();
				$('[data-toggle="tooltip"]').popover();
			});
		</script>
	</div>
</body>
</html>
