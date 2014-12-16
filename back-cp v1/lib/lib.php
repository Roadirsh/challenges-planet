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
