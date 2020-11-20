<?php
	$loli = file_get_contents("https://arugaz.herokuapp.com/api/randomloli");
	//$char = file_get_contents("https://arugaz.herokuapp.com/api/waifu");
	//$json = json_decode($char, true);
	$json2 = json_decode($loli, true);
	//$result = $json['image'];
	$result2 = $json2['result'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Random Waifu/Husbu</title>
	<meta charset="utf-8">
	<meta name="author" content="./EcchiExploit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<div class="jumbotron">
			<h1 class="text-center">Random Character Anime Loli</h1>
		</div>
		<div class="row justify-content-center mt-5">
			<div class="md-4">
				<div class="card">
					<div class="card-header bg-transparent mb-0">
						<div class="card-body">
							<form method="POST">
								<div class="form-group">
									<input class="btn btn-primary" type="submit" name="char" value="Klick Disini">
								</div>
							</form>
						</div>
					</div>
				</div>
				<?php
				if (isset($_POST['char'])) {
					//echo "<a href='$result'><img class='img-fluid' src='$result'></a><br>";
					echo "<a href='$result2'><img class='img-fluid img-thumbnail' src='$result2'><a/>";
				}
				?>
			</div>
		</div>
	</div>
</body>
</html>