<?php if(isset($_SESSION['message']) && !empty($_SESSION['message'])){ ?>
    <div class="message <?php echo $_SESSION['messtype']; ?>"><?php echo $_SESSION['message']; ?></div>
<?php } $_SESSION['message'] = null; ?>

<?php include(ROOT . "view/layout/header.inc.php"); ?>

<div class="contain">
    <div class="signup">
        <form id="form-signup" action="" method="post" class="clearfix">
            <div class="classic-login">
                <fieldset>
                    <h1>Please enter your email, you will recive a new password on your mailbox</h1>
                    <label for="email">Email</label>
                    <input id="sign-up-email" name="forgot_email" type="email" placeholder="" required>
                    <input type="submit" class="button-submit" value="get my new password" alt="sign up">
                </fieldset>
            </div>
            <div class="">
                <fieldset>
                    <span>Have you already an account ? </span><a class="connect popup-with-form" href="#form-login">Log you here !</a>
                </fieldset>
            </div>
        </form>
    </div>
</div>
<?php include(ROOT . "view/layout/footer.inc.php"); ?>