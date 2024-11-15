<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="assets/Js/Painter.js"></script>
    <title>Profile Creator</title>
    <link rel="stylesheet" href="assets/css/Canvas.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="profile-container">
        <h2>🎨 Profile Creator</h2>
        <canvas id="myCanvas" width="600" height="300"></canvas>
        <div class="buttons">
            <button id="saveProfile">💾 Save Profile</button>
            <button id="clearCanvas">🧹 Clear Canvas</button>
        </div>
    </div>
    <script>
        window.addEventListener('DOMContentLoaded', app.init)
    </script>
</body>
</html>
