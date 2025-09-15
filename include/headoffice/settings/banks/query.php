<?php
    // ADD BANK
	if(isset($_POST['submit_add'])) {

		$condition	=	array ( 
								'select' 	=> "bank_id",
								'where' 	=> array( 
														'bank_name'		=>	cleanvars($_POST['bank_name'])
														,'is_deleted'	=>	'0'	
													),
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(BANKS, $condition)) {
			alert_msg('error', 'Error', 'Record Already Exists');
			header("Location: banks.php", true, 301);
			exit();
		}else{
			$values = array(
							'bank_name'		=>	cleanvars($_POST['bank_name'])
							,'bank_code'	=>	cleanvars($_POST['bank_code'])
							,'bank_status'	=>	cleanvars($_POST['bank_status'])
							,'id_added'		=> 	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							,'date_added'	=>	date('Y-m-d H:i:s')
						   );   
			$sqllms  	= 	$dblms->insert(BANKS, $values);

			if($sqllms) { 
				$bank_id    =	$dblms->lastestid();
				$remarks = 'Add Bank#:'.$bank_id;
				$values = array (
								"id_user"	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,"filename"	=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
								,"action"	=>	'1'
								,"dated"	=>	date('Y-m-d h:i:s')
								,"ip"		=>	cleanvars($ip)
								,"remarks"	=>	cleanvars($remarks)
								);
				$sqllms  = $dblms->insert(LOGS, $values);
				alert_msg('success', 'Success', 'Bank added Successfully.');
				header("Location: banks.php", true, 301);
				exit();
			}
		}
	}

    // EDIT BANK
	if(isset($_POST['submit_edit'])) {

		$condition	=	array ( 
								'select' 	=> "bank_id",
								'where' 	=> array( 
														'bank_name'	=>	cleanvars($_POST['bank_name'])
														,'is_deleted'	=>	'0'	
													),
								'not_equal' 	=> array( 
															'bank_id'	=>	cleanvars($_POST['bank_id'])
														), 
								'return_type' 	=> 'count' 
							  ); 
	
		if($dblms->getRows(BANKS, $condition)) {
			alert_msg('error', 'Error', 'Record Already Exists');
			header("Location: banks.php", true, 301);
			exit();
		}else{

			$values = array(
							'bank_name'         =>    cleanvars($_POST['bank_name'])
							,'bank_code'         =>    cleanvars($_POST['bank_code'])
							,'bank_status'       =>    cleanvars($_POST['bank_status'])
							,'id_modified'       =>    cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							,'date_modified'     =>    date('Y-m-d H:i:s')

						   );   
			$sqllms = $dblms->Update(BANKS , $values , "WHERE bank_id  = '".cleanvars($_POST['bank_id'])."'");

			if($sqllms) { 
				$remarks = 'Update Bank#:'.cleanvars($_POST['bank_id']);
				$values = array (
									"id_user"		  =>	  cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
									,"filename"	  =>	  strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
									,"action"		  =>	  '2'
									,"dated"		  =>	  date('Y-m-d h:i:s')
									,"ip"			  =>	  cleanvars($ip)
									,"remarks" 	  =>	  cleanvars($remarks)
								);
				$sqllms  = $dblms->insert(LOGS, $values);
				alert_msg('info', 'Success', 'Bank Updated Successfully.');
				header("Location: banks.php", true, 301);
				exit();
			}

		}
	}

	// DELETE BANK
	if(isset($_POST['submit_delete'])) {
		
		$values = array(
						'id_deleted'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,'is_deleted'	=>	'1'
						,'ip_deleted'	=>	cleanvars($ip)
						,'date_deleted'	=>	date('Y-m-d H:i:s')
					   );   

		$sqlDel = $dblms->Update(BANKS , $values , "WHERE bank_id  = '".cleanvars($_POST['bank_id'])."'");

		if($sqlDel) { 
			$remarks = 'Delete Bank#:'.cleanvars($_POST['bank_id']);
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
			alert_msg('success', 'Success', 'Bank deleted Successfully.');
			header("Location: banks.php", true, 301);
			exit();
		}
	}
?>