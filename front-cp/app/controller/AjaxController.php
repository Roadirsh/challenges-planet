<?php

/**
 * Controller Ajax
 *
 * @package     Framework_L&G
 * @copyright   L&G
 */

/**
 * Action AJAX de traitement de POST
 */
class AjaxController extends CoreController{


    public function formAjax() {

        if(isset($_POST['ajax1'])) {
            $flux = array(
                "numero 1"  => $_POST['ajax1'],
                "numero 2"  => $_POST['ajax2'],
                "Retour"    => "numero 1" . $_POST['ajax1'] . " -- numero 2" . $_POST['ajax2']);
            
            echo json_encode($flux);
        }

        $this->load->view('page', 'ajax');
    }

};