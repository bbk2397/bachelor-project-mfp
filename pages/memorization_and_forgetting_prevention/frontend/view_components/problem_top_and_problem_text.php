<?php
	$problem_solution_association_select_stmt = getProblemSolutionAssociation( $pdo, 1 );
	$there_is_nothing_to_review = $problem_solution_association_select_stmt->rowCount() == 0;
?>

<div style="position: -webkit-sticky; /* Safari */ position: sticky; top: 10%; z-index: 1;">
	<div class="alert alert-light">
		<div class="row">
			<div class="col-md-12 d-flex justify-content-center">
				<?php
					require_once "top_messages.php";
				?>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12 d-flex justify-content-center">
				<?php
					require_once "next_problem_displayer.php";
				?>
			</div>
		</div>

		<div class="row"> 
			<div class="col-md-12 d-flex justify-content-center">
				<?php
					require_once "problem_text.php";
				?>
			</div>
		</div>
	</div>
</div>
