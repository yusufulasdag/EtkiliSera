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

	$malzeme = isset($_POST['malzeme']) ? $_POST['malzeme'] : null;
	$miktar = isset($_POST['miktar']) ? $_POST['miktar'] : null;
	$sera_id = isset($_POST['sera_id']) ? $_POST['sera_id'] : null;

	if(!$malzeme){
		echo 'Malzeme kısmı boş';
	} 
	elseif(!$miktar){
		echo 'Miktar kısmı boş';
	} 
	elseif(!$sera_id){
		echo 'Sera kısmı boş';
	}
	else{

		$sorgu = $db->prepare('INSERT INTO depolar SET
		malzeme = ?,
		miktar = ?,
		sera_id= ?');

		$ekle = $sorgu->execute([
			$malzeme, $miktar, $sera_id
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

<h2>Depo Malzeme Ekleme</h2>

<form action="" method="post">

	Malzeme: 
	<input type="text" value="<?php echo isset($_POST['malzeme']) ? $_POST['malzeme'] : '' ?>" name="malzeme" required> <br><br>

	Miktar: 
	<input type="text" value="<?php echo isset($_POST['miktar']) ? $_POST['miktar'] : '' ?>" name="miktar" required> <br><br>

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

