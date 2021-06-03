<?php
require("config/config.php");
require("lib/db.php");
$conn = db_init($config["host"], $config["duser"],  $config["dpw"], $config["dname"]);
$result = mysqli_query($conn, "SELECT * FROM topic");
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <link rel="shortcut icon" href="J.png" />
    <title>전생일기</title>
    <link href="http://localhost/bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">
    <style media="screen">
      body.white{
        background-color: white;
        color: black;
      }
      body.black{
        background-color: black;
        color: white;
      }
      #logo{
        width:100px;
      }

    </style>
  </head>
  <body id="target">
    <div class="container">
      <header class="jumbotron text-center">
        <img src="J.png" alt="전" class="img-circle" id="logo">
          <div><h1><a href="/index.php?id"  text-decoration= target="" title="전공자">Jeon's Life Diary</a></h1>  </div>
      </header>
      <div class="row">
        <nav class="col-md-3">
          <ol class="nav nav-pills nav-stacked">
        <?php
         //echo file_get_contents("list.txt");
         while($row = mysqli_fetch_assoc($result)){
           echo '<li><a href="/index.php?id='.$row['id'].'">'.htmlspecialchars($row['title']).'</a></li>'."\n";
         }
         ?>
       </ol>
      </nav>
      <div class="col-md-9">
            <article class="">
        <?php
        if (empty($_GET['id'])===false) {
          $sql = 'SELECT * FROM topic WHERE id='.$_GET['id'];
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);
          echo '<h2>'.htmlspecialchars($row['title']).'</h2>';
          echo '<p>'.htmlspecialchars($row['author']).'</p>';
          echo strip_tags($row['description'].'<a><h1><h2><h3><h4><h5><ul><ol><li>');
        }
         ?>
          </article>
          <hr>
          <div id="control">
            <div class="btn-group" role="group" aria-label="...">
              <input type="button" value="white" onclick="document.getElementById('target').className='white'" class="btn btn-default btn-lg"/>
              <input type="button" value="black" onclick="document.getElementById('target').className='black'" class="btn btn-default btn-lg"/>
            </div>
            <a href="write.php" class="btn btn-info btn-lg">쓰기</a>
          </div>
        </div>
      </div>
    </div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   <!-- Include all compiled plugins (below), or include individual files as needed -->
   <script src="bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
  </body>
  <script src="javascript.js"></script>
</html>
