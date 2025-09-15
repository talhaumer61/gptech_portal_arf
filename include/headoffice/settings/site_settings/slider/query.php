<?php
    // ADD SLIDER
	if(isset($_POST['submit_add'])) {

		$condition	=	array ( 
								'select' 	=> "slider_id",
								'where' 	=> array( 
														'slider_title'	=>	cleanvars($_POST['slider_title'])
														,'is_deleted'	=>	'0'	
													),
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(SLIDER, $condition)) {
			$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'Record Already Exists';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: slider.php", true, 301);
			exit();
		}else{

			$values = array(
								 'slider_status'		=>	cleanvars($_POST['slider_status'])
								,'slider_title'			=>	cleanvars($_POST['slider_title'])
								,'slider_description'	=>	cleanvars($_POST['slider_description'])
								,'slider_btn_href'		=>	cleanvars($_POST['slider_btn_href'])
								,'slider_btn_text' 		=>	cleanvars($_POST['slider_btn_text'])
								,'id_added'				=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_added'			=>	date('Y-m-d H:i:s')
						   ); 

			$sqllms		=	$dblms->insert(SLIDER, $values);

			if($sqllms) { 

				$slider_id   =	$dblms->lastestid();

				// SLIDER IMAGE
				if(!empty($_FILES['slider_img']['name'])) {

					$path_parts 	= pathinfo($_FILES["slider_img"]["name"]);
					$extension 		= strtolower($path_parts['extension']);
					if(in_array($extension , array('jpeg','jpg', 'png', 'JPEG', 'JPG', 'PNG'))) {
						$img_dir 		= 'uploads/images/slider/';
						$originalImage	= $img_dir.'slider-img-'.$slider_id.".".($extension);
						$img_fileName	= 'slider-img-'.$slider_id.".".($extension);
						$dataImage = array(
											'slider_img'	=>	$img_fileName, 
										  );
						$sqllmsUpdateCNIC = $dblms->Update(SLIDER, $dataImage, "WHERE slider_id = '".$slider_id."'");
						unset($sqllmsUpdateCNIC);
						$mode = '0644';
						move_uploaded_file($_FILES['slider_img']['tmp_name'],$originalImage);
						chmod ($originalImage, octdec($mode));
					}
	
				}
				
				$remarks = 'Add Slider#:'.$slider_id;
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
				header("Location: slider.php", true, 301);
				exit();
			}
		}
	}

    // EDIT SLIDER
	if(isset($_POST['submit_edit'])) {

		$condition	=	array ( 
								'select' 	=> "slider_id",
								'where' 	=> array( 
														  'slider_title'	=>	cleanvars($_POST['slider_title'])
														,'is_deleted'		=>	'0'	
													),
								'not_equal' 	=> array( 
														'slider_id'			=>	cleanvars($_POST['slider_id'])
													),					
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(SLIDER, $condition)) {
			$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'Record Already Exists';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: slider.php", true, 301);
			exit();
		}else{
		
			$values = array(
								 'slider_status'		=>	cleanvars($_POST['slider_status'])
								,'slider_title'			=>	cleanvars($_POST['slider_title'])
								,'slider_description'	=>	cleanvars($_POST['slider_description'])
								,'slider_btn_href'		=>	cleanvars($_POST['slider_btn_href'])
								,'slider_btn_text' 		=>	cleanvars($_POST['slider_btn_text'])
								,'id_modify'		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_modify'		=>	date('Y-m-d H:i:s')

						   ); 
			$sqllms = $dblms->Update(SLIDER , $values , "WHERE slider_id  = '".cleanvars($_POST['slider_id'])."'");
			if($sqllms) { 
				// SLIDER IMAGE
				if(!empty($_FILES['slider_img']['name'])) {

					$path_parts 	= pathinfo($_FILES["slider_img"]["name"]);
					$extension 		= strtolower($path_parts['extension']);
					if(in_array($extension , array('jpeg','jpg', 'png', 'JPEG', 'JPG', 'PNG'))) {
						$img_dir 		= 'uploads/images/slider/';
						$originalImage	= $img_dir.'slider-img-'.$_POST['slider_id'].".".($extension);
						$img_fileName	= 'slider-img-'.$_POST['slider_id'].".".($extension);
						$dataImage = array(
											'slider_img'	=>	$img_fileName, 
										  );
						$sqllmsUpdateCNIC = $dblms->Update(SLIDER, $dataImage, "WHERE slider_id = '".$_POST['slider_id']."'");
						unset($sqllmsUpdateCNIC);
						$mode = '0644';
						move_uploaded_file($_FILES['slider_img']['tmp_name'],$originalImage);
						chmod ($originalImage, octdec($mode));
					}
	
				}
				$remarks = 'Update Slider#:'.cleanvars($_POST['slider_id']);
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
				header("Location: slider.php", true, 301);
				exit();
			}
		}
	}

	// DELETE SLIDER
	if(isset($_GET['deleteid'])) {
		
		$values = array(
						 'id_deleted'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,'is_deleted'	=>	'1'
						,'ip_deleted'	=>	cleanvars($ip)
						,'date_deleted'	=>	date('Y-m-d H:i:s')
					   );   

		$sqlDel = $dblms->Update(SLIDER , $values , "WHERE slider_id  = '".cleanvars($_GET['deleteid'])."'");

		if($sqlDel) { 
			$remarks = 'Delete Region#:'.cleanvars($_GET['deleteid']);
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
			header("Location: slider.php", true, 301);
			exit();
		}
	}
?>