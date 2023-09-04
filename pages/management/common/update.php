<?php
	function update( $pdo, $table_name, $field_name, $field_name_value ) {
		$sql = "
			UPDATE ".$table_name." SET ".$field_name." = :field
			WHERE id = :id
		";
		$update_stmt = $pdo->prepare($sql);
		$update_stmt->execute(array(
			':field' => $field_name_value,
			':id' => $_POST['id']
		));
	}
	
	function insertInV( $pdo, $number_value, $version, $field_v_versioned_value, $table_v_name, $field_v_number, $field_v_version, $field_v_versioned ) {
		$values = ' VALUES (:number, :version, :versioned_field)';
		$sql = 'INSERT INTO '.$table_v_name.'('.$field_v_number.', '.$field_v_version.', '.$field_v_versioned.')'.$values;
		$insert_stmt = $pdo->prepare($sql);

		$insert_stmt->execute(array(
				':number' => $number_value,
				':version' => $version,
				':versioned_field' => $field_v_versioned_value
		));
	}

	function insertFirstInV( $pdo, $number_value, $field_v_versioned_value, $table_v_name, $field_v_number, $field_v_version, $field_v_versioned  ) {
		insertInV( $pdo, $number_value, 1, $field_v_versioned_value, $table_v_name, $field_v_number, $field_v_version, $field_v_versioned );
	}
?>
