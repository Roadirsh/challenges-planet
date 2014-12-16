<?

/**
 * CONFIDENTIEL
 *
 * @package     Framework_mobile_L&G
 * @copyright 	L&G
 */

if ($_SERVER['HTTP_HOST'] == DEV) {
	// le chemin vers le serveur
		$PARAM_hote = 'localhost'; 
	// port utilisé
		$PARAM_port = '3306';
	// le nom de la BDD
		$PARAM_nom_bd = 'giraudsa'; 
	// login de l'utilisateur
		$PARAM_utilisateur = 'giraudsa'; 
	// mdp de l'utilisateur
		$PARAM_mot_passe = '600106'; 
	// construction 
		$dns = 'mysql:host=' . $PARAM_hote . ';port=' . $PARAM_port . ';dbname=' . $PARAM_nom_bd;
} else {
	// le chemin vers le serveur
		$PARAM_hote = 'localhost'; 
	// port utilisé
		$PARAM_port = '3306';
	// le nom de la BDD
		$PARAM_nom_bd = 'ChallengesPlanet'; 
	// login de l'utilisateur
		$PARAM_utilisateur = 'root'; 
	// mdp de l'utilisateur
		$PARAM_mot_passe = 'root'; 
	// construction 
		$dns = 'mysql:host=' . $PARAM_hote . ';port=' . $PARAM_port . ';dbname=' . $PARAM_nom_bd;

}