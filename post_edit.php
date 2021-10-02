<?php 
$active_link = "home";
require("header.php");
if (!empty($_GET["post_id"]) && ($user["role"] == "admin" || $user["role"] == "editor" ) ){    
    $post_id =$_GET["post_id"];
    require_once("config.php");
    $cn = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, DB_PORT);
    
    if ($user["role"] !="admin")    $cond ="and created_by=" .$user["id"];
    $qry = "select * from posts  where id=$post_id  $cond";
    $rslt = mysqli_query($cn, $qry);
    if ($post = mysqli_fetch_assoc($rslt)){
       // 
    }else{
        header("location:home.php");
    }
    mysqli_close($cn);
}else{
    header("location:home.php");
}

?>
	

<div class="container mt-4">
 
    <h1>Edit Post</h1>
  <div class="row">
      <div class="col-md-6">
        <form action="post_update.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="post_id" value="<?=$post['id']?>">
            <input type="text" name="title" class="form-control m-1" placeholder="Post Title" value="<?=$post['title']?>">
            <textarea name="body" class="form-control m-1" rows="5"  placeholder="Post Body"><?=$post['body']?></textarea>
            <input type="file" name="image" multiple class="form-control m-1">      
            <input type="submit" class="btn btn-light m-1" value="Save">
        </form>
      </div>
      <div class="col-md-4">
          <img class="img img-fluid m-1" src="<?= $post['image']?>"/>
      </div>

  </div>


  <div class="m-5">
    &nbsp;
  </div>
</div>
	<?php require("footer.php")?>