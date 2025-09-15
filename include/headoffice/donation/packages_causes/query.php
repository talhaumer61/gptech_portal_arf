<?php
    // ADD PACKAGE & DONATION
	if(isset($_POST['submit_add'])) {

		$condition	=	array ( 
								'select' 	=> "pc_id ",
								'where' 	=> array( 
														 'pc_title'		=>	cleanvars($_POST['pc_title'])
														,'is_deleted'	=>	'0'	
													),
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(PACKAGES_CAUSES, $condition)) {
			$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'Record Already Exists';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: packages_causes.php", true, 301);
			exit();
		}else{

			$values = array(
							 'pc_status'			=>	cleanvars($_POST['pc_status'])
							,'pc_ordering'			=>	cleanvars($_POST['pc_ordering'])
							,'id_cat' 				=>	cleanvars($_POST['id_cat'])
							,'id_type' 				=>	cleanvars($_POST['id_type'])
							,'pc_title' 			=>	cleanvars($_POST['pc_title'])
							,'pc_href'				=>	cleanvars(to_seo_url($_POST['pc_title']))
							,'pc_description' 		=>	cleanvars($_POST['pc_description'])
							,'pc_amount' 			=>	cleanvars($_POST['pc_amount'])
							,'id_org' 				=>	cleanvars($_POST['id_org'])
							,'pc_meta_keywords' 	=>	cleanvars($_POST['pc_meta_keywords'])
							,'pc_meta_description' 	=>	cleanvars($_POST['pc_meta_description'])
							,'id_added'				=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							,'date_added'			=>	date('Y-m-d H:i:s')
						   ); 
			if($_POST['id_type'] == '1'){
				$values['id_duration_type'] = cleanvars($_POST['id_duration_type']);
				$values['pc_duration'] 		= cleanvars($_POST['pc_duration']);
			}elseif($_POST['id_type'] == '2'){
				$values['pc_start_date'] 	= cleanvars($_POST['pc_start_date']);
				$values['pc_end_date'] 		= cleanvars($_POST['pc_end_date']);
			}
			$sqllms		=	$dblms->insert(PACKAGES_CAUSES, $values);

			if($sqllms) { 

				$pc_id    =	$dblms->lastestid();

				// IMAGE
				if(!empty($_FILES['pc_image']['name'])) {

					$path_parts 	= pathinfo($_FILES["pc_image"]["name"]);
					$extension 		= strtolower($path_parts['extension']);
					if(in_array($extension , array('jpeg','jpg', 'png', 'JPEG', 'JPG', 'PNG'))) {
						$img_dir 		= 'uploads/images/packages_causes/';
						$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['pc_title'])).'-'.$pc_id .".".($extension);
						$img_fileName	= to_seo_url(cleanvars($_POST['pc_title'])).'-'.$pc_id .".".($extension);
						$dataImage = array(
											'pc_image'	=>	$img_fileName, 
										  );
						$sqllmsUpdateCNIC = $dblms->Update(PACKAGES_CAUSES, $dataImage, "WHERE pc_id = '".$pc_id ."'");
						unset($sqllmsUpdateCNIC);
						$mode = '0644';
						move_uploaded_file($_FILES['pc_image']['tmp_name'],$originalImage);
						chmod ($originalImage, octdec($mode));
					}
	
				}
				
				$remarks = 'Add Package & Cause#:'.$pc_id ;
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
				header("Location: packages_causes.php", true, 301);
				exit();
			}
		}
	}

    // EDIT PACKAGE & DONATION
	if(isset($_POST['submit_edit'])) {

		$condition	=	array ( 
								'select' 	=> "pc_id",
								'where' 	=> array( 
														 'pc_title'		=>	cleanvars($_POST['pc_title'])
														,'is_deleted'	=>	'0'	
													),
								'not_equal' 	=> array( 
														'pc_id'		=>	cleanvars($_POST['pc_id'])
													),					
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(PACKAGES_CAUSES, $condition)) {
			$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'Record Already Exists';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: packages_causes.php", true, 301);
			exit();
		}else{
		
			$values = array(
								'pc_status'			=>	cleanvars($_POST['pc_status'])
								,'pc_ordering'			=>	cleanvars($_POST['pc_ordering'])
								,'id_cat' 				=>	cleanvars($_POST['id_cat'])
								,'id_type' 				=>	cleanvars($_POST['id_type'])
								,'pc_title' 			=>	cleanvars($_POST['pc_title'])
								,'pc_href'				=>	cleanvars(to_seo_url($_POST['pc_title']))
								,'pc_description' 		=>	cleanvars($_POST['pc_description'])
								,'pc_amount' 			=>	cleanvars($_POST['pc_amount'])
								,'id_org' 				=>	cleanvars($_POST['id_org'])
								,'pc_meta_keywords' 	=>	cleanvars($_POST['pc_meta_keywords'])
								,'pc_meta_description' 	=>	cleanvars($_POST['pc_meta_description'])
								,'id_added'				=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_added'			=>	date('Y-m-d H:i:s')
						   ); 
			if($_POST['id_type'] == '1'){
				$values['id_duration_type'] = cleanvars($_POST['id_duration_type']);
				$values['pc_duration'] 		= cleanvars($_POST['pc_duration']);
			}elseif($_POST['id_type'] == '2'){
				$values['pc_start_date'] 	= cleanvars($_POST['pc_start_date']);
				$values['pc_end_date'] 		= cleanvars($_POST['pc_end_date']);
			}
			$sqllms = $dblms->Update(PACKAGES_CAUSES , $values , "WHERE pc_id = '".cleanvars($_POST['pc_id'])."'");

			if($sqllms) { 
				// IMAGE
				if(!empty($_FILES['pc_image']['name'])) {

					$path_parts 	= pathinfo($_FILES["pc_image"]["name"]);
					$extension 		= strtolower($path_parts['extension']);
					if(in_array($extension , array('jpeg','jpg', 'png', 'JPEG', 'JPG', 'PNG'))) {
						$img_dir 		= 'uploads/images/packages_causes/';
						$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['pc_title'])).'-'.$_POST['pc_id'] .".".($extension);
						$img_fileName	= to_seo_url(cleanvars($_POST['pc_title'])).'-'.$_POST['pc_id'] .".".($extension);
						$dataImage = array(
											'pc_image'	=>	$img_fileName, 
										  );
						$sqllmsUpdateCNIC = $dblms->Update(PACKAGES_CAUSES, $dataImage, "WHERE pc_id = '".$_POST['pc_id'] ."'");
						unset($sqllmsUpdateCNIC);
						$mode = '0644';
						move_uploaded_file($_FILES['pc_image']['tmp_name'],$originalImage);
						chmod ($originalImage, octdec($mode));
					}
	
				}
				$remarks = 'Update Package & Cause#:'.cleanvars($_POST['pc_id']);
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
				header("Location: packages_causes.php", true, 301);
				exit();
			}
		}

		
	}

	// DELETE PACKAGE & DONATION
	if(isset($_GET['deleteid'])) {
		
		$values = array(
						 'id_deleted'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,'is_deleted'	=>	'1'
						,'ip_deleted'	=>	cleanvars($ip)
						,'date_deleted'	=>	date('Y-m-d H:i:s')
					   );   

		$sqlDel = $dblms->Update(PACKAGES_CAUSES , $values , "WHERE pc_id  = '".cleanvars($_GET['deleteid'])."'");

		if($sqlDel) { 
			$remarks = 'Delete Package & Cause#:'.cleanvars($_GET['deleteid']);
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
			header("Location: packages_causes.php", true, 301);
			exit();
		}
	}
?>