<?php
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    require_once "config.php";
    $id = $_POST["id"];
    $sql = "DELETE FROM employees WHERE id= '" . $id . "';";
    if ($conn->query($sql) === TRUE) {
        header("location: index.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    $conn->close();
} else {
    if (empty(trim($_GET["id"]))) {
        header("location: error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/927f8205e9.js" crossorigin="anonymous"></script>
    <title>حذف</title>
</head>

<body>
<?php include 'navbar.php' ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="alert alert-danger">
            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>" />
            <p>هل انت متأكد من حذف هذا السجل؟</p>
            <p>
                <input type="submit" value="نعم" class="btn btn-danger">
                <a href="index.php" class="btn btn-secondary ml-2">لا</a>
            </p>
        </div>
    </form>
</body>

</html>