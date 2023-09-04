<!-- delete a problem -->
<?php
	require_once "constants.php";
	require_once $PREFIXED_PDO_PATH;
	require_once $PREFIXED_TABLE_IDENTIFIERS_AND_STATEMENTS_PATH;

	if ( isset($_POST['id']) && isset($_POST['problem_number']) && isset($_POST['delete']) ) {
		$id = $_POST['id'];
		require_once '../common/delete.php';
		delete( $table_name_problem, $pdo, $id );
		$problem_number = $_POST['problem_number'];
		require_once '../common/main.php';
		$highest_version = getHighestVersion( $pdo, $problem_number, $table_name_problem_v, $field_problem_v_problem_number, $field_v_version );
		setUntilToNow( $pdo, $problem_number, $field_problem_v_problem_number, $field_v_version, $highest_version, $table_name_problem_v, $field_v_until );

		require_once "ui_not_database_texts_and_translations/my_english.php";
		$_SESSION['deleted_message'] = $problem_successfully_deleted_message;
		header( 'Location: problems.php' );
		return;
	}
?>
	
