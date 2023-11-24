<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ferma</title>
</head>
<body>

<?php
if (isset($_SESSION['error'])){
    echo $_SESSION['error'];
}
?>

</body>
</html>
