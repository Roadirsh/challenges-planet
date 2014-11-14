#Documentation Framework[SaG]
<hr>

###Architecture: 
- app
	- conf
	- controller
	- model
	- view
- public
	- css
	- fonts
	- images
	- js
	- index.php
	
###Fichiers:

#####../app/conf/conf_define.php : 
Fichier de centralisation des constantes. <br>
`define ROOT` => ../app/ chemin le plus courant <br>
`define MODEL` => model/Model chemin vers le model <br>

#####../app/conf/conf_mysql.php : 
Fichier de log à la BDD <br>
`$PARAM_hote;` <br>
`$PARAM_port;` <br>
`$PARAM_nom_bd;` <br>
`$PARAM_utilisateur;` <br>
`$PARAM_mot_passe;` <br>

#####../app/conf/conf_url.php : 
Fichier permettant de centraliser les url récurantes dans un tableau. 

#####../app/conf/mysql.php : 
Fichier de connexion à la Base de donnée. 

#####../app/model/Model :
Dossier regroupant les fonctions génériques, executant les requetes à la BDD.

##### ../app/model/Model/Connexion() :
`include(ROOT . MODEL . '/Connexion.php');`<br>
on transmet les paramètres $_POST["login"] et $_POST["pwd"] <br>
`if(isconnect(($_POST["login"]), (md5($_POST["pwd"]))))` <br>
on execute la requete, avec les paramètres transmis et récupérés dans les variables $login et $pwd. <br>

##### ../app/model/Model/Delete() :
`include_once(ROOT . MODEL . 'Delete.php');` <br>
on construit un tableau pour transmettre des paramètres. <br>
`$a[1] = array('MINITP_ID', $_GET['c']);` <br>
on transmet les paramètres: Table / Clause <br>
`$suppression = delete(array('minitp'), $a);` <br>
on execute la requete, avec les paramètres transmis et récupérés dans les variables $array1<em>(table)</em> et $array2<em>(clause)</em> <br>
<br>
Initialisation de la variable `$requete = "DELETE "`<br>
<br>
On vérifie que la variable $array1 n'est pas vide. <br>
Si elle n'est pas vide, on ajoute à la variable $requete: <br>
`$myFrom = "FROM " . $from;`<br>
`$requete .= $myFrom;` <br>
<br>
On vérifie que la variable $array2 n'est pas vide. <br>
On compte le nombre d'entrées du tableau $array2 dans le $counta <br>
On initialise $clause. <br>
On parcours le tableau $array2 pour construire la clause. <br>
Si le nombre d'entrées est superieure à $i on ajoute le paramètre `AND` et on incrémente $i. <br>
On ajoute à la variable $requete: <br>
`$myWhere = " WHERE " . $clause;`<br>
`$requete .= $myWhere;` <br>
<br>
La variable $requete étant construite, on excecute la requete: <br>
`$query = $connexion -> prepare($requete);` <br>

##### ../app/model/Model/Insert() :
`include_once(ROOT . MODEL . 'Insert.php');` <br>
On transmet les paramètres Table/ Colonne/ Values <br>
`$insertion = insert(array('minitp'), array('MINITP_NAME', 'MINITP_MAIL', 'MINITP_COMMENT'), array($_POST['nom'], $_POST['mail'], $_POST['comment']));` <br>
on execute la requete, avec les paramètres transmis et récupérés dans les variables $array1<em>(table)</em>, $array2<em>(colonne)</em> et $array2<em>(values)</em> <br>
<br>
Initialisation de la variable `$requete = ""`<br>
<br>
On vérifie que la variable $array1 n'est pas vide. <br>
On compte le nombre d'entrées du tableau $array1 dans le $counta <br>
On initialise $insert. <br>
On parcours le tableau $array1 pour ajouter les différentes tables. <br>
Si le nombre d'entrées est superieure à $i on ajoute le paramètre `,` et on incrémente $i. <br>
On ajoute à la variable $requete: <br>
`$myInsert = "INSERT INTO " . $insert;`<br>
`$requete .= $myInsert;` <br>
<br>
Si la variable $array1 n'est pas vide, on vérifie que la variable $array2 n'est pas vide. <br>
On réitère l'opération avec les variables $array2 et $countb.<br>
`$myColumn = " (" . $column . ")";`<br>
`$requete .= $myColumn;` <br>
<br>
Si la variable $array2 n'est pas vide, on vérifie que la variable $array3 n'est pas vide. <br>
On réitère l'opération avec les variables $array3 et $countc.<br>
`$myValue = " VALUES(" . $value . ")";`<br>
`$requete .= $myValue;` <br>
<br>
La variable $requete étant construite, on excecute la requete: <br>
`$query = $connexion -> prepare($requete);` <br>

##### ../app/model/Model/Show() :
`include_once(ROOT . MODEL . 'Show.php');` <br>
On transmet les paramètres Select/ Table/ Clause/ Order / Group by <br>
`$affcom = show(array('*'), array('minitp'), array(), array("MINITP_ID DESC"), array());` <br>
On execute la requete, avec les paramètres transmis et récupérés dans les variables $array1<em>(select)</em>, $array2<em>(table)</em>,  $array3<em>(clause)</em>, $array4<em>(order by)</em> et $array5<em>(group by)</em><br>
<br>
Initialisation de la variable `$requete = ""`<br>
<br>
On vérifie que la variable $array1 n'est pas vide. <br>
On compte le nombre d'entrées du tableau $array1 dans le $counta <br>
On initialise $insert. <br>
On parcours le tableau $array1 pour ajouter les différentes tables. <br>
Si le nombre d'entrées est superieure à $i on ajoute le paramètre `,` et on incrémente $i. <br>
On ajoute à la variable $requete: <br>
`$mySelect = "SELECT " . $select;`<br>
`$requete .= $mySelect;` <br>
<br>
Si la variable $array1 n'est pas vide, on vérifie que la variable $array2 n'est pas vide. <br>
On réitère l'opération avec les variables $array2 et $countb.<br>
`$myFrom = " FROM " . $from;`<br>
`$requete .= $myFrom;` <br>
<br>
Si la variable $array2 n'est pas vide, on vérifie que la variable $array3 n'est pas vide. <br>
On réitère l'opération du select avec les variables $array3 et $countc.<br>
`$myWhere = " WHERE " . $where;`<br>
`$requete .= $myWhere;` <br>
<br>
On vérifie que la variable $array4 n'est pas vide, on ajoute le paramètre ORDER BY <br>
`$myOrder = " ORDER BY " . $array4[0];`<br>
`$requete .= $myOrder;` <br>
<br>
On vérifie que la variable $array4 n'est pas vide, on ajoute le paramètre GROUP BY <br>
On réitère l'opération du select avec les variables $array5 et $counte.<br>
`$myGroup = " GROUP BY " . $group;`<br>
`$requete .= $myGroup;` <br>
<br>
La variable $requete étant construite, on excecute la requete: <br>
`$query = $connexion -> prepare($requete);` <br>

##### ../app/model/Model/Update() :
`include_once(ROOT . MODEL . 'Update.php');` <br>
On transmet les paramètres Table/ Set/ Clause<br>
`$myUpdate = update($Table, $Value, $Clause);` <br>
On execute la requete, avec les paramètres transmis et récupérés dans les variables $array1<em>(table)</em>, $array2<em>(value)</em> et $array3<em>(clause)</em><br>
<br>
Initialisation de la variable `$requete = ""`<br>
<br>
On vérifie que la variable $array1 n'est pas vide. <br>
On ajoute à la variable $requete: <br>
`$myTable = "UPDATE " . $array1[0];`<br>
`$requete .= $myTable;` <br>
<br>
Si la variable $array1 n'est pas vide, on vérifie que la variable $array2 n'est pas vide. <br>
On parcours le tableau $array2 pour ajouter les différents SET. <br>
Si le nombre d'entrés est superieur à $i on ajoute le paramètre `,` et on incrémente $i. <br>
On ajoute à la variable $requete: <br>
`$mySet = " SET " . $set;`<br>
`$requete .= $mySet;` <br>
<br>
Si la variable $array2 n'est pas vide, on vérifie que la variable $array3 n'est pas vide. <br>
On réitère l'opération du select avec les variables $array3 et $countc.<br>
`$myClause = " WHERE " . $clause;`<br>
`$requete .= $myClause;` <br>
<br>
La variable $requete étant construite, on excecute la requete: <br>
`$query = $connexion -> prepare($requete);` <br>

##### ../app/model/Model/doc() :
On y retrouve tout les appels aux fonctions, avec les tableaux requis. 

##### ../public/index.php :
On ajoute au top du dispatcheur, la création de session, et son renommage. <br>
`session_start();` <br>
`session_name('monexpo.com');` <br>
<br>
On inclut les define <br>
`require_once('../app/conf/conf_define.php');`
On défini l'encodage de l'ensemble des pages <br>
`header('Content-type: text/html; charset=UTF-8');`<br>
On inclut le fichier de connexion à la BDD <br>
`include(ROOT . "conf/mysql.php");` <br>
On inclut le fichier regroupant les url en dur <br>
`include(ROOT . "conf/conf_url.php");`<br>
<br>
On ajoute la fonction PHP nous permettant d'afficher les erreurs. <br>
`error_reporting(E_ALL);` <br>
<br>
Ce dispatcheur, permet la réécriture d'url. Le .htaccess n'étant pas joint, il est très simple. <br>
Il permet de récupérer le champs `"a"` pour ensuite inclure les controller correspondant. <br>
<br>