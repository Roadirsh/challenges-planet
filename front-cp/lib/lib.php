<?php
function lang_url(){
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

function formDate($date, $mode) {

    $retour = array();
    
    $day = substr($date, 8, 2);
    $month = substr($date, 5, 2);
    $year = substr($date, 0, 4);


    $newDate = gregoriantojd ($month , $day , $year);
    $month = jdmonthname($newDate, $mode);

  	if($day == '01'){
  	    $att = 'st';
  	} elseif($day == '02'){
      	$att = 'nd';
  	} elseif($day == '03'){
      	$att = 'rd';
  	} else{
      	$att = 'th';
  	}
  	
  	$string = $month . ' ' . $day  . '<small>'.$att.'</small>' . ' ' . $year;
  	return $string;

}


function titleEvent($count = null, $array = null, $str = null){

  $title = '';

  // Number 
  if(isset($count) && !empty($count)){
    $title .= $count. ' ';
  } else{
    $title .= "Sorry, we don't have any projects for <span class='active'>'" . $array[1] . "'</span>";
    return $title;
    exit;
  }
  // Subject
  if(isset($str)){
    $title .= $str;
  }
  // Plural
  if(isset($count) && $count > 1){
    $title .= 's '; // s
  }

  if(isset($array)){
    // Type of research
    if(!empty($array[2])){
      $title .= ' for ' . $array[2];
    }
    // $_POST
    if(!empty($array[1])){
      $title .= " '<span class='active'>" . $array[1] . "</span>'";
    }

  }

  return $title;
  
}

function titleOneEvent($count = null, $str = null){

  $title = '';

  // Number 
  if(isset($count) && !empty($count[0])){
    $title .= count($count) . ' ';
  } else{
    $title .= "Sorry, they are no teams to sponsorize";
    return $title;
    exit;
  }
  
  // Subject
  if(isset($str)){
    $title .= $str;
  }
  // Plural
  if(isset($count) && count($count) > 1){
    $title .= 's '; // s
  }
  
  $title .= ' to sponsor'; // s

  return $title;
  
}







