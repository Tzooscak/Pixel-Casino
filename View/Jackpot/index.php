<?php

if (!isset($_SESSION['balance'])) {
    $_SESSION['balance'] = 1000;
}

// Handle spin
$message = '';
$winAmount = 0;
$symbols = ['🍒', '🍋', '🍊', '7️⃣', '💎', '🎰'];
$result = [];
$isWin = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['spin'])) {
    $bet = isset($_POST['bet']) ? (int)$_POST['bet'] : 10;
    
    // Check if player has enough balance
    if ($_SESSION['balance'] >= $bet) {
        $_SESSION['balance'] -= $bet;
        
        // Generate random symbols
        for ($i = 0; $i < 3; $i++) {
            $result[] = $symbols[array_rand($symbols)];
        }
        
        // Check for wins
        if ($result[0] === $result[1] && $result[1] === $result[2]) {
            // All symbols match
            $multiplier = 0;
            switch ($result[0]) {
                case '💎':
                    $multiplier = 50;
                    break;
                case '7️⃣':
                    $multiplier = 25;
                    break;
                case '🎰':
                    $multiplier = 15;
                    break;
                case '🍊':
                    $multiplier = 10;
                    break;
                case '🍋':
                    $multiplier = 8;
                    break;
                case '🍒':
                    $multiplier = 5;
                    break;
                default:
                    $multiplier = 0;
            }

            $winAmount = $bet * $multiplier;
            $_SESSION['balance'] += $winAmount;
            $isWin = true;
            $message = "Congratulations! You won $winAmount credits!";
        } elseif ($result[0] === $result[1] || $result[1] === $result[2] || $result[0] === $result[2]) {
            // Two symbols match
            $winAmount = $bet * 2;
            $_SESSION['balance'] += $winAmount;
            $isWin = true;
            $message = "Nice! You won $winAmount credits!";
        } else {
            $message = "Try again!";
        }
    } else {
        $message = "Insufficient balance!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Slot Machine</title>
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
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .balance {
            font-size: 24px;
            color: #ffd700;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        }

        .slot-machine {
            background: rgba(0, 0, 0, 0.7);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            text-align: center;
            margin-bottom: 30px;
        }

        .slots {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 30px 0;
        }

        .slot {
            width: 120px;
            height: 120px;
            background: linear-gradient(145deg, #2c3e50, #34495e);
            border: 3px solid #ffd700;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            box-shadow: 0 0 20px rgba(255, 215, 0, 0.2);
        }

        .controls {
            background: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .bet-input {
            width: 100%;
            padding: 10px;
            background: rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
            border-radius: 5px;
            text-align: center;
            margin: 10px 0;
        }

        .spin-button {
            background: linear-gradient(145deg, #f39c12, #d35400);
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 18px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: bold;
            box-shadow: 0 5px 15px rgba(243, 156, 18, 0.3);
        }

        .spin-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 20px rgba(243, 156, 18, 0.4);
        }

        .message {
            margin-top: 20px;
            padding: 15px;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
        }

        .win {
            background: rgba(46, 204, 113, 0.2);
            color: #2ecc71;
            animation: winPulse 1s ease infinite;
        }

        .lose {
            background: rgba(231, 76, 60, 0.2);
            color: #e74c3c;
        }

        @keyframes winPulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .paytable {
            margin-top: 30px;
            background: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 10px;
        }

        .paytable h3 {
            color: #ffd700;
            margin-bottom: 15px;
        }

        .paytable-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Luxury Slots</h1>
            <div class="balance">Balance: <?php echo $_SESSION['balance']; ?> credits</div>
        </div>

        <div class="slot-machine">
            <div class="slots">
                <?php if (!empty($result)): ?>
                    <?php foreach ($result as $symbol): ?>
                        <div class="slot"><?php echo $symbol; ?></div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="slot">🎰</div>
                    <div class="slot">🎰</div>
                    <div class="slot">🎰</div>
                <?php endif; ?>
            </div>

            <?php if ($message): ?>
                <div class="message <?php echo $isWin ? 'win' : 'lose'; ?>">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="controls">
                <input type="number" name="bet" min="10" max="100" value="10" class="bet-input" required>
                <button type="submit" name="spin" class="spin-button">SPIN</button>
            </form>
        </div>

        <div class="paytable">
            <h3>Paytable</h3>
            <div class="paytable-row">
                <span>💎 💎 💎</span>
                <span>50x</span>
            </div>
            <div class="paytable-row">
                <span>7️⃣ 7️⃣ 7️⃣</span>
                <span>25x</span>
            </div>
            <div class="paytable-row">
                <span>🎰 🎰 🎰</span>
                <span>15x</span>
            </div>
            <div class="paytable-row">
                <span>🍊 🍊 🍊</span>
                <span>10x</span>
            </div>
            <div class="paytable-row">
                <span>🍋 🍋 🍋</span>
                <span>8x</span>
            </div>
            <div class="paytable-row">
                <span>🍒 🍒 🍒</span>
                <span>5x</span>
            </div>
            <div class="paytable-row">
                <span>Any two matching symbols</span>
                <span>2x</span>
            </div>
        </div>
    </div>
</body>
</html>