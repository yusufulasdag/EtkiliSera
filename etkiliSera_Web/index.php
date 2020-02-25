<?php

try{
	
	require_once 'baglan.php';
	require 'header.php';

} catch ( PDOException $e ){
	echo $e->getMessage();
}

if (!isset($_GET['sayfa'])){
	$_GET['sayfa'] = "index";
}

Switch ($_GET['sayfa']){

	case 'index':
		require_once 'homepage.php';
	break;

	case 'insert':
		require_once 'insert.php';
	break;

	case 'oku':
		require_once 'oku.php';
	break;

	case 'guncelleme':
		require_once 'guncelleme.php';
	break;

	case 'sil':
		require_once 'sil.php';

	case 'seralar':
		require_once 'seralar.php';
	break;

	case 'sera_ekle':
		require_once 'sera_ekle.php';
	break;

	case 'sera_calisan':
		require_once 'sera_calisan.php';
	break;

	case 'sera_sil':
		require_once 'sera_sil.php';
	break;

	case 'sera_guncelle':
		require_once 'sera_guncelle.php';
	break;

	case 'mail':
		require_once 'mail.php';
	break;

	case 'depo_ekle':
		require_once 'depo_ekle.php';
	break;

	case 'depo_oku':
		require_once 'depo_oku.php';
	break;

	case 'depo_sil':
		require_once 'depo_sil.php';
	break;

	case 'depo_guncelle':
		require_once 'depo_guncelle.php';
	break;

	case 'gelir_gider_ekle':
		require_once 'gelir_gider_ekle.php';
	break;	
	
	case 'gelir_gider_oku':
		require_once 'gelir_gider_oku.php';
	break;

	case 'gelir_gider_sil':
		require_once 'gelir_gider_sil.php';
	break;

	case 'gelir_gider_guncelle':
		require_once 'gelir_gider_guncelle.php';
	break;

}

?>