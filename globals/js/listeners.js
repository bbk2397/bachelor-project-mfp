function addQuestionListListeners() {
	answerSelectionChange();
}

function answerSelectionChange( ) {
	$(".answer-selection").click(function(){
    colorSwitch1( $(this) );
  });
}

function colorSwitch1( e ) {
	var backgroundColor = e.css( BACKGROUND_COLOR );
	if ( backgroundColor == BLACK ) {
		e.css( BACKGROUND_COLOR, WHITE );
		e.css( TEXT_COLOR, BLACK );
	}
	else {
		e.css( BACKGROUND_COLOR, BLACK );
		e.css( TEXT_COLOR, WHITE );
	}
}

function addSubmitListener() {
  $(".submit-answers").click(function(){
    var correctAnswerClass = $(".correct-answer"); // TODO use it later
		var correctAnswerEvaluationResultClass = $(".correct-answer-evaluation-result"); // TODO use it later
		var incorrectAnswerClass = $(".incorrect-answer"); // TODO use it later
		var incorrectAnswerEvaluationResultClass = $(".incorrect-answer-evaluation-result"); // TODO use it later
		
		var answerEvaluationResult = $(".answer-evaluation-result");
		
		$(".answer").removeClass('answer-hover');
		$(".answer-selection").off( "click" );
		answerEvaluationResult.css( "display", "inline-block" );
  });
}

