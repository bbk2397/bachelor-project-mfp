<?php
	require_once 'horizontal_list_style.css';
?>
<div class="container the-group">
	<div class="row text-center">
		<ul class="list-group list-group-flush list-group-horizontal" id="<?=$search_solution_list_id?>">
		<?php
			$select_stmt = getTableDisplayDataForSolution( $pdo );
			while( $row = $select_stmt->fetch(PDO::FETCH_ASSOC) ) {
				$solution_number= $row['solution_number'];
				$solution_number_text = htmlentities($solution_number)."(solution number)"."\r\n";
				$version_text = htmlentities($row['version'])."(solution text version)"."\r\n";
				$since_text = htmlentities($row['since'])."(since)";
				$number_version_since = $solution_number_text.$version_text.$since_text;
				$solution_text = $row['text'];
				$solution_textarea = '<textarea cols="35" rows="7" readonly>'.htmlentities($solution_text)."\r\n"."\r\n".$number_version_since.'</textarea>';
		?>
			<li class="list-group-item list-group-item-action list-group-item-primary" onclick="fillElements( `<?=$solution_textarea_for_number_id?>`, `<?=$solution_textarea_for_text_id?>`, `<?=$solution_number?>`, `<?=$solution_text?>`)">
				<?=$solution_textarea?>
			</li>
		<?php
			}
		?>
		</ul>
	</div>
</div>
