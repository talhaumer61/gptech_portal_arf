<?php
    // ADD FAQS
	if(isset($_POST['submit_add'])) {

		$condition	=	array ( 
								'select' 	=> "faq_id",
								'where' 	=> array( 
														 'faq_question'		=>	cleanvars($_POST['faq_question'])
														,'is_deleted'	=>	'0'	
													),
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(FAQS, $condition)) {
			$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'Record Already Exists';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: faqs.php", true, 301);
			exit();
		}else{

			$values = array(
							 'faq_status'	=>	cleanvars($_POST['faq_status'])
							,'faq_ordering'	=>	cleanvars($_POST['faq_ordering'])
							,'faq_question'	=>	cleanvars($_POST['faq_question'])
							,'faq_answer'	=>	cleanvars($_POST['faq_answer'])
							,'id_cat' 		=>	cleanvars($_POST['id_cat'])
							,'id_added'		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							,'date_added'	=>	date('Y-m-d H:i:s')
						   ); 

			$sqllms		=	$dblms->insert(FAQS, $values);

			if($sqllms) { 
				$faq_id  =	$dblms->lastestid();
				$remarks = 'Add Faqs#:'.$faq_id;
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
				header("Location: faqs.php", true, 301);
				exit();
			}
		}
	}

    // EDIT FAQS
	if(isset($_POST['submit_edit'])) {

		$condition	=	array ( 
								'select' 	=> "faq_id",
								'where' 	=> array( 
														 'faq_question'	=>	cleanvars($_POST['faq_question'])
														,'is_deleted'	=>	'0'	
													),
								'not_equal' 	=> array( 
														'faq_id'		=>	cleanvars($_POST['faq_id'])
													),					
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(FAQS, $condition)) {
			$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'Record Already Exists';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: faqs.php", true, 301);
			exit();
		}else{
		
			$values = array(
							 'faq_status'	=>	cleanvars($_POST['faq_status'])
							,'faq_ordering'	=>	cleanvars($_POST['faq_ordering'])
							,'faq_question'	=>	cleanvars($_POST['faq_question'])
							,'faq_answer'	=>	cleanvars($_POST['faq_answer'])
							,'id_cat' 		=>	cleanvars($_POST['id_cat'])
							,'id_modify'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							,'date_modify'	=>	date('Y-m-d H:i:s')

						   ); 
			$sqllms = $dblms->Update(FAQS , $values , "WHERE faq_id  = '".cleanvars($_POST['faq_id'])."'");
			if($sqllms) { 
				$remarks = 'Update Faqs#:'.cleanvars($_POST['faq_id']);
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
				header("Location: faqs.php", true, 301);
				exit();
			}
		}

		
	}

	// DELETE FAQS
	if(isset($_GET['deleteid'])) {
		
		$values = array(
						 'id_deleted'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,'is_deleted'	=>	'1'
						,'ip_deleted'	=>	cleanvars($ip)
						,'date_deleted'	=>	date('Y-m-d H:i:s')
					   );   

		$sqlDel = $dblms->Update(FAQS , $values , "WHERE faq_id  = '".cleanvars($_GET['deleteid'])."'");

		if($sqlDel) { 
			$remarks = 'Delete Faqs#:'.cleanvars($_GET['deleteid']);
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
			header("Location: faqs.php", true, 301);
			exit();
		}
	}
?>