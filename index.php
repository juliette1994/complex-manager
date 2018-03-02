<!DOCTYPE html>
<html>
  <head>
    <meta name="Calculatrice" http-equiv="Content-Type" content="text/html;charset=utf8" />
    <link rel="stylesheet" type="text/css" href="body.css">
    <title>Nombres complexes</title>
  </head>
  <header>
    <nav id="nav_head">
      <h1 id="title">Nombres complexes</h1>
    </nav>
  </header>
  <body>
      <div id="block_haut">
        <p id="premierp">Le nombre complexe z est de la forme z = a + ib.</p>
        <form method="POST" action="complexons.php">
          <input type="text" name="reel" id="reel" placeholder="a"/><br/>
          <input type="text" name="imaginaire" id="imaginaire" placeholder="b"/>
      </div>
      <div id="block_calcul">
          <input type="submit" id="button" name="submit_complex" value="Complexons!" />
        </form>
<!--          <input type="submit" id="graphique" name="submit_graph" value="Graphiquons!" />           -->
      </div>
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script type="text/javascript" src="main.js"></script>
  <script type="text/javascript">
    complexe();
  </script>
</html>
<!-- onsubmit="return false" -->