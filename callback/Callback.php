<?php
require_once('../../../../wp-config.php');

if (isset($_POST)) {
    $myfile = fopen("logDoPost.txt", "a+") or die("não deu!");
    $result = file_get_contents("php://input");
    fwrite($myfile, $result);
    fclose($myfile);
    if ($result != '') {
        $arraycall = json_decode($result, true);
        if (isset($arraycall['type']) && $arraycall['type'] == 'ORDER') {
            require_once(MEUWP__DIR.'integracao/test-orders.php');
            $test = new Teste();
            $resultOrder = $test->getOrder($arraycall['content']['id']);
        }
    }
}
// if (isset($_GET)) {
//     $myfile = fopen("logDoGet.txt", "a+") or die("não deu!");
//     $result = file_get_contents("php://input");
//     fwrite($myfile, $result);
//     fclose($myfile);
//      if ($result != '') {
//         $arraycall = json_decode($result, true);
//         if (isset($arraycall['type']) && $arraycall['type'] == 'ORDER') {
//         }
//     }
// }
?>