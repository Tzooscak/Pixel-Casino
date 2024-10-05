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
      <h4 id="username"><?php echo $_SESSION['name'] ?></h4>
      <p id="wallet"><?php echo $_SESSION['wallet'] ?></p>
      <form action="logout.php" method="POST"> 
          <button type="submit">Logout</button> 
      </form> 
  </div>

  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="/Pixel-Casino/Blackjack.php">BlackJack</a>
  <a href="/Pixel-Casino/AuthRegister.php">Register</a>
  <a href="/Pixel-Casino/AuthLogin.php">Login</a>
  <a href="/Pixel-Casino/Roulette.php">Roulette</a>
  <a href="/Pixel-Casino/Jackpot.php">Jackpot</a>
</div>

<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>

<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}

</script>
</body>
</html>