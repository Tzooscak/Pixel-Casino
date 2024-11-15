<!DOCTYPE html>
<html lang="hun">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <title>Document</title>
      <link rel="stylesheet" href="assets\css\sideTools.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  </head>
  <body>
      
      
    <div id="Tools" class="tools">

        <a href="javascript:void(0)" class="closebtn" onclick="closeTools()">&times;</a>

        <div class="color-palette">
                <span class="color" style="--set-color:#000000" data-color="#000000"></span>
                <span class="color" style="--set-color:#808080" data-color="#808080"></span>
                <span class="color" style="--set-color:#800000" data-color="#800000"></span>
                <span class="color" style="--set-color:#ff0000" data-color="#ff0000"></span>
                <span class="color" style="--set-color:#ff4500" data-color="#ff4500"></span>
                <span class="color" style="--set-color:#ffff00" data-color="#ffff00"></span>
                <span class="color" style="--set-color:#008000" data-color="#008000"></span>
                <span class="color" style="--set-color:#00a2e8" data-color="#00a2e8"></span>
                <span class="color" style="--set-color:#3f48cc" data-color="#3f48cc"></span>
                <span class="color" style="--set-color:#a349a4" data-color="#a349a4"></span>
                <span class="color" style="--set-color:#ffffff" data-color="#ffffff"></span>
                <span class="color" style="--set-color:#c3c3c3" data-color="#c3c3c3"></span>
                <span class="color" style="--set-color:#b97a57" data-color="#b97a57"></span>
                <span class="color" style="--set-color:#ffaec9" data-color="#ffaec9"></span>
                <span class="color" style="--set-color:#ffc90e" data-color="#ffc90e"></span>
                <span class="color" style="--set-color:#efe4b0" data-color="#efe4b0"></span>
                <span class="color" style="--set-color:#b5e61d" data-color="#b5e61d"></span>
                <span class="color" style="--set-color:#99d9ea" data-color="#99d9ea"></span>
                <span class="color" style="--set-color:#7092be" data-color="#7092be"></span>
                <span class="color" style="--set-color:#c8bfe7" data-color="#c8bfe7"></span>
        </div>

    </div>

    <div class="tools-toggle">
      <span class="material-symbols-outlined" onclick="openTools()">bookmark</span>
    </div>

    <script>
    function openTools() {
      document.getElementById("Tools").style.width = "250px";
    }

    function closeTools() {
      document.getElementById("Tools").style.width = "0";
    }

    </script>
  </body>
</html>