<?php
	function setNextReviewDate( $pdo, $problem_number, $solution_number, $next_review_timestamp_lower_limit ) {
		$sql = "
			UPDATE Problem_Solution SET next_review_timestamp_lower_limit = :next_review_timestamp_lower_limit
			WHERE problem_number = :problem_number AND solution_number = :solution_number
		";
		$update_stmt = $pdo->prepare($sql);

		$update_stmt->execute(array(
			':next_review_timestamp_lower_limit' => $next_review_timestamp_lower_limit,
			':problem_number' => $problem_number,
			':solution_number' => $solution_number
		));
	}
?>
