<!DOCTYPE html>
<html>
<head>
	<title>Jadwal Sholat</title>
	<meta charset="utf-8">
	<meta name="author" content="./EcchiExploit">
	<meta name="description" content="Jadwal Sholat">
</head>
<body>
	<h1>Jadwal Sholat</h1>
	<form method="POST">
		Nama Kota Anda : <input type="text" name="namakota">
		<input type="submit" value="Submit">
		<br><br>
		Lihat Semua Nama Kota <input type="submit" name="semuakota" value="Disini">
		<br><br>
	</form>
</body>
</html>
<?php
if (isset($_POST['namakota']) && !empty($_POST['namakota'])) {
	$filter = htmlspecialchars($_POST['namakota']);
	$sekarang = date("Y-m-d");
	$api = file_get_contents("https://api.banghasan.com/sholat/format/json/kota/nama/$filter");
	$json = json_decode($api, true);
	$nama = $json['kota']['0']['id'];
	$jadwal = file_get_contents("https://api.banghasan.com/sholat/format/json/jadwal/kota/$nama/tanggal/$sekarang");
	$jsond = json_decode($jadwal, true);
	echo "<br>Nama Kota : ".$json['kota']['0']['nama']."<br>";
	echo "Ashar : ".$jsond['jadwal']['data']['ashar']."<br>";
	echo "Dzuhur : ".$jsond['jadwal']['data']['dzuhur']."<br>";
	echo "Imsak : ".$jsond['jadwal']['data']['imsak']."<br>";
	echo "Maghrib : ".$jsond['jadwal']['data']['maghrib']."<br>";
	echo "Subuh : ".$jsond['jadwal']['data']['subuh']."<br>";
	//echo "Tanggal : ".$jsond['jadwal']['data']['tanggal']."<br>";
	echo "Terbit : ".$jsond['jadwal']['data']['terbit']."<br><br>";
}
else if (isset($_POST['semuakota']) && !empty($_POST['semuakota'])) {
	$kotall = file_get_contents("https://api.banghasan.com/sholat/format/json/kota");
	$decode = json_decode($kotall, true);
	foreach ($decode['kota'] as $key) {
		echo $key['nama']."<br>";
	}
}
?>
