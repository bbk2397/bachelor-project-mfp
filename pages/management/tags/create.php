<!-- create a knowledge tag -->
<?php
	require_once "constants.php";
	require_once $PREFIXED_PDO_PATH;
	require_once $PREFIXED_TABLE_IDENTIFIERS_AND_STATEMENTS_PATH;
	
	if ( isset($_POST['text']) && isset($_POST['create']) ) {
		require_once '../common/create.php';
		$number = getSmallestNotUserNumber( $pdo, $table_name_tag_v, $field_tag_v_tag_number );
		$name = $_POST['text'];
		insertInto( $pdo, $table_name_tag, $field_tag_tag_number, $number, $field_tag_name, $name );
		require_once '../common/update.php';
		insertFirstInV( $pdo, $number, $name, $table_name_tag_v, $field_tag_v_tag_number, $field_v_version, $field_tag_v_name );

		require_once "ui_not_database_texts_and_translations/my_english.php";
		$_SESSION['created_message'] = $tag_successfully_created_message;
		header( 'Location: tags.php' );
		return;
	}
?>
