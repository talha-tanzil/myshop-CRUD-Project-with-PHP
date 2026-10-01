<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'myshop';

//Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

$name = '';
$email = '';
$phone = '';
$address = '';
$errorMessage2 = '';
$successMessage2 = '';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET method: show data of the client
    if (!isset($_GET['id'])) {

        header("Location: index.php");
        exit();
    }
    $id = $_GET['id'];
    // read the row of the selected client from database table
    $sql2 = "SELECT `name`,`email`,`address`,`phone`,`address` FROM clients where `id`= $id";
    $result2 = mysqli_query($connection, $sql2);

    // $row = $result2->fetch_assoc();
    $row = mysqli_fetch_assoc($result2);
    // print_r($row);
    if (!$row) {
        header("Location: index.php");
        exit();
    }
    $name = $row['name'];
    $email = $row['email'];
    $phone = $row['phone'];
    $address = $row['address'];
} else {
    // post method: Update the data of the client
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    echo 'ok';
    do {
        if (empty($id) || empty($name) || empty($email) || empty($phone) || empty($address)) {
            $errorMessage2 = "All the fields are required.";
            break;
        }

        $sql3 = "UPDATE clients " . "SET name = '$name', email = '$email', phone ='$phone', address = '$address' " . "WHERE id=$id";
        echo $sql3;
        $result3 = mysqli_query($connection, $sql3);
        if (!$result3) {
            $errorMessage2 = "Invalid query: " . $connection->error;
            break;
        }
        $successMessage2 = "Client added successfully";
        header("Location: index.php");
        exit();
    } while (true);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container" my-5>
        <h2>Update Client</h2>
        <?php
        if (!empty($errorMessage2)) {
            echo "<div class= 'alert alert-warning alert-dismissible show' role='alert'>
            <strong>$errorMessage2</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label=''close></button>
           </div>";
        }

        ?>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo "$id" ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Phone Number</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $address ?>">
                </div>
            </div>
            <?php
            if (!empty($successMessage2)) {
                echo "<div class= 'alert alert-success alert-dismissible show' role='alert'>
            <strong>$successMessage2</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label=''close></button>
           </div>";
            }
            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/myshop/index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>