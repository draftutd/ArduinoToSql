<?php
session_start();
?>
<!DOCTYPE html >
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DISPLAY OF THE SENSOR</title>
</head>

<body>
<?php
$_SESSION["data"] = "30";
echo "Favorite color is " . $_SESSION["dataf"] . ".<br>";
?>
</body>
</html>
