<!-- update a solution tag -->
<?php
	require_once "constants.php";
	require_once $PREFIXED_PDO_PATH;
	require_once $PREFIXED_TABLE_IDENTIFIERS_AND_STATEMENTS_PATH;

	if ( isset($_POST['text']) && isset($_POST['id']) && isset($_POST['solution_number']) && isset($_POST['update'])) {
		$text = $_POST['text'];
		require_once '../common/update.php';
		update( $pdo, $table_name_solution, $field_solution_text, $text );

		$solution_number = $_POST['solution_number'];
		require_once '../common/main.php';
		$highest_version = getHighestVersion( $pdo, $solution_number, $table_name_solution_v, $field_solution_v_solution_number, $field_v_version );
		
		setUntilToNow( $pdo, $solution_number, $field_solution_v_solution_number, $field_v_version, $highest_version, $table_name_solution_v, $field_v_until );
		insertInV( $pdo, $solution_number, $highest_version+1, $text, $table_name_solution_v, $field_solution_v_solution_number, $field_v_version, $field_solution_v_text );

		require_once "ui_not_database_texts_and_translations/my_english.php";
		$_SESSION['updated_message'] = $solution_successfully_updated_message;
		header( 'Location: solutions.php' );
		return;
	}
?>
