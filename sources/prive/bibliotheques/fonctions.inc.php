<?PHP


//
function dossierLister($dossier = '')
{

	// initialisation des variables
	$sortie = false;
	
	// traitement
	if (is_dir($dossier)) {
	
		// Ouverture du dossier
		$pointeur = @opendir($dossier);
		
		// on regarde si le dossier a été ouvert avec succès
		if ($pointeur !== false) {
		
			// intialisation du tableau de sortie
			$sortie = array();
			
			// on parcourt les éléments contenus dans le dossier
			while ($element = @readdir($pointeur)) {
			
				// on élimine les éléments inutiles
				if ($element != '.' && $element != '..') {
				
					// chemin complet
					$courant = $dossier . $element;
					
					// on regarde si l'élément est un dossier
					if (is_dir($courant)) {
					
						$sortie[$element] = dossierLister($courant);
					
					} else {
					
						$sortie[$element] = $element;
					
					}
				
				}
			
			}
			
			closedir($pointeur);
		
		}
	
	}
	
	// sortie
	return $sortie;

}


?>