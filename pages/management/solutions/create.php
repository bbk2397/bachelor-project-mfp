<!-- create a solution -->
<?php
	require_once "constants.php";
	require_once $PREFIXED_PDO_PATH;
	require_once $PREFIXED_TABLE_IDENTIFIERS_AND_STATEMENTS_PATH;

	if ( isset($_POST['text']) && isset($_POST['create']) ) {
		require_once '../common/create.php';
		$number = getSmallestNotUserNumber( $pdo, $table_name_solution_v, $field_solution_v_solution_number );
		$text = $_POST['text'];
		insertInto( $pdo, $table_name_solution, $field_solution_solution_number, $number, $field_solution_text, $text);
		require_once '../common/update.php';
		insertFirstInV( $pdo, $number, $text, $table_name_solution_v, $field_solution_v_solution_number, $field_v_version, $field_solution_v_text );

		require_once "ui_not_database_texts_and_translations/my_english.php";
		$_SESSION['created_message'] = $solution_successfully_created_message;
		header( 'Location: solutions.php' );
		return;
	}
?>
