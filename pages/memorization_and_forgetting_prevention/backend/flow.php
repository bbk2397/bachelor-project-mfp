<?php		
	if ( isset($_POST["there_is_a_request_to_display_a_problem"]) ) {
		unset($_SESSION["solution_submitted"]);
		unset($_SESSION["feedback"]);
		unset($_SESSION[ $submission_message ]);
		unset($_SESSION['problem_text']);
		unset($_SESSION['problem_number']);
		unset($_SESSION['solution_number']);
		unset($_SESSION['next_review_timestamp_lower_limit']);
		unset($_SESSION['correct']);

		$randomness = 20;
		$problem_solution_association_select_stmt = getProblemSolutionAssociation( $pdo, $randomness );
		$number_of_rows = $problem_solution_association_select_stmt->rowCount();

		$random_number = 0;
		if ( $number_of_rows >= 1 )
			$random_number = mt_rand(1, $number_of_rows);

		$_SESSION["is_something_to_review"] = $number_of_rows;

		$counter = 0;
		while( $row = $problem_solution_association_select_stmt->fetch(PDO::FETCH_ASSOC) ) {
			$counter += 1;
			if( $random_number == $counter ) {				
				$_SESSION['problem_text'] = htmlentities($row["problem_text"]);
				$_SESSION['solution_text'] = htmlentities($row["solution_text"]);
				$_SESSION['problem_number'] = htmlentities($row["problem_number"]);
				$_SESSION['solution_number'] = htmlentities($row["solution_number"]);
				$_SESSION['next_review_timestamp_lower_limit'] = htmlentities($row["next_review_timestamp_lower_limit"]);
				$_SESSION['solution_must_be_entered'] = 'solution must be entered';
				
				$_SESSION['redirected_from_flow.php'] = 'redirected_from_flow.php';
				header( "Location: memorization_and_forgetting_prevention.php" );
				return;
			}
		}

		unset($_SESSION['solution_must_be_entered']);
		$_SESSION['redirected_from_flow.php'] = 'redirected_from_flow.php';
		header( "Location: memorization_and_forgetting_prevention.php" );
		return;
	}
	else if( isset($_POST["solution_submitted"]) ) {
		$submitted_solution_text = htmlentities($_POST["solution_submitted"]);

		$_SESSION["solution_submitted"] = $submitted_solution_text;

		$_SESSION['solution_text'] = str_replace("&quot;", "\"", $_SESSION['solution_text']);

		$_SESSION['feedback'] = '';
		if( strcmp($submitted_solution_text, $_SESSION['solution_text']) == 0 ) {
			$_SESSION['feedback'] .= "This submitted solution is considered correct, because it is a solution found in the database for the displayed problem. (it may not be correct, but this is how it is stored in the database.)";
			$next_review_date = createProblemSolutionExperienceAndReturnNextReviewDate( $pdo, $_SESSION['problem_number'], $_SESSION['solution_number'], true, $_SESSION['next_review_timestamp_lower_limit'] );
			$_SESSION['feedback'] .= "\n\nThe next review date should be ".$next_review_date;
			setNextReviewDate( $pdo, $_SESSION['problem_number'],  $_SESSION['solution_number'], $next_review_date );
			$_SESSION['correct'] = "true";
		}
		else if( strcmp($submitted_solution_text, $_SESSION['solution_text']) != 0 ) {
			$_SESSION['feedback'] .= "This submitted solution is not considered correct, because it is not a solution found in the used database for the displayed problem. (it may be correct, but it is not stored in the database.)";
			$_SESSION['feedback'] .= "\n\nA solution is:\n".$_SESSION['solution_text'];
			$next_review_date = createProblemSolutionExperienceAndReturnNextReviewDate( $pdo, $_SESSION['problem_number'], $_SESSION['solution_number'], false, $_SESSION['next_review_timestamp_lower_limit'] );
			setNextReviewDate( $pdo, $_SESSION['problem_number'],  $_SESSION['solution_number'], $next_review_date );
			$_SESSION['feedback'] .= "\n\nThe next review date should be ".$next_review_date;
			$_SESSION['correct'] = "false";
		}

		unset($_SESSION['solution_must_be_entered']);

		require_once "../backend/ui_not_database_texts_and_translations/my_english.php";

		$_SESSION['redirected_from_flow.php'] = 'redirected_from_flow.php';
		header( "Location: memorization_and_forgetting_prevention.php" );
		return;
	}
?>
