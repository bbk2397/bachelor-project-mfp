<navbar class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
		<span class="navbar-toggler-icon"></span>
	</button>

<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/globals/view_components/ui_not_database_texts_and_translations/my_english.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/constants.php';
?>
	<div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar"> <!-- d-flex  -->
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle text-white" href="#" id="navbardrop" data-bs-toggle="dropdown">
                <?=$manage?>
            </a>
			<div class="dropdown-menu">
				<a class="dropdown-item" href='/<?=$PAGES_MANAGEMENT_PROBLEM_SOLUTION_ASSOCIATIONS?>'><b><?=$problem_solutions_associations?></b></a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href='/<?=$PAGES_MANAGEMENT_PROBLEMS?>'>
					<b><?=$problems?></b>
				</a>
				<a class="dropdown-item" href='/<?=$PAGES_MANAGEMENT_SOLUTIONS?>'>
					<b><?=$solutions?></b>
				</a>
				<a class="dropdown-item" href='/<?=$PAGES_MANAGEMENT_TAGS?>'>
					<b><?=$tags?></b>
				</a>
				<a class="dropdown-item" href='/<?=$PAGES_MANAGEMENT_TEXTS?>'>
					<b><?=$texts?></b>
				</a>
			</div>
		</li>

		<a class="nav-link text-white" href='/<?=$PAGES_MEMORIZATION_AND_FORGETTING_PREVENTION_FRONTEND?>' style="font-size: 16px;">
			<?=$memorize_and_prevent_forgetting?>
		</a>
	</div>
</navbar>
