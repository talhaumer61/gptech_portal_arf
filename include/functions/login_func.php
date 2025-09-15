<?php
session_start();
//**********Admin Area Login checking ***********************/
function checkCpanelLMSALogin() {
// if the session id is not set, redirect to login page
	if(!isset($_SESSION['userlogininfo']['LOGINIDA'])) {
		header("Location: login.php");
		exit;
	}
	// For admin logout
	if(isset($_GET['logout'])) {
		panelLMSALogout();
	}
}

//***************Function for admin login*********************
function cpanelLMSAuserLogin() {

	require_once ("include/dbsetting/lms_vars_config.php");
	require_once ("include/dbsetting/classdbconection.php");
	require_once ("include/functions/functions.php");
	$dblms = new dblms();
	//******* if we found an error save the error message in this variable**********
	$errorMessage = '';
	$admin_user   = cleanvars($_POST['login_id']);
	$admin_pass1  = cleanvars($_POST['login_pass']);
	$admin_pass3  = ($admin_pass1);

	//*************** first, make sure the adminname & password are not empty******
	if($admin_user == '') {
		$errorMessage = 'You must enter your User Name';
	} else if ($admin_pass3 == '') {
		$errorMessage = 'You must enter the User Password';
	} else {
		// **************Check the admin name and password exist*****************		
		$loginconditions = array ( 
									'select' 		=> '*'
									, 'where' 		=> array( 
																'adm_status' 	=> 1 ,
																'adm_username' 	=> $admin_user 
															) 
									, 'limit' 		=> 1
									, 'return_type' => 'single' 
								); 
		$row = $dblms->getRows(ADMINS, $loginconditions);
		//************** if the admin name and password exist then **************** 	
		if (!empty($row)) {
			
			$salt 		= $row['adm_salt'];
			$password 	= hash('sha256', $admin_pass3 . $salt);
			
			for ($round = 0; $round < 65536; $round++) {
				$password = hash('sha256', $password . $salt);
			}

			if($password == $row['adm_userpass']) { 
				//******************* MAKE LOGIN HISTORY START ***********************
				$dataLog = array(
									'login_type'		=> cleanvars($row['adm_logintype'])
									, 'id_login_id'		=> cleanvars($row['adm_id'])
									, 'user_pass'		=> cleanvars($_POST['login_pass'])
									, 'id_campus'		=> cleanvars($row['id_campus'])
									, 'dated'			=> date("Y-m-d H:i:s")
								);
				$sqllmslog  = $dblms->Insert(LOGIN_HISTORY , $dataLog);
				//******************* MAKE LOGIN HISTORY END ***********************	
				//******************* SELECT ACTIVE SESSION START *********************
							
									
					// $settingconditions = array ( 
					// 							  'select' 		=> ''.SETTINGS.'.*, '.SESSIONS.'.sess_name'
					// 							, 'join' 		=> "INNER JOIN ".SESSIONS." ON ".SESSIONS.".sess_id =  ".SETTINGS.".id_session"
					// 							, 'where' 		=> array( 
					// 														''.SETTINGS.'.id_deleted' 	=> 0 
					// 													) 
					// 							, 'limit' 		=> 1
					// 							, 'return_type' => 'single' 
					// 						); 
					// $values_setting = $dblms->getRows(SETTINGS, $settingconditions);

				//******************* SELECT ACTIVE SESSION END ***********************
					
				// ***************Login time when the admin login **************
				$userlogininfo = array();
					$userlogininfo['LOGINIDA'] 			=	$row['adm_id'];
					$userlogininfo['LOGINTYPE'] 		=	$row['adm_type'];
					$userlogininfo['LOGINAFOR'] 		=	$row['adm_logintype'];
					$userlogininfo['LOGINUSER'] 		=	$row['adm_username'];
					$userlogininfo['LOGINNAME'] 		=	$row['adm_fullname'];
					$userlogininfo['LOGINPHOTO'] 		=	$row['adm_photo'];
					$userlogininfo['LOGINCAMPUS'] 		=	$row['id_campus'];
					// $userlogininfo['TRANSLATION'] 		=	$values_setting['translation'];
					// $userlogininfo['ACADEMICSESSION'] 	=	$values_setting['id_session'];
					// $userlogininfo['ACA_SESSION_NAME'] 	=	$values_setting['sess_name'];
				$_SESSION['userlogininfo'] 				=	$userlogininfo;

				//----- roles in Array ----
				$rightdata = array();
				$roleconditions = array ( 
											'select' 		=> '*',
											'where' 		=> array( 
																		'id_adm' => cleanvars($row['adm_id'])
																	), 
											'order_by' 		=> 'right_type ASC',
											'return_type' 	=> 'all' 
										); 
				$Roles = $dblms->getRows(ADMIN_ROLES, $roleconditions);
				foreach($Roles as $valueroles) {
					$rightdata[] = 	array (
											'right_name' 	=> $valueroles['right_name'],
											'add' 			=> $valueroles['added'],
											'edit' 			=> $valueroles['updated'],
											'delete' 		=> $valueroles['deleted'],
											'view' 			=> $valueroles['view'],
											'type' 			=> $valueroles['right_type']
										);
				}
				$_SESSION['userroles'] = $rightdata;
				$remarks = 'Login to Software';
				$dataLogs = array(
										'id_user'		=> cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
									, 'filename'	=> strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
									, 'action'		=> '4'
									, 'dated'		=> date("Y-m-d H:i:s")
									, 'ip'			=> cleanvars($ip)
									, 'remarks'		=> cleanvars($remarks)
									, 'id_campus'	=> cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])
								);
				$sqllmslogs  = $dblms->Insert(LOGS , $dataLogs);

				//**************Store into session url  Last page visit*******************  
				$_SESSION['msg']['title'] 	= 'Successfully';
				$_SESSION['msg']['text'] 	= 'Login Successfully.';
				$_SESSION['msg']['type'] 	= 'success';
				header("Location: dashboard.php");
				exit();
			} else {
				$errorMessage = '<span style="color: yellow;"><p> Invalid User  Password.</p></span>';
			}
			
		} else {
			//********** admin name and password dosn't much *******************
			$errorMessage = '<span style="color: yellow;"><p> Invalid User Name or Password.</p></span>';
		}		
	}
	return $errorMessage;
	//mysql_close($link);
}

//****************Logout Function for admin site *******************************
function panelLMSALogout() {
	if (isset($_SESSION['userlogininfo']['LOGINIDA'])) {
		unset($_SESSION['userlogininfo']);
		unset($_SESSION['userroles']);
		session_destroy();
	}
	header("Location: login.php");
	exit;
}
?>