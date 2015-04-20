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
	
		<div class="work-image">


<?PHP

	$APP_Sortie = '';
	
	if (isset($photos_base[$empreinte])) {
	
		$document = $photos_base[$empreinte];
		// die(var_dump($document));
		
		$document = $photos_base[$empreinte];
		
		$document_url = URL_INDEX . '?app=ged.images.afficher&amp;document=' . $empreinte;
		
		$largeur = 1200;
		$hauteur = 900;
		
		$APP_Sortie .= '<a href="' . $document_url . '" title="' . $document['nom'] . '">' . "\n";
		$APP_Sortie .= '<img src="' . $document_url . '&amp;largeur=' . $largeur . '&amp;hauteur=' . $hauteur . '" height="' . $hauteur . '" width="' . $largeur . '"" alt="" />' . "\n";
		$APP_Sortie .= '</a>' . "\n";
	
	} else {
	
		die("Document N°" . $empreinte . " inconnu");
	
	}
	
	echo $APP_Sortie;

?>


		</div>
	
	</div>


	<div class="ligne">

		<div class="textes">
		

<?PHP

$APP_Sortie = '';

$APP_Sortie .= '<h2>' . $document['nom'] . '</h2>' . "\n";

echo $APP_Sortie;

?>

		
		</div>
	
	</div>
	
	<div class="ligne">
	
		<div class="navigation">
			<a href="#" title="Précédent">Précédent</a>
			<a href="#" title="Suivant">Suivant</a>
		</div>
	
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