<?php
try
{
	$userId = $_POST["userId"];
	$paperId = $_POST["paperId"];
	$content = $_POST["content"];
	$category = $_POST["category"];
	$type = $_POST["type"];
	$parentId = $_POST["parentId"];
	$date = gmDate("Y-m-d H:i:s");
	$anonymous = $_POST["anonymous"];
	$others = split(",", $_POST["reference"]);
	//open the database
	$db = new PDO('sqlite:sg1.sqlite');
	if ($type == "true") {
		$db->exec("INSERT INTO questions (author_id, paper_id, content, category, datetime, anonymous) VALUES ('$userId', '$paperId', '$content', '$category', '$date', '$anonymous');");
		if ($category == 1) {
			$questionId = $db->lastInsertId();
			foreach($others as $other) {
				$db->exec("INSERT INTO relations VALUES ('$questionId', '$other');");
			}
		}
	}else{
		$db->exec("INSERT INTO comments (author_id, question_id, content, datetime, anonymous) VALUES ('$userId', '$parentId', '$content', '$date', '$anonymous');");
	}
	$db = NULL;
}
catch(PDOException $e)
{
	print 'Exception : '.$e->getMessage();
}
?>
