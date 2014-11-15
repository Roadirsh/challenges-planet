<?
function update($array1, $array2, $array3)
{
    // $array1 = UPDATE
    // $array2 = SET
    // $array3 = Clause
    $requete = "";
    $bindvalue = "";
    
    // check tableau UPDATE
    if(!empty($array1)) {
    
        $myTable = "UPDATE " . $array1[0];
        $requete .= $myTable;

        if(!empty($array2)) {

            $countb = count($array2);

            $i = 1;
            $set = "";
            
            foreach($array2 as $k => $a){
                $set .= " " . $a[0] . " = ";
                $set .= " " . $a[1];
                if($countb > $i){
                    $set .= ", ";
                    $i ++;
                }
            }
                       
            $mySet = " SET " . $set;
            $requete .= $mySet;

            if(!empty($array3)) {
                
                $countc = count($array3);

                $i = 1;
                $clause = "";
                
                foreach($array3 as $k => $b){
                
                    $clause .= " " . $b[0] . " = ";
                    $clause .= " " . $b[1];
                    if($countc > $i){
                        $clause .= "AND ";
                        $i ++;
                    }
                }
                           
               
                $myClause = " WHERE " . $clause;
                $requete .= $myClause;
            }
        }
    }
    

    global $connexion;

    try
	{
		$query = $connexion -> prepare($requete);

		$query -> execute();

        return $query;
        
		$query -> closeCursor();
		
	}

	catch (Exception $e)
	{
		die ('Erreur Mysql' . $e -> getMessage());
	}

}