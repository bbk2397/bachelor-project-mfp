<?php
	function getHighestVersion( $pdo, $number, $table_v_name, $number_field, $field_version ) {
		$where = ' WHERE '.$number_field.'='.$number;
		$stmt = $pdo->query('SELECT MAX('.$field_version.') FROM '.$table_v_name.$where);
		$stmt->execute();
		$highestNumber = $stmt->fetchAll()[0][0];
		return $highestNumber;
	}

	function setUntilToNow( $pdo, $number, $field_number, $field_version, $highest_version, $table_name_v, $field_until ) {
		$where = ' WHERE ( '.$field_number.' = '.$number.' AND '.$field_version.' = '.$highest_version.' )';
		$sql = 'UPDATE '.$table_name_v.' SET '.$field_until.' = :until'.$where;
		$update_stmt = $pdo->prepare($sql);
		date_default_timezone_set('Europe/Bucharest');
		$update_stmt->execute(array(
			':until' => date('Y-m-d H-i-s')
		));
	}

	function getTableDisplayDataForTag( $pdo ) {
		return $pdo->query("
			SELECT c.id, c.tag_number, c.name, d.version, d.since
			FROM Tag c
			INNER JOIN (    
	    	SELECT a.tag_number, a.version, a.since
	    	FROM Tag_v a
	    	INNER JOIN (
	        SELECT tag_number, MAX(version) maximum_version
	        FROM Tag_v
	        GROUP BY tag_number
	    	) b ON a.tag_number = b.tag_number AND a.version = b.maximum_version
	    	WHERE until = '0000-00-00 00:00:00' -- only the not deleted tags should be displayed
			) d ON c.tag_number = d.tag_number
			ORDER BY d.since DESC
		");
	}

	function getTableDisplayDataForText( $pdo ) {
		return $pdo->query("
			SELECT c.id, c.text_number, c.text, d.version, d.since
			FROM Text c
			INNER JOIN (    
    		SELECT a.text_number, a.version, a.since
    		FROM Text_v a
    		INNER JOIN (
        	SELECT text_number, MAX(version) maximum_version
        	FROM Text_v
        	GROUP BY text_number
    		) b ON a.text_number = b.text_number AND a.version = b.maximum_version
    		WHERE until = '0000-00-00 00:00:00' -- only the not deleted texts should be displayed
			) d ON c.text_number = d.text_number
			ORDER BY d.since DESC
		");
	}

	function getTableDisplayDataForProblem( $pdo ) {
		return $pdo->query("
			SELECT c.id, c.problem_number, c.text, d.version, d.since
			FROM Problem c
			INNER JOIN (    
    		SELECT a.problem_number, a.version, a.since
    		FROM Problem_v a
    		INNER JOIN (
        	SELECT problem_number, MAX(version) maximum_version
        	FROM Problem_v
        	GROUP BY problem_number
    		) b ON a.problem_number = b.problem_number AND a.version = b.maximum_version
    		WHERE until = '0000-00-00 00:00:00' -- only the not deleted problems should be displayed
			) d ON c.problem_number = d.problem_number
			ORDER BY d.since DESC
		");
	}

	function getTableDisplayDataForSolution( $pdo ) {
		return $pdo->query("
			SELECT c.id, c.solution_number, c.text, d.version, d.since
			FROM Solution c
			INNER JOIN (    
    		SELECT a.solution_number, a.version, a.since
    		FROM Solution_v a
    		INNER JOIN (
        	SELECT solution_number, MAX(version) maximum_version
        	FROM Solution_v
        	GROUP BY solution_number
    		) b ON a.solution_number = b.solution_number AND a.version = b.maximum_version
    		WHERE until = '0000-00-00 00:00:00' -- only the not deleted problems should be displayed
			) d ON c.solution_number = d.solution_number
			ORDER BY d.since DESC
		");
	}

	function getTableDisplayDataForProblemSolution ( $pdo ) {
		return $pdo->query("
			SELECT  g.problem_number, g.problem_text, g.solution_number, h.text AS solution_text, g.tag_numbers, g.text_numbers, g.active, g.deleted, g.version, g.since
			FROM Solution h
			INNER JOIN (

				SELECT e.problem_number AS problem_number, f.text AS problem_text, e.solution_number AS solution_number, e.tag_numbers AS tag_numbers, e.text_numbers AS text_numbers, e.active AS active, e.deleted AS deleted, e.version AS version, e.since AS since
				FROM Problem f
				INNER JOIN (

					SELECT c.problem_number, c.solution_number AS solution_number, c.tag_numbers AS tag_numbers, c.text_numbers AS text_numbers, c.active AS active, c.deleted AS deleted, d.version AS version, d.since AS since
					FROM Problem_Solution c
					INNER JOIN (    
		    		SELECT a.problem_number, a.solution_number, a.version, a.since
		    		FROM Problem_Solution_v a
		    		INNER JOIN (
		        	SELECT problem_number, solution_number, MAX(version) maximum_version
		        	FROM Problem_Solution_v
		        	GROUP BY problem_number, solution_number
		    		) b ON a.problem_number = b.problem_number AND a.solution_number = b.solution_number AND a.version = b.maximum_version
		    		WHERE until = '0000-00-00 00:00:00' -- only the not deleted problems should be displayed
					) d ON c.problem_number = d.problem_number AND c.solution_number = d.solution_number

				) e ON e.problem_number = f.problem_number
			) g ON g.solution_number = h.solution_number
			ORDER BY g.since DESC
		");
	}

	function getMapTagNumberName( $pdo, $tag_numbers ) {
		return "";
	}

	function getMapTextNumberName( $pdo, $text_numbers ) {
		return "";
	}
?>
