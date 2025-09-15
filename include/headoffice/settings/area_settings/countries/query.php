<?php
    // ADD COUNTRY
	if(isset($_POST['submit_add'])) {

		$condition	=	array ( 
								'select' 	=> "country_id",
								'where' 	=> array( 
														'country_name'		=>	cleanvars($_POST['country_name'])
														,'is_deleted'	=>	'0'	
													),
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(COUNTRIES, $condition)) {
			$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'Record Already Exists';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: countries.php", true, 301);
			exit();
		}else{
		
			$values = array(
								'country_name'			=>	cleanvars($_POST['country_name'])
								,'country_callingcode'	=>	cleanvars($_POST['country_callingcode'])
								,'country_iso2digit'	=>	cleanvars($_POST['country_iso2digit'])
								,'country_iso3digit'	=>	cleanvars($_POST['country_iso3digit'])
								,'country_latitude'		=>	cleanvars($_POST['country_latitude'])
								,'country_longitude'	=>	cleanvars($_POST['country_longitude'])
								,'id_timezone'			=>	cleanvars($_POST['id_timezone'])
								,'id_currency'			=>	cleanvars($_POST['id_currency'])
								,'id_region'			=>	cleanvars($_POST['id_region'])
								,'country_status'		=>	cleanvars($_POST['country_status'])
								,'country_ordering'		=>	cleanvars($_POST['country_ordering'])
								,'id_added'				=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_added'			=>	date('Y-m-d H:i:s')
							);   
			$sqllms  	 = $dblms->insert(COUNTRIES, $values);

			if($sqllms) { 
				$country_id  =	$dblms->lastestid();
				$remarks = 'Add Country#:'.$country_id;
				$values = array (
									"id_user"		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
									,"filename"	=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
									,"action"		=>	'1'
									,"dated"		=>	date('Y-m-d h:i:s')
									,"ip"			=>	cleanvars($ip)
									,"remarks"	=>	cleanvars($remarks)
								);
				$sqllms  = $dblms->insert(LOGS, $values);
				$_SESSION['msg']['title'] 	= 'Successfully';
				$_SESSION['msg']['text'] 	= 'Record Successfully Added.';
				$_SESSION['msg']['type'] 	= 'success';
				header("Location: countries.php", true, 301);
				exit();
			}
		}
	}

    // EDIT COUNTRY
	if(isset($_POST['submit_edit'])) {

		$condition	=	array ( 
								'select' 	=> "country_id",
								'where' 	=> array( 
														'country_name'		=>	cleanvars($_POST['country_name'])
														,'is_deleted'	=>	'0'	
													),
								'not_equal'	=>	array( 
														'country_id'		=>	cleanvars($_POST['country_id'])	
													),
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(COUNTRIES, $condition)) {
			$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'Record Already Exists';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: countries.php", true, 301);
			exit();
		}else{
		
			$values = array(
								'country_name'			=>	cleanvars($_POST['country_name'])
								,'country_callingcode'	=>  cleanvars($_POST['country_callingcode'])
								,'country_iso2digit'	=>  cleanvars($_POST['country_iso2digit'])
								,'country_iso3digit'	=>  cleanvars($_POST['country_iso3digit'])
								,'country_latitude'		=>  cleanvars($_POST['country_latitude'])
								,'country_longitude'	=>  cleanvars($_POST['country_longitude'])
								,'id_timezone'			=>  cleanvars($_POST['id_timezone'])
								,'id_currency'			=>  cleanvars($_POST['id_currency'])
								,'id_region'			=>  cleanvars($_POST['id_region'])
								,'country_status'       =>  cleanvars($_POST['country_status'])
								,'country_ordering'		=>	cleanvars($_POST['country_ordering'])
								,'id_modify'          	=>  cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_modify'        	=>  date('Y-m-d H:i:s')

						   );   

			$sqllms = $dblms->Update(COUNTRIES , $values , "WHERE country_id  = '".cleanvars($_POST['country_id'])."'");

			if($sqllms) { 
				$remarks = 'Update Country#:'.cleanvars($_POST['country_id']);
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
				header("Location: countries.php", true, 301);
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
		$sqlDel = $dblms->Update(COUNTRIES , $values , "WHERE country_id  = '".cleanvars($_GET['deleteid'])."'");

		if($sqlDel) { 
			$remarks = 'Delete Country#:'.cleanvars($_GET['deleteid']);
			$values = array (
								"id_user"		=>	  cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,"filename"		=>	  strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
								,"action"		=>	  '3'
								,"dated"		=>	  date('Y-m-d h:i:s')
								,"ip"			=>	  cleanvars($ip)
								,"remarks"		=>	  cleanvars($remarks)
								,"id_deleted"	=>	  cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,"ip_deleted"	=>	  cleanvars($ip)
								,'date_deleted'	=>	  date('Y-m-d H:i:s')
							);
			$sqllms  = $dblms->insert(LOGS, $values);
			$_SESSION['msg']['title'] 	= 'Warning';
			$_SESSION['msg']['text'] 	= 'Record Successfully Deleted.';
			$_SESSION['msg']['type'] 	= 'warning';
			header("Location: currencies.php", true, 301);
			header("Location: countries.php", true, 301);
			exit();
		}
	}
?>