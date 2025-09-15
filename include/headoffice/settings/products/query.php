<?php
    // ADD PRODUCTS
	if(isset($_POST['submit_add'])) {

		$condition	=	array ( 
								'select' 	=>	'product_id',
								'where' 	=>	array( 
														'product_name'	=>	cleanvars($_POST['product_name'])
														,'id_brand'		=>	cleanvars($_POST['id_brand'])
														,'is_deleted'	=>	'0'
													),
								'return_type' 	=> 'count'
							); 
		if($dblms->getRows(PRODUCTS, $condition)) {
			alert_msg('error', 'Error', 'Record Already Exists');
			header("Location: products.php", true, 301);
			exit();
		}else{
			$values = array(
								'product_name'		=>	cleanvars($_POST['product_name'])
								,'product_code'		=>	cleanvars($_POST['product_code'])
								,'id_cat'			=>	cleanvars($_POST['id_cat'])
								,'id_subcat'		=>	cleanvars($_POST['id_subcat'])
								,'id_brand'			=>	cleanvars($_POST['id_brand'])
								,'product_status'	=>	cleanvars($_POST['product_status'])
								,'id_added'			=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_added'		=>	date('Y-m-d H:i:s')
							); 
			
			$sqllms	=	$dblms->insert(PRODUCTS, $values);

			if($sqllms) { 

				$idLatest	=	$dblms->lastestid();

				//Check if Product Image File is not empty
				if(!empty($_FILES['product_image']['name'])) {

					//File Extension
					$path_parts	= pathinfo($_FILES["product_image"]["name"]);
					$extension	= strtolower($path_parts['extension']);

					//Check File extension
					if(in_array($extension , array('jpeg','jpg', 'png',  'JPEG' , 'JPG' , 'PNG'))) {

						//File Path
						$img_dir 	= 'uploads/images/products/';
					
						//Set File Name
						$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['product_name'])).'-'.$idLatest.".".($extension);
						$img_fileName	= to_seo_url(cleanvars($_POST['product_name'])).'-'.$idLatest.".".($extension);

						//Update File Name in DB
						$dataImage = array(
							'product_image'	=> $img_fileName, 
						);
					
						$sqllmsUpdatePicture = $dblms->Update(PRODUCTS, $dataImage, "WHERE product_id = '".$idLatest."'");

						unset($sqllmsUpdatePicture);

						//Move File to the Directory
						$mode = '0644';
						move_uploaded_file($_FILES['product_image']['tmp_name'],$originalImage);
						chmod ($originalImage, octdec($mode));
					}
				}
				//End of Product Image File Check

				$remarks = 'Add Product#:'.$idLatest;
				$values = array (
									"id_user"	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
									,"filename"	=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
									,"action"	=>	'1'
									,"dated"	=>	date('Y-m-d h:i:s')
									,"ip"		=>	cleanvars($ip)
									,"remarks"	=>	cleanvars($remarks)
								);
				$sqllms  = $dblms->insert(LOGS, $values);
				alert_msg('success', 'Success', 'Product added Successfully.');
				header("Location: products.php", true, 301);
				exit();
			}
		}
	}

    // EDIT PRODUCTS
	if(isset($_POST['submit_edit'])) {

		$condition	=	array ( 
								'select' 	=> "product_id",
								'where' 	=> array( 
														'product_name'	=>	cleanvars($_POST['product_name'])
														,'id_brand'		=>	cleanvars($_POST['id_brand'])
														,'is_deleted'	=>	'0'
													),
								'not_equal' 	=> array( 
														'product_id'	=>	cleanvars($_POST['product_id'])
													),					
								'return_type' 	=> 'count' 
							  ); 
		if($dblms->getRows(PRODUCTS, $condition)) {
			alert_msg('error', 'Error', 'Record Already Exists');
			header("Location: products.php", true, 301);
			exit();
		}else{
			$values = array(
								'product_name'		=>	cleanvars($_POST['product_name'])
								,'product_code'		=>	cleanvars($_POST['product_code'])
								,'id_cat'			=>	cleanvars($_POST['id_cat'])
								,'id_subcat'		=>	cleanvars($_POST['id_subcat'])
								,'id_brand'			=>	cleanvars($_POST['id_brand'])
								,'product_status'	=>	cleanvars($_POST['product_status'])
								,'id_modified'		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_modified'	=>	date('Y-m-d H:i:s')

							);   
			$sqllms = $dblms->Update(PRODUCTS , $values , "WHERE product_id  = '".cleanvars($_POST['product_id'])."'");

			if($sqllms) { 

				$idLatest	=	cleanvars($_POST['product_id']);

				//Check if Product Image File is not empty
				if(!empty($_FILES['product_image']['name'])) {

					//File Extension
					$path_parts	= pathinfo($_FILES["product_image"]["name"]);
					$extension	= strtolower($path_parts['extension']);

					//Check File extension
					if(in_array($extension , array('jpeg','jpg', 'png',  'JPEG' , 'JPG' , 'PNG'))) {

						//File Path
						$img_dir 	= 'uploads/images/products/';
					
						//Set File Name
						$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['product_name'])).'-'.$idLatest.".".($extension);
						$img_fileName	= to_seo_url(cleanvars($_POST['product_name'])).'-'.$idLatest.".".($extension);

						//Update File Name in DB
						$dataImage = array(
							'product_image'	=> $img_fileName, 
						);
					
						$sqllmsUpdatePicture = $dblms->Update(PRODUCTS, $dataImage, "WHERE product_id = '".$idLatest."'");

						unset($sqllmsUpdatePicture);

						//Move File to the Directory
						$mode = '0644';
						move_uploaded_file($_FILES['product_image']['tmp_name'],$originalImage);
						chmod ($originalImage, octdec($mode));
					}
				}
				//End of Product Image File Check

				$remarks = 'Update Product#:'.cleanvars($idLatest);
				$values = array (
									"id_user"	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
									,"filename"	=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
									,"action"	=>	'2'
									,"dated"	=>	date('Y-m-d h:i:s')
									,"ip"		=>	cleanvars($ip)
									,"remarks"	=>	cleanvars($remarks)
								);
				$sqllms  = $dblms->insert(LOGS, $values);
				alert_msg('info', 'Success', 'Product Updated Successfully.');
				header("Location: products.php", true, 301);
				exit();
			}
		}		
	}

	// DELETE PRODUCTS
	if(isset($_POST['submit_delete'])) {
		
		$values = array(
							'id_deleted'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							,'is_deleted'	=>	'1'
							,'ip_deleted'	=>	cleanvars($ip)
							,'date_deleted'	=>	date('Y-m-d H:i:s')
					   );   
		$sqlDel = $dblms->Update(PRODUCTS , $values , "WHERE product_id  = '".cleanvars($_POST['product_id'])."'");

		if($sqlDel) { 
			$remarks = 'Delete Product#:'.cleanvars($_POST['product_id']);
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
			alert_msg('success', 'Success', 'Product deleted Successfully.');
			header("Location: products.php", true, 301);
			exit();
		}
	}
?>