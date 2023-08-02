<?php
require "includes/header.php";

$allPosts = $conn->query("SELECT posts.id AS id, posts.title AS title, posts.created_at AS created_at, posts.post_author AS post_author, posts.category AS category, COUNT(replies.post_id) AS num_replies FROM posts LEFT JOIN replies ON posts.id = replies.post_id GROUP BY (replies.post_id)");
$allPosts->execute();

$posts = $allPosts->fetchAll(PDO::FETCH_OBJ);

?>
<!-- Main content -->
<div style="margin-top: 43px;" class="col-lg-9 mb-3">
  <?php foreach($posts as $post) : ?>
  <div class="mt-5 card row-hover pos-relative py-3 px-3 mb-3 border-warning border-top-0 border-right-0 border-bottom-0 rounded-0">
    <div class="row align-items-center">
      <div class="col-md-8 mb-3 mb-sm-0">
        <h5>
          <a href="single.php?id=<?= $post->id;?>" class="text-primary"><?= $post->title?></a>
        </h5>
        <p class="text-sm"><span class="op-6">Posted</span> <?= $post->created_at; ?><a class="text-black" href="#"> By <?= $post->post_author; ?></a></p>
        <div class="text-sm op-5"> <a class="text-black mr-2" href="#"><?= $post->category; ?></a></div>
      </div>
      <div class="col-md-4 op-7">
        <div class="row text-center op-7">
          <div class="col px-1"> <i class="ion-ios-chatboxes-outline icon-1x"></i> <span class="d-block text-sm"><?= $post->num_replies; ?> Replies</span> </div>
        </div>
      </div>
    </div>
  </div>

  <?php endforeach ?>
</div>


<?php
require "includes/footer.php";
?>