<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
<head>
	<title>
		<?php
			require_once "constants.php";
			require_once $PREFIXED_TAB_TITLE_PATH;
			echo 'Associations -'.$TAB_TITLE;
		?>
	</title>
	<script src="<?=$PREFIXED_GLOBAL_JS_HELP_PATH?>"></script>
	<script src="javascript/fill.js"></script>

	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link rel="shortcut icon" href="/favicon.ico">
  	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
</head>
<body class="container-fluid">
<?php
	require_once "constants.php";	
	require_once $PREFIXED_PDO_PATH;
	require_once "../common/main.php";
	require_once 'create.php';
	require_once '../../../globals/view_components/navbar_with_margin_top.php';
	require_once 'ui_not_database_texts_and_translations/my_english.php';

	$enter_problem_textarea_placeholder_text = $enter_problem_text_placeholder_text;
	$enter_solution_textarea_placeholder_text = $enter_solution_text_placeholder_text;

	$problem_textarea_for_number_id = "problem_number_textarea_id";
	$problem_textarea_for_text_id = "problem_text_textarea_id";
	$solution_textarea_for_number_id = "solution_number_textarea_id";
	$solution_textarea_for_text_id = "solution_text_textarea_id";
?>
	<div class="row" style="position: -webkit-sticky; /* Safari */ position: sticky; top: 8%; z-index: 1; background-color: #ffffb3; padding: 5px; font-size: 10px;">
		<div class="col-md-12 d-flex justify-content-center">
			<form method="post">
				<div class="row">
					<div class="col-md-12 d-flex justify-content-center">
						<textarea class="form-control" name="problem_number" placeholder="<?=$problem_number?>" id="<?=$problem_textarea_for_number_id?>" readonly></textarea>
						<textarea class="form-control" name="solution_number" placeholder="<?=$solution_number?>" id="<?=$solution_textarea_for_number_id?>" readonly></textarea>
					</div>
				</div>
				<style>
					#<?=$problem_textarea_for_number_id?>, #<?=$solution_textarea_for_number_id?> {
						height: 3em;
    					width: 10em;
    					-webkit-transition: width .35s ease-in-out;
  						transition: width .35s ease-in-out;
  						font-size: 10px;
					}

					#<?=$problem_textarea_for_number_id?>:focus, #<?=$solution_textarea_for_number_id?>:focus {
						background-color: #d9fefc;
						border-top: 1px solid #6683ff;
						border-right: 3px solid #6683ff;
						border-bottom: 5px solid #6683ff;
						border-left: 1px solid #6683ff;
    					width: 40em;
					}
				</style>
				<div class="row">
					<style>
						#<?=$problem_textarea_for_text_id?>, #<?=$solution_textarea_for_text_id?> {
							height: 10em;
							-webkit-transition: height .35s ease-in-out;
  							transition: height .35s ease-in-out;
	    					width: 25em;
	    					font-size: 10px;
						}

						#<?=$problem_textarea_for_text_id?>:focus, #<?=$solution_textarea_for_text_id?>:focus {
							background-color: #d9fefc;
							border-top: 1px solid #6683ff;
							border-right: 3px solid #6683ff;
							border-bottom: 5px solid #6683ff;
							border-left: 1px solid #6683ff;
						}
					</style>
					<div class="col-md-12 d-flex justify-content-center">
						<textarea class="form-control shadow" name="problem_text" placeholder="<?=$enter_problem_text_placeholder_text?>" id="<?=$problem_textarea_for_text_id?>" oninput="empty(`<?=$problem_textarea_for_number_id?>`)" required></textarea>
						<textarea class="form-control shadow" name="solution_text" placeholder="<?=$enter_solution_text_placeholder_text?>" id="<?=$solution_textarea_for_text_id?>" oninput="empty(`<?=$solution_textarea_for_number_id?>`)" required></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 d-flex justify-content-center">
						<button class="btn btn-outline-dark" name="create" type="submit" style="margin-top: 5px; font-size: 10px;"><?=$create_problem_solution_association_button_text?></button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12 d-flex justify-content-center shadow-textarea" style="margin-top: 3px;">
	<?php
		$created_message = 'created_message';
		if ( isset( $_SESSION[$created_message] ) and !( isset($_POST['problem_text']) and isset($_POST['solution_text']) and isset($_POST['create']) ) ) {
	?>
		<div class="alert alert-success" role="alert">
				<?=$_SESSION[ $created_message ];?>
		</div>
	<?php
			unset( $_SESSION[ $created_message ] );
		}
	?>
		</div>
	</div>

	<?php
		$search_box_id_for_problem_horizontal_list = 'search_box_or_problem_horizontal_list_id';
		$search_problem_list_id = 'search_problem_horizontal_list_id';
	?>
	<div class="row" style="margin-top: 10px; font-size: 10px;">
		<div class="col-md-12 d-flex justify-content-center">
			<div class="row">
				<style>
					#<?=$search_box_id_for_problem_horizontal_list?> {
						margin-bottom: 5px;
					}

					#<?=$search_box_id_for_problem_horizontal_list?> {
						height: 2em;
						-webkit-transition: height .35s ease-in-out;
  						transition: height .35s ease-in-out;
    					width: 20em;
    					-webkit-transition: width .35s ease-in-out;
  						transition: width .35s ease-in-out;
					}

					#<?=$search_box_id_for_problem_horizontal_list?>:focus {
						background-color: #d9fefc;
						border-top: 1px solid #6683ff;
						border-right: 3px solid #6683ff;
						border-bottom: 5px solid #6683ff;
						border-left: 1px solid #6683ff;
						height: 6em;
    					width: 35em;
					}
				</style>
				<div class="col-md-12 d-flex justify-content-center">
					<textarea class="shadow" id="<?=$search_box_id_for_problem_horizontal_list?>" placeholder="Search in the problem horizontal list below"></textarea>
				</div>
				<?php
					require_once "view_components/problems_horizontal_list.php";
				?>
			</div>
		</div>
	</div>


	<?php
		$search_box_id_for_solution_horizontal_list = 'search_box_for_solution_horizontal_list_id';
		$search_solution_list_id = 'search_solution_horizontal_list_id';
	?>
	<div class="row" style="margin-top: 10px; font-size: 10px;">
		<div class="col-md-12 d-flex justify-content-center">
				<style>
					#<?=$search_box_id_for_solution_horizontal_list?> {
						margin-bottom: 5px;
					}

					#<?=$search_box_id_for_solution_horizontal_list?> {
						height: 2em;
						-webkit-transition: height .35s ease-in-out;
  						transition: height .35s ease-in-out;
    					width: 20em;
    					-webkit-transition: width .35s ease-in-out;
  						transition: width .35s ease-in-out;
					}

					#<?=$search_box_id_for_solution_horizontal_list?>:focus {
						background-color: #d9fefc;
						border-top: 1px solid #6683ff;
						border-right: 3px solid #6683ff;
						border-bottom: 5px solid #6683ff;
						border-left: 1px solid #6683ff;
						height: 6em;
    					width: 35em;
					}
				</style>
			<div class="row">
				<div class="col-md-12 d-flex justify-content-center">
					<textarea class="shadow" id="<?=$search_box_id_for_solution_horizontal_list?>" placeholder="Search in the solution horizontal list below" style="margin-bottom: 5px;"></textarea>
				</div>
				<?php
					require_once "view_components/solutions_horizontal_list.php";
				?>
			</div>
		</div>
	</div>
	
	<div style="margin-top: 10px; position: -webkit-sticky; /* Safari */ position: sticky; top: 38%; z-index: 2;">
		<?php
			$search_bar_id = 'search_bar_id_for_table';
		?>
			<style>
				#<?=$search_bar_id?> {
					margin-bottom: 5px;
				}

				#<?=$search_bar_id?> {
					height: 2em;
					-webkit-transition: height .35s ease-in-out;
						transition: height .35s ease-in-out;
					width: 30em;
					-webkit-transition: width .35s ease-in-out;
						transition: width .35s ease-in-out;
					font-size: 10px;
				}

				#<?=$search_bar_id?>:focus {
					background-color: #d9fefc;
					border-top: 1px solid #6683ff;
					border-right: 3px solid #6683ff;
					border-bottom: 5px solid #6683ff;
					border-left: 1px solid #6683ff;
					height: 6em;
					width: 35em;
				}
			</style>
			<div class="col-md-12 d-flex justify-content-center">
				<textarea class="shadow" id="<?=$search_bar_id?>" placeholder="Search in the table below by either problem text or solution text" style="margin-bottom: 5px;"></textarea>
			</div>
		<?php
			$search_table_id = 'search_table_id';
		?>
	</div>
	<div class="row">
		<div class="col-md-12">
			<table class="table table-striped table-dark table-hover table-sm table-responsive-sm" style="font-size: 10px;">
				<thead>
					<tr>
						<th>#</th>
						<th>problem number<br>solution number<br>version<br>since</th>
						<th>problem text<br>solution text</th>
						<th>tags<br>texts<br>head<br>tail</th>
						<th>states</th>
					</tr>
				</thead>
				<tbody id="<?=$search_table_id?>">

			<?php
				function h( $a ) {
					return htmlentities( $a );
				}

				function hn( $a ) {
					return htmlentities( $a )."\r\n";
				}

				function br( $a ) {
					return $a.'<br />';
				}

				function ta( $a, $title, $data_content ) {
					return '<textarea data-toggle="tooltip" data-html="true" data-container="body" title="'.$title.'" data-content="'.$data_content.'" data-placement="top" cols=20 rows=3 readonly>'.$a.'</textarea>';
				}

				$select_stmt = getTableDisplayDataForProblemSolution( $pdo );
				$row_count = 0;
				while( $row = $select_stmt->fetch(PDO::FETCH_ASSOC) ) {
					$row_count += 1;
					$problem_number = $row['problem_number'];
					$problem_text = $row['problem_text'];
					$solution_number = $row['solution_number'];
					$solution_text = $row['solution_text'];
					$version = $row['version'];
					$since = $row['since'];
					$meta_info_column_textarea = '<textarea data-toggle="tooltip" data-html="true" data-container="body" title="Hint!" data-content="problem number<br />solution number<br />version<br />since" data-placement="top" cols="18" rows="4" readonly>'.hn( $problem_number ).hn( $solution_number ).hn( $version ).h( $since ).'</textarea>';

					$tag_numbers = $row['tag_numbers'];
					$tag_text = "tags: ".$tag_numbers;
					$tag_number_name = getMapTagNumberName( $pdo, $tag_numbers ); // because of multiple calls, there should be displayed only a small number of (problem, solution) associations
					$text_numbers = $row['text_numbers']; // the texts should be loaded when a set of events occur (it's needed probably a lot of space to be displayed)
					$text_text = "texts: ".$text_numbers;
					$text_number_text = getMapTextNumberName( $pdo, $text_numbers );

					$tag_text_head_tail_textareas = br( ta( $tag_text, "Hint!", "All associated tags" ) ).br( ta( $text_text, "Hint!", "All associated texts" ) ).br( ta( $head_text, "Hint!", "All (problem, solution) associations that are heads to this (problem, solution) association" ) ).ta( $tail_text, "Hint!", "All (problem, solution) associations that are tails to this (problem, solution) association" );

					$active = $row['active'];
					$active_text = "inactive";
					if ( $active == 1 )
						$active_text = 'active';
					$deleted = $row['deleted'];
					$deleted_text = "not deleted";
					if ( $deleted == 1 )
						$deleted_text = "deleted";
			?>
					<tr>
						<td><?=$row_count?></td>
						<td><?=$meta_info_column_textarea?></td>
						<td>
							<textarea cols="40" rows="3" readonly onclick="fillElements( `<?=$problem_textarea_for_number_id?>`, `<?=$problem_textarea_for_text_id?>`, `<?=$problem_number?>`, `<?=$problem_text?>`)"><?=$problem_text?></textarea>
							<br />
							<textarea cols="40" rows="3" readonly onclick="fillElements( `<?=$solution_textarea_for_number_id?>`, `<?=$solution_textarea_for_text_id?>`, `<?=$solution_number?>`, `<?=$solution_text?>`)"><?=$solution_text?></textarea>
						</td>
						<td><?=$tag_text_head_tail_textareas?></td>
						<td><?=br($active_text).$deleted_text?></td>
					</tr>
			<?php
				}
			?>
				</tbody>
			</table>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

	<script>
		$(document).ready(function() {
			$('[data-toggle="popover"]').popover();
			$('[data-toggle="tooltip"]').popover();

			$("#<?=$search_bar_id?>").on("keyup", function() {
			    var value = $(this).val().toLowerCase();
			    $("#<?=$search_table_id?> tr").filter(function() {
			    	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		    	});
		  	});

		  	$("#<?=$search_box_id_for_problem_horizontal_list?>").on("keyup", function() {
			    var value = $(this).val().toLowerCase();
			    $("#<?=$search_problem_list_id?> li").filter(function() {
			    	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		    	});
		  	});

		  	$("#<?=$search_box_id_for_solution_horizontal_list?>").on("keyup", function() {
			    var value = $(this).val().toLowerCase();
			    $("#<?=$search_solution_list_id?> li").filter(function() {
			    	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		    	});
		  	});
		});
	</script>
</div>
  	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
</body>
</html>
