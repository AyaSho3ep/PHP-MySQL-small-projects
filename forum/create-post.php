<?php
require "includes/header.php";

$errors = [];

if (isset($_POST['submit'])) {

  if (empty($_POST['title']) or empty($_POST['post_author']) or empty($_POST['category']) or empty($_POST['body'])) {
    $errors['form']= "<div class='text-white font-weight-bold bg-danger mb-5'>All fields are requird</div>";
  } 
  else {
    $title = $_POST['title'];
    $post_author = $_POST['post_author'];
    $category = $_POST['category'];
    $body = $_POST['body'];

    $insert = $conn->prepare("INSERT INTO posts (title, post_author, category, body) 
    VALUES (:title, :post_author, :category, :body)");

    $insert->execute([
      ":title" => $title,
      ":post_author" => $post_author,
      ":category" => $category,
      ":body" => $body,
    ]);

    header("location: index.php");
  }
}

// categories

  $categories = $conn->query("SELECT * FROM categories");
  $categories->execute();
  
  $all_cats = $categories->fetchAll(PDO::FETCH_OBJ);
?>

<!-- Main content -->
<div style="margin-top: 57px;" class="col-lg-9 mb-3">

  <form method="POST" action="create-post.php" class="w-75 text-center">

    <div class="mb-3">
      <input type="text" name="title" class="form-control" placeholder="title">
    </div>

    <div class="form-group mb-3">
      <textarea class="form-control" name="body" placeholder="Write Body" rows="3"></textarea>
    </div>

    <div class="mb-3">
      <input type="text" name="post_author" class="form-control" placeholder="Author name">
    </div>

    <select name="category" class="form-select mb-5" aria-label="Default select example">
      <label class="form-label">Choose Category</label>

      <option selected>Choose Category</option>
      <?php foreach($all_cats AS $category) : ?>
      <option value="<?= $category->name; ?>"><?= $category->name; ?></option>
      <?php endforeach ?>
    </select>

    <?= $errors['form'] ?? "" ?>

    <button type="submit" name="submit" class="btn btn-primary w-50">Submit</button>

  </form>

</div>

<?php
require "includes/footer.php";
?>