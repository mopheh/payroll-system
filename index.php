<?php include 'inc/header.php' ?>
<?php 
  $name = $salary = $department = $resident = '';
  $nameErr = $salaryErr = $departmentErr = $residentErr = '';

  if (isset($_POST['submit'])) {
    if (empty($_POST['name'])) {
      $nameErr = 'Name is required';
    } else {
      $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    if (empty($_POST['salary'])) {
      $salaryErr = ' Required';
    } else {
      $salary = filter_input(INPUT_POST, 'salary', FILTER_SANITIZE_SPECIAL_CHARS);
    }

    if (empty($_POST['department'])) {
      $departmentErr = 'Required';
    } else {
      $department = filter_input(INPUT_POST, 'department', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    if (empty($_POST['resident'])) {
      $residentErr = 'Required';
    } else {
      $resident = filter_input(INPUT_POST, 'resident', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    if( empty($nameErr) && empty($salaryErr) && empty($departmentErr) && empty($residentErr) ){
      $sql = "INSERT INTO payroll (name, salary, department, resident) VALUES ('$name', '$salary', '$department', '$resident')";
      if (mysqli_query($conn, $sql)) {
        header('location: index.php');
      } else {
        echo 'Error: ' . mysqli_error($conn);
      }
      
    }

  }
?>
  <table class="table w-75 font-weight-light"> 
    <thead>
      <th>Employee's Name</th>
      <th>Department</th>
      <th>Salary</th>
      <th>Residential Town</th>
      <th></th>
      <th></th>
    </thead>
    
    <tbody>
      <?php
        $sql = 'SELECT * FROM payroll';
        $result = mysqli_query($conn, $sql);
        $payroll = mysqli_fetch_all($result, MYSQLI_ASSOC);
      ?>
      <?php if (empty($payroll)): ?>
          <td><h4>Payroll is Empty.</h4></td>
      <?php endif; ?>
      <?php foreach ($payroll as $employer): ?>
        
        <?php if (isset($_GET['id']) && $employer['id'] == $_GET['id']): ?>

        <tr>
          <form action="update.php" method="POST" class="form-inline">
            <div class="row" >
              <td>
                <div class="col">
                  <input type="text" name="name" class="form-control" value="<?php echo $employer['name'] ?>">
                </div>
              </td>
              <td>
                <div class="col">
                  <input type="text" name="department" class="form-control" value="<?php echo $employer['department'] ?>">
                </div>
              </td>
              <td>
                <div class="col">
                  <input type="text" name="salary" class="form-control" value="<?php echo $employer['salary'] ?>">
                </div>
              </td>
              <td>
                <div class="col">
                  <input type="text" name="resident" class="form-control" value="<?php echo $employer['resident'] ?>">
                </div>
              </td>
              <td>
                <div class="col">
                  <button type="submit" name="submit" class="btn btn-success">Save</button>
                </div>
              </td>
                <input type="hidden" name="id" value="<?php echo $employer['id'] ?>">
            </div>
          </form>
        </tr>

        <?php endif; ?>
        <?php if (!isset($_GET['id']) || $employer['id'] != $_GET['id']): ?>
          <tr>
               
            <td><?php echo $employer['name']; ?></td>
            <td><?php echo $employer['department']; ?></td>
            <td>₦<?php echo number_format($employer['salary']); ?></td>
            <td><?php echo $employer['resident']; ?></td>
            <td><a class="btn btn-primary" href="index.php?id=<?php echo  $employer['id']; ?>" role="button">Edit</a></td>
            <td><a class="btn btn-danger" href="delete.php?id=<?php echo  $employer['id']; ?>" role="button">Delete</a></td>
               
          </tr>
        <?php endif; ?>
        <?php endforeach; ?>
    </tbody>
  </table>
  
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" class="form-inline my-2 justify-content-center">
    <div class="row" >
      <div class="col">

        <input type="text" name="name" class="form-control <?php echo $nameErr ? 'is-invalid' : null ?>" placeholder="Enter Name" >
        <div class="invalid-feedback">
          <?php echo $nameErr; ?>
        </div>

      </div>
      <div class="col">
        <input type="text" name="department" class="form-control mb-3 <?php echo $departmentErr ? 'is-invalid' : null ?>" placeholder="Enter Department">
        <div class="invalid-feedback">
          <?php echo $departmentErr; ?>
        </div>
      </div>
      <div class="col">
        <input type="text" name="salary" class="form-control mb-3 <?php echo $salaryErr ? 'is-invalid' : null ?>" placeholder="Enter Amount">
        <div class="invalid-feedback">
          <?php echo $salaryErr; ?>
        </div>
      </div>
      <div class="col">
        <input type="text" name="resident" class="form-control mb-3 <?php echo $residentErr ? 'is-invalid' : null ?>" placeholder="Enter Residential Town">
        <div class="invalid-feedback">
          <?php echo $residentErr; ?>
        </div>
      </div>
      <div class="col">
        <button type="submit" name="submit" class="btn btn-success">Add</button>
      </div>
    </div>
  </form>
<?php include 'inc/footer.php' ?>
    