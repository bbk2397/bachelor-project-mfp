<?php
	$PREFIX = "../../../";
	
	$PATH_CONSTANTS = "globals/php/path_constants.php";
	
	$PREFIXED_PATH_CONSTANTS = $PREFIX.$PATH_CONSTANTS;
	require_once $PREFIXED_PATH_CONSTANTS;
	
	$PREFIXED_TAB_TITLE_PATH = $PREFIX.$TAB_TITLE_PATH;
	$PREFIXED_PDO_PATH = $PREFIX.$PDO_PATH;
	$PREFIXED_TABLE_IDENTIFIERS_AND_STATEMENTS_PATH = $PREFIX.$TABLE_IDENTIFIERS_AND_STATEMENTS_PATH;
	$PREFIXED_GLOBAL_JS_HELP_PATH = $PREFIX.$GLOBAL_JS_HELP_PATH;
	
	$COMMON_MANAGEMENT_MAIN = "../common/main.php";
	$COMMON_MANAGEMENT_CREATE = "../common/create.php";
	$COMMON_MANAGEMENT_UPDATE = "../common/update.php";
	
	$REDIRECT_TO_INDEX = $PREFIX.'index.php';
	$REDIRECT_TO_PROBLEM_SOLUTION_ASSOCIATIONS = 'Location: problem_solution_associations.php';
?>