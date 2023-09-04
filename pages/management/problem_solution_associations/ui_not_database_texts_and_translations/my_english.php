<?php
	$help_title_text1 = "Hint!";
	$help_body_text1 ="Every (problem, solution) association can have:<br />
  		1. a new problem, a new solution,<br />
  		2. a new problem, an existing solution,<br />
  		3. an existing problem, a new solution, or<br />
  		4. an existing problem, an existing solution.
  	";

  	$help_title_text2 = "Attention!";
  	$help_body_text2 = "The text of every problem should be:<br />
		1. unique in the scope of the problem texts of this application at the current time,<br />
		2. must have at least one character, and<br />
		3. TODO think: are all characters allowed? Should all characters be allowed?
	";

	$help_title_text3 = "Attention!";
  	$help_body_text3 = "The text of every solution should be:<br />
		1. unique in the scope of the solution texts of this application at the current time,<br />
		2. must have at least one character, and<br />
		3. TODO think: are all characters allowed? Should all characters be allowed?
	";

	$todos = "
	<div>
		TODOs
	</div>
	<div>
		#1 General question: How to create (problem, solution) associations faster? There should be possible to use templates, e.g. problem: translate from X to Y: NS, solution: TS. It should be possible to also generate another problem solution like this: translate from Y to X, TS, solution: NS. There should also be standard answers, e.g. yes, no, true, false, unknown, 1, 2, ..., 30, a, b, ..., z
	</div>
	<div>
		#2 Increase performance by redesigning the table problem_solution_exeperience using serialisation. Problem 1: it is possible? If yes, Problem 2: all records from the current table problem_solution_experience should be moved in the redesigned table problem_solution_experience.
	</div>
	<div>
		#3 The (problem, solution) association with the earliest lower_next_review_date is given, but it should be one of the problems to be reviewed.
	</div>
	<div>#4 There should be possible to choose an order, e.g. sequential (should be possible to create sequences; more general: create conditional sequences), pseudo-random
	</div>
	<div>
		#5 There should be possible to focus on doing only some. This will be solved with tags.
	</div>
	";

	$enter_problem_text_placeholder_text = "Enter a problem text or select an existing problem";
	$enter_solution_text_placeholder_text = "Enter a solution text or select an existing solution";
	$create_problem_solution_association_button_text = "Create (problem, solution) association";

	$problem_number = "problem number";
	$solution_number = "solution number";

	$more_information = "More information";
	$problem_hint = "problem text<br />problem number<br />problem version<br />since";
	$solution_hint = "solution text<br />solution number<br />solution version<br />since";

	$text_successfully_created_message = "The (problem, solution) association was successfully created!";
?>
