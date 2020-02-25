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

<?php 


$sorgu = $db->prepare('SELECT * FROM gelir_gider WHERE id = ?');
$sorgu->execute([
	$_GET['id']
]);
$oku = $sorgu->fetch(PDO::FETCH_ASSOC);

$seralar = $db->query("SELECT * FROM seralar ORDER BY sera ASC")->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['submit'])){
	$aciklama = isset($_POST['aciklama']) ? $_POST['aciklama'] : $oku['aciklama'];
	$para = isset($_POST['para']) ? $_POST['para'] : $oku['para'];
	$no = isset($_POST['no']) ? $_POST['no'] : $oku['no'];
	$sera_id = isset($_POST['sera_id']) ? $_POST['sera_id'] : null;

	$sorgu = $db->prepare('UPDATE gelir_gider SET
	aciklama = ?,
	para = ?,
	no = ?,
	sera_id = ?
	WHERE id = ?');
	$guncelle = $sorgu->execute([
		$aciklama, $para, $no, $sera_id, $oku['id']
	]);

	if($guncelle){
			header('Location:index.php?sayfa=gelir_gider_oku&id=' . $oku['id']);
		} else {
			$hata = $sorgu->errorInfo();
			echo 'MySql Hatası:' . $hata[2];
		}
}

?>

	<div class="ana">
		<h2>Gelir-Gider Güncelleme</h2>
		<form action="" method="post">
			Açıklama: <br>
			<textarea name="aciklama" rows="7" cols="44" required><?php echo isset($_POST['aciklama']) ? $_POST['aciklama'] : $oku['aciklama'] ?></textarea> 
			<br>

			Tutar: <br>
			<input type="text" name="para" value="<?php echo isset($_POST['para']) ? $_POST['para'] : $oku['para'] ?>" required> <br>

			Gelir-Gider: <br>
			<select name="no">
				<option>Gelir</option>
				<option>Gider</option>
			</select>
			<br>
			Sera: <br>
				<select name="sera_id">
					<?php foreach($seralar as $ad): ?>
						<option <?php echo $ad["id"] == $oku["sera_id"] ? 'selected' : '' ?> value="<?php echo $ad['id'] ?>"><?php echo $ad['sera'] ?></option>
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

