<?php
require "conn.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $data = $conn->query("SELECT * FROM tasks WHERE id = '$id'");

    $rows = $data->fetch(PDO::FETCH_OBJ);

    if(isset($_POST['submit'])){
        $task = $_POST['task'];
    
        $update = $conn->prepare("UPDATE tasks SET name = :name WHERE id = '$id'");
        $update->execute([':name' => $task]);
    
        header("location: index.php");
    }
}

?>

<form class="row justify-content-center my-5" method="POST" action="update.php?id=<?= $id; ?>">

  <div class="col-auto">
    <input type="text" class="form-control" id="inputPassword2" placeholder="Enter Task" name="task" value='<?= $rows->name; ?>'>
  </div>
  <div class="col-auto">
    <input name="submit" type="submit" class="btn btn-primary" value="Update">
  </div>
</form>