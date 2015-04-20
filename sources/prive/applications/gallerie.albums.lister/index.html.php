<!DOCTYPE html>
<html>

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Mon mur d'images</title>
	
	<!-- FAVICON -->
	<link rel="SHORTCUT ICON" href="public/images/favicon.ico" />
	
	<!-- VIEWPORT -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
	<!-- -->
	<link rel="stylesheet" href="public/styles/general.css" type="text/css" media="screen" />
	
	<!-- JQUERY -->
	<script src="public/scripts/jquery-2.1.3.min.js"></script>
	
	<!-- MASONRY -->
	<script src="public/scripts/masonry.pkgd.min.js"></script>
	
	<!-- INITIALISATION -->
	<script src="public/scripts/initialisation.js"></script>

</head>

<body>

<div id="Page">

<div id="Entete">

	<div class="ligne">
	
		<div class="titre">
			<h1><a href="#">Mon mur d'images</a></h1>
		</div>
		
		<br class="nettoyeur" />
	
	</div>

</div>

<div id="Corps">

	<div class="ligne">
	
		<ul class="menu">
		
			<li><strong>Choisissez une catégorie :</strong></li>

<?PHP

$APP_Sortie = '';

// On parcourt les categories
foreach ($categories as $c => $categorie) {

	$classe = '';
	
	if (is_array($categorie)) {
	
		if ($categorie_id == $c) {
		
			$classe = 'class="active"';
		
		}
		
		$categorie_url = URL_INDEX . '?app=gallerie.albums.lister&amp;categorie=' . $c;
		
		$APP_Sortie .= '<li>' . "\n";
		$APP_Sortie .= '<a ' . $classe . ' href="' . $categorie_url . '">' . $categorie['nom'] . '</a>' . "\n";
		$APP_Sortie .= '</li>' . "\n";
	
	}

}

echo $APP_Sortie;

?>

		</ul>
	
	</div>
	
	<div class="ligne">
	
		<div class="masonry-container">


<?PHP


$APP_Sortie = '';

$compteur = 1;

$formats = [
	['largeur' => 188, 'hauteur' => 188],
	['largeur' => 188, 'hauteur' => 188],
	['largeur' => 188, 'hauteur' => 188],
	['largeur' => 388, 'hauteur' => 388],
];

// var_dump($dossiers);

foreach($dossiers as $dossier_cle => $dossier) {

	if (is_array($dossier)) {
	
		$style = '';
		$my_style = '';
		$enfants = count($dossier['contenu']);
		
		$couverture = current($dossier['contenu']);
		// var_dump($couverture);
		
		$nom = $couverture['nom'];
		$empreinte = $couverture['informations']['empreinte'];
		
		
		$action = '';
		
		$tirage = rand(0, (count($formats) - 1));
		$format = $formats[$tirage];
		
		$largeur = $format['largeur'];
		$hauteur = $format['hauteur'];
		
		$photo_url = URL_INDEX . '?app=gallerie.photos.afficher&amp;categorie=' . $categorie_id . '&amp;document=' . $empreinte;
		$document_url = URL_INDEX . '?app=ged.images.afficher&amp;document=' . $empreinte;
		
		$APP_Sortie .= '<a class="" href="' . $photo_url . '">' . "\n";
		$APP_Sortie .= '<img src="' . $document_url . '&amp;largeur=' . $largeur . '&amp;hauteur=' . $hauteur . '" height="' . $hauteur . '" width="' . $largeur . '" class="work-masonry-thumb" alt="" />' . "\n";
		$APP_Sortie .= '</a>' . "\n";
		
		$compteur++;
	
	}

}

echo $APP_Sortie;

?>

		</div>
		
		<br class="nettoyeur" />
	
	</div>

</div>

<div id="Pied">

	<div class="ligne">
	
		<div>
			<p>Site par <a href="http://github.com/orouet/mur10mages/">Mur10mages</a></p>
		</div>
	
	</div>

</div>


</div>

</body>

</html>