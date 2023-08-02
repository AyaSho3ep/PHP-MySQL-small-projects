<?php
require "conn.php";

$data = $conn->query("SELECT * FROM tasks");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TO Do</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/css/bootstrap.min.css">

<body>

<form class="row justify-content-center my-5" method="POST" action="insert.php">

  <div class="col-auto">
    <input type="text" class="form-control" id="inputPassword2" placeholder="Enter Task" name="task">
  </div>
  <div class="col-auto">
    <input name="submit" type="submit" class="btn btn-primary mb-3" value="Create">

  </div>
</form>


<table class="table w-75 mx-auto">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Task</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php while($rows = $data->fetch(PDO::FETCH_OBJ)): ?>
    <tr>
      <th><?= $rows->id; ?></th>
      <td><?= $rows->name; ?></td>
      <td><a href="delete.php?id=<?=$rows->id; ?>" class="btn btn-danger me-3">Delete</a>
      <a href="update.php?id=<?=$rows->id; ?>" class="btn btn-warning">Update</a></td>
    </tr>
    <?php endwhile ?>
  </tbody>
</table>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>