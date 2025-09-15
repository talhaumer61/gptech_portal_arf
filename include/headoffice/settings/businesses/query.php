<?php
    // ADD BUSINESS
	if(isset($_POST['submit_add'])) {

		$condition	=	array ( 
								'select'	=>	'business_id',
								'where'		=>	array( 
														'business_ntn'	=>	cleanvars($_POST['business_ntn'])
														,'is_deleted'	=>	'0'
													),
								'return_type' 	=> 'count'
							  ); 
		if($dblms->getRows(BUSINESS, $condition)) {
			alert_msg('error', 'Error', 'Record Already Exists');
			header("Location: businesses.php", true, 301);
			exit();
		}else{
			$values = array(
								'business_name'						=>	cleanvars($_POST['business_name'])
								,'business_website'					=>	cleanvars($_POST['business_website'])
								,'id_vendor'						=>	cleanvars($_POST['id_vendor'])
								,'business_contactperson'			=>	cleanvars($_POST['business_contactperson'])
								,'business_contactperson_mobile'	=>	cleanvars($_POST['business_contactperson_mobile'])
								,'business_contactperson_email'		=>	cleanvars($_POST['business_contactperson_email'])
								,'business_stn'						=>	cleanvars($_POST['business_stn'])
								,'business_ntn'						=>	cleanvars($_POST['business_ntn'])
								,'business_status'					=>	cleanvars($_POST['business_status'])
								,'business_address'					=>	cleanvars($_POST['business_address'])
								,'business_description'				=>	cleanvars($_POST['business_description'])
								,'id_added'							=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_added'						=>	date('Y-m-d H:i:s')
							);
			$sqllms	=	$dblms->insert(BUSINESS, $values);

			if($sqllms) { 
				$idLatest	=	$dblms->lastestid();

				//Check if Logo File is not empty
				if(!empty($_FILES['business_logo']['name'])) {

					//File Extension
					$path_parts 	= pathinfo($_FILES["business_logo"]["name"]);
					$extension 		= strtolower($path_parts['extension']);

					//Check File extension
					if(in_array($extension , array('jpeg','jpg', 'png',  'JPEG' , 'JPG' , 'PNG'))) {

						//File Path
						$img_dir 	= 'uploads/images/business-logo/';
					
						//Set File Name
						$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['business_name'])).'_'.$idLatest.".".($extension);
						$img_fileName	= to_seo_url(cleanvars($_POST['business_name'])).'_'.$idLatest.".".($extension);

						//Update File Name in DB
						$dataImage = array(
							'business_logo'		=> $img_fileName, 
						);
					
						$sqllmsUpdatePicture = $dblms->Update(BUSINESS, $dataImage, "WHERE business_id = '".$idLatest."'");

						unset($sqllmsUpdatePicture);

						//Move File to the Directory
						$mode = '0644';
						move_uploaded_file($_FILES['business_logo']['tmp_name'],$originalImage);
						chmod ($originalImage, octdec($mode));
					}

				}//End of Logo File Check

				$remarks = 'Add Business#:'.$idLatest;
				$values = array (
									"id_user"	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
									,"filename"	=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
									,"action"	=>	'1'
									,"dated"	=>	date('Y-m-d h:i:s')
									,"ip"		=>	cleanvars($ip)
									,"remarks"	=>	cleanvars($remarks)
								);
				$sqllms  = $dblms->insert(LOGS, $values);
				alert_msg('success', 'Success', 'Business added Successfully.');
				header("Location: businesses.php", true, 301);
				exit();
			}
		}
	}

    // EDIT BUSINESS
	if(isset($_POST['submit_edit'])) {

		$condition	=	array ( 
								'select' 	=> "business_id",
								'where' 	=> array( 
														'business_ntn'	=>	cleanvars($_POST['business_ntn'])
														,'is_deleted'	=>	'0'	
													),
								'not_equal' 	=> array( 
														'business_id'	=>	cleanvars($_POST['business_id'])
													),					
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(BUSINESS, $condition)) {
			alert_msg('error', 'Error', 'Record Already Exists');
			header("Location: businesses.php", true, 301);
			exit();
		}else{
			$values = array(
								'business_name'						=>	cleanvars($_POST['business_name'])
								,'business_website'					=>	cleanvars($_POST['business_website'])
								,'id_vendor'						=>	cleanvars($_POST['id_vendor'])
								,'business_contactperson'			=>	cleanvars($_POST['business_contactperson'])
								,'business_contactperson_mobile'	=>	cleanvars($_POST['business_contactperson_mobile'])
								,'business_contactperson_email'		=>	cleanvars($_POST['business_contactperson_email'])
								,'business_stn'						=>	cleanvars($_POST['business_stn'])
								,'business_ntn'						=>	cleanvars($_POST['business_ntn'])
								,'business_address'					=>	cleanvars($_POST['business_address'])
								,'business_description'				=>	cleanvars($_POST['business_description'])
								,'business_status'					=>	cleanvars($_POST['business_status'])
								,'id_modified'						=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_added'						=>	date('Y-m-d H:i:s')
							);  
			$sqllms = $dblms->Update(BUSINESS , $values , "WHERE business_id  = '".cleanvars($_POST['business_id'])."'");

			if($sqllms) {

				$idLatest	=	$_POST['business_id'];

				//Check if Logo File is not empty
				if(!empty($_FILES['business_logo']['name'])) {

					//File Extension
					$path_parts	= pathinfo($_FILES["business_logo"]["name"]);
					$extension	= strtolower($path_parts['extension']);

					//Check File extension
					if(in_array($extension , array('jpeg','jpg', 'png',  'JPEG' , 'JPG' , 'PNG'))) {

						//File Path
						$img_dir 	= 'uploads/images/business-logo/';
					
						//Set File Name
						$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['business_name'])).'_'.$idLatest.".".($extension);
						$img_fileName	= to_seo_url(cleanvars($_POST['business_name'])).'_'.$idLatest.".".($extension);

						//Update File Name in DB
						$dataImage = array(
							'business_logo'	=> $img_fileName					, 
						);
					
						$sqllmsUpdatePicture = $dblms->Update(BUSINESS, $dataImage, "WHERE business_id = '".$idLatest."'");

						unset($sqllmsUpdatePicture);

						//Move File to the Directory
						$mode = '0644';
						move_uploaded_file($_FILES['business_logo']['tmp_name'],$originalImage);
						chmod ($originalImage, octdec($mode));
					}
				}
				//End of Logo File Check

				$remarks = 'Add Business#:'.$idLatest;
				$values = array (
									"id_user"		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
									,"filename"		=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
									,"action"		=>	'1'
									,"dated"		=>	date('Y-m-d h:i:s')
									,"ip"			=>	cleanvars($ip)
									,"remarks"		=>	cleanvars($remarks)
								);
				$sqllms  = $dblms->insert(LOGS, $values);
				alert_msg('info', 'Success', 'Business Updated Successfully.');
				header("Location: businesses.php", true, 301);
				exit();
			}
		}
	}

	// DELETE BUSINESS
	if(isset($_POST['submit_delete'])) {
		
		$values = array(
						'id_deleted'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,'is_deleted'	=>	'1'
						,'ip_deleted'	=>	cleanvars($ip)
						,'date_deleted'	=>	date('Y-m-d H:i:s')
					   );   
		$sqlDel = $dblms->Update(BUSINESS , $values , "WHERE business_id  = '".cleanvars($_POST['business_id'])."'");

		if($sqlDel) { 
			$remarks = 'Delete Business#:'.cleanvars($_POST['business_id']);
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
			alert_msg('success', 'Success', 'Business deleted Successfully.');
			header("Location: businesses.php", true, 301);
			exit();
		}
	}

	
    // LINK ACCOUNT TO A BUSINESS
	if(isset($_POST['submit_link'])) {

		$existing	=	array ( 
								'select'	=>	'id',
								'where'		=>	array( 
														'id_businessact'	=>	cleanvars($_POST['id_businessact'])
														,'id_business'		=>	cleanvars($_POST['id_business'])
													),
								'return_type' 	=> 'count'
							  ); 
		$check_existing = $dblms->getRows(LINKACCOUNT, $existing);

		$is_default	=	array ( 
			'select'		=>	'id',
			'where'			=>	array( 
									'is_default'	=>	cleanvars($_POST['is_default'])
									,'id_business'	=>	cleanvars($_POST['id_business'])
								),
			'not_equal'		=>	array( 
									'id_businessact'	=>	cleanvars($_POST['id_businessact'])
								),
			'return_type' 	=> 'count'
		  ); 
		$check_is_default = $dblms->getRows(LINKACCOUNT, $is_default);

		if($check_existing || $check_is_default) {
			alert_msg('error', 'Error', 'Record Already Exists');
			header("Location: businesses.php", true, 301);
			exit();
		}else{
			$values = array(
								'id_business'		=>	cleanvars($_POST['id_business'])
								,'id_bank'			=>	cleanvars($_POST['id_bank'])
								,'id_businessact'	=>	cleanvars($_POST['id_businessact'])
								,'is_default'		=>	cleanvars($_POST['is_default'])
							);
			$sqllms	=	$dblms->insert(LINKACCOUNT, $values);

			if($sqllms) { 
				$idLatest	=	$dblms->lastestid();

				$remarks = 'Add Link Account#:'.$idLatest;
				$values = array (
									"id_user"	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
									,"filename"	=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
									,"action"	=>	'1'
									,"dated"	=>	date('Y-m-d h:i:s')
									,"ip"		=>	cleanvars($ip)
									,"remarks"	=>	cleanvars($remarks)
								);
				$sqllms  = $dblms->insert(LOGS, $values);
				alert_msg('success', 'Success', 'Account Linked Successfully.');
				header("Location: businesses.php", true, 301);
				exit();
			}
		}
	}
?>