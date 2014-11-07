<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Main Screen</title>
		<link rel="stylesheet" type="text/css" href="../css/admin.css" />
		<script src="js/jquery-2.1.1.min.js" type="text/javascript"></script>
		<script src="js/custom.js" type="text/javascript"></script>
	</head>
	<body>
		<div id="wrapper">
			<div id="innerWrapper">
<?php
require_once("connectDb.php");
if(isset($_SESSION["admin"])&& $_SESSION["admin"] == "admin123"){
	if(isset($_POST["youtubeID"])&&isset($_POST["theme"])){
		$url = clean($_POST["youtubeID"]);
		$theme = intval($_POST["theme"]);
		if(!empty($url))
		mysqli_query($link,"insert into links values(NULL,$theme,'$url')");	     
	}
	if(isset($_POST["question"])&&isset($_POST["answer"])&&isset($_POST["theme"])){
		$question = clean($_POST["question"]);
		$answer = clean($_POST["answer"]);
		$theme = intval($_POST["theme"]);
		if(!empty($question)&&!empty($answer))
		mysqli_query($link,"insert into questionsanswers values(NULL,$theme,'$question','$answer')");	     
	}
}
$query = mysqli_query($link, "select * from links order by date desc");
?>
<h1>Admin Panel</h1>
<?php if(!isset($_POST["username"])&&!isset($_SESSION["admin"])){ ?>
<form name="adminForm" id="adminForm" method="post" action="admin.php">
    <div class="adminForm">
    <div class="content">
        <table id="messageTable">
            <tr>
                <td>Username</td>
                <td><input type="text" name="username" id="username"/></td>           
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" id="password"/></td>           
            </tr>
            <tr>
                <td colspan="2"><input id="subm2" type="submit" value="Ok"/></td>
            </tr>
        </table>
    </div>
</div>
</form>
<?php
} else {
    if(!isset($_SESSION["admin"])){
    if(isset($_POST["username"])) $username = clean($_POST["username"]);
    else $username = "";
    if(isset($_POST["password"])) $password = clean($_POST["password"]);
    else $password = "";
    if(empty($username)||empty($password)){
?>

        Username or password is incorrect!!!
 
<?php
    } else {
        if($username!="admin" || $password!="admin"){
            ?>
     
        Username or password is incorrect!!!

            <?php
        } else {
        $_SESSION["admin"] = "admin123";
        }
    }
    }
        if(isset($_SESSION["admin"])&&$_SESSION["admin"]=="admin123"){
    if(isset($_GET["link_id"])){
        $id = intval($_GET["link_id"]);
        $remQuery = mysqli_query($link,"delete from links where id=$id");
    }
    if(isset($_GET["question_id"])){
        $id = intval($_GET["question_id"]);
        $remQuery = mysqli_query($link,"delete from questionsanswers where id=$id");
    }
if(!$query = mysqli_query($link,"select url,name,fullName,links.id as ID from links,themes where themes.id = links.theme order by ID desc")){
    echo "Can not load data!";
    exit;
}
echo "<h2>Links</h2>
<form method=\"post\" name=\"addLink\" id=\"addLink\" action=\"admin.php\">YouTube ID <input type=\"text\" name=\"youtubeID\" id=\"youtubeID\"/> <select name=\"theme\" id=\"theme\">
<option value=\"1\">Harry Potter</option>
<option value=\"2\">Winnie the Pooh</option>
<option value=\"3\">Percy the Jackson</option>
</select> <input type=\"submit\" value=\"Add Link\"/>
</form><br/>
<table><tr><th>YouTube ID</th><th>Theme</th><th>Action</th></tr>";
while($res = mysqli_fetch_array($query)){
?>
<tr>
	<td><?php echo $res["url"]; ?></td>
	<td><?php echo $res["fullName"]; ?></td>
	<td><a class="noDec" href="admin.php?link_id=<?php echo $res["ID"];?>"><span class="remSpan">Remove</span></a></td>
</tr>
<?php } echo "</table>"; ?>
            <?php
	    if(!$query = mysqli_query($link,"select name,fullName,question,answer,questionsanswers.id as ID from questionsanswers,themes where themes.id = questionsanswers.theme order by ID desc")){
    echo "Can not load data!";
    exit;
}
echo "<h2>Questions</h2>
<form method=\"post\" name=\"addQA\" id=\"addQA\" action=\"admin.php\">Question <input type=\"text\" name=\"question\" id=\"question\"/> Answer <input type=\"text\" name=\"answer\" id=\"answer\"/> <select name=\"theme\" id=\"theme\">
<option value=\"1\">Harry Potter</option>
<option value=\"2\">Winnie the Pooh</option>
<option value=\"3\">Percy the Jackson</option>
</select> <input type=\"submit\" value=\"Add Question\"/>
</form><br/>
<table><tr><th>Theme</th><th>Question</th><th>Answer</th><th>Action</th></tr>";
while($res = mysqli_fetch_array($query)){
?>
<tr>
	<td><?php echo $res["fullName"]; ?></td>
	<td><?php echo $res["question"]; ?></td>
	<td><?php echo $res["answer"]; ?></td>
	<td><a class="noDec" href="admin.php?question_id=<?php echo $res["ID"];?>"><span class="remSpan">Remove</span></a></td>
</tr>
<?php }
echo "</table>";
        }

}
?>
			</div>
		</div>
	</body>
</html>