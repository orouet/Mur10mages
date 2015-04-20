<?PHP


/* CONFIGURATION */
$debug = false;
$format = 'html';

$filtre = false;



/* LECTURE DES ENTREES */
if (isset($_REQUEST['format']) && $_REQUEST['format'] !== '') {

	$format = $_REQUEST['format'];

}

if (isset($_REQUEST['filtre']) && $_REQUEST['filtre'] !== '') {

	$filtre = $_REQUEST['filtre'];

}



/* TRAITEMENT */



/* SORTIE */
if ($format === 'html') {

	include('index.html.php');
	
	// echo $sortie;

}


?>