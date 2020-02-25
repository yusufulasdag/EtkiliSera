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
		<h2>Çalışan Bilgileri Güncelleme</h2>
<?php 

if (!isset($_GET['id']) || empty($_GET['id'])){
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

$seralar = $db->query("SELECT * FROM seralar ORDER BY sera ASC")->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['submit'])){
	$ad = isset($_POST['ad']) ? $_POST['ad'] : $insan['ad'];
	$soyad = isset($_POST['soyad']) ? $_POST['soyad'] : $insan['soyad'];
	$maas = isset($_POST['maas']) ? $_POST['maas'] : $insan['maas'];
	$telefon = isset($_POST['telefon']) ? $_POST['telefon'] : $insan['telefon'];
	$adres = isset($_POST['adres']) ? $_POST['adres'] : $insan['adres'];
	$sera_id = isset($_POST['sera_id']) ? $_POST['sera_id'] : null;

	if(!$ad){
		echo 'Ad kısmı boş';
	} elseif(!$soyad){
		echo 'Soyad kısmı boş';
	} elseif(!$sera_id){
		echo 'Sera kısmı boş';
	}
	else{
		$sorgu = $db->prepare('UPDATE insanlar SET
		ad = ?,
		soyad = ?,
		maas = ?,
		telefon = ?,
		adres = ?,
		sera_id = ?
		WHERE id = ?');
		$guncelle = $sorgu->execute([
			$ad, $soyad, $maas, $telefon, $adres, $sera_id, $insan['id']
		]);

		if($guncelle){
			header('Location:index.php?sayfa=oku&id=' . $insan['id']);
		} else {
			$hata = $sorgu->errorInfo();
			echo 'MySql Hatası:' . $hata[2];
		}
	}
}

?>

<form action="" method="post">

	Ad: <br>
	<input type="text" value="<?php echo isset($_POST['ad']) ? $_POST['ad'] : $insan['ad'] ?>" name="ad"> <br><br>

	Soyad: <br>
	<input type="text" value="<?php echo isset($_POST['soyad']) ? $_POST['soyad'] : $insan['soyad'] ?>" name="soyad"> <br><br>

	Maas: <br>
	<input type="text" name="maas" value="<?php echo isset($_POST['maas']) ? $_POST['maas'] : $insan['maas'] ?>" required> <br><br>

	Telefon: <br>
	<input type="text" name="telefon" required> <br><br>

	Adres: <br>
	<input type="text" name="adres" required> <br><br>

	Sera: <br>
	<select name="sera_id">
		<?php foreach($seralar as $ad): ?>
			<option <?php echo $ad["id"] == $insan["sera_id"] ? 'selected' : '' ?> value="<?php echo $ad['id'] ?>"><?php echo $ad['sera'] ?></option>
		<?php endforeach ?>
	</select>
	<br><br>

	<input type="hidden" name="submit" value="1">
	<input type="submit" value="Güncelle">

</form>
	</div>
</div>
</body>
</html>