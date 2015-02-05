<?php include("header.inc.php"); 
	// $logger->log('test', 'loadapp', "Chargement de la vue notfound.php", Logger::GRAN_MONTH);
?>

<div class="notfound jumbotron">
        <h1>404 NOT FOUND</h1>
        <p class="lead">The page you are trying to looking for doesn't exist... sorry! </p>
        <p><a class="btn btn-lg btn-warning" href="<?php echo MODULE . 'page' . ACTION . 'home'; ?>" role="button">Go home</a></p>
    </div>
</div>

<?php include("footer.inc.php"); ?>