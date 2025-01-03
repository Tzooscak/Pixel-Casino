<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixel Casino</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 20px;
            background: linear-gradient(135deg, #1a1a1a, #0d0d0d);
            color: #fff;
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            color: #ffd700;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
            font-size: 3rem;
            margin-bottom: 2rem;
            text-transform: uppercase;
            letter-spacing: 3px;
        }

        .card {
            background: rgba(0, 0, 0, 0.7);
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            margin-bottom: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.8);
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
            border-bottom: 2px solid rgba(255, 215, 0, 0.3);
            filter: brightness(0.8);
            transition: all 0.3s ease;
        }

        .card:hover .card-img-top {
            filter: brightness(1);
        }

        .card-body {
            padding: 1.5rem;
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0.9) 100%);
        }

        .card-title {
            color: #ffd700;
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
            text-shadow: 0 0 5px rgba(255, 215, 0, 0.3);
        }

        .card-text {
            color: #ffffff;
            opacity: 0.8;
            margin-bottom: 1.5rem;
        }

        .btn-primary {
            background: linear-gradient(145deg, #f39c12, #d35400);
            border: none;
            padding: 12px 30px;
            font-size: 1rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: bold;
            box-shadow: 0 5px 15px rgba(243, 156, 18, 0.3);
            width: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 20px rgba(243, 156, 18, 0.4);
            background: linear-gradient(145deg, #e67e22, #d35400);
        }

        /* Custom animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            animation: fadeInUp 0.6s ease forwards;
        }

        .card:nth-child(1) { animation-delay: 0.1s; }
        .card:nth-child(2) { animation-delay: 0.2s; }
        .card:nth-child(3) { animation-delay: 0.3s; }
        .card:nth-child(4) { animation-delay: 0.4s; }

        /* Glowing effect for title */
        @keyframes glow {
            0% { text-shadow: 0 0 10px rgba(255, 215, 0, 0.5); }
            50% { text-shadow: 0 0 20px rgba(255, 215, 0, 0.7); }
            100% { text-shadow: 0 0 10px rgba(255, 215, 0, 0.5); }
        }

        h1 {
            animation: glow 2s ease-in-out infinite;
        }
    </style>
</head>
<body>
    <div class="container text-center py-5">
        <h1 class="mb-4">Dark Casino</h1>
        <div class="row g-4">
            <!-- BlackJack -->
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <img src="assets/Imgs/BlackJack.jpeg" class="card-img-top" alt="BlackJack">
                    <div class="card-body">
                        <h5 class="card-title">BlackJack</h5>
                        <p class="card-text">Test your luck and skill in BlackJack!</p>
                        <a href="/Pixel-Casino/Blackjack.php" class="btn btn-primary">Play Now</a>
                    </div>
                </div>
            </div>
            <!-- Profile Maker -->
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <img src="assets/Imgs/ProfileDrawer.jpeg" class="card-img-top" alt="Profile Maker">
                    <div class="card-body">
                        <h5 class="card-title">Profile Maker</h5>
                        <p class="card-text">Create your own profile using our paint tool!</p>
                        <a href="/Pixel-Casino/Canvas.php" class="btn btn-primary">Start Drawing</a>
                    </div>
                </div>
            </div>
            <!-- Roulette -->
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <img src="assets/Imgs/Roulette.jpeg" class="card-img-top" alt="Roulette">
                    <div class="card-body">
                        <h5 class="card-title">Roulette</h5>
                        <p class="card-text">Spin the wheel and test your fortune!</p>
                        <a href="/Pixel-Casino/Roulette.php" class="btn btn-primary">Spin Now</a>
                    </div>
                </div>
            </div>
            <!-- Jackpot -->
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <img src="assets/Imgs/Slot.jpeg" class="card-img-top" alt="Jackpot">
                    <div class="card-body">
                        <h5 class="card-title">Jackpot</h5>
                        <p class="card-text">Hit the jackpot and win big!</p>
                        <a href="/Pixel-Casino/Jackpot.php" class="btn btn-primary">Try Your Luck</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>