<?php
require_once '../classes/User.php';

$user = new User();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $password2 = trim($_POST['password2']);

    if ($password !== $password2) {
        $error = "Lozinke se ne poklapaju!";
    } elseif (strlen($password) < 6) {
        $error = "Lozinka mora imati najmanje 6 karaktera!";
    } else {
        if ($user->register($username, $password)) {
            $success = "Registracija uspešna! Možete se prijaviti.";
        } else {
            $error = "Korisničko ime već postoji ili je došlo do greške!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija - Vrtić App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-header text-center bg-success text-white">
                        <h4>Registracija novog korisnika</h4>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <?php if (isset($success)): ?>
                            <div class="alert alert-success"><?php echo $success; ?></div>
                        <?php endif; ?>

                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Korisničko ime</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Lozinka</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Ponovi lozinku</label>
                                <input type="password" name="password2" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Registruj se</button>
                        </form>

                        <div class="text-center mt-3">
                            <a href="login.php">Već imate nalog? Prijavite se</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>