<!-- used for tag, text, problem, solution -->
<!-- usage (as I see it right now):
	step 1: write the text in the variable:
		$create_textarea_placeholder_text
	step 2: import this html code
-->
<form method="post">
	<textarea class="form-control shadow" type="text" name="text" cols="35" rows="1" placeholder="<?=$create_textarea_placeholder_text?>" required></textarea>
	<button class="btn btn-outline-dark" type="submit" style="margin-top: 5px;">Create</button>
	<input type="hidden" name="create" value="true">
</form>
