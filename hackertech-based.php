<!DOCTYPE html>
<html>
<head>
	<title>Hackerrank Mass Mirror</title>
	<meta name="author" content="./EcchiExploit">
	<meta name="description" content="hackerrank.tech mass mirror submit">
</head>
<body>
	<form method="POST">
		Nickname : <input type="text" name="hacker" required="true"><br>
		Team : <input type="text" name="team" required="true"><br>
		Mirror Site : <br><textarea cols="60" rows="10" name="url" placeholder="Your Mirror Site" required="true"></textarea>
		<input type="submit" name="sub">
	</form>
</body>
</html>
<?php
set_time_limit(60);
$hacker = $_POST['hacker'];
$team = $_POST['team'];
$url = $_POST['url'];
function curl($nick,$team,$site){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://hackerrank.tech/notify.php");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "defacer=$nick&team=$team&vulntype=0&reason=0&urlb=$site&submit=Notify");
	curl_setopt($ch, CURLOPT_POST, 1);
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}
if (isset($_POST['sub'])) {
	$fil = htmlspecialchars($hacker);
	$fil2 = htmlspecialchars($team);
	$fil3 = htmlspecialchars($url);
	$exp = explode("\n", $fil3);
	foreach ($exp as $key) {
		$notify = curl($fil,$fil2,$key);
		if (preg_match("/<div class=\"error\">(.*)<br>Mirrored onhold/", $notify)) {
			echo "Success Mirror Onhold : $key\n";
		}
		else if (preg_match("/<div class=\"error\">(.*)<br>Domain Not Active/", $notify)) {
			echo "Success Mirror Onhold : $key\n";
		}
		else if (preg_match("/<div class=\"success\">(.*)/", $notify)) {
			echo "Sucess Mirror : $key\n";
		}
		else {
			echo "Failed Mirror : $key\n";
		}
	}
}
?>
