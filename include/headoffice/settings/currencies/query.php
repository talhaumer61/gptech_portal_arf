<?php
    // ADD CURRENCY
	if(isset($_POST['submit_add'])) {

		$condition	=	array ( 
								'select' 	=> "currency_id",
								'where' 	=> array( 
														'currency_name'	=>	cleanvars($_POST['currency_name'])
														,'is_deleted'	=>	'0'	
													),
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(CURRENCIES, $condition)) {
			$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'Record Already Exists';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: currencies.php", true, 301);
			exit();
		}else{
			$values = array(
							'currency_name'             =>	cleanvars($_POST['currency_name'])
							,'currency_code'  		    =>	cleanvars($_POST['currency_code'])
							,'currency_symbol'		    =>	cleanvars($_POST['currency_symbol'])
							,'currency_position'  		=>	cleanvars($_POST['currency_position'])
							,'currency_fractionalunits'	=>	cleanvars($_POST['currency_fractionalunits'])
							,'currency_status'          =>	cleanvars($_POST['currency_status'])
							,'currency_ordering'        =>	cleanvars($_POST['currency_ordering'])
							,'id_added'          	    =>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							,'date_added'          	    =>	date('Y-m-d h:i:s')
						   );   
			$sqllms  	=	$dblms->insert(CURRENCIES, $values);

			if($sqllms) {
				$currency_id  =	$dblms->lastestid(); 
				$remarks = 'Add Currency#:'.$currency_id;
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
				header("Location: currencies.php", true, 301);
				exit();
			}
		}
	}

    // EDIT CURRENCY
	if(isset($_POST['submit_edit'])) {

		$condition	=	array ( 
								'select' 	=> "currency_id",
								'where' 	=> array( 
														'currency_name'	=>	cleanvars($_POST['currency_name'])
														,'is_deleted'	=>	'0'	
													),
								'not_equal' => array( 
														'currency_id' => cleanvars($_POST['currency_id']) 
													),
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(CURRENCIES, $condition)) {
			$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'Record Already Exists';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: currencies.php", true, 301);
			exit();
		}else{

			$values	=	array(
								'currency_name'             =>	cleanvars($_POST['currency_name'])
								,'currency_code'  		    =>	cleanvars($_POST['currency_code'])
								,'currency_symbol'		    =>	cleanvars($_POST['currency_symbol'])
								,'currency_position'  		=>	cleanvars($_POST['currency_position'])
								,'currency_fractionalunits'	=>	cleanvars($_POST['currency_fractionalunits'])
								,'currency_status'          =>	cleanvars($_POST['currency_status'])
								,'currency_ordering'        =>	cleanvars($_POST['currency_ordering'])
								,'id_modify'          		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_modify'				=>	date('Y-m-d H:i:s')

						    );   
			$sqllms = $dblms->Update(CURRENCIES , $values , "WHERE currency_id  = '".cleanvars($_POST['currency_id'])."'");

			if($sqllms) { 
				$remarks = 'Update Currency#:'.cleanvars($_POST['currency_id']);
				$values = array (
									"id_user"		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
									,"filename"	=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
									,"action"		=>	'2'
									,"dated"		=>	date('Y-m-d h:i:s')
									,"ip"			=>	cleanvars($ip)
									,"remarks"	=>	cleanvars($remarks)
								);
				$sqllms  = $dblms->insert(LOGS, $values);
				$_SESSION['msg']['title'] 	= 'Successfully';
				$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
				$_SESSION['msg']['type'] 	= 'info';
				header("Location: currencies.php", true, 301);
				exit();
			}

		}
	}

	// DELETE CURRENCY
	if(isset($_GET['deleteid'])) {
		
		$values = array(
						'id_deleted'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,'is_deleted'	=>	'1'
						,'ip_deleted'	=>	cleanvars($ip)
						,'date_deleted'	=>	date('Y-m-d H:i:s')
					   );   
		$sqlDel = $dblms->Update(CURRENCIES , $values , "WHERE currency_id  = '".cleanvars($_GET['deleteid'])."'");

		if($sqlDel) { 
			$remarks = 'Delete Currency#:'.cleanvars($_GET['deleteid']);
			$values = array (
								"id_user"			=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,"filename"		=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
								,"action"			=>	'3'
								,"dated"			=>	date('Y-m-d h:i:s')
								,"ip"				=>	cleanvars($ip)
								,"remarks"		=>	cleanvars($remarks)
								,"id_deleted"		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,"ip_deleted"		=>	cleanvars($ip)
								,'date_deleted'	=>	date('Y-m-d H:i:s')
							);
			$sqllms  = $dblms->insert(LOGS, $values);
			$_SESSION['msg']['title'] 	= 'Warning';
			$_SESSION['msg']['text'] 	= 'Record Successfully Deleted.';
			$_SESSION['msg']['type'] 	= 'warning';
			header("Location: currencies.php", true, 301);
			exit();
		}
	}
?>