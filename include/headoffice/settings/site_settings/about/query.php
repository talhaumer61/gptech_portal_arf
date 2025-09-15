<?php

    // EDIT ABOUT
	if(isset($_POST['submit_edit'])) {
		
			$values = array(
								 'about_title'			=>	cleanvars($_POST['about_title'])
								,'about_description'	=>	cleanvars($_POST['about_description'])
								,'our_mission'			=>	cleanvars($_POST['our_mission'])
								,'our_vision'			=>	cleanvars($_POST['our_vision'])
								,'our_values' 			=>	cleanvars($_POST['our_values'])
								,'id_modify'			=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_modify'			=>	date('Y-m-d H:i:s')

						   ); 
			$sqllms = $dblms->Update(ABOUT , $values , "WHERE about_id  = '".cleanvars($_POST['about_id'])."'");
			if($sqllms) { 
				// ABOUT IMAGE
				if(!empty($_FILES['about_image']['name'])) {

					$path_parts 	= pathinfo($_FILES["about_image"]["name"]);
					$extension 		= strtolower($path_parts['extension']);
					if(in_array($extension , array('jpeg','jpg', 'png', 'JPEG', 'JPG', 'PNG'))) {
						$img_dir 		= 'uploads/images/about/';
						$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['about_title'])).'-'.$_POST['about_id'].".".($extension);
						$img_fileName	= to_seo_url(cleanvars($_POST['about_title'])).'-'.$_POST['about_id'].".".($extension);
						$dataImage 		= array(
													'about_image'	=>	$img_fileName, 
											   );
						$sqllmsImage = $dblms->Update(ABOUT, $dataImage, "WHERE about_id = '".$_POST['about_id']."'");
						unset($sqllmsImage);
						$mode = '0644';
						move_uploaded_file($_FILES['about_image']['tmp_name'],$originalImage);
						chmod ($originalImage, octdec($mode));
					}
	
				}
				$remarks = 'Update About#:'.cleanvars($_POST['about_id']);
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
				header("Location: about.php", true, 301);
				exit();
			}

		
	}
?>