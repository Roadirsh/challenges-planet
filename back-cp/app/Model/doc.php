<?
include('mysql.php');
include('Show.php');
include('Update.php');
include('Insert.php');
include('Delete.php');

    // test show
    $Select = array('USER_LOGIN', 'USER_ID');
    $From = array('minitp_users');
    $Where = array();
    $Order = array();
    $Group = array();
    // array['']();
    $mySelect = show($Select, $From, $Where, $Order, $Group);
    

    // test update
    $Table = array('minitp_users');
    $Value = array();
    $Value[1] = array('USER_LOGIN', '"saskia"');
    //$Value[2] = array('USER_LOGIN', '"janvier"');
    $Clause = array();
    $Clause[1] = array('USER_ID', '"3"');
    
    $myUpdate = update($Table, $Value, $Clause);


    // test insert
    $iTable = array('minitp_users');
    $Column = array('USER_LOGIN');
    $iValue = array('"saskia"');
    
    //$myInsert = insert($iTable, $Column, $iValue);
    
    // test delete
    $dTable = array('minitp_users');
    
    $Clause[1] = array('USER_LOGIN', '"saskia"');
    //$Clause[2] = array('USER_LOGIN', '"haha"');
    
    //$myDelete = delete($dTable, $Clause);
    
    