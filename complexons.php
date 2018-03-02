<link rel="stylesheet" type="text/css" href="body.css">
<?php 
$a = 0;
if (isset($_POST['reel']) && (isset($_POST['imaginaire'])) && ($_POST['reel'] != "") && ($_POST['imaginaire'] != ""))
{
  $reel = $_POST['reel'];
  $imaginaire = $_POST['imaginaire'];
  if ($imaginaire == 0)
    $conjugue = $reel;
  else if ($reel == 0)
    $conjugue = "- i" . $imaginaire;
  else if ($imaginaire == 1 && $reel != 0)
    $conjugue = $reel . " - i";
  else if ($imaginaire == 1 && $reel == 0)
    $conjugue = "- i";
  else
    $conjugue = $reel . " - i" . $imaginaire;
  
  $regex = "/^[-]?[+]?[0-9]+[.]?[,]?[0-9]*$/";
  $regex_non = "/^[\w\W]*[0-9]*[a-zA-Z]+[0-9]*[\w\W]*$/";
  if ((preg_match($regex, $reel) && (preg_match($regex, $imaginaire)))) {
    $reel = str_replace(',', '.', $reel);
    $imaginaire = str_replace(',', '.', $imaginaire);
    $float_reel = floatval($reel);
    $float_imaginaire = floatval($imaginaire);
    $module = sqrt($reel*$reel + $imaginaire*$imaginaire);

    if ($reel*$reel + $imaginaire*$imaginaire != 0) {
      $inv1 = $reel/($reel*$reel + $imaginaire*$imaginaire);
      $inv2 = $imaginaire/($reel*$reel + $imaginaire*$imaginaire);
      
    if ($inv1 == 0)
      $inverse = "- i" . $inv2;
    else if ($inv2 == 0)
      $inverse = $inv1;
    else
      $inverse = $inv1 . " - i" . $inv2;
    }
    else
      $error1 = "<a id='link_color2' href='index.php'>Attention!\nLe dénominateur ne doit pas être nul.</a>";   
    $argument = atan2($imaginaire, $reel);
    $trig = $module . "(cos(" . $argument . ") + isin(" . $argument . "))";
    $a = 1;
  }
  else
  {
      if ((preg_match($regex_non, $reel) || (preg_match($regex_non, $imaginaire)) || (!preg_match($regex, $reel)) || (!preg_match($regex, $imaginaire))))
      {
        $error2 = "<a id='link_color2' href='index.php'>Attention!\nUne valeur ne peut contenir que des chiffres, une virgule ou un point.</a>";
        if ((preg_match($regex_non, $reel) || (!preg_match($regex, $reel))))
          ?> <script type="text/javascript" src="functions.js">delete_input()</script> <?php
        if ((preg_match($regex_non, $imaginaire)) || (!preg_match($regex, $imaginaire)))
          ?> <script type="text/javascript" src="functions.js">delete_input2()</script> <?php
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="complexes" http-equiv="Content-Type" content="text/html;charset=utf8" />
    <title>Complexons</title>
  </head>
  <header>
    <nav id="nav_head">
      <h1 id="title">Calculs</h1>
    </nav>
  </header>
  <body>
    <?php if(isset($error1)) echo $error1; ?>
    <?php if(isset($error2)) echo $error2; ?>
    <?php if((!isset($error1) && (!isset($error2)))) { ?>
      <div id="block_middle">
       <form method="POST" action="graphiquons.php">
        <p class="text_inline">Sa partie reel est: </p>
        <input type="text" name="rreel" id="rreel" placeholder="Reel" value="<?php if(isset($reel) && $a == 1) echo $reel; ?>"/><br/>
        <p class="text_inline">Sa partie imaginaire est: </p>
        <input type="text" name="iimaginaire" id="iimaginaire" placeholder="Imaginaire" value="<?php if(isset($imaginaire) && $a == 1) echo $imaginaire; ?>"/><br/>
        <p class="text_inline">Son conjugué est: </p>
        <input type="text" name="conjugue" id="conjugue" placeholder="Conjugue" value="<?php if(isset($conjugue) && $a == 1) echo $conjugue; ?>"/><br/>
        <p class="text_inline">Son inverse est: </p>
        <input type="text" name="inverse" id="inverse" placeholder="Inverse" value="<?php if(isset($inverse) && $a == 1) echo $inverse; ?>"/><br/>
        <p class="text_inline">Son module est: </p>
        <input type="text" name="module" id="module" placeholder="Module" value="<?php if(isset($module) && $a == 1) echo $module; ?>"/><br/>
        <p class="text_inline">Son argument est: </p>
        <input type="text" name="argument" id="argument" placeholder="Argument" value="<?php if(isset($argument) && $a == 1) echo $argument; ?>"/><br/>
        <p class="text_inline">Son écriture trigonométrique est: </p>
        <input type="text" name="trigo" id="trigo" placeholder="Ecriture trigonométrique" value="<?php if(isset($trig) && $a == 1) echo $trig; ?>"/>
      </div>
      <!-- <button id="retour"><a id="link_color" href="index.php">Retour</a></button>
      <a id="link_color" href="index.php">Retour</a> -->
      <input type="submit" id="graphique" name="submit_graph" value="Graphiquons!" />
      </form>
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  
</html>
<?php
}
}
else {
  ?> <a id="link_color2" href="index.php">Veuillez entrer les nombres a et b!</a> <?php }
?>