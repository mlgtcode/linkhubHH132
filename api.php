<?php
function router($fname, $cpid)
{
    $headers = [
        "Referer: http://192.168.1.1/default.html",
        "Origin: http://192.168.1.1",
        "Content-Type: application/json",
        "_TclRequestVerificationKey: XXX", // placeholder, no need to add key
        "_TclRequestVerificationToken: XXX", // replace XXX with the TclRequestVerificationToken
    ];

    $payload = [
        "id" => $cpid,
        "jsonrpc" => "2.0",
        "method" => $fname,
        "params" => "{}",
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_URL, "http://192.168.1.1/jrd/webapi");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch);
    $result_dec = json_decode($result, true);
    if (isset($result["error"]["message"])) {
        echo "ERROR: " . $result["error"]["message"];
    } else {
        if ($fname === "GetUsageSettings") {
            echo "\n***TRAFFIC***\n" . $result_dec["result"]["UsedData"] / pow(1024, 3) ." GB\n\n"; // traffico
        }
        echo "\n\n****************************** " . $fname . " ******************************\n";
        //var_dump($result);
        $result2 = json_decode($result, true);
        echo json_encode($result2, JSON_PRETTY_PRINT);
    }
}

// router("PLAYLOAD", "ID");
router("GetUsageSettings", "0");
router("HeartBeat", "2.3");
router("GetCurrentTime", "27.55");
router("GetConnectionState", "88.1");
router("GetApSystemInfo", "80.6");
router("GetModemSystemInfo", "50.8");
router("GetApStatus", "82.2");
router("GetSimStatus", "73.9");
router("GetModemStatus", "20.8");
router("GetConnectedDeviceList", "82.5");
router("GetLanPortInfo", "28.6");
router("GetLanSettings", "53.2");
router("GetWanSettings", "60.3");
router("getDMZInfo", "4.8");
router("GetSMSStorageState", "25.6");
router("GetQosSettings", "98.4");

// Wlan
router("GetWlanStatistics", "99.7");
router("GetWlanSettings", "40.7");
router("GetWlanSupportMode", "99.8");

// SIP
router("GetSIPServerSettings", "98.3");
router("GetSIPAccountSettings", "98.4");
?>
