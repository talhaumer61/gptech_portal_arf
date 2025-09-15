<?php
    // ADD BUSINESS ACCOUNTS
	if(isset($_POST['submit_add'])) {

		$condition	=	array ( 
								'select'	=>	'businessact_id',
								'where'		=>	array( 
														'businessact_number'	=>	cleanvars($_POST['businessact_number'])
														,'id_bank'				=>	cleanvars($_POST['id_bank'])
														,'is_deleted'			=>	'0'
													),
								'return_type' 	=> 'count'
							);

		if($dblms->getRows(BUSINESSACT, $condition)) {
			// alert_msg('error', 'Error', 'Record Already Exists');
			header("Location: business_accounts.php", true, 301);
			exit();
		}else{
			$values = array(
								'businessact_name'			=>	cleanvars($_POST['businessact_name'])
								,'businessact_number'		=>	cleanvars($_POST['businessact_number'])
								,'businessact_cellno'		=>	cleanvars($_POST['businessact_cellno'])
								,'businessact_description'	=>	cleanvars($_POST['businessact_description'])
								,'businessact_status'		=>	cleanvars($_POST['businessact_status'])
								,'id_bank'					=>	cleanvars($_POST['id_bank'])
								,'id_added'					=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_added'				=>	date('Y-m-d H:i:s')
							);
			$sqllms	=	$dblms->insert(BUSINESSACT, $values);

			if($sqllms) { 
				$idLatest	=	$dblms->lastestid();

				$remarks = 'Add Business Account#:'.$idLatest;
				$values = array (
									"id_user"	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
									,"filename"	=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
									,"action"	=>	'1'
									,"dated"	=>	date('Y-m-d h:i:s')
									,"ip"		=>	cleanvars($ip)
									,"remarks"	=>	cleanvars($remarks)
								);
				$sqllms  = $dblms->insert(LOGS, $values);
				// alert_msg('success', 'Success', 'Region added Successfully.');
				header("Location: business_accounts.php", true, 301);
				exit();
			}
		}
	}

    // EDIT BUSINESS ACCOUNTS
	if(isset($_POST['submit_edit'])) {

		$condition	=	array ( 
								'select' 	=> "businessact_id",
								'where' 	=> array( 
														'businessact_number'	=>	cleanvars($_POST['businessact_number'])
														,'id_bank'				=>	cleanvars($_POST['id_bank'])
														,'is_deleted'			=>	'0'
													),
								'not_equal' 	=> array( 
														'businessact_id'	=>	cleanvars($_POST['businessact_id'])
													),					
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(BUSINESS, $condition)) {
			// alert_msg('error', 'Error', 'Record Already Exists');
			header("Location: business_accounts.php", true, 301);
			exit();
		}else{
			$values = array(
								'businessact_name'			=>	cleanvars($_POST['businessact_name'])
								,'businessact_number'		=>	cleanvars($_POST['businessact_number'])
								,'businessact_cellno'		=>	cleanvars($_POST['businessact_cellno'])
								,'businessact_description'	=>	cleanvars($_POST['businessact_description'])
								,'businessact_status'		=>	cleanvars($_POST['businessact_status'])
								,'id_bank'					=>	cleanvars($_POST['id_bank'])
								,'id_modified'				=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_added'				=>	date('Y-m-d H:i:s')
							);  
			$sqllms = $dblms->Update(BUSINESSACT , $values , "WHERE businessact_id  = '".cleanvars($_POST['businessact_id'])."'");

			if($sqllms) {

				$idLatest	=	cleanvars($_POST['businessact_id']);

				$remarks = 'Edit Business Account#:'.cleanvars($idLatest);
				$values = array (
									"id_user"		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
									,"filename"		=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
									,"action"		=>	'2'
									,"dated"		=>	date('Y-m-d h:i:s')
									,"ip"			=>	cleanvars($ip)
									,"remarks"		=>	cleanvars($remarks)
								);
				$sqllms  = $dblms->insert(LOGS, $values);
				// alert_msg('success', 'Success', 'State Updated Successfully.');
				header("Location: business_accounts.php", true, 301);
				exit();
			}
		}
	}

	// DELETE BUSINESS ACCOUNTS
	if(isset($_POST['submit_delete'])) {
		
		$values = array(
							'id_deleted'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							,'is_deleted'	=>	'1'
							,'ip_deleted'	=>	cleanvars($ip)
							,'date_deleted'	=>	date('Y-m-d H:i:s')
						);   
		$sqlDel = $dblms->Update(BUSINESSACT , $values , "WHERE businessact_id  = '".cleanvars($_POST['businessact_id'])."'");

		if($sqlDel) { 
			$remarks = 'Delete Business Account#:'.cleanvars($_POST['businessact_id']);
			$values = array (
								"id_user"		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,"filename"		=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
								,"action"		=>	'3'
								,"dated"		=>	date('Y-m-d h:i:s')
								,"ip"			=>	cleanvars($ip)
								,"remarks"		=>	cleanvars($remarks)
								,"id_deleted"	=>	cleanvars($_SESSION['adm_id'])
								,"ip_deleted"	=>	cleanvars($ip)
								,'date_deleted'	=>	date('Y-m-d H:i:s')
							);
			$sqllms  = $dblms->insert(LOGS, $values);
			// alert_msg('success', 'Success', 'State deleted Successfully.');
			header("Location: business_accounts.php", true, 301);
			exit();
		}
	}
?>