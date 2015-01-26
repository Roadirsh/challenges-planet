<?
function lang_url()
{
   $ret = "";
   
   if(isset($_GET['a']))
   {
       $ret .= "/". $_GET['a'];
   }
   elseif(isset($_GET['b']))
   {
       $ret .= "/". $_GET['b'];
   }
   elseif(isset($_GET['c']))
   {
       $ret .= "/". $_GET['c'];
   }
   elseif(isset($_GET['d']))
   {
       $ret .= "/". $_GET['d'];
   }
   
   return $ret;
}
    
function confirmation($messageOK, $messageNOK, $e)
{
    if($e)
    {
        echo '<p class="conf-nok">'.$e.'</p>';
    }
}

function comp_date($str){
    // DATE TIME - PHP
    $year = date("Y");
    $month = date('m');
    $day = date('d');
    
    // DATE STR EXPLODE
    $year1 = substr($str, 0, 4);
    $month1 = substr($str, 5, 2);
    $day1 = substr($str, 8, 2);
    
    // CALCUL DU RESTE
    $newYear = $year-$year1;
    $newMonth = $month-$month1;
    $newDay = $day-$day1;
    
    // GESTION DES NEGATIFS
    $newYear = preg_replace('/-/', '', $newYear);
    $newMonth = preg_replace('/-/', '', $newMonth);
    $newDay = preg_replace('/-/', '', $newDay);
    
    $new = array('');
    $new['Cy'] = $newYear;
    $new['Cm'] = $newMonth;
    $new['Cd'] = $newDay;
    
    return $new;
}

function nbJours($debut, $fin) {
    //60 secondes X 60 minutes X 24 heures dans une journée
    $nbSecondes= 60*60*24;

    $debut_ts = strtotime($debut);
    $fin_ts = strtotime($fin);
    $diff = $fin_ts - $debut_ts;
    return round($diff / $nbSecondes);
}

