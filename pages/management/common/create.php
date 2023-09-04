<?php
	function getSmallestNotUserNumber( $pdo, $versioning_table_name, $field_number ) {
		$stmt = $pdo->query('SELECT MAX('.$field_number.') FROM '.$versioning_table_name);
		$stmt->execute();
		return $stmt->fetchAll()[0][0] + 1;
	}

	function insertInto( $pdo, $table_name, $field_number, $number, $field1, $field1_value ) {
		$sql = 'INSERT INTO '.$table_name.' ('.$field1.', '.$field_number.', active, deleted) VALUES (:field1, :number, :active, :deleted)';
		$insert_stmt = $pdo->prepare($sql);
		$insert_stmt->execute(array(
			':field1' => $field1_value,
			':number' => $number,
			':active' => 1,
			':deleted' => 0
		));
	}
?>
