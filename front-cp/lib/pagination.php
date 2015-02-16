 <?php
    //pagination([requete globale], [requete avec limit], [limit]);  
    function pagination($requete1, $limit)
    {

    ///////////////////////////////////////////////////////////////
    // ETAPE 1: RECUPERER LE NBRE TOTAL 
    
        $limite = $limit; //Nombre par page

        $total = count($requete1); // count de la requete COMPLETE sans limites

    ///////////////////////////////////////////////////////////////
    // ETAPE 2: COMPTER LE NOMBRE DE PAGE
    
        $nb_pages = ceil($total / $limite); // ceil = arrondis au superieur
     
        //echo $_GET['page']; 
        if(isset($_GET['page'])) // isset, vérifie l'existance de ()
        {
             $page = intval($_GET['page']);
             
             if($page>$nb_pages) // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nb_pages...
             {
                  $page = $nb_pages;
             }
        }
        else
        {
             $page = 1; // La page actuelle est la n°1    
        }
        
        // echo $page;
    ///////////////////////////////////////////////////////////////
    // ETAPE 3: SAVOIR OU L'ON EST DANS LES PAGES

        $debut = ($page -1) * $limite; // On calcul la première entrée à lire

        if($nb_pages >1){

            $a = $page-1;
            $b = $page+1;
            $i = $page;
            
    
            // 1ere partie  
            $c = $page-4;
            if($c < 0) $c = 0;

            //echo $page;
            while($c <= $page-1)
            {
                if($c >= 1)
                    echo '<a href="' . url_mmv($azerty, $c) .'" class="btn" >' . $c . '</a>';
                if($c<0)
                    break;
                $c++;
            }
    
            
            echo '<a class="btn current">' . $page . '</a>'; 
            
            // 3ere partie   
            $i = $page+1;
            
            while($i <= ($page+4))
            {
                if($i<=$nb_pages)
                    echo '<a href="' . url_mmv($azerty, $i) .'" class="btn">' . $i . '</a>';
                    
                if($i>$nb_pages)
                    break;
                $i++;
            }
            
            return $debut;  

        }
        else{
            return $debut;
        }
    }
?>
