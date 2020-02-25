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

a {
	text-decoration: none;
	color: black;
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

$seraCalisan = $sorgu->fetch(PDO::FETCH_ASSOC);

if(!$seraCalisan){
	header('Location:index.php?sayfa=seralar');
	exit;
}

// seraya ait çalışanları listeleme
$sorgu = $db->prepare('SELECT * FROM insanlar WHERE sera_id = ?');
$sorgu->execute([
	$seraCalisan["id"]
]);

$insanlar = $sorgu->fetchAll(PDO::FETCH_ASSOC);

?>


<?php if($insanlar): ?>
<center><h3> <?php echo $seraCalisan["sera"], " "; ?>Sera Çalışanları </h3></center>

<!-- 
<ul>
	<?php foreach ($insanlar as $insan): ?>
		<li>
			<?php echo $insan['ad'], " "; 
			 	  echo $insan['soyad']; ?>
			<div>
				<a href="index.php?sayfa=oku&id=<?php echo $insan['id'] ?>"> OKU</a>
				<a href="index.php?sayfa=guncelleme&id=<?php echo $insan['id'] ?>"> Güncelle</a>
				<a href="index.php?sayfa=sil&id=<?php echo $insan['id'] ?>"> Sil</a>
			</div>
		</li>
	<?php endforeach; ?>
</ul>
-->

<table id="data">
	<th>Ad</th>
	<th>Soyad</th>
	<th></th>
	<th></th>
	<th></th>
	<?php foreach ($insanlar as $insan): ?>
		<tr>
			<td><?php echo $insan['ad']; ?></td>
			<td><?php echo $insan['soyad']; ?></td>
			<td style="background-color: rgb(0,192,0);"><a href="index.php?sayfa=oku&id=<?php echo $insan['id'] ?>"> Bilgileri Görüntüle</a></td>
			<td style="background-color: gold;"><a href="index.php?sayfa=guncelleme&id=<?php echo $insan['id'] ?>"> Güncelle </a></td>
			<td style="background-color: red;"><a href="index.php?sayfa=sil&id=<?php echo $insan['id'] ?>"> Sil </a></td>
		</tr>
	<?php endforeach; ?>
</table>

<?php else: ?>

	Bu serada çalışan yok.

<?php  endif; ?>
	</div>
</div>
</body>
</html>


