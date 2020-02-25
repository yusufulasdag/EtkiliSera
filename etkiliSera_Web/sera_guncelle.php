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

if (!isset($_GET['id']) || empty($_GET['id'])){
	header('Location:index.php');
	exit;
}

$sorgu = $db->prepare('SELECT * FROM seralar WHERE id = ?');
$sorgu->execute([
	$_GET['id']
]);
$sera = $sorgu->fetch(PDO::FETCH_ASSOC);

if(!$sera){
	header('Location:index.php');
	exit;
}

if (isset($_POST['submit'])){
	$sera_adi = isset($_POST['sera_adi']) ? $_POST['sera_adi'] : $sera['sera_adi'];

	if(!$sera_adi){
		echo 'Sera adını belirtiniz.';
	} 
	else{
		$sorgu = $db->prepare('UPDATE seralar SET
		sera = ?
		WHERE id = ?');
		$guncelle = $sorgu->execute([
			$sera_adi, $sera['id']
		]);

		if($guncelle){
			header('Location:index.php?sayfa=oku&id=' . $sera['id']);
		} else {
			$hata = $sorgu->errorInfo();
			echo 'MySql Hatası:' . $hata[2];
		}
	}
}

?>

<h2>Sera Güncelle</h2>
<form action="" method="post">
	Sera Adı: <br>
	<input type="text" value="<?php echo isset($_POST['sera']) ? $_POST['sera'] : $sera['sera'] ?>" name="sera_adi" required> <br><br>

	<input type="hidden" name="submit" value="1">
	<input type="submit" value="Güncelle">

</form>
	</div>
</div>
</body>
</html>