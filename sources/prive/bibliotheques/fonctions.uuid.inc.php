<?PHP


// Génération d'un UUID V4 de type xxxxxxxx-xxxx-4xxx-Yxxx-xxxxxxxxxxxx avec Y = 8, 9, A ou B
function uuid_v4_generer()
{

	// initialisation des variables
	$sortie = false;
	$chaine = '';
	$dictionnaire = '0123456789ABCDEF';
	$bloc4_prefixe = '89AB';
	
	
	// Bloc 1
	$bloc1 = '';
	debug('Tirage de 8 caractères' . "\n");
	
	for ($i = 0; $i < 8; $i ++) {
	
		// On tire un caractère dans le dictionnaire
		$tirage = '';
		$tirage = chaine_tirage($dictionnaire);
		
		// On ajoute le tirage à la chaine
		$bloc1 .= $tirage;
		debug('Tirage N°' . $i . ' : ' . $tirage . "\n");
	
	}
	
	
	// Bloc 2
	$bloc2 = '';
	debug('Tirage de 4 caractères' . "\n");
	
	for ($i = 0; $i < 4; $i ++) {
	
		// On tire un caractère dans le dictionnaire
		$tirage = '';
		$tirage = chaine_tirage($dictionnaire);
		
		// On ajoute le tirage à la chaine
		$bloc2 .= $tirage;
		debug('Tirage N°' . $i . ' : ' . $tirage . "\n");
	
	}
	
	
	// Bloc 3
	$bloc3 = '4';
	debug('Tirage de 3 caractères' . "\n");
	
	for ($i = 0; $i < 3; $i ++) {
	
		// On tire un caractère dans le dictionnaire
		$tirage = '';
		$tirage = chaine_tirage($dictionnaire);
		
		// On ajoute le tirage à la chaine
		$bloc3 .= $tirage;
		debug('Tirage N°' . $i . ' : ' . $tirage . "\n");
	
	}
	
	
	// Bloc 4
	$bloc4 = '';
	
	// Préfixe
	$tirage = '';
	$tirage = chaine_tirage($bloc4_prefixe);
	debug('Préfixe : ' . $tirage . "\n");
	$bloc4 .= $tirage;
	
	// Corps
	debug('Tirage de 3 caractères' . "\n");
	
	for($i = 0; $i < 3; $i ++) {
	
		// On tire un caractère dans le dictionnaire
		$tirage = '';
		$tirage = chaine_tirage($dictionnaire);
		
		// On ajoute le tirage à la chaine
		$bloc4 .= $tirage;
		debug('Tirage N°' . $i . ' : ' . $tirage . "\n");
	
	}
	
	
	// Bloc 5
	$bloc5 = '';
	debug('Tirage de 12 caractères' . "\n");
	
	for ($i = 0; $i < 12; $i ++) {
	
		// On tire un caractère dans le dictionnaire
		$tirage = '';
		$tirage = chaine_tirage($dictionnaire);
		
		// On ajoute le tirage à la chaine
		$bloc5 .= $tirage;
		debug('Tirage N°' . $i . ' : ' . $tirage . "\n");
	
	}
	
	// Assemblage des blocs
	$chaine = $bloc1 . '-' . $bloc2 . '-' . $bloc3 . '-' . $bloc4 . '-' . $bloc5;
	
	$sortie = $chaine;
	
	// sortie
	return $sortie;

}


?>