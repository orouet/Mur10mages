<?PHP

//
function chaine_tirage($dictionnaire)
{

	// initialisation des variables
	$sortie = false;
	
	// mesure de la taille du dictionnaire
	$taille = strlen($dictionnaire);
	
	// boucle de traitement
	if ($taille > 0) {
	
		$caractere = '';
		$position = mt_rand(0, ($taille - 1));
		debug('Hazard = ' . $position . "\n");
		
		$caractere = $dictionnaire[$position];
		debug('Caractère = ' . $caractere . "\n");
		
		$sortie = (string) $caractere;
	
	}
	
	// sortie
	return $sortie;

}


//
function chaine_melanger($chaine)
{

	// initialisation des variables
	$sortie = false;
	$melange = '';
	
	// mesure de la taille de la chaine à mélanger
	$taille = strlen($chaine);
	debug('Entrée : ' . $chaine . "\n");
	
	//
	$i = 1;
	
	while (strlen($melange) < $taille ) {
	
		debug('Tirage N°' . $i . ' : ');
		$t = strlen($chaine);
		
		if ($t > 0) {
		
			debug('Chaine = ' . $chaine . ' ; ');
			
			// position random
			$position = mt_rand(0, ($t - 1));
			debug('Hazard = ' . $position . ' ; ');
			
			//
			$melange .= $chaine[$position];
			debug('Mélange = ' . $melange . ' ; ');
			
			//
			if ($position > 0) {
			
				$a = substr($chaine, 0, $position);
			
			} else {
			
				$a = '';
			
			}
			
			debug('Morceau A = ' . $a . ' ; ');
			
			//
			if ($position < $t) {
			
				$b = substr($chaine, ($position + 1));
			
			} else {
			
				$b = '';
			
			}
			
			//
			debug('Morceau B = ' . $b . "\n");
			
			//
			$chaine = $a . $b;
		
		}
		
		$i ++;
	
	}
	
	debug('Sortie : ' . $melange . "\n");
	$sortie = (string) $melange;
	
	// sortie
	return $sortie;

}

?>