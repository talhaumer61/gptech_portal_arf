<?php
    // ADD ORGANIZATION
	if(isset($_POST['submit_add'])) {

		$condition	=	array ( 
								'select' 	=> "id",
								'where' 	=> array( 
														 'org_email'	=>	cleanvars($_POST['org_email'])
														,'is_deleted'	=>	'0'	
													),
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(ORGANIZATIONS, $condition)) {
			$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'Record Already Exists';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: organizations.php", true, 301);
			exit();
		}else{

			$values = array(
							 'org_status'	=>	cleanvars($_POST['org_status'])
							,'org_ordering'	=>	cleanvars($_POST['org_ordering'])
							,'org_name' 	=>	cleanvars($_POST['org_name'])
							,'org_email' 	=>	cleanvars($_POST['org_email'])
							,'org_phone' 	=>	cleanvars($_POST['org_phone'])
							,'id_city' 		=>	cleanvars($_POST['id_city'])
							,'id_substate' 	=>	cleanvars($_POST['id_substate'])
							,'id_state' 	=>	cleanvars($_POST['id_state'])
							,'id_country' 	=>	cleanvars($_POST['id_country'])
							,'id_added'		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							,'date_added'	=>	date('Y-m-d H:i:s')
						   ); 

			$sqllms		=	$dblms->insert(ORGANIZATIONS, $values);

			if($sqllms) { 

				$org_id   =	$dblms->lastestid();

				// PROFILE IMAGE
				if(!empty($_FILES['org_image']['name'])) {

					$path_parts 	= pathinfo($_FILES["org_image"]["name"]);
					$extension 		= strtolower($path_parts['extension']);
					if(in_array($extension , array('jpeg','jpg', 'png', 'JPEG', 'JPG', 'PNG'))) {
						$img_dir 		= 'uploads/images/organizations/';
						$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['org_name'])).'-'.$org_id.".".($extension);
						$img_fileName	= to_seo_url(cleanvars($_POST['org_name'])).'-'.$org_id.".".($extension);
						$dataImage = array(
											'org_image'	=>	$img_fileName, 
										  );
						$sqllmsUpdateCNIC = $dblms->Update(ORGANIZATIONS, $dataImage, "WHERE org_id = '".$org_id."'");
						unset($sqllmsUpdateCNIC);
						$mode = '0644';
						move_uploaded_file($_FILES['org_image']['tmp_name'],$originalImage);
						chmod ($originalImage, octdec($mode));
					}
	
				}
				
				$remarks = 'Add Organization#:'.$org_id;
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
				header("Location: organizations.php", true, 301);
				exit();
			}
		}
	}

    // EDIT ORGANIZATION
	if(isset($_POST['submit_edit'])) {

		$condition	=	array ( 
								'select' 	=> "org_id",
								'where' 	=> array( 
														 'org_email'	=>	cleanvars($_POST['org_email'])
														,'is_deleted'	=>	'0'	
													),
								'not_equal' 	=> array( 
														'org_id'		=>	cleanvars($_POST['org_id'])
													),					
								'return_type' 	=> 'count' 
							  ); 
							  
		if($dblms->getRows(ORGANIZATIONS, $condition)) {
			$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'Record Already Exists';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: organizations.php", true, 301);
			exit();
		}else{
		
			$values = array(
								 'org_status'	=>	cleanvars($_POST['org_status'])
								,'org_ordering'	=>	cleanvars($_POST['org_ordering'])
								,'org_name' 	=>	cleanvars($_POST['org_name'])
								,'org_email' 	=>	cleanvars($_POST['org_email'])
								,'org_phone' 	=>	cleanvars($_POST['org_phone'])
								,'id_city' 		=>	cleanvars($_POST['id_city'])
								,'id_substate' 	=>	cleanvars($_POST['id_substate'])
								,'id_state' 	=>	cleanvars($_POST['id_state'])
								,'id_country' 	=>	cleanvars($_POST['id_country'])
								,'id_modify'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_modify'	=>	date('Y-m-d H:i:s')

						   ); 
			$sqllms = $dblms->Update(ORGANIZATIONS , $values , "WHERE org_id  = '".cleanvars($_POST['org_id'])."'");
			if($sqllms) { 
				// PROFILE IMAGE
				if(!empty($_FILES['org_image']['name'])) {

					$path_parts 	= pathinfo($_FILES["org_image"]["name"]);
					$extension 		= strtolower($path_parts['extension']);
					if(in_array($extension , array('jpeg','jpg', 'png', 'JPEG', 'JPG', 'PNG'))) {
						$img_dir 		= 'uploads/images/organizations/';
						$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['org_name'])).'-'.$_POST['org_id'].".".($extension);
						$img_fileName	= to_seo_url(cleanvars($_POST['org_name'])).'-'.$_POST['org_id'].".".($extension);
						$dataImage = array(
											'org_image'	=>	$img_fileName, 
										  );
						$sqllmsUpdateCNIC = $dblms->Update(ORGANIZATIONS, $dataImage, "WHERE org_id = '".$_POST['org_id']."'");
						unset($sqllmsUpdateCNIC);
						$mode = '0644';
						move_uploaded_file($_FILES['org_image']['tmp_name'],$originalImage);
						chmod ($originalImage, octdec($mode));
					}
	
				}
				$remarks = 'Update Organization#:'.cleanvars($_POST['org_id']);
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
				header("Location: organizations.php", true, 301);
				exit();
			}
		}

		
	}

	// DELETE ORGANIZATION
	if(isset($_GET['deleteid'])) {
		
		$values = array(
						 'id_deleted'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,'is_deleted'	=>	'1'
						,'ip_deleted'	=>	cleanvars($ip)
						,'date_deleted'	=>	date('Y-m-d H:i:s')
					   );   

		$sqlDel = $dblms->Update(ORGANIZATIONS , $values , "WHERE org_id  = '".cleanvars($_GET['deleteid'])."'");

		if($sqlDel) { 
			$remarks = 'Delete Organization#:'.cleanvars($_GET['deleteid']);
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
			header("Location: organizations.php", true, 301);
			exit();
		}
	}
?>