
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Regisztráció</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f7f7f7;
        }
        .register-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="register-container">
    <h2 class="mb-4">Regisztráció</h2>
    <form id="registrationForm" method = "post">
        <div class="mb-3">
            <label for="username" class="form-label">Felhasználónév</label>
            <input type="text" class="form-control" id="username" name = "name" placeholder="Add meg a felhasználóneved" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email cím</label>
            <input type="email" class="form-control" id="email" name = "email" placeholder="Add meg az email címed" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Jelszó</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Add meg a jelszavad" required>
        </div>
        <div class="mb-3">
            <label for="confirmPassword" class="form-label">Jelszó megerősítése</label>
            <input type="password" class="form-control" id="confirmPassword" placeholder="Erősítsd meg a jelszavad" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Regisztráció</button>
    </form>
</div>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $register = new UserRegister();
        $register->register();
    }
    echo $_SESSION["nev"];
?>

</body>
</html>
