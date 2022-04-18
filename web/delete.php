<?php include 'config/database.php'; ?>
<?php 
    $id = $_GET['id'];
    $sql = "DELETE from payroll WHERE id='$id' ";
    if (mysqli_query($conn, $sql)) {
        header('location: index.php');
      } else {
        echo 'Error: ' . mysqli_error($conn);
      }
?>

    
