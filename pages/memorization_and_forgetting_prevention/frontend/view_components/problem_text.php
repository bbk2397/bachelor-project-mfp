<?php
	$problem_text = '';
	if( isset($_SESSION['problem_text']) ) {
		$problem_text = $_SESSION['problem_text'];
	}
?>

<textarea rows="13" cols="100" placeholder="the problem will be displayed here" style="font-size: 16px;" readonly><?=$problem_text?></textarea><br>
 
