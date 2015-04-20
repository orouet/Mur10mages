<?PHP


// Application par défaut
define('ENVIRONNEMENT_APP', 'gallerie.categories.afficher');

// cache
$map_cache = false;

if (isset($_SESSION['CACHE'])) {

	$temp = $_SESSION['CACHE'];
	
	if (is_array($temp)) {
	
		$map_cache = $temp;
	
	}
	
	unset($temp);

}

$categorie_id = null;

/* LECTURE DES ENTREES */
if (isset($_REQUEST['categorie']) && $_REQUEST['categorie'] !== '') {

	$categorie_id = $_REQUEST['categorie'];

}

/* INCLUSIONS */
require_once (CHEMIN_BIBLIOTHEQUES . 'fonctions.chaines.inc.php');
require_once (CHEMIN_BIBLIOTHEQUES . 'fonctions.uuid.inc.php');
require_once (CHEMIN_BIBLIOTHEQUES . 'fonctions.inc.php');

$cache = false;

$categories = false;
$photos_base = false;
$dossiers = false;

// var_dump($_SESSION);

if (isset($_SESSION['CACHE'])) {

	$cache = $_SESSION['CACHE'];

}


if ($cache !== false) {

	if (isset($cache['categories'])) {
	
		$temp = $cache['categories'];
		
		if (isset($temp['expiration'])) {
		
			$temps = (integer) time();
			$expiration = (integer) $temp['expiration'];
			
			if ($expiration > $temps) {
			
				$categories = $temp['donnees'];
			
			}
		
		}
		
		unset($temp);
	
	}
	
	if (isset($cache['photos_base'])) {
	
		$temp = $cache['photos_base'];
		
		if (isset($temp['expiration'])) {
		
			$temps = (integer) time();
			$expiration = (integer) $temp['expiration'];
			
			if ($expiration > $temps) {
			
				$photos_base = $temp['donnees'];
			
			}
		
		}
		
		unset($temp);
	
	}

}

if ($categories === false) {

	// die('pas de cache');
	
	// On parcourt le dossier contenant les albums
	$categories = dossierLister2(CHEMIN_STOCKAGE);
	// var_dump($categories);
	
	// Création du cache
	$cache['categories'] = [
		'expiration' => time() + (60 * 60),
		'donnees' => $categories,
	];


}

if ($photos_base === false) {

	// Génération de la base d'empreintes
	foreach($categories as $categorie) {
	
		if (is_array($categorie)) {
		
			$dossiers = $categorie['contenu'];
			
			foreach($dossiers as $dossier) {
			
				if (is_array($dossier)) {
				
					$documents = $dossier['contenu'];
					
					$enfants = count($documents);
					
					// On regarde si le dossier contient des documents
					if ($enfants > 0) {
					
						// On établit la liste des empreintes des documents
						$empreintes = array();
						
						foreach ($documents as $document) {
						
							$empreinte = $document['informations']['empreinte'];
							
							$photos_base[$empreinte] = $document;
						
						}
					
					}
				
				}
			
			}
		
		}
	
	}
	
	// Création du cache
	$cache['photos_base'] = [
		'expiration' => time() + (60 * 60),
		'donnees' => $photos_base,
	];

}

// var_dump($photos_base);


if (isset($categories[$categorie_id])) {

	$categorie = $categories[$categorie_id];

} else {

	$categorie = current($categories);

}

$categorie_id = $categorie['nom'];
$dossiers = $categorie['contenu'];

// var_dump($dossiers);


?>