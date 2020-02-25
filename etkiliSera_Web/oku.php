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
		
<?php 
	if(!isset($_GET['id']) || empty($_GET['id'])){
		header('Location:index.php');
		exit;
	}
	$sorgu = $db->prepare('SELECT * FROM insanlar WHERE id = ?');
	$sorgu->execute([
		$_GET['id']
	]);
	$insan = $sorgu->fetch(PDO::FETCH_ASSOC);
	if(!$insan){	
		header('Location:index.php');
		exit;
	}
?>

<h3> <?php echo $insan['ad'], " ", $insan['soyad'] ?> </h3>
<div>
	Maas: <?php echo $insan['maas'] ?><br>
	Telefon: <?php echo $insan['telefon'] ?><br>
	Adres: <?php echo $insan['adres'] ?><br>
</div>
	</div>
</div>
</body>
</html>