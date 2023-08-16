<?php
  ob_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('home.php', false);}
?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/main.css">
    </head>
    <body>
        <div class="main">
            <section class="signup">
                <div class="container">
                    <div class="signup-content">
                        <div class="signup-form">
                            <h2 class="form-title">Iniciar Sesión</h2>
                            <div class="signup-image">
                                
                                <figure><img class="animation" 
                                    data-mdb-toggle="animation"  
                                    data-mdb-animation-start="onLoad" 
                                    data-mdb-animation="slide-in-right" 
                                    data-mdb-animation-reset="true" 
                                    src="assets/img/logo.png" 
                                    alt="sing up image" 
                                    style="animation-duration: 500ms;"></figure>
                                
                            </div>
                            <form method="POST" class="register-form" id="register-form" action="auth.php">
                                <div class="form-group">
                                    <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                    <input type="text" name="username" id="username" placeholder="Nombre de Usuario"/>
                                </div>
                                <div class="form-group">
                                    <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                    <input type="password" name="password" id="password" placeholder="Contraseña"/>
                                </div>
                                <?php echo display_msg($msg); ?>
                                <div class="form-group form-button">
                                    <input type="submit" name="signup" id="signup" class="form-submit" value="Iniciar Sesión"/>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </section>
            </div>
    <?php include_once('layouts/footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>