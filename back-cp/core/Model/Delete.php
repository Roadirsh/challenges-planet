<?
function delete($array1, $array2)
{
    $requete = "DELETE ";
    
    // check tableau SELECT
    if(!empty($array1)) {
    
        $from = $array1[0];
        
        $myFrom = "FROM " . $from;
        $requete .= $myFrom;
    
        if(!empty($array2)) {

            $counta = count($array2);
            $i = 1;
            $clause = "";

            foreach($array2 as $k => $b){
                
                $clause .= " " . $b[0] . " = ";
                $clause .= " " . $b[1];
                if($counta > $i){
                    $clause .= "AND ";
                    $i ++;
                }
            }
            
            $myWhere = " WHERE " . $clause;
            $requete .= $myWhere;

        }
    }
    
    //echo $requete;
    
    global $connexion;

    try
	{
		$query = $connexion -> prepare($requete);
        
		$query -> execute();

        
		$query -> closeCursor();
		
	}

	catch (Exception $e)
	{
		die ('Erreur Mysql' . $e -> getMessage());
	}
}
