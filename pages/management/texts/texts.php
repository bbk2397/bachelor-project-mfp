<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
<head>
	<title>
		<?php
			require_once 'constants.php';
			require_once $PREFIXED_TAB_TITLE_PATH;
			echo 'Texts -'.$TAB_TITLE;
		?>
	</title>
	
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link rel="shortcut icon" href="/favicon.ico">
  	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
</head>
<body class="container-fluid">
<?php
	require_once 'constants.php';
	require_once 'create.php';
	require_once 'update.php';
	require_once 'delete.php';
	require_once '../../../globals/view_components/navbar_with_margin_top.php';
	require_once 'ui_not_database_texts_and_translations/my_english.php';
	
	$create_textarea_placeholder_text = $enter_text_placeholder_text;
	require_once '../common/view_components/create_form_in_styled_divs.php';
	require_once '../common/view_components/crud_messages_in_styled_divs.php';

	$search_bar_id = 'search_bar_id';
	require_once '../common/view_components/search_bar_in_styled_divs.php';
	$search_table_id = 'search_table_id';
?>
	<div class="row">
		<div class="col-md-12">
			<table class="table table-striped table-dark table-hover table-sm table-responsive-sm">
				<caption class="bg-dark" style="color: white; text-indent: 20px;"><?=$caption_text?></caption>
				<thead>
					<tr>
						<th scope="col"><?=$table_row_counter_header?></th>
						<th scope="col"><?=$second_column?></th>
						<th scope="col"><?=$third_column?></th>
						<th scope="col"><?=$actions?></th>
					</tr>
				</thead>
				<tbody id="<?=$search_table_id?>">
<?php
	require_once '../common/main.php';
	$select_stmt = getTableDisplayDataForText( $pdo );

	$row_number = 0;
	while( $row = $select_stmt->fetch(PDO::FETCH_ASSOC) ) {
		$row_number += 1;
		$text_id = $row['id'];
		$text_number= $row['text_number'];
		$text_number_text = htmlentities($text_number)."\r\n";
		$version_text = htmlentities($row['version'])."\r\n";
		$since_text = htmlentities($row['since']);
		$number_version_since_textarea= '<textarea data-toggle="tooltip" data-placement="top" title="'.$number_version_since_tool_tip_text.'" data-html="true" type="text" cols="18" rows="3" readonly>'.$text_number_text.$version_text.$since_text.'</textarea>'; 
		$text_textarea = '<textarea data-toggle="tooltip" data-placement="top" title="'.$text_tool_tip_text.'" type="text" cols="30" rows="3" readonly>'.htmlentities($row['text']).'</textarea>';
?>
					<tr>
						<td><?=$row_number?></td>
						<td><?=$number_version_since_textarea?></td>
						<td><?=$text_textarea?></td>
						<td>
							<form method="post" style="display: inline;">
								<textarea  type="text" name="text" cols="30" rows="3" placeholder="<?=$text_update_placeholder_text?>" required></textarea>
								<input type="hidden" name="id" value="<?=$text_id?>">
								<input type="hidden" name="text_number" value="<?=$text_number?>">
								<input type="hidden" name="update" value="true"><br />
								<button class="btn btn-md btn-dark" type="submit" style="border-color: white; margin: 2px;">Update</button>
							</form>
							<form method="post" style="display: inline;">
								<input type="hidden" name="id" value="<?=$text_id?>">
								<input type="hidden" name="text_number" value="<?=$text_number?>">
								<input type="hidden" name="delete" value="true">
								<button class="btn btn-md btn-danger" type="submit" style="border-color: white; margin: 2px;">Delete</button>
							</form>
							<a tabindex="0" data-toggle="popover" data-trigger="focus" data-container="body" title="<?=$help_title_text1?>" data-content="<?=$help_body_text1?>" data-placement="top" style="text-decoration: none; margin: 2px;">
						</td>
					</tr>
<?php
	}
?>
				</tbody>
			</table>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
  	<?php
  		require_once '../common/view_components/when_document_is_ready.php';
  		whenDocumentIsReady( $search_bar_id, $search_table_id, true, true );
  	?>
</body>
</html>
