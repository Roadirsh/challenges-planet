<?php 

/**
 * ProjectModel
 *
 *
 * @package     Framework_L&G
 * @copyright   L&G
 */


class ProjectModel extends CoreModel{

    
    /**
     * Constructor
     */
    function __construct(){
        parent::__construct();
    }
    
/////////////////////////////////////////////////////
/* SEE ONE PROJECT * * * * * * * * * * * * * * * * */

    /**
     * seeOneProject.php
     * 
     */
    public function SeeOneGroup($id) {

        try {
            $select = $this->connexion->prepare("SELECT A.*, B.*, SUM(C.donate_amount) as group_given, D.*
                                                FROM cp_group A, cp_event_has_group B, cp_donate C, cp_event D
                                                WHERE D.event_id = B.event_event_id
                                                AND A.group_valid = 1
                                                AND A.group_id = :id");

            $select->bindValue(':id', $id, PDO::PARAM_INT);
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $array = $select->FetchAll();
            $select->closeCursor();
            
            return $array[0];

        } catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        }   
    }


    /**
     * seeOneProject.php
     * 
     */
    public function SeeOneGroupSponsors($id) {

        try {
            $select2 = $this->connexion->prepare("SELECT A.cp_user_user_id, B.*
                                                FROM cp_donate A
                                                JOIN cp_user B
                                                ON A.cp_user_user_id = B.user_id
                                                WHERE group_group_id = :id
                                                LIMIT 6");

            $select2->bindValue(':id', $id, PDO::PARAM_INT);
            $select2->execute();
            $select2->setFetchMode(PDO::FETCH_ASSOC);
            $array = $select2->FetchAll();
            $select2->closeCursor(); 
            
            return $array;

        } catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        }   
    }

/////////////////////////////////////////////////////
/* MOBILE APP * * * * * * * * * * * * * * * * * * */

    /**
     * mobile application
     *
     */
    public function getProjectJSON() {

        try {
				$selectfrom = "SELECT group_name, group_descr, group_id 
                                                    FROM  `cp_group` ";
                if(isset($_GET['id'])){
	                $projetparevent = "`cp_event_has_group`.`event_event_id` = :id AND ";
					$jointure = "LEFT JOIN cp_event_has_group 
                             ON cp_group.group_id = cp_event_has_group.group_group_id ";
							 
                }
                else{
	                $jointure = "";
	                $projetparevent = "";
                }
                
                
                $where = "WHERE "  .  $projetparevent . " group_valid = 1";
                $query = $selectfrom.$jointure.$where;
                                                    
                $select = $this->connexion->prepare($query);
				if(isset($_GET['id'])){
                	$select->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
                }
                $select->execute();
                $select->setFetchMode(PDO::FETCH_ASSOC);
                $event = $select->FetchAll();
                
                $json = json_encode($event);

                return $json;

        }

        catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        }
    }

/////////////////////////////////////////////////////
/* ADD PROJECT * * * * * * * * * * * * * * * * * * */
    
    //Retourne l'extension d'un fichier
    public function getExtension($fichier){
		$extension_upload = strtolower(  substr(  strrchr($fichier, '.') ,1)  );
		return $extension_upload;
	}

    //Déplacement de l'emplacement temporaire vers la desitnation finale sur le serveur
    public function upload($index, $destination){
		
		$extension = $this->getExtension($destination);
		//Déplacement
	   move_uploaded_file($index,$destination);
		if($extension=="jpg" || $extension=="jpeg" )
		{
			$src = imagecreatefromjpeg($destination);
		}
		else if($extension=="png")
		{
			$src = imagecreatefrompng($destination);
		}
		else 
		{
			$src = imagecreatefromgif($destination);
		}
		
		list($width,$height)=getimagesize($destination);
		// Resize de l'image et compression
		$newwidth=378;
		$newheight=($height/$width)*$newwidth;
		$tmp=imagecreatetruecolor($newwidth,$newheight);

		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,
		 $width,$height);

		$filename = $destination;
		
		imagejpeg($tmp,$filename,100);
		
		imagedestroy($src);
		imagedestroy($tmp);

	   return true;
	}


}