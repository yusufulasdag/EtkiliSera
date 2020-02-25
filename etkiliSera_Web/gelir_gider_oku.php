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

<?php 

	$sorgu = $db->prepare('SELECT * FROM gelir_gider');
	$sorgu->execute([ ]);
	$oku = $sorgu->fetchAll(PDO::FETCH_ASSOC);
	if(!$oku){	
		header('Location:index.php');
		exit;
	}
?>

	<div class="ana">

		<center><h3>Gelirler</h3></center>
		<table id="data">
			<tr>
				<th>Açıklama</th>
				<th>Tutar</th>
				<th></th>
				<th></th>
			</tr>
			<?php foreach ($oku as $yaz): 
				if ($yaz['no'] == 'Gelir'){ ?>
			<tr>
				<td><?php echo $yaz['aciklama']; ?></td>
				<td><?php echo $yaz['para']; ?></td>
				<td style="background-color: gold;"><a href="index.php?sayfa=gelir_gider_guncelle&id=<?php echo $yaz['id'] ?>"> Güncelle </a></td>
				<td style="background-color: red;"><a href="index.php?sayfa=gelir_gider_sil&id=<?php echo $yaz['id'] ?>"> Kaldır </a></td>
			</tr>
			<?php } endforeach ?>
		</table>

		<br><br>

		<center><h3>Giderler</h3></center>
		<table id="data">
			<tr>
				<th>Açıklama</th>
				<th>Tutar</th>
				<th></th>
				<th></th>
			</tr>
			<?php foreach ($oku as $yaz): 
				if ($yaz['no'] == 'Gider'){ ?>
			<tr>
				<td><?php echo $yaz['aciklama']; ?></td>
				<td><?php echo $yaz['para']; ?></td>
				<td style="background-color: gold;"><a href="index.php?sayfa=gelir_gider_guncelle&id=<?php echo $yaz['id'] ?>"> Güncelle </a></td>
				<td style="background-color: red;"><a href="index.php?sayfa=gelir_gider_sil&id=<?php echo $yaz['id'] ?>"> Kaldır </a></td>
			</tr>
			<?php } endforeach ?>
		</table>
	</div>

</div>
</body>
</html>

