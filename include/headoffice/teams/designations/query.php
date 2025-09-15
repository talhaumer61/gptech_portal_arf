<?php
    // ADD DESIGNATION
	if(isset($_POST['submit_add'])) {

		$condition	=	array ( 
								'select' 	=> "des_id",
								'where' 	=> array( 
														'des_name'		=>	cleanvars($_POST['des_name'])
														,'is_deleted'	=>	'0'	
													),
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(DESIGNATIONS, $condition)) {
			$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'Record Already Exists';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: designations.php", true, 301);
			exit();
		}else{

			$values = array(
							 'des_name'			=>	cleanvars($_POST['des_name'])
							,'des_code'			=>	cleanvars($_POST['des_code'])
							,'des_status' 		=>	cleanvars($_POST['des_status'])
							,'des_ordering' 	=>	cleanvars($_POST['des_ordering'])
							,'id_added'			=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							,'date_added'		=>	date('Y-m-d H:i:s')
						   ); 

			$sqllms		=	$dblms->insert(DESIGNATIONS, $values);

			if($sqllms) { 
				$des_id  =	$dblms->lastestid();
				$remarks = 'Add Designation#:'.$des_id;
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
				header("Location: designations.php", true, 301);
				exit();
			}
		}
	}

    // EDIT DESIGNATION
	if(isset($_POST['submit_edit'])) {

		$condition	=	array ( 
								'select' 	=> "des_id",
								'where' 	=> array( 
														'des_name'		=>	cleanvars($_POST['des_name'])
														,'is_deleted'	=>	'0'	
													),
								'not_equal' 	=> array( 
														'des_id'		=>	cleanvars($_POST['des_id'])
													),					
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(DESIGNATIONS, $condition)) {
			$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'Record Already Exists';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: designations.php", true, 301);
			exit();
		}else{
		
			$values = array(
								 'des_name'			=>	cleanvars($_POST['des_name'])
								,'des_code'			=>	cleanvars($_POST['des_code'])
								,'des_status' 		=>	cleanvars($_POST['des_status'])
								,'des_ordering' 	=>	cleanvars($_POST['des_ordering'])
								,'id_modify'		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_modify'		=>	date('Y-m-d H:i:s')

						   ); 
			$sqllms = $dblms->Update(DESIGNATIONS , $values , "WHERE des_id  = '".cleanvars($_POST['des_id'])."'");
			if($sqllms) { 
				$remarks = 'Update Designation#:'.cleanvars($_POST['des_id']);
				$values = array (
									"id_user"	=>	  cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
									,"filename"	=>	  strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
									,"action"	=>	  '2'
									,"dated"	=>	  date('Y-m-d h:i:s')
									,"ip"		=>	  cleanvars($ip)
									,"remarks"	=>	  cleanvars($remarks)
								);
				$sqllLog  = $dblms->insert(LOGS, $values);
				$_SESSION['msg']['title'] 	= 'Successfully';
				$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
				$_SESSION['msg']['type'] 	= 'info';
				header("Location: designations.php", true, 301);
				exit();
			}
		}

		
	}

	// DELETE DESIGNATION
	if(isset($_GET['deleteid'])) {
		
		$values = array(
						 'id_deleted'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,'is_deleted'	=>	'1'
						,'ip_deleted'	=>	cleanvars($ip)
						,'date_deleted'	=>	date('Y-m-d H:i:s')
					   );   

		$sqlDel = $dblms->Update(DESIGNATIONS , $values , "WHERE des_id  = '".cleanvars($_GET['deleteid'])."'");

		if($sqlDel) { 
			$remarks = 'Delete Designation#:'.cleanvars($_GET['deleteid']);
			$values = array (
								"id_user"		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,"filename"		=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
								,"action"		=>	'3'
								,"dated"		=>	date('Y-m-d h:i:s')
								,"ip"			=>	cleanvars($ip)
								,"remarks"		=>	cleanvars($remarks)
								,"id_deleted"	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,"ip_deleted"	=>	cleanvars($ip)
								,'date_deleted'	=>	date('Y-m-d H:i:s')
							);
			$sqllms  = $dblms->insert(LOGS, $values);
			$_SESSION['msg']['title'] 	= 'Warning';
			$_SESSION['msg']['text'] 	= 'Record Successfully Deleted.';
			$_SESSION['msg']['type'] 	= 'warning';
			header("Location: designations.php", true, 301);
			exit();
		}
	}
?>