<?php
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    require_once "config.php";
    $input_id = $_GET["id"];
    $sql = "SELECT * FROM employees WHERE id = " . $input_id;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row["name"];
        $address = $row["address"];
        $salary = $row["salary"];
    } else {
        echo "حدث خطأ";
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/927f8205e9.js" crossorigin="anonymous"></script>
    <title><?php echo $name ?></title>
</head>

<body>
    <?php include 'navbar.php' ?>
    <div class="container text-right" style="text-align:right;">
        <h1 class="p-2"> عرض المعلومات</h1>
        <div class="container m-0" style="text-align: right;">
            <label for="id"><i class="fa-regular fa-id-badge"></i> رقم التعريف</label>
            <input class="form-control m-1" id="id" type="text" value="<?php echo $input_id ?>" disabled readonly>
            <label for="id"><i class="fa-solid fa-user"></i> الاسم و اللقب</label>
            <input class="form-control m-1" id="name" type="text" value="<?php echo $name ?>" disabled readonly>
            <label for="id"><i class="fa-solid fa-address-card"></i> العنوان</label>
            <input class="form-control m-1" id="address" type="text" value="<?php echo $address ?>" disabled readonly>
            <label for="id"><i class="fa-solid fa-dollar-sign"></i> الراتب</label>
            <input class="form-control m-1" id="salary" type="text" value="<?php echo $salary ?>" disabled readonly>
        </div>
    </div>
</body>

</html>