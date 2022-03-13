<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/927f8205e9.js" crossorigin="anonymous"></script>
    <title>الصفحة الرئيسية</title>
</head>

<body>
    <?php include 'navbar.php' ?>
    <div class="container text-center">
        <div class="container-fliud m-0">
            <table class="table table-bordered border-primary">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">الاسم</th>
                        <th scope="col">العنوان</th>
                        <th scope="col">الراتب</th>
                        <th scope="col">تعديل/حذف</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once "config.php";
                    $sql = "SELECT id, name, address, salary FROM employees";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<th scope="row">' . $row["id"] . '</th>';
                            echo '<td>' . $row["name"] . '</td>';
                            echo '<td>' . $row["address"] . '</td>';
                            echo '<td>$' . $row["salary"] . '</td>';
                            echo '<th scope="row" class="p-0 align-middle">' . '<a href="./update.php?id=' . $row["id"] . '" class="m-1"><i class="fa-solid fa-user-pen"></i></a> <a href="./delete.php?id=' . $row["id"] . '" class="mb-1"><i class="fa-solid fa-trash-can"></i></a> <a href="./read.php?id=' . $row["id"] . '" class="mb-1"><i class="fa-solid fa-eye"></i></a>' . '</th>';
                            echo '</tr>';
                        }
                    } else {
                        echo "0 results";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
            <a type="button" href="./create.php" class="btn btn-primary">اضافة سجل جديد</a>
        </div>
    </div>

</body>

</html>