<?php
// URL de callback: {{SEUSITE}}/wp-content/plugins/meu-wp/callback/Callback.php
if (isset($_POST)) {
    $myfile = fopen("logDoPost.txt", "a+") or die("não deu!");
    $txt = file_get_contents("php://input") ;
    fwrite($myfile, $txt);
    fclose($myfile);
    if (isset($_POST['ORDER'])) {
        $myfile = fopen("logDoGetOrder.txt", "w+") or die("não deu!");
        $txt = "" . var_dump($_POST['ORDER']);
        fwrite($myfile, $txt);
        fclose($myfile);
    }
}
if (isset($_GET)) {
    $myfile = fopen("logDoGet.txt", "a+") or die("não deu!");
    $txt = file_get_contents("php://input")
    fwrite($myfile, $txt);
    fclose($myfile);
}
if (isset($_PUT)) {
    $myfile = fopen("logDoPut.txt", "a+") or die("não deu!");
    $txt = file_get_contents("php://input")
    fwrite($myfile, $txt);
    fclose($myfile);
}
if (isset($_DELETE)) {
    $myfile = fopen("logDoDelete.txt", "a+") or die("não deu!");
    $txt = file_get_contents("php://input")
    fwrite($myfile, $txt);
    fclose($myfile);
}