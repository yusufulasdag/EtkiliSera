<?php 

if (!isset($_GET['id']) || empty($_GET['id'])){
	header('Location:index.php');
	exit;
}

$sorgu = $db->prepare('DELETE FROM insanlar WHERE sera_id = ?');
$sorgu->execute([
	$_GET['id']
]);

$sorgu = $db->prepare('DELETE FROM depolar WHERE sera_id = ?');
$sorgu->execute([
	$_GET['id']
]);

$sorgu = $db->prepare('DELETE FROM seralar WHERE id = ?');
$sorgu->execute([
	$_GET['id']
]);


header('Location:index.php');

?>