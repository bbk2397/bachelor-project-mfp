<!-- create a text -->
<?php
	require_once "constants.php";
	require_once $PREFIXED_PDO_PATH;
	require_once $PREFIXED_TABLE_IDENTIFIERS_AND_STATEMENTS_PATH;

	if ( isset($_POST['text']) && isset($_POST['create']) ) {
		require_once '../common/create.php';
		$number = getSmallestNotUserNumber( $pdo, $table_name_text_v, $field_text_v_text_number );
		$text = $_POST['text'];	
		insertInto( $pdo, $table_name_text, $field_text_text_number, $number, $field_text_text, $text);
		require_once '../common/update.php';
		insertFirstInV( $pdo, $number, $text, $table_name_text_v, $field_text_v_text_number, $field_v_version, $field_text_v_text );

		require_once "ui_not_database_texts_and_translations/my_english.php";
		$_SESSION['created_message'] = $text_successfully_created_message;
		header( 'Location: texts.php' );
		return;
	}
?>
