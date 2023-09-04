<?php
	function delete( $table_name, $pdo, $id ) {
		$sql = "DELETE FROM ".$table_name." WHERE id = :id";
		$delete_stmt = $pdo->prepare($sql);
		$delete_stmt->execute(array(':id' => $id));
	}
?>
