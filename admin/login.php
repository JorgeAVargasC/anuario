<?php
    session_start();
    
    if (isset($_GET['cerrar_sesion'])) {
        # code...
        session_destroy();
    }
    include_once 'templates/header.php';

?>

<body class="hold-transition login-page">

    <div class="login-box">
    <div class="login-logo">
        <a href="../index.php"><b>Anuario Rama IEEE</b></a>
        </div>
        <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Inicia sesión aquí</p>

                    <form name="login-admin-form" id="login-admin" method="post" action="modelo-admin.php">
                        <div class="input-group mb-3">
                        <input type="text" class="form-control" name="usuario" placeholder="Usuario">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <i class="fas fa-user"></i>
                            
                            </div>
                        </div>
                        </div>
                        <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        </div>
                        <div>
                            <input type="hidden" name="login-admin" value="1">
                            <button  type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
                        </div>
                    </form>

                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
    </div>
    </div>


<?php
    include_once 'templates/footer.php';
?>
