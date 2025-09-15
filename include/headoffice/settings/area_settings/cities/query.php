<?php
    // ADD CITY
	if(isset($_POST['submit_add'])) {

		$condition	=	array ( 
								'select' 	=>	'city_id',
								'where' 	=>	array( 
														'city_name'	=>	cleanvars($_POST['city_name'])
														,'is_deleted'	=>	'0'
													),
								'return_type' 	=> 'count'
							); 
		if($dblms->getRows(CITIES, $condition)) {
			alert_msg('error', 'Error', 'Record Already Exists');$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'Record Already Exists';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: cities.php", true, 301);
			exit();
		}else{
			$values = array(
								'city_name'			=>	cleanvars($_POST['city_name'])
								,'city_latitude'	=>	cleanvars($_POST['city_latitude'])
								,'city_longitude'	=>	cleanvars($_POST['city_longitude'])
								,'city_codedigit'	=>	cleanvars($_POST['city_codedigit'])
								,'city_codealpha'	=>	cleanvars($_POST['city_codealpha'])
								,'id_country'		=>	cleanvars($_POST['id_country'])
								,'id_state'			=>	cleanvars($_POST['id_state'])
								,'id_substate'		=>	cleanvars($_POST['id_substate'])
								,'city_status'		=>	cleanvars($_POST['city_status'])
								,'city_ordering'	=>	cleanvars($_POST['city_ordering'])
								,'id_added'			=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_added'		=>	date('Y-m-d H:i:s')
							); 
			
			$sqllms		= 	$dblms->insert(CITIES, $values);
			$city_id	=	$dblms->lastestid();

			if($sqllms) { 
				$remarks = 'Add City#:'.$city_id;
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
				header("Location: cities.php", true, 301);
				exit();
			}
		}
	}

    // EDIT CITY
	if(isset($_POST['submit_edit'])) {

		$condition	=	array ( 
								'select' 	=> "city_id",
								'where' 	=> array( 
														'city_name'	=>	cleanvars($_POST['city_name'])
														,'is_deleted'	=>	'0'
													),
								'not_equal' 	=> array( 
														'city_id'		=>	cleanvars($_POST['city_id'])
													),					
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(CITIES, $condition)) {
			$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'Record Already Exists';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: cities.php", true, 301);
			exit();
		}else{
			$values = array(
								'city_name'			=>	cleanvars($_POST['city_name'])
								,'city_latitude'	=>	cleanvars($_POST['city_latitude'])
								,'city_longitude'	=>	cleanvars($_POST['city_longitude'])
								,'city_codedigit'	=>	cleanvars($_POST['city_codedigit'])
								,'city_codealpha'	=>	cleanvars($_POST['city_codealpha'])
								,'id_country'		=>	cleanvars($_POST['id_country'])
								,'id_state'			=>	cleanvars($_POST['id_state'])
								,'id_substate'		=>	cleanvars($_POST['id_substate'])
								,'city_status'		=>	cleanvars($_POST['city_status'])
								,'city_ordering'	=>	cleanvars($_POST['city_ordering'])
								,'id_modify'		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_modify'		=>	date('Y-m-d H:i:s')

							);   
			$sqllms = $dblms->Update(CITIES , $values , "WHERE city_id  = '".cleanvars($_POST['city_id'])."'");

			if($sqllms) { 
				$remarks = 'Update City#:'.cleanvars($_POST['city_id']);
				$values = array (
				  "id_user"		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
				  ,"filename"	=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
				  ,"action"		=>	'2'
				  ,"dated"		=>	date('Y-m-d h:i:s')
				  ,"ip"			=>	cleanvars($ip)
				  ,"remarks"		=>	cleanvars($remarks)
				);
				$sqllms  = $dblms->insert(LOGS, $values);
				$_SESSION['msg']['title'] 	= 'Successfully';
				$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
				$_SESSION['msg']['type'] 	= 'info';
				header("Location: cities.php", true, 301);
				exit();
			}
		}		
	}

	// DELETE CITY
	if(isset($_GET['deleteid'])) {
		
		$values = array(
						'id_deleted'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,'is_deleted'	=>	'1'
						,'ip_deleted'	=>	cleanvars($ip)
						,'date_deleted'	=>	date('Y-m-d H:i:s')

					   );   
		$sqlDel = $dblms->Update(CITIES , $values , "WHERE city_id  = '".cleanvars($_GET['deleteid'])."'");

		if($sqlDel) { 
			$remarks = 'Delete City#:'.cleanvars($_GET['deleteid']);
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
			header("Location: cities.php", true, 301);
			exit();
		}
	}
?>