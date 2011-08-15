<html>
<head>
</head>
<body>
	<div id="accordion">

	<?php
	try
	{
		//open the database
		$dbh = new PDO('sqlite:sg1.sqlite') or die("cannot open database file");
		$sth=$dbh->prepare("SELECT * FROM questions where paper_id ='".$_GET["paperId"]."'"." union select * from questions where id in  (select question_id from relations where paper_id = '".$_GET["paperId"]."');"); //where category='".$type."'");
		$sth->execute();
		while ($result = $sth->fetch(PDO::FETCH_BOTH)){
			?>
		<h3>
			<a href="#">
			<?php
			if (strlen($result["content"]) >= 50) {
				print_r(substr($result["content"], 0, 50)."...");
			} else {
				print_r($result["content"]);
			}
			?> </a>
		</h3>
		<div>
			<div class="question-body">
				<p class="main_content">
				<?php print_r($result["content"])?></p>
				<div align="right">
					posted by <b>
					<?php
					if ($result["anonymous"] == "true" || $result["author_id"] == null || strlen($result["author_id"]) == 0) {
						echo "Anonymous";
					} else {
						echo addslashes($result["author_id"]);
					}
					?></b> on <b><?php echo $result["datetime"]?>
					</b>
				</div>
			</div>


			<ol class="selectable ui-widget-content">

			<?php
			$comsth=$dbh->prepare("select * from comments where question_id=".$result["id"]);
			$comsth->execute();
			while($comment=$comsth->fetch(PDO::FETCH_BOTH)){
				?>
				<li>
					<p>
					<?php print_r($comment["content"]) ?></p>
					<div align="right">
						posted by <b>
						<?php
						if ($comment["anonymous"] == "true" || $comment["author_id"] == null || strlen($comment["author_id"]) == 0) {
							echo "Anonymous";
						} else {
							echo addslashes($comment["author_id"]);
						}
						?></b> on <b><?php echo $comment["datetime"]?>
						</b>
					</div></li>
				
				
	        <?php
		        }  
	        ?>
            </ol>
			<br />
			<comment_button id="<?php echo $result["id"] ?>">Comment</comment_button>
		</div>
		
		
	<?php
    }
  }
  catch(PDOException $e)
  {
    print 'Exception : '.$e->getMessage();
  }
?>
</div>
</body>
</html>
