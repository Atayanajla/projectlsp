<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        body {
            background-image: url('/reglog.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            background-color: gainsboro;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row align-items-start pt-5">
            <form method="post" action="/register/store" >
                @csrf
             <div class="pt-3 col-md-4 shadow-sm bg-body-tertiary rounded mx-auto p-3">
                <h6 class="fs-3 fw-bold text-center">Register</h6>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                    <?php if (isset($validation) && $validation->getError('email')) : ?>
                    <div class="invalid-feedback"><?= $validation->getError('email') ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="namaLengkap" name="namaLengkap">
                    <?php if (isset($validation) && $validation->getError('namaLengkap')) : ?>
                    <div class="invalid-feedback"><?= $validation->getError('namaLengkap') ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <?php if (isset($validation) && $validation->getError('password')) : ?>
                    <div class="invalid-feedback"><?= $validation->getError('password') ?></div>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Daftar</button>
                <p class="pt-3">Anda Sudah Punya Akun? <a href="login">login</a></p>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>
