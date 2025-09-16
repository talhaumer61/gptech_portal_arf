<?php
    // ADD DONATION
	if(isset($_POST['submit_add'])) {

			$values = array(
							 'status'			=>	cleanvars($_POST['status'])
							,'id_type'			=>	'3'
							,'is_by_portal'		=>	'1'
							,'id_pc_subcat' 	=>	cleanvars($_POST['id_pc_subcat'])
							,'dated' 			=>	date('Y-m-d')
							,'id_donor' 		=>	cleanvars($_POST['id_donor'])
							,'referrals' 		=>	cleanvars($_POST['referrals'])
							,'amount' 			=>	cleanvars($_POST['amount'])
							,'id_added'			=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							,'date_added'		=>	date('Y-m-d H:i:s')
						   ); 
			
			$sqllms		=	$dblms->insert(DONATIONS, $values);

			if($sqllms) { 

				$id    =	$dblms->lastestid();

				$remarks = 'Add Donation#:'.$id ;
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
				header("Location: donations.php", true, 301);
				exit();
			}
	}

    // EDIT DONATION
	if(isset($_POST['submit_edit'])) {

			$values = array(
								'status'			=>	cleanvars($_POST['status'])
								,'id_type'			=>	'3'
								,'is_by_portal'		=>	'1'
								,'id_pc_subcat' 	=>	cleanvars($_POST['id_pc_subcat'])
								,'dated' 			=>	date('Y-m-d')
								,'id_donor' 		=>	cleanvars($_POST['id_donor'])
								,'referrals' 		=>	cleanvars($_POST['referrals'])
								,'amount' 			=>	cleanvars($_POST['amount'])
								,'id_modify'		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_modify'		=>	date('Y-m-d H:i:s')
						   ); 
		
			$sqllms = $dblms->Update(DONATIONS , $values , "WHERE id = '".cleanvars($_POST['id'])."'");

			if($sqllms) { 
				
				$remarks = 'Update Donation#:'.cleanvars($_POST['id']);
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
				header("Location: donations.php", true, 301);
				exit();
			}

		
	}

	// DELETE DONATION
	if(isset($_GET['deleteid'])) {
		
		$values = array(
						 'id_deleted'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,'is_deleted'	=>	'1'
						,'ip_deleted'	=>	cleanvars($ip)
						,'date_deleted'	=>	date('Y-m-d H:i:s')
					   );   

		$sqlDel = $dblms->Update(DONATIONS , $values , "WHERE id  = '".cleanvars($_GET['deleteid'])."'");

		if($sqlDel) { 
			$remarks = 'Delete Donation#:'.cleanvars($_GET['deleteid']);
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
			header("Location: donations.php", true, 301);
			exit();
		}
	}
?>