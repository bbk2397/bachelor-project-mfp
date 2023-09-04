<!-- delete a tag -->
<?php
	require_once "constants.php";
	require_once $PREFIXED_PDO_PATH;
	require_once $PREFIXED_TABLE_IDENTIFIERS_AND_STATEMENTS_PATH;

	if ( isset($_POST['id']) && isset($_POST['tag_number']) && isset($_POST['delete']) ) {
		$id = $_POST['id'];
		require_once '../common/delete.php';
		delete( $table_name_tag, $pdo, $id );
		$tag_number = $_POST['tag_number'];
		require_once '../common/main.php';
		$highest_version = getHighestVersion( $pdo, $tag_number, $table_name_tag_v, $field_tag_v_tag_number, $field_v_version );
		setUntilToNow( $pdo, $tag_number, $field_tag_v_tag_number, $field_v_version, $highest_version, $table_name_tag_v, $field_v_until );

		require_once "ui_not_database_texts_and_translations/my_english.php";
		$_SESSION['deleted_message'] = $tag_successfully_deleted_message;
		header( 'Location: tags.php' );
		return;
	}
?>
	
