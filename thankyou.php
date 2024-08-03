<?php
include 'db/db.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Token Authentication</title>
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400|Montserrat:700' rel='stylesheet' type='text/css'>
    <style>
        @import url(//cdnjs.cloudflare.com/ajax/libs/normalize/3.0.1/normalize.min.css);
        @import url(//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css);
    </style>
    <link rel="stylesheet" href="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/default_thank_you.css">
    <script src="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/jquery-1.9.1.min.js"></script>
    <script src="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/html5shiv.js"></script>
</head>
<body>

<?php

$htmlCodeSuccess = '
    <header class="site-header" id="header">
		<h1 class="site-header__title" data-lead-id="site-header-title">THANK YOU!</h1>
	</header>

	<div class="main-content">
		<i class="fa fa-check main-content__checkmark" id="checkmark"></i>
		<p class="main-content__body" data-lead-id="main-content-body">
		Thanks a bunch for filling that out.
		<br>
		Thanks and Regards
		<br>
		<b>Hot Metal Logos (Website Name)</b>
		</p>
	</div>

	<footer class="site-footer" id="footer">
		<p class="site-footer__fineprint" id="fineprint">Copyright ©2024 | All Rights Reserved</p>
	</footer>
	';
$htmlCodeFail = '
    <header class="site-header" id="header">
		<h1 class="site-header__title" data-lead-id="site-header-title">Data Already Exits!</h1>
	</header>

    <style>
        #checkmark{
            color: red;
        }
    </style>

	<div class="main-content">
		<i class="fa fa-times main-content__checkmark" id="checkmark"></i>
		<p class="main-content__body" data-lead-id="main-content-body">
		Thanks a bunch for filling that out. But the Requested Data is already Exits Try a New Link.
		<br>
		Thanks and Regards
		<br>
		<b>Hot Metal Logos (Website Name)</b>
		</p>
	</div>

	<footer class="site-footer" id="footer">
		<p class="site-footer__fineprint" id="fineprint">Copyright ©2024 | All Rights Reserved</p>
	</footer>
	';
if (isset($_GET['token'])) {
    $token = mysqli_real_escape_string($db, $_GET['token']);

    // Split the token into parts (header, payload, signature)
    $token_parts = explode('.', $token);
    $header = base64_decode($token_parts[0]);
    $payload = base64_decode($token_parts[1]);
    $signature = base64_decode($token_parts[2]);

    // Decode the JSON payload into an associative array
    $payload_data = json_decode($payload, true);

    // Example of accessing decoded payload data
    $country = $payload_data['country'];
    $language = $payload_data['language'];
    $model = $payload_data['model'];
    $modelCode = $payload_data['modelCode'];
    $customer = $payload_data['customer'];
    if ($customer == 'BUSINESS') {
        $orderID = $payload_data['orderID'];
        $locale = $payload_data['locale'];
    }
    else{
        $orderID = $payload_data['orderId'];
        $locale = "";
    }
    $price = $payload_data['price'];
    $options = $payload_data['options'];
    $vehicle = $payload_data['vehicle'];
    if ($orderID != "") {
        $sqlCount =  mysqli_num_rows(mysqli_query($db, "SELECT * FROM `datasave` WHERE orderID = '".$orderID."'"));
        if ($sqlCount > 0)
        {
            echo $htmlCodeFail;
        }
        else {
            $sqlInsert = mysqli_query($db, "INSERT INTO `datasave`(`country`, `language`, `locale`, `model`, `modelCode`, `orderID`, `price`, `options`, `customer`, `vehicle`) VALUES ('$country', '$language', '$locale', '$model', '$modelCode', '$orderID', '$price', '$options', '$customer', '$vehicle')");
            if ($sqlInsert) {
                $emails = mysqli_query($db, "SELECT * FROM email");
                while ($rowEmail = mysqli_fetch_array($emails)) {
                    $to = $rowEmail['email'];
                    $subject = "New Listing | Property / Car Panel";

                    $headers = "From: admin@hotmetallogos.com" . "\r\n";
                    $headers .= "MIME-Version: 1.0\r\n";
                    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

                    $message = '
<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #fff;">
    <center style="width: 100%; background-color: #fff;">
        <div style="max-width: 600px; border-radius: 10px; background: lightgrey; margin: 100px auto 0;" class="email-container">
            <table id="example" class="table-bordered table-hover">
                <thead>
                <tr>
                    <th>Country</th>
                    <td>' . $payload_data["country"] . '</td>
                </tr>
                <tr>
                    <th>Language</th>
                    <td>' . $payload_data["language"] . '</td>
                </tr>
                <tr>
                    <th>locale</th>
                    <td>' . $payload_data["locale"] . '</td>
                </tr>
                <tr>
                    <th>model</th>
                    <td>' . $payload_data["model"] . '</td>
                </tr>
                <tr>
                    <th>modelCode</th>
                    <td>' . $payload_data["modelCode"] . '</td>
                </tr>
                <tr>
                    <th>orderID</th>
                    <td>' . $payload_data["orderID"] . '</td>
                </tr>
                <tr>
                    <th>price</th>
                    <td>' . $payload_data["price"] . '</td>
                </tr>
                <tr>
                    <th>options</th>
                    <td>' . $payload_data["options"] . '</td>
                </tr>
                <tr>
                    <th>customer</th>
                    <td>' . $payload_data["customer"] . '</td>
                </tr>
                <tr>
                    <th>vehicle</th>
                    <td>' . $payload_data["vehicle"] . '</td>
                </tr>
                </thead>
                <tbody>
            </table>
        </div>
    </center> 
</body>
    ';
                    $mail = mail($to, $subject, $message, $headers);
                }
                echo $htmlCodeSuccess;
            }
        }
    }
}
?>
</body>
</html>