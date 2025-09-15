<?php
    // ADD RECORD
	if(isset($_POST['submit_add'])) {

		$condition	=	array ( 
								'select' 	=> "testimonials_id",
								'where' 	=> array( 
														'testimonials_title'	=>	cleanvars($_POST['testimonials_title'])
														,'is_deleted'	=>	'0'	
													),
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(TESTIMONIALS, $condition)) {
			$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'Record Already Exists';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: testimonials.php", true, 301);
			exit();
		}else{

			$values = array(
								 'testimonials_status'			=>	cleanvars($_POST['testimonials_status'])
								,'testimonials_name'			=>	cleanvars($_POST['testimonials_name'])
								,'testimonials_title'			=>	cleanvars($_POST['testimonials_title'])
								,'testimonials_description'		=>	$_POST['testimonials_description']
								,'id_added'						=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_added'					=>	currentDateAndTime()
						   ); 

			$sqllms		=	$dblms->insert(TESTIMONIALS, $values);

			if($sqllms) { 

				$testimonials_id   =	$dblms->lastestid();

				// SLIDER IMAGE
				if(!empty($_FILES['testimonials_image']['name'])) {

					$path_parts 	= pathinfo($_FILES["testimonials_image"]["name"]);
					$extension 		= strtolower($path_parts['extension']);
					if(in_array($extension , array('jpeg','jpg', 'png', 'JPEG', 'JPG', 'PNG'))) {
						$img_dir 		= 'uploads/images/testimonials/';
						$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['testimonials_title'])).'-'.$testimonials_id.".".($extension);
						$img_fileName	= to_seo_url(cleanvars($_POST['testimonials_title'])).'-'.$testimonials_id.".".($extension);
						$dataImage = array(
											'testimonials_image'	=>	$img_fileName, 
										  );
						$sqllmsUpdateCNIC = $dblms->Update(TESTIMONIALS, $dataImage, "WHERE testimonials_id = '".$testimonials_id."'");
						unset($sqllmsUpdateCNIC);
						$mode = '0644';
						move_uploaded_file($_FILES['testimonials_image']['tmp_name'],$originalImage);
						chmod ($originalImage, octdec($mode));
					}
	
				}
				
				$remarks = 'Add Slider#:'.$testimonials_id;
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
				header("Location: testimonials.php", true, 301);
				exit();
			}
		}
	}

    // EDIT RECORD
	if(isset($_POST['submit_edit'])) {

		$condition	=	array ( 
								'select' 	=> "testimonials_id",
								'where' 	=> array( 
														  'testimonials_name'	=>	cleanvars($_POST['testimonials_name'])
														,'is_deleted'		=>	'0'	
													),
								'not_equal' 	=> array( 
														'testimonials_id'			=>	cleanvars($_POST['testimonials_id'])
													),					
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(TESTIMONIALS, $condition)) {
			$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'Record Already Exists';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: testimonials.php", true, 301);
			exit();
		}else{
		
			$values = array(
								 'testimonials_status'			=>	cleanvars($_POST['testimonials_status'])
								,'testimonials_name'			=>	cleanvars($_POST['testimonials_name'])
								,'testimonials_title'			=>	cleanvars($_POST['testimonials_title'])
								,'testimonials_description'		=>	$_POST['testimonials_description']
								,'id_modify'					=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_modify'					=>	currentDateAndTime()

						   ); 
			$sqllms = $dblms->Update(TESTIMONIALS , $values , "WHERE testimonials_id  = '".cleanvars($_POST['testimonials_id'])."'");
			if($sqllms) { 
				// SLIDER IMAGE
				if(!empty($_FILES['testimonials_image']['name'])) {

					$path_parts 	= pathinfo($_FILES["testimonials_image"]["name"]);
					$extension 		= strtolower($path_parts['extension']);
					if(in_array($extension , array('jpeg','jpg', 'png', 'JPEG', 'JPG', 'PNG'))) {
						$img_dir 		= 'uploads/images/testimonials/';
						$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['testimonials_title'])).'-'.$_POST['testimonials_id'].".".($extension);
						$img_fileName	= to_seo_url(cleanvars($_POST['testimonials_title'])).'-'.$_POST['testimonials_id'].".".($extension);
						$dataImage = array(
											'testimonials_image'	=>	$img_fileName, 
										  );
						$sqllmsUpdateCNIC = $dblms->Update(TESTIMONIALS, $dataImage, "WHERE testimonials_id = '".$_POST['testimonials_id']."'");
						unset($sqllmsUpdateCNIC);
						$mode = '0644';
						move_uploaded_file($_FILES['testimonials_image']['tmp_name'],$originalImage);
						chmod ($originalImage, octdec($mode));
					}
	
				}
				$remarks = 'Update Slider#:'.cleanvars($_POST['testimonials_id']);
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
				header("Location: testimonials.php", true, 301);
				exit();
			}
		}

		
	}

	// DELETE RECORD
	if(isset($_GET['deleteid'])) {
		
		$values = array(
						 'id_deleted'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,'is_deleted'	=>	'1'
						,'ip_deleted'	=>	cleanvars($ip)
						,'date_deleted'	=>	date('Y-m-d H:i:s')
					   );   

		$sqlDel = $dblms->Update(TESTIMONIALS , $values , "WHERE testimonials_id  = '".cleanvars($_GET['deleteid'])."'");

		if($sqlDel) { 
			$remarks = 'Delete Testimonials#:'.cleanvars($_GET['deleteid']);
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
			header("Location: testimonials.php", true, 301);
			exit();
		}
	}
?>