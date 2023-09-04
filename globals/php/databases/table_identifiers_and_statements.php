<?php
	$id = 'id';

	// fields used by all versioning tables (at least, until now)
	$field_v_version = 'version';
	$field_v_since = 'since';
	$field_v_until = 'until';

	// tag table
	$table_name_tag = 'Tag';
	$field_tag_tag_number = 'tag_number'; // used also by the versioning table
	$field_tag_name = 'name'; // used also by the versioning table
	
	// tag_v table
	$table_name_tag_v = 'Tag_v';
	$field_tag_v_tag_number = 'tag_number';
	$field_tag_v_name = 'name';
	
	// text table
	$table_name_text = 'Text';
	$field_text_text_number = 'text_number';
	$field_text_text = 'text';

	// text_v table
	$table_name_text_v = 'Text_v';
	$field_text_v_text_number = 'text_number';
	$field_text_v_text = 'text';

	// problem table
	$table_name_problem = 'Problem';
	$field_problem_problem_number = 'problem_number';
	$field_problem_text = 'text';

	// problem_v table
	$table_name_problem_v = 'Problem_v';
	$field_problem_v_problem_number = 'problem_number';
	$field_problem_v_text = 'text';

	// solution table
	$table_name_solution = 'Solution';
	$field_solution_solution_number = 'solution_number';
	$field_solution_text = 'text';

	// solution_v table
	$table_name_solution_v = 'Solution_v';
	$field_solution_v_solution_number = 'solution_number';
	$field_solution_v_text = 'text';
?>
