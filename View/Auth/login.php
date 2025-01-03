<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login - Pixel Casino</title>
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, #1a1a1a, #0d0d0d);
            color: #fff;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .register-container {
            background: rgba(0, 0, 0, 0.7);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 400px;
            border: 1px solid rgba(255, 215, 0, 0.1);
            animation: fadeIn 0.6s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h2 {
            color: #ffd700;
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 2rem;
            text-transform: uppercase;
            letter-spacing: 3px;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
            animation: glow 2s ease-in-out infinite;
        }

        @keyframes glow {
            0% { text-shadow: 0 0 10px rgba(255, 215, 0, 0.5); }
            50% { text-shadow: 0 0 20px rgba(255, 215, 0, 0.7); }
            100% { text-shadow: 0 0 10px rgba(255, 215, 0, 0.5); }
        }

        .form-label {
            color: #ffd700;
            font-size: 1rem;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .form-control {
            background: rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 215, 0, 0.2);
            color: #fff;
            padding: 12px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: rgba(0, 0, 0, 0.6);
            border-color: #ffd700;
            box-shadow: 0 0 10px rgba(255, 215, 0, 0.3);
            color: #fff;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .btn-primary {
            background: linear-gradient(145deg, #f39c12, #d35400);
            border: none;
            padding: 12px;
            font-size: 1.1rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: bold;
            box-shadow: 0 5px 15px rgba(243, 156, 18, 0.3);
            margin-top: 1rem;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 20px rgba(243, 156, 18, 0.4);
            background: linear-gradient(145deg, #e67e22, #d35400);
        }

        p {
            text-align: center;
            margin-top: 1.5rem;
            color: rgba(255, 255, 255, 0.8);
        }

        a {
            color: #ffd700;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        a:hover {
            color: #f39c12;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        }

        /* Field highlight animation */
        .form-control:focus + .focus-border {
            width: 100%;
            transition: 0.4s;
        }

        .focus-border {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: #ffd700;
            transition: 0.4s;
        }

        .mb-3 {
            position: relative;
            margin-bottom: 1.5rem !important;
        }

        /* Error state */
        .form-control.is-invalid {
            border-color: #dc3545;
            box-shadow: 0 0 10px rgba(220, 53, 69, 0.3);
        }

        /* Success state */
        .form-control.is-valid {
            border-color: #28a745;
            box-shadow: 0 0 10px rgba(40, 167, 69, 0.3);
        }
    </style>
</head>
<body>

<div class="register-container">
    <h2>Login</h2>
    <form id="registrationForm" method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="name" placeholder="Add meg a felhasználóneved" required>
            <span class="focus-border"></span>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Add meg a jelszavad" required>
            <span class="focus-border"></span>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
    <p>Registered? <a href="/Pixel-Casino/AuthRegister.php">Regisztrálj!</a></p>
    <p>Main page: <a href="/Pixel-Casino/">Back</a></p>
</div>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $loginster = new UserLogin();
        $loginster->login();
    };
?>

</body>
</html>