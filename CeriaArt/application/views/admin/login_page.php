<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Admin</title>

    <!-- Bootstrap core CSS-->
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('css/main.css') ?>" rel="stylesheet">
</head>

<body id="login">

    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 text-center mt-5 mx-auto p-4">
                <h1 class="h2 text-warning pb-4">CeriaArtPro Promo</h1>
                <p class="lead">Silahkan Login terlebih dahulu untuk melanjutkan</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-5 mx-auto mt-2">
                <form action="<?= site_url('admin/login') ?>" method="POST">
                    <div class="form-group">
                        <label for="email" class="text-light">Email</label>
                        <input type="text" class="form-control" name="email" placeholder="**** @  *** . ***" required />
                    </div>
                    <div class="form-group">
                        <label for="password" class="text-light">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="*******" required />
                    </div>
                    <div class="form-group mt-5">
                        <input type="submit" class="btn btn-dark w-100" value="Kirim" />
                    </div>

                </form>
            </div>
        </div>
    </div>

</body>

</html>