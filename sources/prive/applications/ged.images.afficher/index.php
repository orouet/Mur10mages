<?PHP



/* CONFIGURATION */
$debug = false;

$image_type = 'PNG';
$image_type = 'JPEG';

$document_id = false;
$largeur = false;
$hauteur = false;
$r = 0;
$g = 0;
$b = 0;



/* LECTURE DES ENTREES */
if (isset($_REQUEST['document']) && $_REQUEST['document'] !== '') {

	$document_id = (string) $_REQUEST['document'];

}

if (isset($_REQUEST['largeur']) && $_REQUEST['largeur'] !== '') {

	$largeur = (integer) $_REQUEST['largeur'];

}

if (isset($_REQUEST['hauteur']) && $_REQUEST['hauteur'] !== '') {

	$hauteur = (integer) $_REQUEST['hauteur'];

}

if (isset($_REQUEST['r']) && $_REQUEST['r'] !== '') {

	$r = (integer) $_REQUEST['r'];

}

if (isset($_REQUEST['g']) && $_REQUEST['g'] !== '') {

	$g = (integer) $_REQUEST['g'];

}

if (isset($_REQUEST['b']) && $_REQUEST['b'] !== '') {

	$b = (integer) $_REQUEST['b'];

}

// Sélection du document
if ($document_id === false) {

	die("Document manquant");

}



/* TRAITEMENT */


/* INCLUSIONS */
require_once (CHEMIN_BIBLIOTHEQUES . 'fonctions.chaines.inc.php');
require_once (CHEMIN_BIBLIOTHEQUES . 'fonctions.uuid.inc.php');
require_once (CHEMIN_BIBLIOTHEQUES . 'fonctions.inc.php');

/* Recherche du document */
if (isset($photos_base[$document_id])) {

	$document = $photos_base[$document_id];
	// die(var_dump($document));

} else {

	die("Document N°" . $document_id . " inconnu");

}

// var_dump($document);

$sortie = '';

$cible = $document['chemin'];
// var_dump($cible);

// die();

//
switch ($image_type) {

	case 'JPEG':
	
		$content_type = 'image/jpeg';
		$extension = '.jpeg';
	
	break;
	
	case 'PNG':
	
		$content_type = 'image/png';
		$extension = '.png';
	
	break;

}

// 
if (file_exists($cible)) {

	if (($largeur !== false) && ($hauteur !== false)) {
	
		$miniature = $largeur . 'x' . $hauteur . '-r' . $r . 'g' . $g . 'b' . $b . $extension;
		
		// On regarde dans le cache
		$cache_lot = CHEMIN_CACHE;
		$cache_empreinte = $cache_lot . $document_id . '/';
		$cache_document = $cache_empreinte . $miniature;
		// var_dump($cache_lot);
		// var_dump($cache_empreinte);
		// var_dump($cache_document);
		// die();
		
		if (file_exists($cache_document)) {
		
			$cible = $cache_document;
			// die();
		
		} else {
		
			$lot_dir = file_exists($cache_lot);
			$empreinte_dir = file_exists($cache_empreinte);
			
			if ($lot_dir === false) {
			
				$lot_dir = mkdir($cache_lot);
			
			}
			
			if ($empreinte_dir === false) {
			
				$empreinte_dir = mkdir($cache_empreinte);
			
			}
			
			if ($lot_dir && $empreinte_dir) {
			
				$Image = new GEP_Image($cible);
				
				$p = [
					'cible' => $cache_document,
					'largeur' => $largeur,
					'hauteur' => $hauteur,
					'r' => $r,
					'g' => $g,
					'b' => $b,
				];
				$m = $Image->redimensionner($p);
				
				if ($m === true) {
				
					$cible = $cache_document;
				
				} else {
				
					die("Impossible de créer le document " . $cache_document);
				
				}
			
			} else {
			
				die("Impossible de créer les dossiers");
			
			}
		
		}
	
	}
	
	$etag = sha1_file($cible);
	
	// Cache HTTP
	$http_cache = false;
	
	// if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])) {
	
		// header('HTTP/1.1 304 Not Modified');
		// header('Content-Length: 0');
		// $http_cache = true;
	
	// }
	
	// die(var_dump($_SERVER));
	
	if (isset($_SERVER['HTTP_IF_NONE_MATCH'])) {
	
		$reponse = ($_SERVER['HTTP_IF_NONE_MATCH']);
		
		// die ('Emission=' . $etag . ' / Réception=' . $reponse);
		
		$occurrences = strpos($reponse, $etag);
		
		if ($occurrences !== false) {
		
			header('HTTP/1.1 304 Not Modified');
			header('Content-Length: 0');
			$http_cache = true;
			die();
		
		}
	
	}
	
	if ($http_cache === false) {
	
		$taille = filesize($cible);
		
		$date = filemtime($cible);
		$duree = (60 * 60 * 24 * 7);
		$expiration = time() + $duree;
		
		if ($taille !== false) {
		
			// On vide le tampon de sortie
			ob_end_clean();
			
			// entête
			// header("Content-Disposition: Attachment;filename=" . $document_id . '.jpg'); 
			header('ETag: "' . $etag . '"');
			header('Content-Type: ' . $content_type);
			header('Content-Length: ' . $taille);
			header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $date) . ' GMT');
			header('Cache-control: max-age=' . $duree);
			header('Expires:' . gmdate('D, d M Y H:i:s', $expiration) .' GMT');
			
			readfile($cible);
			
			die();
		
		} else {
		
			var_dump($cible);
			
			die();
		
		}
	
	}

} else {

	die("Erreur de stockage");

}


?>