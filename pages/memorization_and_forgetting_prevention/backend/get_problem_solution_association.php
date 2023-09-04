<?php
	function getProblemSolutionAssociationHavingEarliestReviewDate( $pdo, $limit )
	{
		return $pdo->query("
			SELECT text AS problem_text, d.problem_number, c.solution_number, c.solution_text, c.next_review_timestamp_lower_limit, c.tag_numbers, c.text_numbers
			FROM Problem d
			INNER JOIN (
				SELECT text AS solution_text, b.solution_number, b.problem_number, b.next_review_timestamp_lower_limit, b.tag_numbers, b.text_numbers
				FROM Solution a
				INNER JOIN (    
					SELECT *
					FROM Problem_Solution
					WHERE CURRENT_TIMESTAMP() >= next_review_timestamp_lower_limit
					ORDER BY next_review_timestamp_lower_limit
					LIMIT ".$limit."
				) b ON a.solution_number = b.solution_number
			) c ON c.problem_number = d.problem_number
		");
	}

	function getProblemSolutionAssociation( $pdo, $limit )
	{
		return getProblemSolutionAssociationHavingEarliestReviewDate( $pdo, $limit );
	}
?>
