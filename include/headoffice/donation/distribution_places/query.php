<?php
    // ADD DISTRIBUTION PLACES
	if(isset($_POST['submit_add'])) {

		$condition	=	array ( 
								'select' 	=>	'place_id',
								'where' 	=>	array( 
														 'place_geo_location'	=>	cleanvars($_POST['place_geo_location'])
														,'is_deleted'			=>	'0'
													),
								'return_type' 	=> 'count'
							); 
		if($dblms->getRows(DISTRIBUTION_PLACES, $condition)) {
			alert_msg('error', 'Error', 'Record Already Exists');$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'Record Already Exists';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: distribution_places.php", true, 301);
			exit();
		}else{
			$values = array(
								 'place_status'			=>	cleanvars($_POST['place_status'])
								,'place_ordering'		=>	cleanvars($_POST['place_ordering'])
								,'place_latitude'		=>	cleanvars($_POST['place_latitude'])
								,'place_longitude'		=>	cleanvars($_POST['place_longitude'])
								,'place_address'		=>	cleanvars($_POST['place_address'])
								,'place_description'	=>	cleanvars($_POST['place_description'])
								,'place_people_fed'		=>	cleanvars($_POST['place_people_fed'])
								,'place_youtube_code'	=>	cleanvars($_POST['place_youtube_code'])
								,'place_geo_location'	=>	cleanvars($_POST['place_geo_location'])
								,'place_phone'			=>	cleanvars($_POST['place_phone'])
								,'id_city'				=>	cleanvars($_POST['id_city'])
								,'id_substate'			=>	cleanvars($_POST['id_substate'])
								,'id_state'				=>	cleanvars($_POST['id_state'])
								,'id_country'			=>	cleanvars($_POST['id_country'])
								,'id_added'				=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_added'			=>	date('Y-m-d H:i:s')
							); 
			
			$sqllms		= 	$dblms->insert(DISTRIBUTION_PLACES, $values);
			$place_id	=	$dblms->lastestid();

			if($sqllms) { 

				// PLACE IMAGE
				if(!empty($_FILES['place_image']['name'])) {

					$path_parts 	= pathinfo($_FILES["place_image"]["name"]);
					$extension 		= strtolower($path_parts['extension']);
					if(in_array($extension , array('jpeg','jpg', 'png', 'JPEG', 'JPG', 'PNG'))) {
						$img_dir 		= 'uploads/images/distribution_places/'; 
						$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['place_geo_location'])).'-'.$place_id.".".($extension);
						$img_fileName	= to_seo_url(cleanvars($_POST['place_geo_location'])).'-'.$place_id.".".($extension);
						$dataImage = array(
											'place_image'	=>	$img_fileName, 
										  );
						$sqllmsUpdateCNIC = $dblms->Update(DISTRIBUTION_PLACES, $dataImage, "WHERE place_id = '".$place_id."'");
						unset($sqllmsUpdateCNIC);
						$mode = '0644';
						move_uploaded_file($_FILES['place_image']['tmp_name'],$originalImage);
						chmod ($originalImage, octdec($mode));
					}
				}

				$remarks = 'Add Distribution Place#:'.$place_id;
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
				header("Location: distribution_places.php", true, 301);
				exit();
			}
		}
	}

    // EDIT DISTRIBUTION PLACES
	if(isset($_POST['submit_edit'])) {

		$condition	=	array ( 
								'select' 	=> "place_id",
								'where' 	=> array( 
														'place_geo_location'	=>	cleanvars($_POST['place_geo_location'])
														,'is_deleted'			=>	'0'
													),
								'not_equal' 	=> array( 
														'place_id'		=>	cleanvars($_POST['place_id'])
													),					
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(DISTRIBUTION_PLACES, $condition)) {
			$_SESSION['msg']['title'] 	= 'Error';
			$_SESSION['msg']['text'] 	= 'Record Already Exists';
			$_SESSION['msg']['type'] 	= 'error';
			header("Location: distribution_places.php", true, 301);
			exit();
		}else{
			$values = array(
								 'place_status'			=>	cleanvars($_POST['place_status'])
								,'place_ordering'		=>	cleanvars($_POST['place_ordering'])
								,'place_latitude'		=>	cleanvars($_POST['place_latitude'])
								,'place_longitude'		=>	cleanvars($_POST['place_longitude'])
								,'place_address'		=>	cleanvars($_POST['place_address'])
								,'place_description'	=>	cleanvars($_POST['place_description'])
								,'place_people_fed'		=>	cleanvars($_POST['place_people_fed'])
								,'place_youtube_code'	=>	cleanvars($_POST['place_youtube_code'])
								,'place_geo_location'	=>	cleanvars($_POST['place_geo_location'])
								,'place_phone'			=>	cleanvars($_POST['place_phone'])
								,'id_city'				=>	cleanvars($_POST['id_city'])
								,'id_substate'			=>	cleanvars($_POST['id_substate'])
								,'id_state'				=>	cleanvars($_POST['id_state'])
								,'id_country'			=>	cleanvars($_POST['id_country'])

							);   
			$sqllms = $dblms->Update(DISTRIBUTION_PLACES , $values , "WHERE place_id  = '".cleanvars($_POST['place_id'])."'");

			if($sqllms) { 
				// PLACE IMAGE
				if(!empty($_FILES['place_image']['name'])) {

					$path_parts 	= pathinfo($_FILES["place_image"]["name"]);
					$extension 		= strtolower($path_parts['extension']);
					if(in_array($extension , array('jpeg','jpg', 'png', 'JPEG', 'JPG', 'PNG'))) {
						$img_dir 		= 'uploads/images/distribution_places/'; 
						$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['place_geo_location'])).'-'.$_POST['place_id'].".".($extension);
						$img_fileName	= to_seo_url(cleanvars($_POST['place_geo_location'])).'-'.$_POST['place_id'].".".($extension);
						$dataImage = array(
											'place_image'	=>	$img_fileName, 
										  );
						$sqllmsUpdateCNIC = $dblms->Update(DISTRIBUTION_PLACES, $dataImage, "WHERE place_id = '".$_POST['place_id']."'");
						unset($sqllmsUpdateCNIC);
						$mode = '0644';
						move_uploaded_file($_FILES['place_image']['tmp_name'],$originalImage);
						chmod ($originalImage, octdec($mode));
					}
				}
				$remarks = 'Update Distribution Place#:'.cleanvars($_POST['place_id']);
				$values = array (
				  "id_user"		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
				  ,"filename"	=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
				  ,"action"		=>	'2'
				  ,"dated"		=>	date('Y-m-d h:i:s')
				  ,"ip"			=>	cleanvars($ip)
				  ,"remarks"		=>	cleanvars($remarks)
				);
				$sqllms  = $dblms->insert(LOGS, $values);
				$_SESSION['msg']['title'] 	= 'Successfully';
				$_SESSION['msg']['text'] 	= 'Record Successfully Updated.';
				$_SESSION['msg']['type'] 	= 'info';
				header("Location: distribution_places.php", true, 301);
				exit();
			}
		}		
	}

	// DELETE DISTRIBUTION PLACES
	if(isset($_GET['deleteid'])) {
		
		$values = array(
						'id_deleted'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
						,'is_deleted'	=>	'1'
						,'ip_deleted'	=>	cleanvars($ip)
						,'date_deleted'	=>	date('Y-m-d H:i:s')

					   );   
		$sqlDel = $dblms->Update(CITIES , $values , "WHERE city_id  = '".cleanvars($_GET['deleteid'])."'");

		if($sqlDel) { 
			$remarks = 'Delete City#:'.cleanvars($_GET['deleteid']);
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
			header("Location: distribution_places.php", true, 301);
			exit();
		}
	}
?>