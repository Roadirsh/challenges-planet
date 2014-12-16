<? 

/**
 * Sample Ajax
 *
 * Appel du controller en Ajax
 * Définition des paramètres du form
 *
 * @package     Framework_L&G
 * @copyright   L&G
 */


$(document).ready(function(){

    function processSample(flux) {
        // créarion d'un alert temporaire pour le test
        alert('La réponse va s\'afficher');
        $(retour).val(flux['Retour']);
    }

    $('#formAjax').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url         : "indexAjax.php",
            type        : 'post',
            timeout     : 3000,
            data        : $(this).serialize(),
            dataType    : 'json',
            
            beforeSend  : function(hxr){
                console.log('BEFORESEND: Requete en cours..');       
            },
            
            success     : function(data, status, xhr) {
                console.log('SUCCESS: --data = ' + data + ' --status = ' + status + ' --xhr = ' + xhr);
                console.log(data);
                processSample(data);

            },
            error       : function(xhr status, error) {
                console.log('ERROR: Erreur execution requete Ajax !');
                console.log('--jqXHR = ' + xhr + ' --textStatus = ' + status + ' --errorThrown = ' + error);
            },
            complete    : function(xhr, status) {
                console.log('COMPLETE: --xhr = ' + xhr + ' --status = ' + status);
            },
            statusCode  : {
                404     : function() {
                    console.log("STATUS: 404 :: page not found");
                }
            }
        });
    });
});