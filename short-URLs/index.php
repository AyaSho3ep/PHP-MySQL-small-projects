<?php
require "config.php";

$select = $conn->query('SELECT * FROM urls');
$select->execute();

$rows = $select->fetchAll(PDO::FETCH_OBJ);

if(isset($_POST['submit'])){
    if($_POST['url'] == ''){
        echo "Please enter the rquired URL";
    }else{
        $url = $_POST['url'];

        $insert = $conn->prepare("INSERT INTO urls (url) VALUES (:url)");
        $insert->execute([
            ':url' => $url
        ]);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <!-- bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- font awesome -->
    <link rel="stylesheet" href="css/all.min.css">

    <style>
        body {
            overflow: hidden;
        }

        .margin {
            margin-top: 200px
        }
    </style>
</head>

<body>

    <div class="conatiner">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <form class="card p-2 margin" method="POST" action="index.php">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Enter url" name="url">
                        <div class="input-group-append">
                            <button type="submit" name="submit" class="btn btn-success">Shorten</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="conatiner" id="refresh">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th scope="col">URL</th>
                            <th scope="col">Shorten URL</th>
                            <th scope="col">Clicks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($rows as $row) : ?>
                        <tr>
                            <th scope="row"><?= $row->url ?></th>
                            <td><a href="http://localhost/short-URLs/origin?id=<?= $row->id; ?>" target="_blank">http://localhost/short-URLs/origin?id=<?= $row->id; ?></a></td>
                            <td><?= $row->clicks ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- jquery&bootstrap -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- font awesome -->
    <script src="js/all.min.js"></script>

    <script>
        $(document).ready(function(){
            $("#refresh").click(function(){
                setInterval(function(){
                    $("body").load('index.php')
                }, 1000);
            });
        });
    </script>
</body>

</html>