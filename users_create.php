<?php 
$active_link = "users";
require("header.php");
?>	
<div class="container d-flex justify-content-center mt-4 align-baseline">
			<form class="login100-form" action="users_store.php" method="post">
					<span class="login100-form-title">
						Create New User
					</span>
					<div class="wrap-input100 validate-input 
					<?php if (!empty($_SESSION['errors'] )&&  !empty($_SESSION['errors']['name'])) echo 'alert-validate'?>
					" data-validate = "<?php if (!empty($_SESSION['errors'] )&&  !empty($_SESSION['errors']['name'])) echo $_SESSION['errors']['name']?>">
						<input class="input100" type="text" name="name" placeholder="Name" value="<?php if(!empty($_SESSION["old_values"]["name"] )) echo $_SESSION["old_values"]["name"] ?>">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input <?php if(!empty($_SESSION["errors"]) && !empty($_SESSION["errors"]["email"])) echo 'alert-validate'?>" data-validate = "<?php if(!empty($_SESSION["errors"]) && !empty($_SESSION["errors"]["email"])) echo $_SESSION["errors"]["email"]?>">
						<input class="input100" type="text" name="email" placeholder="Email"  value="<?php if(!empty($_SESSION["old_values"]["email"] )) echo $_SESSION["old_values"]["email"] ?>">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input <?php if(!empty($_SESSION["errors"]) && !empty($_SESSION["errors"]["mobile"])) echo 'alert-validate'?>" data-validate = "<?php if(!empty($_SESSION["errors"]) && !empty($_SESSION["errors"]["mobile"])) echo $_SESSION["errors"]["mobile"]?>">
						<input class="input100" type="text" name="mobile" placeholder="Mobile"  value="<?php if(!empty($_SESSION["old_values"]["mobile"] )) echo $_SESSION["old_values"]["mobile"] ?>">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-phone" aria-hidden="true"></i>
						</span>
						
					</div>

					<div class="wrap-input100 validate-input <?php if(!empty($_SESSION["errors"]) && !empty($_SESSION["errors"]["pass"])) echo 'alert-validate'?>" data-validate = "<?php if(!empty($_SESSION["errors"]) && !empty($_SESSION["errors"]["pass"])) echo $_SESSION["errors"]["pass"]?>">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input <?php if(!empty($_SESSION["errors"]) && !empty($_SESSION["errors"]["pass-confirmation"])) echo 'alert-validate'?>" data-validate = "<?php if(!empty($_SESSION["errors"]) && !empty($_SESSION["errors"]["pass-confirmation"])) echo $_SESSION["errors"]["pass-confirmation"]?>">
						<input class="input100" type="password" name="pass-confirmation" placeholder="Confirm Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 ">
						<input type="radio" name="gender" value="0" checked> Male
						<input  type="radio" name="gender" value="1"> Female						
					</div>	
          <div class="wrap-input100 ">
						<input type="radio" name="role" value="admin" checked> Admin
						<input type="radio" name="role" value="editor" checked> Editor
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Save
						</button>
					</div>
					<div class="text-center p-t-50">
						<a class="txt2" href="index.php">
							Already Register
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>					
				</form>
        </div>
  <div class="m-5">
    &nbsp;
  </div>
</div>
	<?php require("footer.php")?>