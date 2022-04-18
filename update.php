<?php include 'config/database.php'; ?>
<?php 
    $id = $_POST['id'];
    $name = $_POST['name'];
    $department = $_POST['department'];
    $salary = $_POST['salary'];
    $resident = $_POST['resident'];
    $sql = "UPDATE payroll SET name='$name', department='$department', salary='$salary', resident='$resident' WHERE id='$id' ";
    if (mysqli_query($conn, $sql)) {
        header('location: index.php');
      } else {
        echo 'Error: ' . mysqli_error($conn);
      }
?>

    
