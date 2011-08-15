<html>
<head>
</head>
<body>
	<div>
		<ol class="selectable ui-widget-content">
			
		<?php
		try
		{
			//open the database
			$quesCount = 0;
			$commCount = 0;
			$dbh = new PDO('sqlite:sg1.sqlite') or die("cannot open database file");
			$sth=$dbh->prepare("SELECT * FROM questions where paper_id = '".$_GET["paperId"]."'"." union select * from questions where id in (select question_id from relations where paper_id = '".$_GET["paperId"]."');"); //where category='".$type."'");
			$sth->execute();
			while ($result = $sth->fetch(PDO::FETCH_BOTH)){
				if ($quesCount < 3) {
					?>
			<li> 
			<?php
			if (strlen($result["content"]) >= 50) {
				print_r(substr($result["content"], 0, 50)."...");
			} else {
				print_r($result["content"]);
			}
			?></li>
			
			
<?php
    }

        $quesCount += 1;
        $comsth=$dbh->prepare("select count(*) as num from comments where question_id=".$result["id"]);
        $comsth->execute();
        $comment = $comsth->fetch(PDO::FETCH_BOTH);
        $commCount += $comment["num"];
    }
?>
    </ol>
		<div class="statistic-bar">
			questions: <b><?php echo $quesCount ?>
			</b> comments: <b><?php echo $commCount ?>
			</b>
		</div>
		
		
<?php
  }
  catch(PDOException $e)
  {
    print 'Exception : '.$e->getMessage();
  }
?>
</div>
</body>
</html>
