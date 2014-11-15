<?
function insert($array1, $array2, $array3)
{
    $requete = "";
    
    // check tableau SELECT
    if(!empty($array1)) {
        
        $counta = count($array1);
        $i = 0;
        $insert = "";
        
        foreach ($array1 as $k => $a){
        
            $insert .= $a;
            if($i < $counta -1) {
                $insert .= ', ';
            }
            
        $i ++; 
        }
        
        $myInsert = "INSERT INTO " . $insert;
        $requete .= $myInsert;
    
        if(!empty($array2)) {

            $countb = count($array2);
            $i = 0;
            $column = "";
            
            foreach ($array2 as $k => $b){
            
                $column .= $b;
                if($i < $countb-1) {
                    $column .= ', ';
                }
                
            $i ++; 
            }
            
            $myColumn = " (" . $column . ")";
            $requete .= $myColumn;
            

            //check tableau WHERE
            if(!empty($array3)) {
                
                $countc = count($array3);
                $i = 0;
                $value = "";
                
                foreach ($array3 as $k => $c){
                
                    $value .= "'" . $c . "'";
                    if($i < $countc-1) {
                        $value .= ', ';
                    }
                    
                $i ++; 
                }
                
                $myValue = " VALUES(" . $value . ")";
                $requete .= $myValue;

            
            }
        }
    }
    
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


// INSERT INTO blabla
// (blabla, blabla, blabla)
// VALUE(blabla, blabla, blabla)