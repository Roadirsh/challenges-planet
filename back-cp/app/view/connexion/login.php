<?php include(ROOT . "view/layout/header.inc.php"); ?>

        <div class="form-box" id="login-box">
            <div class="header logo">
                Challenges Planet
            </div>
            <form action="" method="post">
                <div class="body bg-gray">
                    <?if(!empty($_SESSION['message'])){ ?>
                        <div class="alert alert-warning" role="alert"><? echo $_SESSION['message']; ?></div>
                    <? $_SESSION['message'] = ''; } ?>
                    
                    <div class="form-group">
                        <input type="text" name="login" id="username" class="form-control" placeholder="Login"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="pwd" id="password" class="form-control" placeholder="Password"/>
                    </div>          
                    <!--
                    <div class="form-group">
                        <input type="checkbox" name="remember_me"/> Remember me
                    </div>
                    -->
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-light-blue btn-block">Let me in</button>  
                    
                    <!-- <p><a href="#">I forgot my password</a></p> -->
                </div>
            </form>
        </div>
        
<?php include(ROOT . "view/layout/footer.inc.php"); ?>