<?php

require_once "db.php";

// $ip = "132.176.205.54";

$ip = "";

if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
    $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
    $ip = trim($ips[0]);
} elseif (!empty($_SERVER['REMOTE_ADDR'])) {
    $ip = $_SERVER['REMOTE_ADDR'];
}



$api = "http://ip-api.com/json/{$ip}";

$ch = curl_init($api);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

curl_close($ch);

$result = json_decode($response, true);

if ($result && $result["status"] === "success") {

$countryUser = $result["countryCode"];

} else {
    echo "IP error or localhost";
    exit();
}

?>


<!DOCTYPE html>
<html lang="en" dir="lrt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Smart Advertising </title>
    <link rel="stylesheet" href="asset/style.css">
</head>
<body>
    <?php
   
    ?>
    <div class="container">
        <header class="header">
            <div class="logo"> <span>🌍</span>  GeoAds </div>
            <div class="user-location">
                <span class="flag"> <?= $result["country"]; ?> </span>
                <span> </span>
            </div>
        </header>

        <main class="main">
            <?php
            $stmt = $pdo->prepare("SELECT * FROM advertisement WHERE country = ?");
            $stmt->execute([$countryUser]);
            $resultDatabase = $stmt->fetchAll();
             if (!empty($resultDatabase)):
            foreach ($resultDatabase as $advertisement):

            ?>
            <div class="ad-card">
                <!-- <div class="ad-badge">تبلیغ ویژه</div> -->
                <div class="ad-image">
                    <img src="<?= $advertisement["image"]; ?>">
                </div>
                <div class="ad-content">
                    <h2 class="ad-title"> <?= $advertisement["title"]; ?> </h2>
                    <p class="ad-description"> <?= $advertisement["content"]; ?> </p>
                    <!-- <a href="#" class="ad-cta"> More →</a> -->
                </div>
            </div>

            
            <?php  
             endforeach;    
              else: 
             ?>
        <span> There are no advertisements. </span>

        <?php  
        endif; 
        ?>

        <div class="info-bar">
                <span> IP: <b> <?= $result["query"]; ?> </b></span>
                <span> Timezone: <b> <?= $result["timezone"]; ?> </b>  </span>
            </div>
        
    </main>
        

        

        <footer class="footer">
            <img src="asset/github.png">
            <a href="https://github.com/BrianDev222">
                BrianDev222
            </a>
        </footer>
    </div>
</body>
</html>