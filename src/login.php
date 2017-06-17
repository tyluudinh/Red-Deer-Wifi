<?php
/**
 * Created by dinhty.luu@gmail.com
 * Date: 17/02/2017
 * Time: 13:42
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/libs/radius/autoload.php';
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $radius = new \Dapphp\Radius\Radius();
    $radius->setServer('192.168.1.138')
        ->setSecret('mikrotest')
        ->setNasIpAddress('192.168.1.138');

    $response = $radius->accessRequest($username, $password);

    if ($response === false) {
        echo sprintf("Access-Request failed with error %d (%s).\n",
            $radius->getErrorCode(),
            $radius->getErrorMessage()
        );
    } else {
        echo sprintf("IP Address Client: (%s) \n",
            $_SERVER['REMOTE_ADDR']
        );
        echo sprintf("Mac Address Client: (%s) \n",
            getMacClient($_SERVER['REMOTE_ADDR'])
        );
        echo "Success!  Received Access-Accept response from RADIUS server.\n";
    }
}
function getMacClient($ip = '192.168.1.182')
{
    exec('arp '.$ip, $result);
    if (is_array($result)) {
        return substr($result[1], 33, 17);
    }
    return 'Error when get mac address';
}
// exec('arp 192.168.1.182', $result);
// var_dump($result[1]);
// var_dump(substr($result[1], 33, 17));
// if(is_array($result)) {
//     $iface = array();
//     foreach($result as $key => $line) {
//         if($key > 0) {
//             $tmp = str_replace(" ", "", substr($line, 0, 10));
//             if($tmp <> "") {
//                 $macpos = strpos($line, "HWaddr");
//                 if($macpos !== false) {
//                     $iface[] = array('iface' => $tmp, 'mac' => strtolower(substr($line, $macpos+7, 17)));
//                 }
//             }
//         }
//     }
//     var_dump($iface);
// } else {
//     echo "notfound";
// }