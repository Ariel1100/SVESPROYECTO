<?php

// switch ($msg) {
//     case '1':
//         print_r('Error de ingreso');
//         //echo "Error de ingreso";
//         break;
//     case '2':
//         echo "Acceso no válido";
//         break;
//     case '3':
//         echo "Gracias por usar el sistema";
//         break;

//     default:
//         echo "";
//         break;
// }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:500,300,100,500,700,900" rel="stylesheet"
        type="text/css">
    <link href="<?php echo base_url(); ?>Limitless/full/assets/css/icons/icomoon/styles.css" rel="stylesheet"
        type="text/css">
    <link href="<?php echo base_url(); ?>Limitless/full/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>Limitless/full/assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>Limitless/full/assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>Limitless/full/assets/css/colors.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url()?>img/logosves.png" rel="icon" type="image/png" />

    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="<?php echo base_url(); ?>Limitless/full/assets/js/plugins/loaders/pace.min.js">
    </script>
    <script type="text/javascript" src="<?php echo base_url(); ?>Limitless/full/assets/js/core/libraries/jquery.min.js">
    </script>
    <script type="text/javascript"
        src="<?php echo base_url(); ?>Limitless/full/assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript"
        src="<?php echo base_url(); ?>Limitless/full/assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript"
        src="<?php echo base_url(); ?>Limitless/full/assets/js/plugins/forms/validation/validate.min.js"></script>
    <script type="text/javascript"
        src="<?php echo base_url(); ?>Limitless/full/assets/js/plugins/forms/styling/uniform.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>Limitless/full/assets/js/core/app.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>Limitless/full/assets/js/pages/login_validation.js">
    </script>
    <!-- /theme JS files -->
    <style>
	body{
        background-image: url(<?php echo base_url(); ?>img/fondo10.jpg) !important;
    }
</style>
</head>

<body class="login-container login-cover" >

    <!-- Page container  col bg-success  /  style="background-color:#072642"-->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Content area -->
                <div class="content pb-10">

                    <!-- Form with validation  background-color:#ced8e0-->
                    <form class="form-validate" method="POST" action="<?php echo base_url();?>login/validarusuario">
                        <div class="panel panel-body login-form" style="background-color: #E8F8F5">
                            <div class="text-center">
                                <div class="">
                                    <img class="img-fluid rounded w-30" src="<?php echo base_url()?>img/logosves.png"
                                        style="margin-top:10px; width:180px; height:120px">
                                </div>
                                <h5 class="content-group">
                                    <h1>Iniciar Sesión</h1> <small class="display-block">
                                        <h6><?php if($msg=='1')
							{
								echo "Error de Usuario o Contraseña";
							} else if($msg=='2')
							{
								echo "Gracias por usar el Sistema";
							} else if($msg=='3')
							{
								echo "Usuario no logueado";
							}else{
								echo "Ingrese el Usuario y Contraseña";
							}?></h6>
                                    </small>
                                </h5>
                            </div>


                            <div class="form-group has-feedback has-feedback-left">
                                <input type="text" class="form-control" placeholder="Usuario" id="txtLogin"
                                    name="txtLogin" required="required">
                                <div class="form-control-feedback">
                                    <i class="icon-user text-muted"></i>
                                </div>
                            </div>

                            <div class="form-group has-feedback has-feedback-left">
                                <input type="password" class="form-control" placeholder="Contraseña" id="txtClave"
                                    name="txtClave" required="required">
                                <div class="form-control-feedback">
                                    <i class="icon-lock2 text-muted"></i>
                                </div>
                            </div>

                            <div class="form-group login-options">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" class="styled" checked="checked">
                                            Recordar
                                        </label>
                                    </div>

                                    <div class="col-sm-6 text-right">
                                        <a href="login_password_recover.html">¿Se te olvidó tu contraseña?</a>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn bg-teal btn-block">Iniciar <i
                                        class="icon-arrow-right14 position-right"></i></button>
                            </div>
                        </div>
                    </form>
                    <!-- /form with validation -->

                </div>
                <!-- /content area -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->

</body>

</html>