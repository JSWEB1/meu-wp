<?php  
// URL de callback: {{SEUSITE}}/wp-content/plugins/meu-wp/callback/Callback.php

  if (isset($_POST)) {
    $myfile = fopen("logDoPost.txt", "a") or die("não deu!");
    $txt = "".$_POST.PHP_EOL;
    $printr = var_export($_POST, true);
   
    fwrite($myfile, $txt . $printr);
    fclose($myfile);
    if (isset($_POST['ORDER'])) {
      $myfile = fopen("logDoGetOrder.txt", "w") or die("não deu!");
      $txt = "".var_dump($_POST['ORDER']);
      fwrite($myfile, $txt);
      fclose($myfile);
    }
  }  
  if (isset($_GET)) {
    $myfile = fopen("logDoGet.txt", "a") or die("não deu!");
    $txt = "".$_GET.PHP_EOL;
    $printr = var_export($_GET, true);
    fwrite($myfile, $txt . $printr);
    fclose($myfile);
  }
?>