<?php
	function whenDocumentIsReady( $search_bar_id, $search_table_id, $enable_boostrap_data_toggle_popover, $enable_bootstrap_data_toggle_tooltip ) {
?>
		<script>
			$(document).ready(function() {
				if ( <?=$enable_boostrap_data_toggle_popover?> )
					$('[data-toggle="popover"]').popover();
				if ( <?=$enable_bootstrap_data_toggle_tooltip?> )
					$('[data-toggle="tooltip"]').popover();

				$("#<?=$search_bar_id?>").on("keyup", function() {
				    var value = $(this).val().toLowerCase();
				    $("#<?=$search_table_id?> tr").filter(function() {
				    	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			    	});
			  	});
			});
		</script>
<?php
	}
?> 
