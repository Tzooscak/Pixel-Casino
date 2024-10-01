<!DOCTYPE html>
<html lang="hun">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
    <link rel="stylesheet" href="assets\css\sidenav.css">
</head>
<body>
    
    
<div id="mySidenav" class="sidenav">

  <div class="profile p-3 text-center">
    <img src="https://via.placeholder.com/100" class="rounded-circle mb-3" alt="Profile Picture">
    <h4 id="username">Felhasználónév</h4>
    <p id="wallet">Egyenleg: $1000</p>
  </div>

  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="/Pixel-Casino/Blackjack.php">BlackJack</a>
  <a href="#">Services</a>
  <a href="#">Clients</a>
  <a href="#">Contact</a>
</div>

<h2>Animated Sidenav Example</h2>
<p>Click on the element below to open the side navigation menu.</p>
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>

<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}

const username = "Játékos01"; 
const walletAmount = 1200;

document.getElementById("username").textContent = username;
document.getElementById("wallet").textContent = `Egyenleg: $${walletAmount}`;
</script>
</body>
</html>