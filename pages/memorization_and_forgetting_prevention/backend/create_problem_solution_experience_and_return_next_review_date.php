<?php
	function buildNextReviewDate( $reviewing_sequence_index, $default_reviewing_sequence ) {
		$splitted = explode( ", ", $default_reviewing_sequence );
		if ( $reviewing_sequence_index >= 0 )
			$number_of_days = $splitted[ $reviewing_sequence_index ];
		else
			$number_of_days = 0;
		date_default_timezone_set( 'Europe/Bucharest' );
		$current_date = new DateTime( date( "Y-m-d H:i:s" ) );
		$next_review_date = $current_date;
		date_add( $next_review_date, date_interval_create_from_date_string( $number_of_days.' days') );
		return $next_review_date->format( "Y-m-d H:i:s" );
	}

	function createProblemSolutionExperienceAndReturnNextReviewDate( $pdo, $problem_number, $solution_number, $success, $current_next_review_timestamp_lower_limit ) {

		// set default data. Probably no default constants for first problem solution experience were set.
		$default_reviewing_sequence = "1, 1, 1, 2, 2, 3, 1, 5, 1, 8, 1, 12, 1, 1, 17, 1, 1, 23, 1, 1, 27, 1, 1, 37, 1, 1, 44, 1, 1, 48, 1, 1, 56, 1, 1, 63, 1, 1, 70, 1, 1, 77, 1, 1, 84, 1, 1, 91, 1, 1, 100, 1, 1, 110, 1, 1, 120, 1, 1, 130, 1, 1, 140, 1, 1, 150, 1, 1, 160, 1, 1, 170, 1, 1, 180, 1, 1, 190, 1, 1, 200";
		$default_m1 = 5;
		$default_m2 = 6;

		$select_stmt_for_default_constants = $pdo->query('
			SELECT *
			FROM default_constants_for_first_problem_solution_experience
			LIMIT 1
		');

		$select_stmt_for_default_constants->execute();
		while( $row = $select_stmt_for_default_constants->fetch(PDO::FETCH_ASSOC ) ) {
			$default_m1 = $row["m1"];
			$default_m2 = $row["m2"];
			$default_reviewing_sequence = $row["reviewing_sequence"];
		}

		// take the last experience for the passed problem_number, solution_number
		$select_stmt = $pdo->query('
			SELECT *
			FROM Problem_Solution_Experience
			WHERE problem_number='.$problem_number.' AND solution_number='.$solution_number.'
			ORDER BY experience_timestamp DESC
			LIMIT 1'
		);
		
		// determine the next problem solution experience number
		// returns the smallest not used number N, N > 0
		// this is dependent on the versioning tables
		// example:
		// used: 1 2 3 5 10
		// return: 11
		$stmt = $pdo->query('
			SELECT MAX( experience_number )
			FROM Problem_Solution_Experience
		');

		$stmt->execute();
		$experience_number = $stmt->fetchAll()[0][0] + 1;

		$success_increment = 0;
		$fail_increment = 0;
		if( $success )
			$success_increment = 1;
		else
			$fail_increment = 1;

		$is_already_an_experience = false;

		$actual_number_of_rows = 0;
		$expected_maximum_number_of_rows = 1;

		while( $row = $select_stmt->fetch(PDO::FETCH_ASSOC ) ) { // only one row; if there would be more => problem
			$actual_number_of_rows++;
			if ( $expected_maximum_number_of_rows < $actual_number_of_rows )
				print 'unexpected behavior: more rows than expected.';

			$is_already_an_experience = true;
			
			// if there is already an experience and it is too soon, i.e. $current_next_review_timestamp_lower_limit > current_date, then return the $current_next_review_date.
			date_default_timezone_set( 'Europe/Bucharest' );
			if ( $is_already_an_experience == true && strtotime($current_next_review_timestamp_lower_limit) > strtotime( date("Y-m-d H:i:s") ) )
			{
				return $current_next_review_timestamp_lower_limit;
			}
			// else $current_next_review_timestamp_lower_limit <= current_date

			$fails_total_number = $row["fails_total_number"] + $fail_increment;
			$successes_total_number = $row["successes_total_number"] + $success_increment;
			
			if ( $success ) {
				$consecutive_successes_in_last_attempts = $row["consecutive_successes_in_last_attempts"] + $success_increment;
				$consecutive_fails_in_last_attempts = 0;

				$consecutive_successes_at_current_reviewing_sequence_index = $row["consecutive_successes_at_current_reviewing_sequence_index"] + $success_increment;
				$consecutive_fails_at_current_reviewing_sequence_index = 0;
			}
			else {
				$consecutive_fails_in_last_attempts = $row["consecutive_fails_in_last_attempts"] + $fail_increment;
				$consecutive_successes_in_last_attempts = 0;

				$consecutive_fails_at_current_reviewing_sequence_index = $row["consecutive_fails_at_current_reviewing_sequence_index"] + $fail_increment;
				$consecutive_successes_at_current_reviewing_sequence_index = 0;
			}

			$state = $row["state"];
			$reviewing_sequence = $row["reviewing_sequence"];
			$reviewing_sequence_index = $row["reviewing_sequence_index"];
			$reviewing_sequence_index_changed_date = $row["reviewing_sequence_index_changed_date"];

			$next_review_date_built = false;
			
			// determine $state, $reviewing_sequence_index, $reviewing_sequence_index_changed_date
			if ( $row["m1"] <= $consecutive_successes_at_current_reviewing_sequence_index ) {
				$state = '11';
				$reviewing_sequence_index++;

				date_default_timezone_set( 'Europe/Bucharest' );
				$reviewing_sequence_index_changed_date = date( "Y-m-d H:i:s" );

				$consecutive_successes_at_current_reviewing_sequence_index = 0;
				$consecutive_fails_at_current_reviewing_sequence_index = 0;

				if( $success ) 
				{
					$next_review_date = buildNextReviewDate( $reviewing_sequence_index, $default_reviewing_sequence );
					$next_review_date_built = true;
				}
			}
			if ( $row["m2"] <= $consecutive_fails_at_current_reviewing_sequence_index ) {
				$state = '10';

				if ( $reviewing_sequence_index >= 0 )
					$reviewing_sequence_index--;

				date_default_timezone_set( 'Europe/Bucharest' );
				$reviewing_sequence_index_changed_date = date( "Y-m-d H:i:s" );

				$consecutive_successes_at_current_reviewing_sequence_index = 0;
				$consecutive_fails_at_current_reviewing_sequence_index = 0;

				if( $success ) 
				{
					$next_review_date = buildNextReviewDate( $reviewing_sequence_index, $default_reviewing_sequence );
					$next_review_date_built = true;
				}
			}

			if ( $next_review_date_built == false ) {
				date_default_timezone_set( 'Europe/Bucharest' );
				$next_review_date = date( "Y-m-d H:i:s" );
				$next_review_date_built = true;
			}

			$fields = ' (experience_number, problem_number, solution_number, fails_total_number, successes_total_number, consecutive_fails_in_last_attempts, consecutive_successes_in_last_attempts, state, reviewing_sequence, reviewing_sequence_index, reviewing_sequence_index_changed_date, consecutive_successes_at_current_reviewing_sequence_index, consecutive_fails_at_current_reviewing_sequence_index, m1, m2)';
			$values = ' VALUES(:experience_number, :problem_number, :solution_number, :fails_total_number, :successes_total_number, :consecutive_fails_in_last_attempts, :consecutive_successes_in_last_attempts, :state, :reviewing_sequence, :reviewing_sequence_index, :reviewing_sequence_index_changed_date, :consecutive_successes_at_current_reviewing_sequence_index, :consecutive_fails_at_current_reviewing_sequence_index, :m1, :m2)';
			
			$sql = 'INSERT INTO Problem_Solution_Experience'.$fields.$values;
			$insert_stmt = $pdo->prepare($sql);

			$insert_stmt->execute(array(
				':experience_number' => $experience_number,
				':problem_number' => $problem_number,
				':solution_number' => $solution_number,
				':fails_total_number' => $fails_total_number,
				':successes_total_number' => $successes_total_number,
				':consecutive_fails_in_last_attempts' => $consecutive_fails_in_last_attempts,
				':consecutive_successes_in_last_attempts' => $consecutive_successes_in_last_attempts,
				':state' => $state,
				':reviewing_sequence' => $row['reviewing_sequence'],
				':reviewing_sequence_index' => $reviewing_sequence_index,
				':reviewing_sequence_index_changed_date' => $reviewing_sequence_index_changed_date,
				':consecutive_successes_at_current_reviewing_sequence_index' => $consecutive_successes_at_current_reviewing_sequence_index,
				':consecutive_fails_at_current_reviewing_sequence_index' => $consecutive_fails_at_current_reviewing_sequence_index,
				':m1' => $row["m1"],
				':m2' => $row["m2"]
			));
			
			return $next_review_date;
		}


		if( $is_already_an_experience == false ) { // create the first experience
			$fields = ' (experience_number, problem_number, solution_number, fails_total_number, successes_total_number, consecutive_fails_in_last_attempts, consecutive_successes_in_last_attempts, state, reviewing_sequence, reviewing_sequence_index, reviewing_sequence_index_changed_date, consecutive_successes_at_current_reviewing_sequence_index, consecutive_fails_at_current_reviewing_sequence_index, m1, m2)';
			$values = ' VALUES(:experience_number, :problem_number, :solution_number, :fails_total_number, :successes_total_number, :consecutive_fails_in_last_attempts, :consecutive_successes_in_last_attempts, :state, :reviewing_sequence, :reviewing_sequence_index, :reviewing_sequence_index_changed_date, :consecutive_successes_at_current_reviewing_sequence_index, :consecutive_fails_at_current_reviewing_sequence_index, :m1, :m2)';
			
			$sql = 'INSERT INTO Problem_Solution_Experience'.$fields.$values;
			$insert_stmt = $pdo->prepare($sql);


			$next_review_date_built = false;
			$reviewing_sequence_index = -1;
			$consecutive_successes_at_current_reviewing_sequence_index = $success_increment;
			$consecutive_fails_at_current_reviewing_sequence_index = $fail_increment;
			$state = "0x";
			if ( $default_m1 <= $success_increment ) {
				$state = '11';
				$reviewing_sequence_index++;
				$consecutive_successes_at_current_reviewing_sequence_index = 0;

				$next_review_date = buildNextReviewDate( $reviewing_sequence_index, $default_reviewing_sequence );
				$next_review_date_built = true;
			}
			else if ( $default_m2 <= $fail_increment ) {
				$state = '10';

				$consecutive_fails_at_current_reviewing_sequence_index = 0;
			}

			date_default_timezone_set( 'Europe/Bucharest' );
			$reviewing_sequence_index_changed_date = date( "Y-m-d H:i:s" );

			if ( $next_review_date_built == false ) {
				date_default_timezone_set( 'Europe/Bucharest' );
				$next_review_date = date( "Y-m-d H:i:s" );
				$next_review_date_built = true;
			}

			$insert_stmt->execute(array(
				':experience_number' => $experience_number,
				':problem_number' => $problem_number,
				':solution_number' => $solution_number,
				':fails_total_number' => $fail_increment,
				':successes_total_number' => $success_increment,
				':consecutive_fails_in_last_attempts' => $fail_increment,
				':consecutive_successes_in_last_attempts' => $success_increment,
				':state' => $state,
				':reviewing_sequence' => $default_reviewing_sequence,
				':reviewing_sequence_index' => $reviewing_sequence_index,
				':reviewing_sequence_index_changed_date' => $reviewing_sequence_index_changed_date,
				':consecutive_successes_at_current_reviewing_sequence_index' => $consecutive_successes_at_current_reviewing_sequence_index,
				':consecutive_fails_at_current_reviewing_sequence_index' => $consecutive_fails_at_current_reviewing_sequence_index,
				':m1' => $default_m1,
				':m2' => $default_m2
			));

			return $next_review_date;
		}
	}
?>
