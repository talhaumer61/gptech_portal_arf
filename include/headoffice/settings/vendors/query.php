<?php
    // ADD VENDOR
	if(isset($_POST['submit_add'])) {

		$condition	=	array ( 
								'select' 	=>	'vendor_id',
								'where' 	=>	array( 
														'vendor_cnic'	=>	cleanvars($_POST['vendor_cnic'])
														,'is_deleted'	=>	'0'
													),
								'return_type' 	=> 'count'
							); 
		if($dblms->getRows(VENDORS, $condition)) {
			alert_msg('error', 'Error', 'Record Already Exists');
			header("Location: vendors.php", true, 301);
			exit();
		}else{
			$values = array(
								'vendor_name'			=>	cleanvars($_POST['vendor_name'])
								,'vendor_phone'			=>	cleanvars($_POST['vendor_phone'])
								,'vendor_mobile'		=>	cleanvars($_POST['vendor_mobile'])
								,'vendor_email'			=>	cleanvars($_POST['vendor_email'])
								,'vendor_cnic'			=>	cleanvars($_POST['vendor_cnic'])
								,'vendor_address'		=>	cleanvars($_POST['vendor_address'])
								,'vendor_description'	=>	cleanvars($_POST['vendor_description'])
								,'vendor_status'		=>	cleanvars($_POST['vendor_status'])
								,'id_added'				=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_added'			=>	date('Y-m-d H:i:s')
							); 
			
			$sqllms		= 	$dblms->insert(VENDORS, $values);
			$vendor_id	=	$dblms->lastestid();

			if($sqllms) { 
				$remarks = 'Add Vendor#:'.$vendor_id;
				$values = array (
									"id_user"	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
									,"filename"	=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
									,"action"	=>	'1'
									,"dated"	=>	date('Y-m-d h:i:s')
									,"ip"		=>	cleanvars($ip)
									,"remarks"	=>	cleanvars($remarks)
								);
				$sqllms  = $dblms->insert(LOGS, $values);
				alert_msg('success', 'Success', 'Vendor added Successfully.');
				header("Location: vendors.php", true, 301);
				exit();
			}
		}
	}

    // EDIT VENDOR
	if(isset($_POST['submit_edit'])) {

		$condition	=	array ( 
								'select' 	=> "vendor_id",
								'where' 	=> array( 
														'vendor_cnic'	=>	cleanvars($_POST['vendor_cnic'])
														,'is_deleted'	=>	'0'
													),
								'not_equal' 	=> array( 
														'vendor_id'		=>	cleanvars($_POST['vendor_id'])
													),					
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(VENDORS, $condition)) {
			alert_msg('error', 'Error', 'Record Already Exists');
			header("Location: vendors.php", true, 301);
			exit();
		}else{
			$values = array(
								'vendor_name'			=>	cleanvars($_POST['vendor_name'])
								,'vendor_phone'			=>	cleanvars($_POST['vendor_phone'])
								,'vendor_mobile'		=>	cleanvars($_POST['vendor_mobile'])
								,'vendor_email'			=>	cleanvars($_POST['vendor_email'])
								,'vendor_cnic'			=>	cleanvars($_POST['vendor_cnic'])
								,'vendor_address'		=>	cleanvars($_POST['vendor_address'])
								,'vendor_description'	=>	cleanvars($_POST['vendor_description'])
								,'vendor_status'		=>	cleanvars($_POST['vendor_status'])
								,'id_modified'			=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_modified'		=>	date('Y-m-d H:i:s')

							);   
			$sqllms = $dblms->Update(VENDORS , $values , "WHERE vendor_id  = '".cleanvars($_POST['vendor_id'])."'");

			if($sqllms) { 
				$remarks = 'Update Vendor#:'.cleanvars($_POST['vendor_id']);
				$values = array (
				  "id_user"		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
				  ,"filename"	=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
				  ,"action"		=>	'2'
				  ,"dated"		=>	date('Y-m-d h:i:s')
				  ,"ip"			=>	cleanvars($ip)
				  ,"remarks"	=>	cleanvars($remarks)
				);
				$sqllms  = $dblms->insert(LOGS, $values);
				alert_msg('info', 'Success', 'Vendor Updated Successfully.');
				header("Location: vendors.php", true, 301);
				exit();
			}
		}		
	}

	// DELETE VENDOR
	if(isset($_POST['submit_delete'])) {
		
		$values = array(
						'id_deleted'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,'is_deleted'	=>	'1'
						,'ip_deleted'	=>	cleanvars($ip)
						,'date_deleted'	=>	date('Y-m-d H:i:s')

					   );   
		$sqlDel = $dblms->Update(VENDORS , $values , "WHERE vendor_id  = '".cleanvars($_POST['vendor_id'])."'");

		if($sqlDel) { 
			$remarks = 'Delete Vendor#:'.cleanvars($_POST['vendor_id']);
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
			alert_msg('success', 'Success', 'Vendor deleted Successfully.');
			header("Location: vendors.php", true, 301);
			exit();
		}
	}
?>