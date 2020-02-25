<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="tasarim.css">
</head>
<body>

<div class="govde">
	<div class="yan">
		<a href = "index.php?sayfa=gelir_gider_oku" style="background-color: rgb(255, 195, 0)"> Gelir-Gider Listele </a>
		<br><br>
		<a href = "index.php?sayfa=sera_ekle"> Sera Ekle </a><br>
		<a href = "index.php?sayfa=insert"> Çalışan Ekle </a><br>
		<a href = "index.php?sayfa=depo_ekle"> Depo Ürün Ekle </a>
		<a href = "index.php?sayfa=gelir_gider_ekle"> Gelir Gider Ekle </a>
	</div>
	<div class="ana">
		<h2>Sera Ekle</h2>
		<?php
			if(isset($_POST["ad"])){

				if(empty($_POST["ad"])){
					echo "sera adını giriniz.";
				}
				else{
					$sorgu = $db->prepare('INSERT INTO seralar SET sera = ?');

					$ekle = $sorgu->execute([
						$_POST["ad"]
					]);

					if($ekle){
						header('Location:index.php?sayfa=seralar');
					} 
					else{
						echo "sera eklenemedi!";
					}
				}
			}
			?>
			<form action="" method="post">
				Sera Adı: <br>
				<input type="text" name="ad"> <br><br>
				<input type="submit" value="Ekle">
			</form>
	</div>
</div>
</body>
</html>

