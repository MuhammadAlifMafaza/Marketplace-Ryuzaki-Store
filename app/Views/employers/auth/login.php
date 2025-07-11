<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard - Login</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('template/sb-admin2/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet"
        type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('template/sb-admin2/css/sb-admin-2.min.css'); ?>" rel="stylesheet">

    <style>
        .bg-login-image {
            background: url('<?= base_url('assets\img\illustraion.jpg') ?>');
            background-position: center;
            background-size: cover;
        }
    </style>
</head>

<body class="bg-gradient-primary">

    <div class="container h-100 d-flex align-items-center justify-content-center">

        <!-- Outer Row -->
        <div class="row justify-content-center w-100">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center mb-4">
                                        <h1 class="h4 text-gray-900">Welcome Back!</h1>
                                    </div>

                                    <?php if (session()->getFlashdata('error')): ?>
                                        <div class="alert alert-danger">
                                            <?= session()->getFlashdata('error') ?>
                                        </div>
                                    <?php endif; ?>

                                    <form class="user" action="<?= base_url('karyawan/loginProcess') ?>" method="post">
                                        <?= csrf_field() ?>
                                        <div class="form-group">
                                            <input type="text" name="login" class="form-control form-control-user"
                                                placeholder="Enter Username or Email..." required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password"
                                                class="form-control form-control-user" placeholder="Password" required>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>

                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="#">Lupa Password?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('template/sb-admin2/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('template/sb-admin2/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('template/sb-admin2/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('template/sb-admin2/js/sb-admin-2.min.js'); ?>"></script>

</body>

</html>