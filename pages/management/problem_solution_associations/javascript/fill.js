function fillElements(textarea_for_number_id, textarea_for_text_id, number, text) {
	document.getElementById( textarea_for_number_id ).innerHTML = number;
	var text_area_for_text = document.getElementById( textarea_for_text_id );
	text_area_for_text.value = text;
	text_area_for_text.style.backgroundColor = "#66ff66";
	setTimeout(() => {
		text_area_for_text.style.backgroundColor = '';
	}, 150);
}

function empty( textarea_id ) {
	document.getElementById( textarea_id ).innerHTML = "";
} 
