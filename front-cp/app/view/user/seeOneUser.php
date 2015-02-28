<?php if(isset($_SESSION['message']) && !empty($_SESSION['message'])){ ?>
    <div class="message <?php echo $_SESSION['messtype']; ?>"><?php echo $_SESSION['message']; ?></div>
<?php } $_SESSION['message'] = null; ?>

<?php include(ROOT . "view/layout/header.inc.php"); ?>

<?php if(isset($data['user']) && !empty($data['user']) ){ $user = $data['user']; }?>
<?php var_dump($data); ?>


<?php include(ROOT . "view/layout/footer.inc.php"); ?>