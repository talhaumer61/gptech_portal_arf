<?php
    // ADD STATE
	if(isset($_POST['submit_add'])) {

		$condition	=	array ( 
								'select' 	=>	'state_id',
								'where' 	=>	array( 
														'state_name'	=>	cleanvars($_POST['state_name'])
														,'is_deleted'	=>	'0'
													),
								'return_type' 	=> 'count'
							  ); 
		if($dblms->getRows(STATES, $condition)) {
			$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'Record Already Exists';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: states.php", true, 301);
			exit();
		}else{
			$values = array(
							'state_name'		=>	cleanvars($_POST['state_name'])
							,'state_codedigit'	=>	cleanvars($_POST['state_codedigit'])
							,'state_codealpha'	=>	cleanvars($_POST['state_codealpha'])
							,'state_latitude'	=>	cleanvars($_POST['state_latitude'])
							,'state_longitude'	=>	cleanvars($_POST['state_longitude'])
							,'id_country'		=>	cleanvars($_POST['id_country'])
							,'state_status' 	=>	cleanvars($_POST['state_status'])
							,'state_ordering' 	=>	cleanvars($_POST['state_ordering'])
							,'id_added'			=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							,'date_added'		=>	date('Y-m-d H:i:s')
						   ); 
			$sqllms		=	$dblms->insert(STATES, $values);

			if($sqllms) { 
				$state_id	=	$dblms->lastestid();
				$remarks = 'Add State#:'.$state_id;
				$values = array (
									"id_user"	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
									,"filename"	=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
									,"action"	=>	'1'
									,"dated"	=>	date('Y-m-d h:i:s')
									,"ip"		=>	cleanvars($ip)
									,"remarks"	=>	cleanvars($remarks)
								);
				$sqllms  = $dblms->insert(LOGS, $values);
				$_SESSION['msg']['title'] 	= 'Successfully';
				$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
				$_SESSION['msg']['type'] 	= 'success';
				header("Location: states.php", true, 301);
				exit();
			}
		}
	}

    // EDIT STATE
	if(isset($_POST['submit_edit'])) {

		$condition	=	array ( 
								'select' 	=> "state_id",
								'where' 	=> array( 
														'state_name'	=>	cleanvars($_POST['state_name'])
														,'is_deleted'	=>	'0'	
													),
								'not_equal' 	=> array( 
														'state_id'		=>	cleanvars($_POST['state_id'])
													),					
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(STATES, $condition)) {
			$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'Record Already Exists';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: states.php", true, 301);
			exit();
		}else{
			$values = array(
							'state_name'		=>	cleanvars($_POST['state_name'])
							,'state_codedigit'	=>	cleanvars($_POST['state_codedigit'])
							,'state_codealpha'	=>	cleanvars($_POST['state_codealpha'])
							,'state_latitude'	=>	cleanvars($_POST['state_latitude'])
							,'state_longitude'	=>	cleanvars($_POST['state_longitude'])
							,'id_country'		=>	cleanvars($_POST['id_country'])
							,'state_status'		=>	cleanvars($_POST['state_status'])
							,'state_ordering' 	=>	cleanvars($_POST['state_ordering'])
							,'id_modify'		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							,'date_modify'		=>	date('Y-m-d H:i:s')
						);  
			$sqllms = $dblms->Update(STATES , $values , "WHERE state_id  = '".cleanvars($_POST['state_id'])."'");

			if($sqllms) { 
				$remarks = 'Add State#:'.$state_id;
				$values = array (
									"id_user"		=>	cleanvars($_SESSION['adm_id'])
									,"filename"	=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
									,"action"		=>	'1'
									,"dated"		=>	date('Y-m-d h:i:s')
									,"ip"			=>	cleanvars($ip)
									,"remarks"		=>	cleanvars($remarks)
								);
				$sqllms  = $dblms->insert(LOGS, $values);
				$_SESSION['msg']['title'] 	= 'Successfully';
				$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
				$_SESSION['msg']['type'] 	= 'info';
				header("Location: states.php", true, 301);
				exit();
			}
		}

		
	}

	// DELETE STATE
	if(isset($_GET['deleteid'])) {
		
		$values = array(
						'id_deleted'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,'is_deleted'	=>	'1'
						,'ip_deleted'	=>	cleanvars($ip)
						,'date_deleted'	=>	date('Y-m-d H:i:s')

					   );   
		$sqlDel = $dblms->Update(STATES , $values , "WHERE state_id  = '".cleanvars($_GET['deleteid'])."'");

		if($sqlDel) { 
			$remarks = 'Delete State#:'.cleanvars($_GET['deleteid']);
			$values = array (
								"id_user"		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,"filename"		=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
								,"action"		=>	'3'
								,"dated"			=>	date('Y-m-d h:i:s')
								,"ip"			=>	cleanvars($ip)
								,"remarks"		=>	cleanvars($remarks)
								,"id_deleted"	=>	cleanvars($_SESSION['adm_id'])
								,"ip_deleted"	=>	cleanvars($ip)
								,'date_deleted'	=>	date('Y-m-d H:i:s')
							);
			$sqllms  = $dblms->insert(LOGS, $values);
			$_SESSION['msg']['title'] 	= 'Warning';
			$_SESSION['msg']['text'] 	= 'Record Successfully Deleted.';
			$_SESSION['msg']['type'] 	= 'warning';
			header("Location: states.php", true, 301);
			exit();
		}
	}
?>