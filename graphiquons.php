<!DOCTYPE html>
<html>
  <head>
    <meta name="Calculatrice" http-equiv="Content-Type" content="text/html;charset=utf8" />
    <link rel="stylesheet" type="text/css" href="body.css">
    <title>Graphique</title>
  </head>
  <header>
    <nav id="nav_head">
      <h1 id="title">Graphique</h1>
    </nav>
  </header>
  <body>
 <?php if (isset($_POST['rreel']) && (isset($_POST['iimaginaire'])) && ($_POST['rreel'] != "") && ($_POST['iimaginaire'] != ""))
 { echo $_POST['iimaginaire'].$_POST['rreel'];?>
  <div id="block_haut2">
      <div id="canvas_center"><canvas width="600" height="600" id="graph"></canvas></div>
      <input type="hidden" name="reel" id="reel" value="<?php echo $_POST['rreel'] ?>"/><br/>
      <input type="hidden" name="imaginaire" id="imaginaire" value="<?php echo $_POST['iimaginaire'] ?>"/>
  </div>
  <form method="POST" action="index.php">
    <input type="submit" id="rebutton" name="submit_complex" value="Retour" />
  </form>
  <?php } ?> 
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script type="text/javascript" src="main.js"></script>
  <script type="text/javascript">
    graphisme();
  </script>
</html>