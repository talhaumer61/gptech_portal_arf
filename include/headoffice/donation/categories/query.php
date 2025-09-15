<?php
    // ADD CATEGORY
	if(isset($_POST['submit_add'])) {

		$condition	=	array ( 
								'select' 	=> "cat_id",
								'where' 	=> array( 
														 'cat_name'		=>	cleanvars($_POST['cat_name'])
														,'is_deleted'	=>	'0'	
													),
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(CATEGORIES, $condition)) {
			$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'Record Already Exists';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: categories.php", true, 301);
			exit();
		}else{
			
			$values = array(
							 'cat_status'			=>	cleanvars($_POST['cat_status'])
							,'cat_ordering'			=>	cleanvars($_POST['cat_ordering'])
							,'cat_name'				=>	cleanvars($_POST['cat_name'])
							,'cat_href'				=>	cleanvars(to_seo_url($_POST['cat_name']))
							,'cat_description'		=>	cleanvars($_POST['cat_description'])
							,'cat_meta_keywords'	=>	cleanvars($_POST['cat_meta_keywords'])
							,'cat_meta_description'	=>	cleanvars($_POST['cat_meta_description'])
							,'id_added'				=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							,'date_added'			=>	date('Y-m-d H:i:s')
						   );

			$sqllms		=	$dblms->insert(CATEGORIES, $values);

			if($sqllms) { 
				$cat_id  =	$dblms->lastestid();

				// CATEGORY ICON
				if(!empty($_FILES['cat_icon']['name'])) {

					$path_parts 	= pathinfo($_FILES["cat_icon"]["name"]);
					$extension 		= strtolower($path_parts['extension']);
					if(in_array($extension , array('jpeg','jpg', 'png', 'JPEG', 'JPG', 'PNG', 'svg'))) {
						$img_dir 		= 'uploads/images/donation/categories/icons/';
						$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['cat_name'])).'-'.$cat_id.".".($extension);
						$img_fileName	= to_seo_url(cleanvars($_POST['cat_name'])).'-'.$cat_id.".".($extension);
						$dataImage = array(
											'cat_icon'		=> $img_fileName, 
										  );
						$sqllmsUpdateCNIC = $dblms->Update(CATEGORIES, $dataImage, "WHERE cat_id = '".$cat_id."'");
						unset($sqllmsUpdateCNIC);
						$mode = '0644';
						move_uploaded_file($_FILES['cat_icon']['tmp_name'],$originalImage);
						chmod ($originalImage, octdec($mode));
					}
	
				}
				// CATEGORY IMAGE
				if(!empty($_FILES['cat_image']['name'])) {

					$path_parts 	= pathinfo($_FILES["cat_image"]["name"]);
					$extension 		= strtolower($path_parts['extension']);
					if(in_array($extension , array('jpeg','jpg', 'png', 'JPEG', 'JPG', 'PNG', 'svg'))) {
						$img_dir 		= 'uploads/images/donation/categories/';
						$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['cat_name'])).'-'.$cat_id.".".($extension);
						$img_fileName	= to_seo_url(cleanvars($_POST['cat_name'])).'-'.$cat_id.".".($extension);
						$dataImage = array(
											'cat_image'		=> $img_fileName, 
										  );
						$sqllmsUpdateCNIC = $dblms->Update(CATEGORIES, $dataImage, "WHERE cat_id = '".$cat_id."'");
						unset($sqllmsUpdateCNIC);
						$mode = '0644';
						move_uploaded_file($_FILES['cat_image']['tmp_name'],$originalImage);
						chmod ($originalImage, octdec($mode));
					}
	
				}

				$remarks = 'Add Category#:'.$cat_id;
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
				header("Location: categories.php", true, 301);
				exit();
			}
		}
	}

    // EDIT CATEGORY
	if(isset($_POST['submit_edit'])) {

		$condition	=	array ( 
								'select' 	=> "cat_id",
								'where' 	=> array( 
														 'cat_name'		=>	cleanvars($_POST['cat_name'])
														,'is_deleted'	=>	'0'	
													),
								'not_equal' 	=> array( 
														'cat_id'		=>	cleanvars($_POST['cat_id'])
													),					
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(CATEGORIES, $condition)) {
			$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'Record Already Exists';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: categories.php", true, 301);
			exit();
		}else{
		
			$values = array(
							'cat_status'			=>	cleanvars($_POST['cat_status'])
							,'cat_ordering'			=>	cleanvars($_POST['cat_ordering'])
							,'cat_name'				=>	cleanvars($_POST['cat_name'])
							,'cat_href'				=>	cleanvars(to_seo_url($_POST['cat_name']))
							,'cat_description'		=>	cleanvars($_POST['cat_description'])
							,'cat_meta_keywords'	=>	cleanvars($_POST['cat_meta_keywords'])
							,'cat_meta_description'	=>	cleanvars($_POST['cat_meta_description'])
							,'id_modify'			=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							,'date_modify'			=>	date('Y-m-d H:i:s')

						   ); 
			$sqllms = $dblms->Update(CATEGORIES , $values , "WHERE cat_id  = '".cleanvars($_POST['cat_id'])."'");
			if($sqllms) { 

				// CATEGORY ICON
				if(!empty($_FILES['cat_icon']['name'])) {

					$path_parts 	= pathinfo($_FILES["cat_icon"]["name"]);
					$extension 		= strtolower($path_parts['extension']);
					if(in_array($extension , array('jpeg','jpg', 'png', 'JPEG', 'JPG', 'PNG', 'svg'))) {
						$img_dir 		= 'uploads/images/donation/categories/icons/';
						$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['cat_name'])).'-'.$_POST['cat_id'].".".($extension);
						$img_fileName	= to_seo_url(cleanvars($_POST['cat_name'])).'-'.$_POST['cat_id'].".".($extension);
						$dataImage = array(
											'cat_icon'		=> $img_fileName, 
										  );
						$sqllmsUpdateCNIC = $dblms->Update(CATEGORIES, $dataImage, "WHERE cat_id = '".$_POST['cat_id']."'");
						unset($sqllmsUpdateCNIC);
						$mode = '0644';
						move_uploaded_file($_FILES['cat_icon']['tmp_name'],$originalImage);
						chmod ($originalImage, octdec($mode));
					}
	
				}
				// CATEGORY IMAGE
				if(!empty($_FILES['cat_image']['name'])) {

					$path_parts 	= pathinfo($_FILES["cat_image"]["name"]);
					$extension 		= strtolower($path_parts['extension']);
					if(in_array($extension , array('jpeg','jpg', 'png', 'JPEG', 'JPG', 'PNG', 'svg'))) {
						$img_dir 		= 'uploads/images/donation/categories/';
						$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['cat_name'])).'-'.$_POST['cat_id'].".".($extension);
						$img_fileName	= to_seo_url(cleanvars($_POST['cat_name'])).'-'.$_POST['cat_id'].".".($extension);
						$dataImage = array(
											'cat_image'		=> $img_fileName, 
										  );
						$sqllmsUpdateCNIC = $dblms->Update(CATEGORIES, $dataImage, "WHERE cat_id = '".$_POST['cat_id']."'");
						unset($sqllmsUpdateCNIC);
						$mode = '0644';
						move_uploaded_file($_FILES['cat_image']['tmp_name'],$originalImage);
						chmod ($originalImage, octdec($mode));
					}
	
				}
				$remarks = 'Update Category#:'.cleanvars($_POST['cat_id']);
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
				header("Location: categories.php", true, 301);
				exit();
			}
		}		
	}

	// DELETE CATEGORY
	if(isset($_GET['deleteid'])) {
		
		$values = array(
						 'id_deleted'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,'is_deleted'	=>	'1'
						,'ip_deleted'	=>	cleanvars($ip)
						,'date_deleted'	=>	date('Y-m-d H:i:s')
					   );   

		$sqlDel = $dblms->Update(CATEGORIES , $values , "WHERE cat_id  = '".cleanvars($_GET['deleteid'])."'");

		if($sqlDel) { 
			$remarks = 'Delete Category#:'.cleanvars($_GET['deleteid']);
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
			header("Location: categories.php", true, 301);
			exit();
		}
	}
?>