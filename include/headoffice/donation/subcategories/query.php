<?php
    // ADD SUB CATEGORY
	if(isset($_POST['submit_add'])) {

		$condition	=	array ( 
								'select' 	=> "subcat_id",
								'where' 	=> array( 
														 'subcat_name'	=>	cleanvars($_POST['subcat_name'])
														,'is_deleted'	=>	'0'	
													),
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(SUB_CATEGORIES, $condition)) {
			$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'Record Already Exists';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: subcategories.php", true, 301);
			exit();
		}else{

			$values = array(
							 'subcat_status'			=>	cleanvars($_POST['subcat_status'])
							,'subcat_ordering'			=>	cleanvars($_POST['subcat_ordering'])
							,'subcat_name'				=>	cleanvars($_POST['subcat_name'])
							,'subcat_description'		=>	cleanvars($_POST['subcat_description'])
							,'subcat_meta_keywords'		=>	cleanvars($_POST['subcat_meta_keywords'])
							,'subcat_meta_description'	=>	cleanvars($_POST['subcat_meta_description'])
							,'id_cat'					=>	cleanvars($_POST['id_cat'])
							,'id_added'					=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							,'date_added'				=>	date('Y-m-d H:i:s')
						   ); 

			$sqllms		=	$dblms->insert(SUB_CATEGORIES, $values);

			if($sqllms) { 
				$subcat_id  =	$dblms->lastestid();

				// SUB CATEGORY ICON
				if(!empty($_FILES['subcat_icon']['name'])) {

					$path_parts 	= pathinfo($_FILES["subcat_icon"]["name"]);
					$extension 		= strtolower($path_parts['extension']);
					if(in_array($extension , array('jpeg','jpg', 'png', 'JPEG', 'JPG', 'PNG', 'svg'))) {
						$img_dir 		= 'uploads/images/donation/subcategories/icons/';
						$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['subcat_name'])).'-'.$subcat_id.".".($extension);
						$img_fileName	= to_seo_url(cleanvars($_POST['subcat_name'])).'-'.$subcat_id.".".($extension);
						$dataImage = array(
											'subcat_icon'	=>	$img_fileName, 
										  );
						$sqllmsUpdateCNIC = $dblms->Update(SUB_CATEGORIES, $dataImage, "WHERE subcat_id = '".$subcat_id."'");
						unset($sqllmsUpdateCNIC);
						$mode = '0644';
						move_uploaded_file($_FILES['subcat_icon']['tmp_name'],$originalImage);
						chmod ($originalImage, octdec($mode));
					}
	
				}
				// SUB CATEGORY IMAGE
				if(!empty($_FILES['subcat_image']['name'])) {

					$path_parts 	= pathinfo($_FILES["subcat_image"]["name"]);
					$extension 		= strtolower($path_parts['extension']);
					if(in_array($extension , array('jpeg','jpg', 'png', 'JPEG', 'JPG', 'PNG', 'svg'))) {
						$img_dir 		= 'uploads/images/donation/subcategories/';
						$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['subcat_name'])).'-'.$subcat_id.".".($extension);
						$img_fileName	= to_seo_url(cleanvars($_POST['subcat_name'])).'-'.$subcat_id.".".($extension);
						$dataImage = array(
											'subcat_image'	=>	$img_fileName, 
										  );
						$sqllmsUpdateCNIC = $dblms->Update(SUB_CATEGORIES, $dataImage, "WHERE subcat_id = '".$subcat_id."'");
						unset($sqllmsUpdateCNIC);
						$mode = '0644';
						move_uploaded_file($_FILES['subcat_image']['tmp_name'],$originalImage);
						chmod ($originalImage, octdec($mode));
					}
	
				}

				$remarks = 'Add Sub Category#:'.$subcat_id;
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
				header("Location: subcategories.php", true, 301);
				exit();
			}
		}
	}

    // EDIT SUB CATEGORY
	if(isset($_POST['submit_edit'])) {

		$condition	=	array ( 
								'select' 	=> "subcat_id",
								'where' 	=> array( 
														'subcat_name'		=>	cleanvars($_POST['subcat_name'])
														,'is_deleted'	=>	'0'	
													),
								'not_equal' 	=> array( 
														'subcat_id'		=>	cleanvars($_POST['subcat_id'])
													),					
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(SUB_CATEGORIES, $condition)) {
			$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'Record Already Exists';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: subcategories.php", true, 301);
			exit();
		}else{
		
			$values = array(
							 'subcat_status'			=>	cleanvars($_POST['subcat_status'])
							,'subcat_ordering'			=>	cleanvars($_POST['subcat_ordering'])
							,'subcat_name'				=>	cleanvars($_POST['subcat_name'])
							,'subcat_description'		=>	cleanvars($_POST['subcat_description'])
							,'subcat_meta_keywords'		=>	cleanvars($_POST['subcat_meta_keywords'])
							,'subcat_meta_description'	=>	cleanvars($_POST['subcat_meta_description'])
							,'id_cat'					=>	cleanvars($_POST['id_cat'])
							,'id_modify'				=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							,'date_modify'				=>	date('Y-m-d H:i:s')

						   ); 
			$sqllms = $dblms->Update(SUB_CATEGORIES , $values , "WHERE subcat_id  = '".cleanvars($_POST['subcat_id'])."'");
			if($sqllms) { 

				// SUB CATEGORY ICON
				if(!empty($_FILES['subcat_icon']['name'])) {

					$path_parts 	= pathinfo($_FILES["subcat_icon"]["name"]);
					$extension 		= strtolower($path_parts['extension']);
					if(in_array($extension , array('jpeg','jpg', 'png', 'JPEG', 'JPG', 'PNG', 'svg'))) {
						$img_dir 		= 'uploads/images/donation/subcategories/icons/';
						$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['subcat_name'])).'-'.$_POST['subcat_id'].".".($extension);
						$img_fileName	= to_seo_url(cleanvars($_POST['subcat_name'])).'-'.$_POST['subcat_id'].".".($extension);
						$dataImage = array(
											'subcat_icon'	=>	$img_fileName, 
										  );
						$sqllmsUpdateCNIC = $dblms->Update(SUB_CATEGORIES, $dataImage, "WHERE subcat_id = '".$_POST['subcat_id']."'");
						unset($sqllmsUpdateCNIC);
						$mode = '0644';
						move_uploaded_file($_FILES['subcat_icon']['tmp_name'],$originalImage);
						chmod ($originalImage, octdec($mode));
					}
	
				}
				// SUB CATEGORY IMAGE
				if(!empty($_FILES['subcat_image']['name'])) {

					$path_parts 	= pathinfo($_FILES["subcat_image"]["name"]);
					$extension 		= strtolower($path_parts['extension']);
					if(in_array($extension , array('jpeg','jpg', 'png', 'JPEG', 'JPG', 'PNG', 'svg'))) {
						$img_dir 		= 'uploads/images/donation/subcategories/';
						$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['subcat_name'])).'-'.$_POST['subcat_id'].".".($extension);
						$img_fileName	= to_seo_url(cleanvars($_POST['subcat_name'])).'-'.$_POST['subcat_id'].".".($extension);
						$dataImage = array(
											'subcat_image'	=>	$img_fileName, 
										  );
						$sqllmsUpdateCNIC = $dblms->Update(SUB_CATEGORIES, $dataImage, "WHERE subcat_id = '".$_POST['subcat_id']."'");
						unset($sqllmsUpdateCNIC);
						$mode = '0644';
						move_uploaded_file($_FILES['subcat_image']['tmp_name'],$originalImage);
						chmod ($originalImage, octdec($mode));
					}
	
				}
				$remarks = 'Update Sub Category#:'.cleanvars($_POST['subcat_id']);
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
				header("Location: subcategories.php", true, 301);
				exit();
			}
		}

		
	}

	// DELETE SUB CATEGORY
	if(isset($_GET['deleteid'])) {
		
		$values = array(
						 'id_deleted'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,'is_deleted'	=>	'1'
						,'ip_deleted'	=>	cleanvars($ip)
						,'date_deleted'	=>	date('Y-m-d H:i:s')
					   );   

		$sqlDel = $dblms->Update(SUB_CATEGORIES , $values , "WHERE subcat_id  = '".cleanvars($_GET['deleteid'])."'");

		if($sqlDel) { 
			$remarks = 'Delete Sub Category#:'.cleanvars($_GET['deleteid']);
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
			header("Location: subcategories.php", true, 301);
			exit();
		}
	}
?>