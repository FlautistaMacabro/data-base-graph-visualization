<?php
  session_start();
  require_once 'php/dbDatatoCy.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="autor" content="Vinícius Pelegrineli Bombarda" />
  <link rel="stylesheet" href="css/configMenu.css">
  <link rel="stylesheet" href="css/main.css">
  <style>
    #cy {
      width: 100%;
      height: 100%;
    }
  </style>
  <title> Graph Data View </title>
</head>

<body>
  <main>
    <div id="divgeral">
      <?php if(false): ?>
      <h1> <?php echo $_SESSION['resultMsg']; ?> </h1>
      <?php unset($_SESSION['resultMsg']); endif; ?>
      <div id="divautomato">
        <div id="cy">

        </div>
      </div>
    </div>
    <div id="divopentestarea" class="divopentestarea">
      <button id="bttopentestarea" onclick="toggleTestArea()">  </button>
    </div>
    <div id="divcontenttestarea" class="divcontenttestarea">
      <div id="divmenuconfg">
        <div class="diviconmenuconfg" onclick="loadMenuHome()">
          <img class="iconsmenuconfg" src="images\icons\house.png" alt="Início">
        </div>
        <div class="diviconmenuconfg" onclick="loadMenuConfg()">
          <img class="iconsmenuconfg" src="images\icons\confg.png" alt="Configurações">
        </div>
        <div class="diviconmenuconfg" onclick="loadMenuConfgAdd()">
          <img class="iconsmenuconfg" src="images\icons\confg_add.png" alt="Configurações Adicionais">
        </div>
        <div class="diviconmenuconfg" onclick="loadMenuStatistics()">
          <img class="iconsmenuconfg" src="images\icons\statistics.png" alt="Estatísticas">
        </div>
      </div>
      <div id="divcontentconfg">
        <?php require_once 'php/menus/menu_confg.php'; ?>
      </div>
    </div>
  </main>
</body>
<!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/cytoscape/3.8.5/cytoscape.min.js"> </script>-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/cytoscape/3.23.0/cytoscape.min.js"> </script>
<script type="text/javascript" src="js/menuAreaFunctions.js"> </script>
<script type="text/javascript" src="js/graphVisualization/inicialization.js"> </script>
<script type="text/javascript" src="js/graphVisualization/manipulationFunctions.js"> </script>
<script type="text/javascript" src="js/util.js"> </script>
<!-- <script type="text/javascript" src="js/cytoscape.min.js"> </script> -->
</html>