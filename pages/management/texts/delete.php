<!-- delete a text -->
<?php
	require_once "constants.php";
	require_once $PREFIXED_PDO_PATH;
	require_once $PREFIXED_TABLE_IDENTIFIERS_AND_STATEMENTS_PATH;

	if ( isset($_POST['id']) && isset($_POST['text_number']) && isset($_POST['delete']) ) {
		$id = $_POST['id'];
		require_once '../common/delete.php';
		delete( $table_name_text, $pdo, $id );
		$text_number = $_POST['text_number'];
		require_once '../common/main.php';
		$highest_version = getHighestVersion( $pdo, $text_number, $table_name_text_v, $field_text_v_text_number, $field_v_version );
		setUntilToNow( $pdo, $text_number, $field_text_v_text_number, $field_v_version, $highest_version, $table_name_text_v, $field_v_until );
		
		require_once "ui_not_database_texts_and_translations/my_english.php";
		$_SESSION['deleted_message'] = $text_successfully_deleted_message;
		header( 'Location: texts.php' );
		return;
	}
?>
	
