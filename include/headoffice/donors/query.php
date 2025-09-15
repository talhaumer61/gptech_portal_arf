<?php
    // ADD DONOR
	if(isset($_POST['submit_add'])) {

		$condition	=	array ( 
								'select' 	=> "dv_id",
								'where' 	=> array( 
														 'dv_email'		=>	cleanvars($_POST['dv_email'])
														,'is_deleted'	=>	'0'	
													),
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(DONORS_VOLUNTREES, $condition)) {
			$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'Record Already Exists';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: donors.php", true, 301);
			exit();
		}else{

			$values = array(
							 'dv_status'		=>	cleanvars($_POST['dv_status'])
							,'dv_donor_id'		=>	cleanvars($_POST['dv_donor_id'])
							,'is_volunteer' 	=>	cleanvars($_POST['is_volunteer'])
							,'dv_full_name' 	=>	cleanvars($_POST['dv_full_name'])
							,'dv_father_name' 	=>	cleanvars($_POST['dv_father_name'])
							,'dv_cnic' 			=>	cleanvars($_POST['dv_cnic'])
							,'dv_dob' 			=>	cleanvars($_POST['dv_dob'])
							,'dv_gender' 		=>	cleanvars($_POST['dv_gender'])
							,'dv_email' 		=>	cleanvars($_POST['dv_email'])
							,'dv_phone' 		=>	cleanvars($_POST['dv_phone'])
							,'dv_whatsapp' 		=>	cleanvars($_POST['dv_whatsapp'])
							,'id_city' 			=>	cleanvars($_POST['id_city'])
							,'id_substate' 		=>	cleanvars($_POST['id_substate'])
							,'id_state' 		=>	cleanvars($_POST['id_state'])
							,'id_country ' 		=>	cleanvars($_POST['id_country'])
							,'id_added'			=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							,'date_added'		=>	date('Y-m-d H:i:s')
						   ); 

			$sqllms		=	$dblms->insert(DONORS_VOLUNTREES, $values);

			if($sqllms) { 

				$dv_id   =	$dblms->lastestid();

				// PROFILE IMAGE
				if(!empty($_FILES['dv_file']['name'])) {

					$path_parts 	= pathinfo($_FILES["dv_file"]["name"]);
					$extension 		= strtolower($path_parts['extension']);
					if(in_array($extension , array('jpeg','jpg', 'png', 'JPEG', 'JPG', 'PNG'))) {
						$img_dir 		= 'uploads/images/donors/';
						$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['dv_full_name'])).'-'.$dv_id.".".($extension);
						$img_fileName	= to_seo_url(cleanvars($_POST['dv_full_name'])).'-'.$dv_id.".".($extension);
						$dataImage = array(
											'dv_file'	=>	$img_fileName, 
										  );
						$sqllmsUpdateCNIC = $dblms->Update(DONORS_VOLUNTREES, $dataImage, "WHERE dv_id = '".$dv_id."'");
						unset($sqllmsUpdateCNIC);
						$mode = '0644';
						move_uploaded_file($_FILES['dv_file']['tmp_name'],$originalImage);
						chmod ($originalImage, octdec($mode));
					}
	
				}
				
				$remarks = 'Add DONOR#:'.$dv_id;
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
				header("Location: donors.php", true, 301);
				exit();
			}
		}
	}

    // EDIT DONOR
	if(isset($_POST['submit_edit'])) {

		$condition	=	array ( 
								'select' 	=> "dv_id",
								'where' 	=> array( 
														 'dv_email'		=>	cleanvars($_POST['dv_email'])
														,'is_deleted'	=>	'0'	
													),
								'not_equal' 	=> array( 
														'dv_id'		=>	cleanvars($_POST['dv_id'])
													),					
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(DONORS_VOLUNTREES, $condition)) {
			$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'Record Already Exists';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: donors.php", true, 301);
			exit();
		}else{
		
			$values = array(
								 'dv_status'		=>	cleanvars($_POST['dv_status'])
								,'dv_donor_id'		=>	cleanvars($_POST['dv_donor_id'])
								,'is_volunteer' 	=>	cleanvars($_POST['is_volunteer'])
								,'dv_full_name' 	=>	cleanvars($_POST['dv_full_name'])
								,'dv_father_name' 	=>	cleanvars($_POST['dv_father_name'])
								,'dv_cnic' 			=>	cleanvars($_POST['dv_cnic'])
								,'dv_dob' 			=>	cleanvars($_POST['dv_dob'])
								,'dv_gender' 		=>	cleanvars($_POST['dv_gender'])
								,'dv_email' 		=>	cleanvars($_POST['dv_email'])
								,'dv_phone' 		=>	cleanvars($_POST['dv_phone'])
								,'dv_whatsapp' 		=>	cleanvars($_POST['dv_whatsapp'])
								,'id_city' 			=>	cleanvars($_POST['id_city'])
								,'id_substate' 		=>	cleanvars($_POST['id_substate'])
								,'id_state' 		=>	cleanvars($_POST['id_state'])
								,'id_country' 		=>	cleanvars($_POST['id_country'])
								,'id_modify'		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_modify'		=>	date('Y-m-d H:i:s')
						   ); 
			$sqllms = $dblms->Update(DONORS_VOLUNTREES , $values , "WHERE dv_id = '".cleanvars($_POST['dv_id'])."'");
			if($sqllms) { 
				// PROFILE IMAGE
				if(!empty($_FILES['dv_file']['name'])) {

					$path_parts 	= pathinfo($_FILES["dv_file"]["name"]);
					$extension 		= strtolower($path_parts['extension']);
					if(in_array($extension , array('jpeg','jpg', 'png', 'JPEG', 'JPG', 'PNG'))) {
						$img_dir 		= 'uploads/images/donors/';
						$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['dv_full_name'])).'-'.$_POST['dv_id'].".".($extension);
						$img_fileName	= to_seo_url(cleanvars($_POST['dv_full_name'])).'-'.$_POST['dv_id'].".".($extension);
						$dataImage = array(
											'dv_file'	=>	$img_fileName, 
										  );
						$sqllmsUpdateCNIC = $dblms->Update(DONORS_VOLUNTREES, $dataImage, "WHERE dv_id = '".$_POST['dv_id']."'");
						unset($sqllmsUpdateCNIC);
						$mode = '0644';
						move_uploaded_file($_FILES['dv_file']['tmp_name'],$originalImage);
						chmod ($originalImage, octdec($mode));
					}
	
				}
				$remarks = 'Update DONOR#:'.cleanvars($_POST['dv_id']);
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
				header("Location: donors.php", true, 301);
				exit();
			}
		}

		
	}

	// DELETE DONOR
	if(isset($_GET['deleteid'])) {
		
		$values = array(
						 'id_deleted'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,'is_deleted'	=>	'1'
						,'ip_deleted'	=>	cleanvars($ip)
						,'date_deleted'	=>	date('Y-m-d H:i:s')
					   );   

		$sqlDel = $dblms->Update(DONORS_VOLUNTREES , $values , "WHERE dv_id  = '".cleanvars($_GET['deleteid'])."'");

		if($sqlDel) { 
			$remarks = 'Delete DONOR#:'.cleanvars($_GET['deleteid']);
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
			header("Location: donors.php", true, 301);
			exit();
		}
	}
?>