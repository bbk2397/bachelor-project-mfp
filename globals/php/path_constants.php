<?php
	/*
		what is the use of these path constants?
			1. Write them once, use them everywhere.
				how?
					#1 import this file by writing
						require_once "php/globals/require_path_constants.php"
					#2 use the constants
			2. If a path changes in the file system, it is enough for that path to be updated only here
	*/
	/*
		Rules
			1. use only upper case letters for variables
			2. the paths should be relative and should start in the directory in which
			index.php is located
	*/

	$GLOBALS = 'globals';
	$GLOBAL_JS = $GLOBALS.'/js';
	$GLOBAL_PHP = $GLOBALS.'/php';
	$DATABASES = '/databases';
	$FRAGMENTS = '/fragments';
	$GLOBAL_PHP_DATABASES = $GLOBAL_PHP.$DATABASES;
	$GLOBAL_PHP_FRAGMENTS = $GLOBAL_PHP.$FRAGMENTS;
	
	// PHP
	$TAB_TITLE_PATH = $GLOBAL_PHP_FRAGMENTS.'/title.php';
	// PHP - databases
	$PDO_PATH = $GLOBAL_PHP_DATABASES.'/pdo.php';
	$TABLE_IDENTIFIERS_AND_STATEMENTS_PATH = $GLOBAL_PHP_DATABASES.'/table_identifiers_and_statements.php';

	// JS
	$GLOBAL_JS_CONSTANTS_PATH = $GLOBAL_JS.'/constants.js';
	$GLOBAL_JS_HELP_PATH = $GLOBAL_JS.'/help.js';
	$GLOBAL_JS_LISTENERS_PATH = $GLOBAL_JS.'/listeners.js';
	
	// pages
	$PAGES = 'pages/';
	$MANAGEMENT = 'management/';
	$FRONTEND = 'frontend/';
	$MEMORIZATION_AND_FORGETTING_PREVENTION = 'memorization_and_forgetting_prevention/';
	
	$TAGS = 'tags/';
	$PAGES_MANAGEMENT_TAGS = $PAGES.$MANAGEMENT.$TAGS.'tags.php';
	
	$TEXTS = 'texts/';
	$PAGES_MANAGEMENT_TEXTS = $PAGES.$MANAGEMENT.$TEXTS.'texts.php';
	
	$PROBLEMS = 'problems/';
	$PAGES_MANAGEMENT_PROBLEMS = $PAGES.$MANAGEMENT.$PROBLEMS.'problems.php';
	
	$SOLUTIONS = 'solutions/';
	$PAGES_MANAGEMENT_SOLUTIONS = $PAGES.$MANAGEMENT.$SOLUTIONS.'solutions.php';
	
	$PROBLEM_SOLUTION_ASSOCIATIONS = 'problem_solution_associations/';
	$PAGES_MANAGEMENT_PROBLEM_SOLUTION_ASSOCIATIONS = $PAGES.$MANAGEMENT.$PROBLEM_SOLUTION_ASSOCIATIONS.'problem_solution_associations.php';
	
	$PAGES_MEMORIZATION_AND_FORGETTING_PREVENTION_FRONTEND = $PAGES.$MEMORIZATION_AND_FORGETTING_PREVENTION.$FRONTEND.'memorization_and_forgetting_prevention.php';
?> 
