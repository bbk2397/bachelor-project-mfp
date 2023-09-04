<!-- update a tag -->
<?php
	require_once "constants.php";
	require_once $PREFIXED_PDO_PATH;
	require_once $PREFIXED_TABLE_IDENTIFIERS_AND_STATEMENTS_PATH;

	if ( isset($_POST['name']) && isset($_POST['id']) && isset($_POST['tag_number']) && isset($_POST['update'])) {
		$name = $_POST['name'];
		require_once '../common/update.php';
		update( $pdo, $table_name_tag, $field_tag_name, $name );
		
		$tag_number = $_POST['tag_number'];
		require_once '../common/main.php';
		$highest_version = getHighestVersion( $pdo, $tag_number, $table_name_tag_v, $field_tag_v_tag_number, $field_v_version );
		
		setUntilToNow( $pdo, $tag_number, $field_tag_v_tag_number, $field_v_version, $highest_version, $table_name_tag_v, $field_v_until );
		insertInV( $pdo, $tag_number, $highest_version+1, $name, $table_name_tag_v, $field_tag_v_tag_number, $field_v_version, $field_tag_v_name );

		require_once "ui_not_database_texts_and_translations/my_english.php";
		$_SESSION['updated_message'] = $tag_successfully_updated_message;
		header( 'Location: tags.php' );
		return;
	}
?>
