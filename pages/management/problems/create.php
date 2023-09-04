<!-- create a problem -->
<?php
	require_once "constants.php";
	require_once $PREFIXED_PDO_PATH;
	require_once $PREFIXED_TABLE_IDENTIFIERS_AND_STATEMENTS_PATH;

	if ( isset($_POST['text']) && isset($_POST['create']) ) {
		require_once '../common/create.php';
		$number = getSmallestNotUserNumber( $pdo, $table_name_problem_v, $field_problem_v_problem_number );
		$text = $_POST['text'];
		insertInto( $pdo, $table_name_problem, $field_problem_problem_number, $number, $field_problem_text, $text);
		require_once '../common/update.php';
		insertFirstInV( $pdo, $number, $text, $table_name_problem_v, $field_problem_v_problem_number, $field_v_version, $field_problem_v_text );

		require_once "ui_not_database_texts_and_translations/my_english.php";
		$_SESSION['created_message'] = $problem_successfully_created_message;
		header( 'Location: problems.php' );
		return;
	}
?>
