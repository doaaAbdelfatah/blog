<?php 
$active_link = "home";
require("header.php")
?>
	

<div class="container mt-4">
  <?php if ($user["role"] == "admin" || $user["role"] == "editor"){ ?>
  <div>
  <h1><?=$messages["Make Post"]?></h1>
  <form action="post_create.php" method="POST" enctype="multipart/form-data">
      <input type="text" name="title" class="form-control m-1 mt-5" placeholder="Post Title">
      <textarea name="body" class="form-control m-1" rows="5"  placeholder="Post Body"></textarea>
      <input type="file" name="image" multiple class="form-control m-1">      
      <input type="submit" class="btn btn-light m-1" value="Post">
  </form>
  </div>
  <?php }?>
  <div class="m-5">
    <?php
      if ($user["role"] != "admin")  $status_cond ="status='approved'";
      else $status_cond ="status in ('approved' ,'pending')";

      $qry = "SELECT p.id, p.title, p.body, p.image, p.created_by, p.status, p.action_by, p.created_at ,u.name user_name  FROM posts p join users u  on (u.id = p.created_by) where $status_cond order by p.created_at desc";

      require_once("config.php");
      $cn = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, DB_PORT);
      $rslt = mysqli_query($cn, $qry);
      while($post =mysqli_fetch_assoc($rslt)){
        // var_dump($row);
        ?>
          <div class="row">
            <div class="col mx-2 my-1">
              <div class="card text-white bg-secondary">
                <img class="card-img-top" src="<?= $post['image'] ?>" alt="">
                <div class="card-body">                  
                  <h4 class="card-title"><?= $post['title'] ?></h4>
                  <p class="card-text"><?= $post['body'] ?></p>                  
                  <div class="d-flex justify-content-between">
                    <p class="text-danger">Post by <?= $post['user_name'] ?> at <?= $post['created_at'] ?></p>
                    <div>
                    <?php 
                    
                    if($user["role"] =="admin" && $post["status"] == "pending"){
                      ?>
                      <a href="post_action.php?post_id=<?= $post['id'] ?>&action=approved" class="btn btn-sm btn-success">Approve</a>
                      <a href="post_action.php?post_id=<?= $post['id'] ?>&action=rejected" class="btn btn-sm btn-danger">Reject</a>
                    <?php
                    }elseif($user["id"] == $post["created_by"] || $user["role"] =="admin")
                    {
                    ?>
                    <a href="post_edit.php?post_id=<?= $post['id'] ?>" class="btn btn-sm btn-success">edit</a>
                    <a href="post_delete.php?post_id=<?= $post['id'] ?>" class="btn btn-sm btn-danger">delete</a>
                    <?php
                    }
                    ?>
                    </div>
                  </div>
                </div>
            </div>
            </div>
          </div>
        <?php
      }
  
      mysqli_close($cn);
    
    ?>

  </div>
  <div class="m-5">
    &nbsp;
  </div>
</div>
	<?php require("footer.php")?>