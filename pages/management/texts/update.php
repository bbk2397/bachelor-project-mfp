<!-- update a knowledge tag -->
<?php
	require_once "constants.php";
	require_once $PREFIXED_PDO_PATH;
	require_once $PREFIXED_TABLE_IDENTIFIERS_AND_STATEMENTS_PATH;

	if ( isset($_POST['text']) && isset($_POST['id']) && isset($_POST['text_number']) && isset($_POST['update'])) {
		$text = $_POST['text'];
		require_once '../common/update.php';
		update( $pdo, $table_name_text, $field_text_text, $text );

		$text_number = $_POST['text_number'];
		require_once '../common/main.php';
		$highest_version = getHighestVersion( $pdo, $text_number, $table_name_text_v, $field_text_v_text_number, $field_v_version );
		
		setUntilToNow( $pdo, $text_number, $field_text_v_text_number, $field_v_version, $highest_version, $table_name_text_v, $field_v_until );
		insertInV( $pdo, $text_number, $highest_version+1, $text, $table_name_text_v, $field_text_v_text_number, $field_v_version, $field_text_v_text );

		require_once "ui_not_database_texts_and_translations/my_english.php";
		$_SESSION['updated_message'] = $text_successfully_updated_message;
		header( 'Location: texts.php' );
		return;
	}
?>
