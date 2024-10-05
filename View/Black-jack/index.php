<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Pixel Casino - Blackjack</title>
    <link rel="stylesheet" href="assets\css\BlackJack.css">
    <script src="assets\Js\Blackjack.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container blackjackmenu bg-dark">
        <!-- Játék tábla -->
        <div class="gameboard">
            <!-- Fogadási terület -->
            <div class="betarea">
                <h4>Bet Area</h4>
                <p>Place your bets here.</p>
                <div id="bet"></div>
            </div>
            <!-- Játékterület -->
            <div class="playarea">
                <h4>Play Area</h4>
                <p>Cards will appear here.</p>
                <div id="game"></div>
            </div>
        </div>

        <!-- Ranglista -->
        <div class="leaderboard">
            <h4>Leaderboard</h4>
            <p>Top players will be displayed here.</p>
        </div>
    </div>

    <script>
        window.addEventListener('DOMContentLoaded',app.init);
    </script>
</body>

</html>
