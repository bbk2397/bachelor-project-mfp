<?php
	require_once 'horizontal_list_style.css';
?>
<div class="container the-group">
	<div class="row text-center">
		<ul class="list-group list-group-flush list-group-horizontal" id="<?=$search_problem_list_id?>">
		<?php
			$select_stmt = getTableDisplayDataForProblem( $pdo );
			while( $row = $select_stmt->fetch(PDO::FETCH_ASSOC) ) {
				$problem_number= $row['problem_number'];
				$problem_number_text = htmlentities($problem_number)."(problem number)"."\r\n";
				$version_text = htmlentities($row['version'])."(problem text version)"."\r\n";
				$since_text = htmlentities($row['since'])."(since)";
				$number_version_since = $problem_number_text.$version_text.$since_text;
				$problem_text = $row['text'];
				$problem_textarea = '<textarea cols="35" rows="7" readonly>'.htmlentities($problem_text)."\r\n"."\r\n".$number_version_since.'</textarea>';
		?>
			<li class="list-group-item list-group-item-action list-group-item-primary" onclick="fillElements( `<?=$problem_textarea_for_number_id?>`, `<?=$problem_textarea_for_text_id?>`, `<?=$problem_number?>`, `<?=$problem_text?>`)">
				<?=$problem_textarea?>
			</li>
		<?php
			}
		?>
		</ul>
	</div>
</div>
