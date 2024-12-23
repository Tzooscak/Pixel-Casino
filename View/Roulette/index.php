<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rulett Fogadás</title>
    <link rel="stylesheet" href="assets\css\Roulette.css">
</head>
<body>
    <h1>Rulett Fogadás</h1>
    <div class="roulette-container">
        <div id="roulette-strip" class="roulette-strip">
            <?php
            $colors = ["green", "red", "black"];
            $numbers = range(0, 36);
            for ($i = 0; $i < 2; $i++) {
                foreach ($numbers as $number) {
                    $colorClass = $number === 0 ? "green" : ($number % 2 === 0 ? "black" : "red");
                    echo "<div class='roulette-slot $colorClass'>$number</div>";
                }
            }
            ?>
        </div>
    </div>

    <div class="bet-area">
        <h2>Fogadási lehetőségek:</h2>
        <div class="bet-options">
            
        </div>
    </div>

    <button class="spin-btn" onclick="">Pörgetés</button>
    <div id="result" class="result"></div>

</body>
</html>
