<?php
  require_once "config.php";
  $fname = $lname = $addr = $salary = "";
  // في حالة وجود خطأ في المدخلات
  $name_err = $addr_err = $salary_err = "";

  if(isset($_POST["id"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];
    // التحقق من الاسم
    if(empty($_POST["fname"]) || empty($_POST["lname"])) {
      $name_err = "من فضلك تحقق من الاسم او اللقب";
    } else {
      $fname = trim($_POST["fname"]);
      $lname = trim($_POST["lname"]);
    }
    // التحقق من العنوان
    if(empty($_POST["addr"])) {
      $addr_err = "من فضلك تحقق من العنوان";
    } else {
      $addr = trim($_POST["addr"]);
    }
    // التحقق من الراتب
    $salary_err = trim($_POST["salary"]);
    if(!empty($salary_err) && is_numeric($salary_err) && $salary_err > 0) {
      $salary = $salary_err;
      $salary_err = '';
    } else {
      $salary_err = "من فضلك تحقق من الراتب";
    }
    // التحقق من المدخلات قبل انشاء السجل في قاعدة البيانات 
    if(empty($name_err) && empty($salary_err) && empty($addr_err)) {
      $f_name = $fname . ' ' . $lname;
      $sql = "UPDATE employees SET name='". $f_name."', address='". $addr ."', salary='". $salary ."' WHERE id='". $id ."';";
      if ($conn->query($sql) === TRUE) {
        header("location: index.php");
        exit("تم انشاء سجل جديد");
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
      
      $conn->close();
    }
  } else {
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
      $id =  trim($_GET["id"]);
      $sql = "SELECT * FROM employees WHERE id = '". $id ."';";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $f_name = $row["name"];
          $name_arr = explode(" ", $f_name);
          $fname = $name_arr[0];
          $lname = '';
          for ($x = 1; $x < count($name_arr); $x++) {
            $lname = $lname ." ". $name_arr[$x];
          } 
          $addr = $row["address"];
          $salary = $row["salary"];
      } else {
          echo "حدث خطأ";
       }
      $conn->close();
    }
  }
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>تحديث <?php echo $f_name ?></title>
  <style>
    input {
      text-align: right;
    }
  </style>
</head>
<body>
<?php include 'navbar.php' ?>
    <div class="container text-center">
        <h1 class="">تحديث</h1>
        <div class="container border">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
              <div class="input-group p-3">
                <span class="input-group-text">الاسم و اللقب</span>
                <input type="text" name="fname" value="<?php echo $fname ?>" aria-label="الاسم" placeholder="الاسم" class="form-control <?php echo (!empty($name_err) ? 'is-invalid' : '');?>">
                <input type="text" name="lname" value="<?php echo $lname ?>" aria-label="اللقب" placeholder="اللقب" class="form-control <?php echo (!empty($name_err) ? 'is-invalid' : '');?>">
                <span class="invalid-feedback"><?php echo $name_err;?></span>
              </div>
              <div class="input-group p-3">
                <span class="input-group-text">العنوان</span>
                <input type="text" name="addr" value="<?php echo $addr ?>" aria-label="العنوان" placeholder="العنوان" class="form-control <?php echo (!empty($addr_err) ? 'is-invalid' : '');?>">
                <span class="invalid-feedback"><?php echo $addr_err;?></span>
              </div>
              <div class="input-group p-3">
                <span class="input-group-text">الراتب</span>
                <input name="salary" value="<?php echo $salary ?>" aria-label="الراتب" placeholder="الراتب" class="form-control <?php echo (!empty($salary_err) ? 'is-invalid' : '');?>">
                <span class="invalid-feedback"><?php echo $salary_err;?></span>
              </div>
              <input type="submit" class="btn btn-success mb-3" value="تحديث">
              <input type="hidden" name="id" value="<?php echo $id; ?>"/>
              <a href="./index.php" class="btn btn-primary mb-3">الغاء</a>
              <?php

              ?>
            </form>
          </div>
    </div>

</body>

</html>