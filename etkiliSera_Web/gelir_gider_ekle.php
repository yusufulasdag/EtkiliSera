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
		<h2>Gelir-Gider Ekleme</h2>

<?php

$seralar = $db->query("SELECT * FROM seralar ORDER BY sera ASC")->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST["aciklama"])){
	$aciklama = isset($_POST['aciklama']) ? $_POST['aciklama'] : null;
	$para = isset($_POST['para']) ? $_POST['para'] : null;
	$no = isset($_POST['no']) ? $_POST['no'] : null;
	$sera_id = isset($_POST['sera_id']) ? $_POST['sera_id'] : null;

	$sorgu = $db->prepare('INSERT INTO gelir_gider SET
		aciklama = ?,
		para = ?,
		no= ?,
		sera_id= ?');

	$ekle = $sorgu->execute([
		$aciklama, $para, $no, $sera_id
	]);

	if($ekle){
		header('Location:index.php?sayfa=seralar');
	} 
	else{
		echo "Gelir-gider eklenemedi!";
	}
}
?>

		<form action="" method="post">
			Açıklama: <br>
			<textarea name="aciklama" rows="7" cols="44" required></textarea> 
			<br>

			Tutar: <br>
			<input type="text" name="para" required> <br>

			Gelir-Gider: <br>
			<select name="no">
				<option>Gelir</option>
				<option>Gider</option>
			</select>
			<br>
			Sera: <br>
			<select name="sera_id">
				<?php foreach($seralar as $ad): ?>
					<option value="<?php echo $ad['id'] ?>"><?php echo $ad['sera'] ?></option>
				<?php endforeach ?>
			</select>
			<br><br>
			<input type="submit" value="Ekle">
		</form>

	</div>
</div>
</body>
</html>

