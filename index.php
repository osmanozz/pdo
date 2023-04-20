<?php
session_start();

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

echo "Welkom " . $_SESSION['username'];
// Hoe je alles selecteert in een query

$stmt = $pdo->query("select * from producten");
$result = $stmt->fetchAll();

// foreach ($result as $row) {
//     echo 'Product_code: '.$row['product_code'] . ' Product_naam: ' . $row['product_naam'] . 
//     ' Prijs_per_stuk: '. $row['prijs_per_stuk'] .' Omschrijving:'. $row['omschrijving'] .'<br>';
// }


// Hoe je een single row selecteert met placeholders

// $stmt = $pdo->prepare('SELECT * FROM producten WHERE product_code = ?');
// $stmt->execute(['1']);
// $result = $stmt->fetchAll();
// foreach ($result as $row) {
//     echo 'Product_code: '.$row['product_code'] . ' Product_naam: ' . $row['product_naam'] . ' Prijs_per_stuk: '. $row['prijs_per_stuk'] .' Omschrijving:'. $row['omschrijving'] . '<br>';
// }

// Hoe je een single row selecteert met named parameters

// $stmt = $pdo->prepare('SELECT * FROM producten WHERE product_code=:product_code');
// $stmt->execute([
//     'product_code' => 1
// ]);

// $result = $stmt->fetchAll();
// foreach ($result as $row) {
//     echo 'Product_code: '.$row['product_code'] . ' Product_naam: ' . $row['product_naam'] . ' Prijs_per_stuk: '. $row['prijs_per_stuk'] .' Omschrijving:'. $row['omschrijving'] . '<br>';
// }


// INSERT 

// if (isset($_POST['button'])) {
//     $sql = "INSERT INTO producten VALUES (:product_code, :product_naam, :prijs_per_stuk, :omschrijving)"; 
//     $stmt = $pdo->prepare($sql);
//     $placeholders = [
//         'product_code' => null,
//         'product_naam' => $_POST['product_naam'],
//         'prijs_per_stuk' => $_POST['prijs_per_stuk'],
//         'omschrijving' => $_POST['omschrijving']
//     ];
//     $stmt->execute($placeholders);
//     if ($stmt->rowCount()) {
//         echo 'Inserted successfully';
//     }
// }


// UPDATE 

// if (isset($_POST['button'])) {
//     $sql = "UPDATE producten SET product_naam=:product_naam, prijs_per_stuk=:prijs_per_stuk,omschrijving=:omschrijving 
//     WHERE product_code=:product_code";
//     $stmt = $pdo->prepare($sql);
//     $placeholders = [
//         'product_code' => 2,
//         'product_naam' => $_POST['product_naam'],
//         'prijs_per_stuk' => $_POST['prijs_per_stuk'],
//         'omschrijving' => $_POST['omschrijving']
//     ];
//     $stmt->execute($placeholders);
//     if ($stmt->rowCount()) {
//         echo 'Updated successfully';
//     }
// }


// Delete
// if (isset($_GET['product_code'])) {
//     $sql = "DELETE FROM producten WHERE product_code=:product_code";
//     $stmt = $pdo->prepare($sql);
//     $placeholders = [
//         'product_code' => 2
//     ];
// $stmt->execute($placeholders);
// echo 'Deleted successfully';
// }

?>

<!-- <!DOCTYPE html>
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
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="2">
        <tr>
            <th>Product code</th>
            <th>Product naam</th>
            <th>Prijs per stuk</th>
            <th>Omschrijving</th>
            <th colspan="2">Action</th>
        </tr>

        <tr>
            <?php foreach ($result as $row) { ?>
            <td> <?php echo $row['product_code']; ?> </td>
            <td> <?php echo $row['product_naam']; ?> </td>
            <td> <?php echo $row['prijs_per_stuk']; ?> </td>
            <td> <?php echo $row['omschrijving']; ?> </td>
            <td> <a href="edit-product.php?product_code=<?php echo $row['product_code'];?>">Edit</a> </td>
            <td> <a href="delete-product.php?product_code=<?php echo $row['product_code'];?>">Delete</a> </td>
        </tr>
        <?php } ?>
    </table>
    <a href="edit.php?product_code=2">Edit product</a>
</body>
</html>