<!-- delete a solution -->
<?php
	require_once "constants.php";
	require_once $PREFIXED_PDO_PATH;
	require_once $PREFIXED_TABLE_IDENTIFIERS_AND_STATEMENTS_PATH;

	if ( isset($_POST['id']) && isset($_POST['solution_number']) && isset($_POST['delete']) ) {
		$id = $_POST['id'];
		require_once '../common/delete.php';
		delete( $table_name_solution, $pdo, $id );
		$solution_number = $_POST['solution_number'];
		require_once '../common/main.php';
		$highest_version = getHighestVersion( $pdo, $solution_number, $table_name_solution_v, $field_solution_v_solution_number, $field_v_version );
		setUntilToNow( $pdo, $solution_number, $field_solution_v_solution_number, $field_v_version, $highest_version, $table_name_solution_v, $field_v_until );
		
		require_once "ui_not_database_texts_and_translations/my_english.php";
		$_SESSION['deleted_message'] = $solution_successfully_deleted_message;
		header( 'Location: solutions.php' );
		return;
	}
?>
	
