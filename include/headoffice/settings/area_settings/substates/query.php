<?php
    // ADD COUNTRY
	if(isset($_POST['submit_add'])) {

		$condition	=	array ( 
								'select' 	=> "substate_id",
								'where' 	=> array( 
														'substate_name'	=>	cleanvars($_POST['substate_name'])
														,'is_deleted'	=>	'0'	
													),
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(SUB_STATES, $condition)) {
			$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'Record Already Exists';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: substates.php", true, 301);
			exit();
		}else{

			$values = array(
							'substate_name'			=>    cleanvars($_POST['substate_name'])
							,'substate_latitude'    =>    cleanvars($_POST['substate_latitude'])
							,'substate_longitude'   =>    cleanvars($_POST['substate_longitude'])
							,'id_country'           =>    cleanvars($_POST['id_country'])
							,'id_state'             =>    cleanvars($_POST['id_state'])
							,'substate_status'      =>    cleanvars($_POST['substate_status'])
							,'substate_ordering'    =>    cleanvars($_POST['substate_ordering'])
							,'id_added'             =>    cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							,'date_added'        	=>    date('Y-m-d H:i:s')
						   );   
			$sqllms  		= 	$dblms->insert(SUB_STATES, $values);
			$substate_id    =	$dblms->lastestid();

			if($sqllms) { 
				$remarks = 'Add Sub State#:'.$substate_id;
				$values = array (
									"id_user"		  =>	  cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
									,"filename"	  =>	  strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
									,"action"		  =>	  '1'
									,"dated"		  =>	  date('Y-m-d h:i:s')
									,"ip"			  =>	  cleanvars($ip)
									,"remarks" 	  =>	  cleanvars($remarks)
								);
				$sqllms  = $dblms->insert(LOGS, $values);
				$_SESSION['msg']['title'] 	= 'Successfully';
				$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
				$_SESSION['msg']['type'] 	= 'success';
				header("Location: substates.php", true, 301);
				exit();
			}
		}
	}

    // EDIT COUNTRY
	if(isset($_POST['submit_edit'])) {
		
		$condition	=	array ( 
								'select' 	=> "substate_id",
								'where' 	=> array( 
														'substate_name'	=>	cleanvars($_POST['substate_name'])
														,'is_deleted'	=>	'0'	
													),
								'not_equal' 	=> array( 
															'substate_id'	=>	cleanvars($_POST['substate_id'])
														),
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(SUB_STATES, $condition)) {
			$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'Record Already Exists';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: substates.php", true, 301);
			exit();
		}else{
			$values = array(
								'substate_name'         =>    cleanvars($_POST['substate_name'])
								,'substate_latitude'    =>    cleanvars($_POST['substate_latitude'])
								,'substate_longitude'	=>    cleanvars($_POST['substate_longitude'])
								,'id_country'           =>    cleanvars($_POST['id_country'])
								,'id_state'             =>    cleanvars($_POST['id_state'])
								,'substate_status'      =>    cleanvars($_POST['substate_status'])
								,'substate_ordering'    =>    cleanvars($_POST['substate_ordering'])
								,'id_modify'            =>    cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_modify'          =>    date('Y-m-d H:i:s')

							);  
			$sqllms = $dblms->Update(SUB_STATES , $values , "WHERE substate_id  = '".cleanvars($_POST['substate_id'])."'");

			if($sqllms) { 
				$remarks = 'Update Sub State#:'.cleanvars($_POST['substate_id']);
				$values = array (
									"id_user"	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
									,"filename"	=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
									,"action"	=>	'2'
									,"dated"	=>	date('Y-m-d h:i:s')
									,"ip"		=>	cleanvars($ip)
									,"remarks"	=>	cleanvars($remarks)
								);
				$sqllms  = $dblms->insert(LOGS, $values);
				$_SESSION['msg']['title'] 	= 'Successfully';
				$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
				$_SESSION['msg']['type'] 	= 'info';
				header("Location: substates.php", true, 301);
				exit();
			}

		}
	}

	// DELETE COUNTRY
	if(isset($_GET['deleteid'])) {
		
		$values = array(
						'id_deleted'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,'is_deleted'	=>	'1'
						,'ip_deleted'	=>	cleanvars($ip)
						,'date_deleted'	=>	date('Y-m-d H:i:s')
					   );   
		$sqlDel = $dblms->Update(SUB_STATES , $values , "WHERE substate_id  = '".cleanvars($_GET['deleteid'])."'");

		if($sqlDel) { 
			$remarks = 'Delete Sub State#:'.cleanvars($_GET['deleteid']);
			$values = array (
								"id_user"		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,"filename"	  	=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
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
			header("Location: substates.php", true, 301);
			exit();
		}
	}
?>