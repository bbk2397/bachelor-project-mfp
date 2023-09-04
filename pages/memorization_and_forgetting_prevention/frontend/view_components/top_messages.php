<?php
  class FutureReviewDate
  {
    private $date;
    private $is;

    function __construct( $pdo ) {
      $stmt = $pdo->query("
        SELECT text AS problem_text, d.problem_number, c.solution_number, c.solution_text, c.next_review_timestamp_lower_limit
        FROM Problem d
        INNER JOIN (
          SELECT text AS solution_text, b.solution_number, b.problem_number, b.next_review_timestamp_lower_limit
          FROM Solution a
          INNER JOIN (    
            SELECT *
            FROM Problem_Solution
            WHERE CURRENT_TIMESTAMP() < next_review_timestamp_lower_limit
            ORDER BY next_review_timestamp_lower_limit
            LIMIT ".'1'."
          ) b ON a.solution_number = b.solution_number
        ) c ON c.problem_number = d.problem_number
      ");

      $this->$is = $stmt->rowCount() > 0;
      if( $this->$is )
      {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->$date = $row['next_review_timestamp_lower_limit'];
      }
    }

    function is()
    {
      return $this->$is;
    }

    function get()
    {
      return $this->$date;
    }
  }
?>


<?php
	if( !isset($_SESSION['solution_must_be_entered']) && $there_is_nothing_to_review )
	{
?>
		<div class="alert alert-warning" role="alert" style="font-size: 16px">
  			There is nothing to review right now.
        <br>
        <br>

<?php
        $date = new FutureReviewDate( $pdo );
        if( $date->is() )
        {
?>
          The next earliest review date is:
          <br>
          <?=$date->get()?>
          <br>
          <br>
<?php
        }
?>
  			<button type="button" class="btn btn-outline-success" style="width: 100%;">
  				<a href="http://www.memorization-and-forgetting-prevention.mine/pages/management/problem_solution_associations/problem_solution_associations.php" style="color: inherit; text-decoration: none;">
  					Add problem-solution associations
  				</a>
  			</button>
		</div>
<?php
	}
?>