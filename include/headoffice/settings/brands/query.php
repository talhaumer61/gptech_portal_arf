<?php
    // ADD BRANDS
	if(isset($_POST['submit_add'])) {

		$condition	=	array ( 
								'select' 	=>	'brand_id',
								'where' 	=>	array( 
														'brand_name'	=>	cleanvars($_POST['brand_name'])
														,'is_deleted'	=>	'0'
													),
								'return_type' 	=> 'count'
							); 
		if($dblms->getRows(BRANDS, $condition)) {
			alert_msg('error', 'Error', 'Record Already Exists');
			header("Location: brands.php", true, 301);
			exit();
		}else{
			$values = array(
								'brand_name'			=>	cleanvars($_POST['brand_name'])
								,'brand_code'			=>	cleanvars($_POST['brand_code'])
								,'brand_description'	=>	cleanvars($_POST['brand_description'])
								,'brand_status'			=>	cleanvars($_POST['brand_status'])
								,'id_added'				=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_added'			=>	date('Y-m-d H:i:s')
							); 
			
			$sqllms		= 	$dblms->insert(BRANDS, $values);

			if($sqllms) { 

				$idLatest	=	$dblms->lastestid();

				//Check if Logo File is not empty
				if(!empty($_FILES['brand_image']['name'])) {

					//File Extension
					$path_parts	= pathinfo($_FILES["brand_image"]["name"]);
					$extension	= strtolower($path_parts['extension']);

					//Check File extension
					if(in_array($extension , array('jpeg','jpg', 'png',  'JPEG' , 'JPG' , 'PNG'))) {

						//File Path
						$img_dir 	= 'uploads/images/brands/';
					
						//Set File Name
						$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['brand_name'])).'_'.$idLatest.".".($extension);
						$img_fileName	= to_seo_url(cleanvars($_POST['brand_name'])).'_'.$idLatest.".".($extension);

						//Update File Name in DB
						$dataImage = array(
							'brand_image'	=> $img_fileName					, 
						);
					
						$sqllmsUpdatePicture = $dblms->Update(BRANDS, $dataImage, "WHERE brand_id = '".$idLatest."'");

						unset($sqllmsUpdatePicture);

						//Move File to the Directory
						$mode = '0644';
						move_uploaded_file($_FILES['brand_image']['tmp_name'],$originalImage);
						chmod ($originalImage, octdec($mode));
					}
				}
				//End of Logo File Check

				$remarks = 'Add Brand#:'.$idLatest;
				$values = array (
									"id_user"	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
									,"filename"	=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
									,"action"	=>	'1'
									,"dated"	=>	date('Y-m-d h:i:s')
									,"ip"		=>	cleanvars($ip)
									,"remarks"	=>	cleanvars($remarks)
								);
				$sqllms  = $dblms->insert(LOGS, $values);
				alert_msg('success', 'Success', 'Brand added Successfully.');
				header("Location: brands.php", true, 301);
				exit();
			}
		}
	}

    // EDIT BRANDS
	if(isset($_POST['submit_edit'])) {

		$condition	=	array ( 
								'select' 	=> "brand_id",
								'where' 	=> array( 
														'brand_name'	=>	cleanvars($_POST['brand_name'])
														,'is_deleted'	=>	'0'
													),
								'not_equal' 	=> array( 
														'brand_id'		=>	cleanvars($_POST['brand_id'])
													),					
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(BRANDS, $condition)) {
			alert_msg('error', 'Error', 'Record Already Exists');
			header("Location: brands.php", true, 301);
			exit();
		}else{
			$values = array(
								'brand_name'			=>	cleanvars($_POST['brand_name'])
								,'brand_code'			=>	cleanvars($_POST['brand_code'])
								,'brand_description'	=>	cleanvars($_POST['brand_description'])
								,'brand_status'			=>	cleanvars($_POST['brand_status'])
								,'id_modified'			=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_modified'		=>	date('Y-m-d H:i:s')

							);   
			$sqllms = $dblms->Update(BRANDS , $values , "WHERE brand_id  = '".cleanvars($_POST['brand_id'])."'");

			if($sqllms) { 

				$idLatest	=	$_POST['brand_id'];

				//Check if Brand Image File is not empty
				if(!empty($_FILES['brand_image']['name'])) {

					//File Extension
					$path_parts 	= pathinfo($_FILES["brand_image"]["name"]);
					$extension 		= strtolower($path_parts['extension']);
		
					//Check File extension
					if(in_array($extension , array('jpeg','jpg', 'png', 'JPEG', 'JPG', 'PNG'))) {
		
						//File Path
						$img_dir 	= 'uploads/images/brands/';
					
						//Set File Name
						$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['brand_name'])).'_'.$idLatest.".".($extension);
						$img_fileName	= to_seo_url(cleanvars($_POST['brand_name'])).'_'.$idLatest.".".($extension);
		
						//Update File Name in DB
						$dataImage = array(
							'brand_image'	=> $img_fileName					, 
						);
					
						$sqllmsUpdateImage = $dblms->Update(BRANDS, $dataImage, "WHERE brand_id = '".$idLatest."'");
		
						unset($sqllmsUpdateCNIC);
		
						//Move File to the Directory
						$mode = '0644';
						move_uploaded_file($_FILES['brand_image']['tmp_name'],$originalImage);
						chmod ($originalImage, octdec($mode));
					}
		
				}
				//End of File Check

				$remarks = 'Update Brand#:'.cleanvars($idLatest);
				$values = array (
				  "id_user"		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
				  ,"filename"	=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
				  ,"action"		=>	'2'
				  ,"dated"		=>	date('Y-m-d h:i:s')
				  ,"ip"			=>	cleanvars($ip)
				  ,"remarks"	=>	cleanvars($remarks)
				);
				$sqllms  = $dblms->insert(LOGS, $values);
				alert_msg('info', 'Success', 'Brand Updated Successfully.');
				header("Location: brands.php", true, 301);
				exit();
			}
		}		
	}

	// DELETE BRANDS
	if(isset($_POST['submit_delete'])) {
		
		$values = array(
						'id_deleted'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,'is_deleted'	=>	'1'
						,'ip_deleted'	=>	cleanvars($ip)
						,'date_deleted'	=>	date('Y-m-d H:i:s')

					   );   
		$sqlDel = $dblms->Update(BRANDS , $values , "WHERE brand_id  = '".cleanvars($_POST['brand_id'])."'");

		if($sqlDel) { 
			$remarks = 'Delete Brand#:'.cleanvars($_POST['brand_id']);
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
			alert_msg('success', 'Success', 'Brand deleted Successfully.');
			header("Location: brands.php", true, 301);
			exit();
		}
	}
?>