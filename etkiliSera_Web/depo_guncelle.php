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

		<h2>Depo Malzeme Güncelleme</h2>

<?php 

if (!isset($_GET['id']) || empty($_GET['id'])){
	header('Location:index.php');
	exit;
}

$sorgu = $db->prepare('SELECT * FROM depolar WHERE id = ?');
$sorgu->execute([
	$_GET['id']
]);
$depo = $sorgu->fetch(PDO::FETCH_ASSOC);



$seralar = $db->query("SELECT * FROM seralar ORDER BY sera ASC")->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['submit'])){
	$malzeme = isset($_POST['malzeme']) ? $_POST['malzeme'] : $depo['malzeme'];
	$miktar = isset($_POST['miktar']) ? $_POST['miktar'] : $depo['miktar'];
	$sera_id = isset($_POST['sera_id']) ? $_POST['sera_id'] : null;

	if(!$malzeme){
		echo 'malzeme kısmı boş';
	} elseif(!$miktar){
		echo 'miktar kısmı boş';
	} elseif(!$sera_id){
		echo 'Sera kısmı boş';
	}
	else{
		$sorgu = $db->prepare('UPDATE depolar SET
		malzeme = ?,
		miktar = ?,
		sera_id = ?
		WHERE id = ?');
		$guncelle = $sorgu->execute([
			$malzeme, $miktar, $sera_id, $depo['id']
		]);

		if($guncelle){
			header('Location:index.php?sayfa=oku&id=' . $depo['id']);
		} else {
			$hata = $sorgu->errorInfo();
			echo 'MySql Hatası:' . $hata[2];
		}
	}
}

?>

<form action="" method="post">

	Malzeme: <br>
	<input type="text" value="<?php echo isset($_POST['malzeme']) ? $_POST['malzeme'] : $depo['malzeme'] ?>" name="malzeme"> <br><br>

	Miktar: <br>
	<input type="text" value="<?php echo isset($_POST['miktar']) ? $_POST['miktar'] : $depo['miktar'] ?>" name="miktar"> <br><br>

	SERA: <br>
	<select name="sera_id">
		<?php foreach($seralar as $ad): ?>
			<option <?php echo $ad["id"] == $depo["sera_id"] ? 'selected' : '' ?> value="<?php echo $ad['id'] ?>"><?php echo $ad['sera'] ?></option>
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