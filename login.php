<?php 
 	include "include/dbsetting/lms_vars_config.php"; 	
	include "include/functions/login_func.php";
if(isset($_SESSION['userlogininfo']['LOGINIDA'])) {
	$_SESSION['msg']['title'] 	= 'Successfully';
	$_SESSION['msg']['text'] 	= 'Login Successfully.';
	$_SESSION['msg']['type'] 	= 'success';
	header("Location: dashboard.php");	
} else { 

	$login_id = (isset($_POST['login_id']) && $_POST['login_id'] != '') ? $_POST['login_id'] : '';	
	$errorMessage = '';
	if (isset($_POST['login_id'])) {
		$result = cpanelLMSAuserLogin();
		if ($result != '') {
			$errorMessage = $result;
		}
	}
	include "login/header.php";
	echo '
    <div class="page-wrapper default-version">
        <div class="form-area bg_img" data-background="login/images/1.jpg">
            <div class="form-wrapper">
                <h4 class="logo-text mb-15">Welcome to <strong>Apportion</strong></h4>
                <p>Admin Login to <strong>Apportion</strong></p>
				<form method="post" class="cmn-form mt-20" accept-charset="utf-8" name="frmLogin" id="frmLogin">';
				if($errorMessage) {
					echo $errorMessage;
				}
				echo '
					<div class="form-group">
                        <label for="email">Username</label>
                        <input type="text" name="login_id" class="form-control b-radius--capsule" autofocus required id="login_id" autocomplete="off" value="'.$login_id.'" placeholder="Enter your username">
                        <i class="las la-user input-icon"></i>
                    </div>
                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="password" name="login_pass" class="form-control b-radius--capsule" required value="" autocomplete="off" id="login_pass" placeholder="Enter your password">
                        <i class="las la-lock input-icon"></i>
                    </div>

                    <div class="form-group d-flex justify-content-between align-items-center">
                        <a href="#" class="text-muted text--small"><i class="las la-lock"></i>Forgot password?</a>
                    </div>

                    <div class="form-group">
                        <button type="submit" id="btn_submit" class="submit-btn mt-25 b-radius--capsule">Login <i class="las la-sign-in-alt"></i></button>
                    </div>
                </form>
				<div style="clear:both;"></div>
				<!-- footer --> 
				<footer id="footer" style="margin-top:20px;">
					<div class="text-center padder">
						<p> <small>'.COPY_RIGHTS_ORG.'
						<br>Powered by: <a href="'.COPY_RIGHTS_URL.'">'.COPY_RIGHTS.'</a>  v1.0</small></p>
					</div>
				</footer>
				<!-- / footer -->
            </div>	

        </div>
		<!-- login-area end -->  

    </div>';
	include "login/footer.php";
}
?>