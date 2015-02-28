<?php if(isset($_SESSION['message']) && !empty($_SESSION['message'])){ ?>
    <div class="message <?php echo $_SESSION['messtype']; ?>"><?php echo $_SESSION['message']; ?></div>
<?php } $_SESSION['message'] = null; ?>
<? var_dump($data); ?>
<?php include(ROOT . "view/layout/header.inc.php"); ?>

<?php if(isset($data['sponsor']) && !empty($data['sponsor']) ){ $project = $data['sponsor']; } ?>
