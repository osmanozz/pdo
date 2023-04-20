<?php

$username = 'root';
$password = '';
$db = 'winkel';
$host = 'localhost:3307';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try 
{
     $pdo = new PDO($dsn, $username, $password, $options);
} 
catch (\PDOException $e) 
{
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$product_code = $_GET['product_code'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "UPDATE producten SET product_naam=:product_naam, 
    prijs_per_stuk=:prijs_per_stuk, omschrijving=:omschriving WHERE product_code=:product_code";
    $placeholders = [
        'product_code' => $_GET['product_code'],
        'product_naam' => $_POST['product_naam'],
        'prijs_per_stuk' => $_POST['prijs_per_stuk'],
        'omschriving' => $_POST['omschrijving']
    ];
    $stmt = $pdo->prepare($sql);
    $stmt->execute($placeholders);
    

    if ($stmt->rowCount()) {
        header('Location: index.php');
    } else {
        header('Location: edit-product.php?product_code='.$product_code);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="POST">
        <input type="text" placeholder="Naam" name="product_naam" required>
        <input type="number" placeholder="Prijs" name="prijs_per_stuk" required>
        <input type="text" placeholder="Omschrijving" name="omschrijving" required>
        <input name="button" type="submit">
    </form>
</body>
</html>