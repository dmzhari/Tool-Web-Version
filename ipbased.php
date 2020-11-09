<!DOCTYPE html>
<html>
<head>
	<title>Mass Reverse Ip To Domain</title>
	<meta charset="utf-8">
	<meta name="author" content="./EcchiExploit">
	<meta name="description" content="Mass Reverse Domain To Ip">
</head>
<body>
	<h1>Mass Reverse Domain To Ip</h1>
	<form action="" method="POST">
		Note : <b> in the list file must be example.com</b>
		<br>
		Input Your File Max 500 Site => <input type="file" name="file">
		<input type="submit" value="submit">
	</form>
</body>
</html>
<?php
error_reporting(0);
$file = $_POST['file'];
if (isset($file)) {
	$site = file_get_contents($file) or die("File Not Found");
	$exp = explode("\n", $site);
	$array = array_unique($exp);
	foreach ($array as $key) {
		if(!preg_match('#^http(s)?://#',$key)){
			$a = "http://".$key;
		}
		else {
			$a = $key;
		}
		$parse = parse_url($a);
		$domain = preg_replace('/^www\./', '', $parse['host']);
		$www = "www.".$domain;
		$host = gethostbyname($www);
		echo $host."<br>";
	}
}
?>