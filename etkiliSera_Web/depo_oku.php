<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="tasarim.css">

<style type="text/css">
	#data {
  margin: auto;
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 60%;
}

#data td, #data th {
  border: 1px solid grey;
  padding: 8px;
}

#data tr{background-color: lightgrey;}

#data th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>

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
	header('Location:index.php?sayfa=seralar');
	exit;
}

$sorgu = $db->prepare("SELECT * FROM seralar WHERE id = ?");
$sorgu->execute([
	$_GET['id']
]);

$depo_urun = $sorgu->fetch(PDO::FETCH_ASSOC);

if(!$depo_urun){
	header('Location:index.php?sayfa=seralar');
	exit;
}

$sorgu = $db->prepare('SELECT * FROM depolar WHERE sera_id = ?');
$sorgu->execute([
	$depo_urun["id"]
]);

$depolar = $sorgu->fetchAll(PDO::FETCH_ASSOC);

?>


<?php if($depolar): ?>

<center><h3>Depo Malzeme-Miktar</h3></center>
<table id="data">
	<tr>
		<th>Malzeme</th>
		<th>Miktar</th>
		<th></th>
		<th></th>
	</tr>
	<?php foreach ($depolar as $depo): ?>
		<tr>
			<td><?php echo $depo['malzeme']; ?></td>
			<td><?php echo $depo['miktar']; ?></td>
			<td style="background-color: gold;"><a href="index.php?sayfa=depo_guncelle&id=<?php echo $depo['id'] ?>"> Güncelle </a></td>
			<td style="background-color: red;"><a href="index.php?sayfa=depo_sil&id=<?php echo $depo['id'] ?>"> Kaldır </a></td>
		</tr>
	<?php endforeach; ?>
</table>

<?php else: ?>

	Bu sera deposunda malzeme bulunmamaktadır.

<?php  endif; ?>
	</div>
</div>
</body>
</html>