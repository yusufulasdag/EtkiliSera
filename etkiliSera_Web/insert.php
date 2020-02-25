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

$seralar = $db->query("SELECT * FROM seralar ORDER BY sera ASC")->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['submit'])){

	$ad = isset($_POST['ad']) ? $_POST['ad'] : null;
	$soyad = isset($_POST['soyad']) ? $_POST['soyad'] : null;
	$maas = isset($_POST['maas']) ? $_POST['maas'] : null;
	$telefon = isset($_POST['telefon']) ? $_POST['telefon'] : null;
	$adres = isset($_POST['adres']) ? $_POST['adres'] : null;
	$sera_id = isset($_POST['sera_id']) ? $_POST['sera_id'] : null;

	if(!$ad){
		echo 'Ad kısmı boş';
	} 
	elseif(!$soyad){
		echo 'Soyad kısmı boş';
	} 
	elseif(!$sera_id){
		echo 'Sera kısmı boş';
	}
	else{

		$sorgu = $db->prepare('INSERT INTO insanlar SET
		ad = ?,
		soyad = ?,
		maas = ?,
		telefon = ?,
		adres = ?,
		sera_id= ?');

		$ekle = $sorgu->execute([
			$ad, $soyad, $maas, $telefon, $adres, $sera_id
		]);

		if($ekle){
			header('Location:index.php');
		} else {
			$hata = $sorgu->errorInfo();
			echo 'MySql Hatası:' . $hata[2];
		}
	}
}

?>

<h2>Çalışan Ekleme</h2>

<form action="" method="post">

	Ad: 
	<input type="text" value="<?php echo isset($_POST['ad']) ? $_POST['ad'] : '' ?>" name="ad"> <br><br>

	Soyad: 
	<input type="text" value="<?php echo isset($_POST['soyad']) ? $_POST['soyad'] : '' ?>" name="soyad"> <br><br>

	Maas: 
	<input type="text" name="maas" required> <br><br>

	Telefon: 
	<input type="text" name="telefon" required> <br><br>

	Adres: 
	<input type="text" name="adres" required> <br><br>

	Sera: 
	<select name="sera_id">
		<?php foreach($seralar as $ad): ?>
			<option value="<?php echo $ad['id'] ?>"><?php echo $ad['sera'] ?></option>
		<?php endforeach ?>
	</select>
	<br><br>

	<input type="hidden" name="submit" value="1">
	<input type="submit" value="Ekle">

</form>
	</div>
</div>
</body>
</html>

