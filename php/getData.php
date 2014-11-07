<?php
require_once("connectDb.php");
$theme = clean($_POST["theme"]);
if(!empty($theme)){
	$query = mysqli_query($link,"select * from themes,links,questionsanswers where themes.name='$theme' and themes.id = links.theme and themes.id = questionsanswers.theme order by rand() limit 1");
	$results = mysqli_num_rows($query);
	if($results==1){
		$res = mysqli_fetch_array($query);
			$response = "{\"link\":\"".$res["url"]."\",\"question\":\"".$res["question"]."\",\"answer\":\"".$res["answer"]."\"";
			$query = mysqli_query($link,"select distinct answer from questionsanswers where theme = ".$res["theme"]." and question!='".$res["question"]."' order by rand() limit 2");
			for($i=0;$i<2;$i++){
				$res = mysqli_fetch_array($query);
				$response .= ",\"answerFake".($i+1)."\":\"".$res["answer"]."\"";
			}
		$response .= "}";
		echo $response;
	}	
}
?> 