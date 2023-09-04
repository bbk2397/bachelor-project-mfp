<?php
	if( !isset($_SESSION['solution_must_be_entered']) )
	{
		if( $there_is_nothing_to_review )
		{
?>
			<form method="post">
				<div class="btn-group btn-group-sm flex-wrap">
					<button class="btn btn-outline-primary btn-sm" type="submit" name="there_is_a_request_to_display_a_problem" style="font-size: 16px;" disabled>Display Problem</button>
				</div>
			</form>
<?php
		}
		else
		{
?>
			<form method="post">
				<div class="btn-group btn-group-sm flex-wrap">
					<button class="btn btn-outline-primary btn-sm" type="submit" name="there_is_a_request_to_display_a_problem" style="font-size: 16px;">Display Problem</button>
				</div>
			</form>
<?php
		}
	}
?>
