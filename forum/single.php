<?php
require "includes/header.php";

if (isset($_POST['submit'])) {
  if (empty($_POST['author_name']) or empty($_POST['replay'])) {
    echo "<script>alert('Please fill all inputs');</script>";
  } else {
    $author_name = $_POST['author_name'];
    $replay = $_POST['replay'];
    $post_id = $_POST['post_id'];

    $insert = $conn->prepare("INSERT INTO replies (author_name, replay, post_id) 
    VALUES (:author_name, :replay, :post_id)");

    $insert->execute([
      ":author_name" => $author_name,
      ":replay" => $replay,
      ":post_id" => $post_id,
    ]);

    header("location: index.php");
  }
}

// get replies
if (isset($_GET['id'])) {

  $id = $_GET['id'];
  $allReplies = $conn->query("SELECT * FROM replies WHERE post_id = '$id'");
  $allReplies->execute();

  $replies = $allReplies->fetchAll(PDO::FETCH_OBJ);

  // get data for every post
  $singlePost = $conn->query("SELECT * FROM posts WHERE id = '$id'");
  $singlePost->execute();

  $post = $singlePost->fetch(PDO::FETCH_OBJ);
}

?>
<!-- Main content -->
<div style="margin-top: 43px;" class="col-lg-9 mb-3">

  <!-- End of post 1 -->
  <div class="mt-5 card row-hover pos-relative py-3 px-3 mb-3 border-warning border-top-0 border-right-0 border-bottom-0 rounded-0">
    <div class="row align-items-center">
      <div class="col-md-12 mb-3 mb-sm-0">
        <h5>
          <a href="#" class="text-primary"><?= $post->title; ?></a>
        </h5>
        <p><?= $post->body; ?></p>
        <p class="text-sm"><span class="op-6">Posted</span> <a class="text-black" href="#"><?= $post->created_at; ?> by</span> <a class="text-black" href="#"><?= $post->post_author; ?></a></p>
        <div class="text-sm op-5"> <a class="text-black mr-2" href="#"><?= $post->category; ?></a></div>
      </div>

    </div>
  </div>

  <div style="margin-left: 40px;" class="card row-hover pos-relative py-3 px-3 mb-3 border-primary border-top-0 border-right-0 border-bottom-0 rounded-0">
    <div class="row align-items-center">
      <div class="col-md-12 mb-3 mb-sm-0">
        <h5>
          <a href="#" class="text-primary">Write Comment</a>
        </h5>
        <form method="POST" action="single.php?id=1">
          <div class="form-group mb-3">
            <input type="text" class="form-control" name="author_name" placeholder="author name">
          </div>

          <div class="form-group mb-3">
            <textarea class="form-control" name="replay" rows="3"></textarea>
          </div>

          <div class="form-group mb-3">
            <input type="hidden" class="form-control" name="post_id" value="<?= $id; ?>">
          </div>

          <button type="submit" name="submit" class="btn btn-primary">Add Replay</button>

        </form>
      </div>

    </div>
  </div>

  <!-- Replies -->
  <?php
  foreach ($replies as $replay) :
  ?>
    <div style="margin-left: 40px;" class="card row-hover pos-relative py-3 px-3 mb-3 border-primary border-top-0 border-right-0 border-bottom-0 rounded-0">
      <div class="row align-items-center">
        <div class="col-md-12 mb-3 mb-sm-0">
          <h5>
            <a href="#" class="text-primary"><?= $replay->author_name ?></a>
          </h5>
          <p><?= $replay->replay ?></p>
          <p class="text-sm"><span class="op-6">Commented</span> <a class="text-black" href="#"><?= $replay->created_at ?></a></p>
        </div>

      </div>
    </div>

  <?php endforeach ?>

</div>
<?php
require "includes/footer.php";
?>