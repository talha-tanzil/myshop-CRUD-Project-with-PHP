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
$errorMessage1 = '';
$successMessage1 = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    do {
        if (empty($name) || empty($email) || empty($phone) || empty($address)) {
            $errorMessage1 = "All the fields are required.";
            break;
        }
        // add new client to database

        $sql1 = "INSERT INTO clients (name, email, phone, address) VALUES ('$name', '$email', '$phone', '$address')";
        // echo "INSERT INTO clients (name, email, phone, address) VALUES ('$name', '$email', '$phone', '$address')";
        // $result = $connection->query($sql);
        $result1 = mysqli_query($connection, $sql1);
        if (!$result1) {
            $errorMessage1 = "Invalid query: " . $connection->error;
            break;
        }

        $name = "";
        $email = "";
        $phone = "";
        $address = "";
        $successMessage1 = "Client added successfully";
        header("Location: index.php");
        exit();
    } while (false);
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
        <h2>New Client</h2>
        <?php
        if (!empty($errorMessage1)) {
            echo "<div class= 'alert alert-warning alert-dismissible show' role='alert'>
            <strong>$errorMessage1</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label=''close></button>
           </div>";
        }

        ?>
        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo "$name" ?>">
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
            if (!empty($successMessage1)) {
                echo "<div class= 'alert alert-success alert-dismissible show' role='alert'>
            <strong>$successMessage1</strong>
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