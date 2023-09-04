<?php 
	function insertIntoProblemSolution( $pdo, $problem_number, $solution_number ) {
		$sql = 'INSERT INTO Problem_Solution (problem_number, solution_number, tag_numbers, text_numbers, active, deleted) VALUES (:problem_number, :solution_number, :tag_numbers, :text_numbers, :active, :deleted)';
		$insert_stmt = $pdo->prepare($sql);
			$insert_stmt->execute(array(
				':problem_number' => $problem_number,
				':solution_number' => $solution_number,
				':tag_numbers' => '',
				':text_numbers' => '',
				':active' => 1,
				':deleted' => 0
		));
	}

	function insertIntoProblemSolutionV( $pdo, $problem_number, $solution_number, $version ) {
		$sql = 'INSERT INTO Problem_Solution_v (problem_number, solution_number, version, tag_numbers, text_numbers, active, deleted) VALUES (:problem_number, :solution_number, :version, :tag_numbers, :text_numbers, :active, :deleted)';
		$insert_stmt = $pdo->prepare($sql);
			$insert_stmt->execute(array(
				':problem_number' => $problem_number,
				':solution_number' => $solution_number,
				':version' => $version,
				':tag_numbers' => '',
				':text_numbers' => '',
				':active' => 1,
				':deleted' => 0
		));
	}

	function insertFirstIntoProblemSolutionV( $pdo, $problem_number, $solution_number ) {
		insertIntoProblemSolutionV( $pdo, $problem_number, $solution_number, 1 );
	}
        require_once "constants.php";
        require_once $PREFIXED_PDO_PATH;
        require_once $PREFIXED_TABLE_IDENTIFIERS_AND_STATEMENTS_PATH;
        require_once $COMMON_MANAGEMENT_CREATE;
        require_once $COMMON_MANAGEMENT_UPDATE;

        if ( isset($_POST['problem_text']) && isset($_POST['solution_text']) && isset($_POST['create'] ))
        {
            $problem_text = $_POST['problem_text'];
            $solution_text = $_POST['solution_text'];

            $problem_number	= $_POST['problem_number'];
            if ($problem_number == '')
            {
                $problem_number = getSmallestNotUserNumber( $pdo, $table_name_problem_v, $field_problem_v_problem_number );
                insertInto( $pdo, $table_name_problem, $field_problem_problem_number, $problem_number, $field_problem_text, $problem_text);
                insertFirstInV( $pdo, $problem_number, $problem_text, $table_name_problem_v, $field_problem_v_problem_number, $field_v_version, $field_problem_v_text );
            }

            $solution_number	= $_POST['solution_number'];
            if ($solution_number == '') 
            {
                $solution_number = getSmallestNotUserNumber( $pdo, $table_name_solution_v, $field_solution_v_solution_number );
                insertInto( $pdo, $table_name_solution, $field_solution_solution_number, $solution_number, $field_solution_text, $solution_text);
                insertFirstInV( $pdo, $solution_number, $solution_text, $table_name_solution_v, $field_solution_v_solution_number, $field_v_version, $field_solution_v_text );
            }

            insertIntoProblemSolution( $pdo, $problem_number, $solution_number );
            insertFirstIntoProblemSolutionV( $pdo, $problem_number, $solution_number );

            require_once "ui_not_database_texts_and_translations/my_english.php";
            $_SESSION['created_message'] = $text_successfully_created_message;
            header( 'Location: problem_solution_associations.php' );
            
            return;
        }
?>
