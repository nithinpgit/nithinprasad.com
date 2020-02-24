
<?php
if(isset($_GET['type'])){
    $requestType = $_GET['type'];
}else{
    die('INVALID REQUEST TYPE');
}
switch ($requestType) {
    case 'start-record':
            $dataBody = file_get_contents( 'php://input' );
            $dataObject = json_decode($dataBody);
            $jwttoken = $dataObject->token;
            $headers = [
                'X-OPENTOK-AUTH: '.$jwttoken,
                'Content-Type: application/json'
            ];
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,"https://api.opentok.com/v2/project/46285772/archive");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$dataBody);  //Post Fields
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $server_output = curl_exec ($ch);
            curl_close ($ch);
            print  $server_output ;
        break;
    case 'stop-record':
        $dataBody = file_get_contents( 'php://input' );
        $dataObject = json_decode($dataBody);
        $jwttoken = $dataObject->token;
        $headers = [
            'X-OPENTOK-AUTH: '.$jwttoken,
            'Content-Type: application/json'
        ];
        $archiveId = $dataObject->archiveId;
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://api.opentok.com/v2/project/46285772/archive/".$archiveId."/stop");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$dataBody);  //Post Fields
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $server_output = curl_exec ($ch);
        curl_close ($ch);
        print  $server_output ;
    break;
    default:
        
    break;
}
?>