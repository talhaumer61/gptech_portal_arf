<?php
    // ADD REGION
	if(isset($_POST['submit_add'])) {

		$condition	=	array ( 
								'select' 	=> "region_id",
								'where' 	=> array( 
														'region_name'		=>	cleanvars($_POST['region_name'])
														,'is_deleted'	=>	'0'	
													),
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(REGIONS, $condition)) {
			$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'Record Already Exists';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: regions.php", true, 301);
			exit();
		}else{

			$values = array(
							 'region_name'			=>	cleanvars($_POST['region_name'])
							,'region_codedigit'		=>	cleanvars($_POST['region_codedigit'])
							,'region_codealpha'		=>	cleanvars($_POST['region_codealpha'])
							,'id_parentregion'		=>	cleanvars($_POST['id_parentregion'])
							,'region_status' 		=>	cleanvars($_POST['region_status'])
							,'region_ordering' 		=>	cleanvars($_POST['region_ordering'])
							,'id_added'				=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							,'date_added'			=>	date('Y-m-d H:i:s')
						   ); 

			$sqllms		=	$dblms->insert(REGIONS, $values);

			if($sqllms) { 
				$region_id  =	$dblms->lastestid();
				$remarks = 'Add Region#:'.$region_id;
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
				header("Location: regions.php", true, 301);
				exit();
			}
		}
	}

    // EDIT REGION
	if(isset($_POST['submit_edit'])) {

		$condition	=	array ( 
								'select' 	=> "region_id",
								'where' 	=> array( 
														'region_name'		=>	cleanvars($_POST['region_name'])
														,'is_deleted'	=>	'0'	
													),
								'not_equal' 	=> array( 
														'region_id'		=>	cleanvars($_POST['region_id'])
													),					
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(REGIONS, $condition)) {
			$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'Record Already Exists';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: regions.php", true, 301);
			exit();
		}else{
		
			$values = array(
							 'region_name'		=>	cleanvars($_POST['region_name'])
							,'region_codedigit'	=>	cleanvars($_POST['region_codedigit'])
							,'region_codealpha'	=>	cleanvars($_POST['region_codealpha'])
							,'id_parentregion'	=>	cleanvars($_POST['id_parentregion'])
							,'region_status'	=>	cleanvars($_POST['region_status'])
							,'region_ordering' 		=>	cleanvars($_POST['region_ordering'])
							,'id_modify'		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							,'date_modify'		=>	date('Y-m-d H:i:s')

						   ); 
			$sqllms = $dblms->Update(REGIONS , $values , "WHERE region_id  = '".cleanvars($_POST['region_id'])."'");
			if($sqllms) { 
				$remarks = 'Update Region#:'.cleanvars($_POST['region_id']);
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
				header("Location: regions.php", true, 301);
				exit();
			}
		}

		
	}

	// DELETE REGION
	if(isset($_GET['deleteid'])) {
		
		$values = array(
						 'id_deleted'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,'is_deleted'	=>	'1'
						,'ip_deleted'	=>	cleanvars($ip)
						,'date_deleted'	=>	date('Y-m-d H:i:s')
					   );   

		$sqlDel = $dblms->Update(REGIONS , $values , "WHERE region_id  = '".cleanvars($_GET['deleteid'])."'");

		if($sqlDel) { 
			$remarks = 'Delete Region#:'.cleanvars($_GET['deleteid']);
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
			header("Location: regions.php", true, 301);
			exit();
		}
	}
?>