<?
function show($array1, $array2, $array3, $array4, $array5)
{
    // $array1 = SELECT
        // prévoir ('distrinct', 'count')
    // $array2 = FROM
    // $array3 = WHERE
        // prévoir boucle AND
    // $array4 = ORDER BY
    // $array5 = GROUP BY
    // ... et bien d'autres encore
    
        
    $requete = "";
    
    // check tableau SELECT
    if(!empty($array1)) {
        
        $counta = count($array1);
        $i = 0;
        $select = "";
        
        foreach ($array1 as $k => $a){
        
            $select .= $a;
            if($i < $counta -1) {
                $select .= ', ';
            }
            
        $i ++; 
        }

        $mySelect = "SELECT " . $select;
        $requete .= $mySelect;

        //check tableau FROM
        if(!empty($array2)) {

            $countb = count($array2);
            $i = 0;
            $from = "";
            
            foreach ($array2 as $k => $b){
            
                $from .= $b;
                if($i < $countb-1) {
                    $from .= ', ';
                }
                
            $i ++; 
            }
            
            $myFrom = " FROM " . $from;
            $requete .= $myFrom;
            
            //check tableau WHERE
            if(!empty($array3)) {
                
                $countc = count($array3);
                $i = 0;
                $where = "";
                
                foreach ($array3 as $k => $c){
                
                    $where .= $c;
                    if($i < $countc-1) {
                        $where .= ' AND ';
                    }
                    
                $i ++; 
                }
                
                $myWhere = " WHERE " . $where;
                $requete .= $myWhere;
                
            }
            //check tableau ORDER BY
            if(!empty($array4)) {
                
                $myOrder = " ORDER BY " . $array4[0];
                $requete .= $myOrder;
            }
            //check tableau GROUP BY
            if(!empty($array5)) {
            
                $counte = count($array5);
                $i = 0;
                $group = "";
                
                foreach ($array5 as $k => $e){
                
                    $group .= $e;
                    if($i < $counte-1) {
                        $group .= ', ';
                    }
                    
                $i ++; 
                }
                
                $myGroup = " GROUP BY " . $group;
                $requete .= $myGroup;
            }
            
            // .... et bien d'autres encore
        }
        
    }

	global $connexion;

    try
	{
		$query = $connexion -> prepare($requete);
        
		$query -> execute();
		$query -> setFetchMode(PDO::FETCH_ASSOC);
		$retour = $query -> fetchAll();

        return $retour;
        
		$query -> closeCursor();
		
	}

	catch (Exception $e)
	{
		die ('Erreur Mysql' . $e -> getMessage());
	}



}