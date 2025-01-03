<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Regisztráció - Pixel Casino</title>
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
            max-width: 450px;
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

        .mb-3 {
            position: relative;
            margin-bottom: 1.5rem !important;
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

        .form-control:focus + .focus-border {
            width: 100%;
        }

        /* Password strength indicator */
        .password-strength {
            height: 3px;
            margin-top: 5px;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .strength-weak {
            background: #dc3545;
            width: 33%;
        }

        .strength-medium {
            background: #ffd700;
            width: 66%;
        }

        .strength-strong {
            background: #28a745;
            width: 100%;
        }

        /* Password match indicator */
        .password-match {
            font-size: 0.8rem;
            margin-top: 5px;
            transition: all 0.3s ease;
        }

        .match-success {
            color: #28a745;
        }

        .match-error {
            color: #dc3545;
        }
    </style>
</head>
<body>

<div class="register-container">
    <h2>Registration</h2>
    <form id="registrationForm" method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="name" placeholder="Add meg a felhasználóneved" required>
            <span class="focus-border"></span>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Add meg az email címed" required>
            <span class="focus-border"></span>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Add meg a jelszavad" required>
            <span class="focus-border"></span>
            <div class="password-strength"></div>
        </div>
        <div class="mb-3">
            <label for="confirmPassword" class="form-label">Password again</label>
            <input type="password" class="form-control" id="confirmPassword" placeholder="Erősítsd meg a jelszavad" required>
            <span class="focus-border"></span>
            <div class="password-match"></div>
        </div>
        <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>
    <p class="mt-3">Already have an account? <a href="/Pixel-Casino/AuthLogin.php">Login</a></p>
    <p>Main page: <a href="/Pixel-Casino/">Back</a></p>
</div>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $register = new UserRegister();
        $register->register();
    }
?>

<script>
// Password strength and match validation
document.addEventListener('DOMContentLoaded', function() {
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirmPassword');
    const strengthIndicator = document.querySelector('.password-strength');
    const matchIndicator = document.querySelector('.password-match');

    function checkPasswordStrength(password) {
        if (password.length < 6) return 'weak';
        if (password.length < 10) return 'medium';
        return 'strong';
    }

    password.addEventListener('input', function() {
        const strength = checkPasswordStrength(this.value);
        strengthIndicator.className = 'password-strength';
        if (this.value) {
            strengthIndicator.classList.add(`strength-${strength}`);
        }
    });

    confirmPassword.addEventListener('input', function() {
        if (this.value && password.value) {
            matchIndicator.textContent = this.value === password.value ? 
                '✓ Passwords match' : '✗ Passwords do not match';
            matchIndicator.className = 'password-match ' + 
                (this.value === password.value ? 'match-success' : 'match-error');
        } else {
            matchIndicator.textContent = '';
        }
    });
});
</script>

</body>
</html>