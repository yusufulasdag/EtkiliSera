<!DOCTYPE html>
<html>
<head>
	<title>Seralar</title>
	<link rel="stylesheet" type="text/css" href="tasarim.css">

<style type="text/css">
	#data {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 60%;
}

#data td, #data th {
  padding: 8px;
  border-bottom: 1px solid grey;
  border-top: 1px solid grey;
}

#data th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  color: white;
}

#data a:link, a:visited {
  padding: 14px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
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

		<h2>Seralar</h2>

	<?php

	$seralar = $db->query("SELECT seralar.*, COUNT(insanlar.id) as toplamCalisan FROM seralar LEFT JOIN insanlar ON insanlar.sera_id = seralar.id GROUP BY seralar.id")->fetchAll(PDO::FETCH_ASSOC);
	?>

	<table id="data">
		<?php foreach ($seralar as $ad): ?>
			<tr>
			<th style="background-color: #404140">
				<?php echo $ad["sera"], " Sera"; ?>
			</th>
				<td style="background-color: #494aff;">
				<a href="index.php?sayfa=sera_calisan&id=<?php echo($ad["id"])?>">
					Sera Çalışanları
					(<?php echo $ad['toplamCalisan'] ?>)
				</a>
				</td>
				<td style="background-color: #4CAF50;">
				<a href="index.php?sayfa=depo_oku&id=<?php echo($ad["id"])?>"> Depo </a>
				</td>
				<td style="background-color: gold">
				<a href="index.php?sayfa=sera_guncelle&id=<?php echo($ad["id"])?>"> Guncelle </a>
				</td>
				<td style="background-color: #f44336;">
				<a href="index.php?sayfa=sera_sil&id=<?php echo($ad["id"])?>"> Sil </a>
				</td>
			</tr>
			<tr>
				<td> </td>
			</tr>
		<?php endforeach ?>
	<table>

<!--	
	<ul>
		<?php foreach ($seralar as $ad): ?>
				<?php if($ad["sera"] == "mavi" || $ad["sera"] == "Murat"){ ?>
				<li>	
				<?php echo $ad["sera"]; ?>
				<br>
				<a href="index.php?sayfa=sera_calisan&id=<?php echo($ad["id"])?>">
					Sera Çalışanları
					(<?php echo $ad['toplamCalisan'] ?>)
				</a>
				<br>
				<a href="index.php?sayfa=depo_oku&id=<?php echo($ad["id"])?>"> Depolar </a>
			</li>
		<?php } endforeach ?>
	</ul> 
-->

	</div>
</div>
</body>
</html>
