<?PHP


// choix du fuseau horaire
date_default_timezone_set('Europe/Paris');


// détection du nom et du port
$serveur_base = 'localhost';
$serveur_port = '80';

$temp = explode(":", $_SERVER['HTTP_HOST'], 2);
$serveur_base = $temp[0];

if (isset($temp[1])) {

	$serveur_port = $temp[1];

}

unset($temp);


// chargement du fichier de configuration
$configuration = './prive/hotes/' . $serveur_base . '_' . $serveur_port . '.php';
include($configuration);



/* CONSTANTES */
define('DEBUG', false);

define('CHEMIN_PRIVE', CHEMIN_RACINE . 'prive/');
define('CHEMIN_BIBLIOTHEQUES', CHEMIN_PRIVE . 'bibliotheques/');
define('CHEMIN_DONNEES', CHEMIN_PRIVE . 'donnees/');
define('CHEMIN_APPLICATIONS', CHEMIN_PRIVE . 'applications/');
define('CHEMIN_ENVIRONNEMENTS', CHEMIN_PRIVE . 'environnements/');

define('URL_INDEX', URL_RACINE . 'index.php');
define('URL_LOGIN', URL_RACINE . 'login.php');
define('URL_PUBLIC', URL_RACINE . 'public/');
define('URL_PLUGINS', URL_PUBLIC . 'plugins/');
define('URL_IMAGES', URL_PUBLIC . 'images/');
define('URL_STYLES', URL_PUBLIC . 'styles/');
define('URL_SCRIPTS', URL_PUBLIC . 'scripts/');

define('EURO', chr(128));


/**
 * Débogage
 * @param mixed $variable
 * @param string $message
 * @return boolean
 */
function debug($variable, $message = '')
{

	// Initialisation des variables
	$sortie = false;
	
	// Traitement
	if (DEBUG === true) {
	
		if ($message !== '') {
		
			echo $message . print_r($variable, true);
		
		} else {
		
			echo print_r($variable, true);
		
		}
		
		$sortie = true;
	
	}
	
	// Sortie
	return $sortie;

}



/* SESSION */
// Début de la session
@session_start();

// Chargement des bibliothèques
require_once(CHEMIN_BIBLIOTHEQUES . 'bibliotheques.php');


// Chargement de l'environnement
require_once(CHEMIN_ENVIRONNEMENTS . ENVIRONNEMENT . '.php');



/* LECTURE DES ENTREES */
$application = '';

if (isset($_REQUEST['app']) && $_REQUEST['app'] !== '') {

	$application = (string) $_REQUEST['app'];

}

//
if (($application != '') && is_dir(CHEMIN_APPLICATIONS . '/' . $application)) {

	define('APP', $application);

} else {

	define('APP', ENVIRONNEMENT_APP);

}

define('URL_APP', URL_INDEX . '?app=' . APP);
include(CHEMIN_APPLICATIONS . '/' . APP . '/index.php');


// Sauvegarde des informations dans la session
$_SESSION['CACHE'] = ($cache);
// var_dump($_SESSION['CACHE']);
session_write_close();


//
die();


?>