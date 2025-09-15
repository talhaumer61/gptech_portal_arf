<?php
    // ADD ORDERS
	if(isset($_POST['submit_order'])) {

		$condition	=	array ( 
								'select' 	=>	'order_id',
								'where' 	=>	array( 
														'order_no'		=>	cleanvars($_POST['order_no'])
														,'is_deleted'	=>	'0'
													),
								'return_type' 	=> 'count'
							); 
		if($dblms->getRows(ORDERS, $condition)) {
			alert_msg('error', 'Error', 'Record Already Exists');
			header("Location: orders.php", true, 301);
			exit();
		}else{
			$values = array(
								'order_status'		=>	'4'
								,'order_no'			=>	cleanvars($_POST['order_no'])
								,'id_vendor'		=>	cleanvars($_POST['id_vendor'])
								,'id_business'		=>	cleanvars($_POST['id_business'])
								,'total'			=>	cleanvars($_POST['total_amount'])
								,'tax'				=>	cleanvars($_POST['total_tax_amount'])
								,'grand_total'		=>	cleanvars($_POST['grand_total'])
								,'advance'			=>	cleanvars($_POST['advance'])
								,'balance'			=>	cleanvars($_POST['balance'])
								,'payment_method'	=>	cleanvars($_POST['payment_method'])
								,'id_businessact'	=>	cleanvars($_POST['id_businessact'])
								,'dated'			=>	cleanvars($_POST['dated'])
								,'id_added'			=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,'date_added'		=>	date('Y-m-d H:i:s')
							);
			$sqllms	=	$dblms->insert(ORDERS, $values);

			if($sqllms) { 
				
				$idLatest	=	$dblms->lastestid();
				//Iterate over order items Array
				for($i=0; $i<=sizeof($_POST['id_product']); $i++){
					//Check if ID item is not empty
					if(!empty($_POST['id_product'][$i])) {

						$foreign_ids = explode("|",$_POST['id_product'][$i]);

						$values = array(
										'id_order'				=>  $idLatest 
										,'id_product'			=>  cleanvars($foreign_ids[0]) 
										,'id_subcat'			=>  cleanvars($foreign_ids[1]) 
										,'id_cat'				=>  cleanvars($foreign_ids[2])
										,'id_brand'				=>  cleanvars($_POST['id_brand'][$i]) 
										,'item_quantity'		=>  cleanvars($_POST['unit_item_quantity'][$i])
										,'unit_price'			=>  cleanvars($_POST['unit_price'][$i]) 
										,'total_price'			=>  cleanvars($_POST['unit_total_price'][$i])
										,'item_tax_percentage'	=>  cleanvars($_POST['unit_tax_percentage'][$i])
										,'item_tax_amount'		=>  cleanvars($_POST['unit_total_tax_amount'][$i])
									   );
						$sqllmsOrderDetail  = $dblms->Insert(ORDERDETAIL , $values);
					}
				}

				//Check if Product Image File is not empty
				if(!empty($_FILES['deposit_slip']['name'])) {

					//File Extension
					$path_parts	= pathinfo($_FILES["deposit_slip"]["name"]);
					$extension	= strtolower($path_parts['extension']);

					//Check File extension
					if(in_array($extension , array('jpeg','jpg', 'png',  'JPEG' , 'JPG' , 'PNG'))) {

						//File Path
						$img_dir 	= 'uploads/images/deposit-slip/';
					
						//Set File Name
						$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['order_no'])).'-'.$idLatest.".".($extension);
						$img_fileName	= to_seo_url(cleanvars($_POST['order_no'])).'-'.$idLatest.".".($extension);

						//Update File Name in DB
						$dataImage = array(
							'deposit_slip'	=> $img_fileName, 
						);
					
						$sqllmsUpdatePicture = $dblms->Update(ORDERS, $dataImage, "WHERE order_id = '".$idLatest."'");

						unset($sqllmsUpdatePicture);

						//Move File to the Directory
						$mode = '0644';
						move_uploaded_file($_FILES['deposit_slip']['tmp_name'],$originalImage);
						chmod ($originalImage, octdec($mode));
					}
				}
				//End of Product Image File Check

				$remarks = 'Create Order#:'.$idLatest;
				$values = array (
									"id_user"	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
									,"filename"	=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
									,"action"	=>	'1'
									,"dated"	=>	date('Y-m-d h:i:s')
									,"ip"		=>	cleanvars($ip)
									,"remarks"	=>	cleanvars($remarks)
								);
				$sqllms  = $dblms->insert(LOGS, $values);
				alert_msg('success', 'Success', 'Order Created Successfully.');
				header("Location: orders.php", true, 301);
				exit();
			}
		}
	}

    // EDIT ORDERS
	if(isset($_POST['edit_order'])) {

		$values = array(
							'order_status'		=>	cleanvars($_POST['order_status'])
							,'order_no'			=>	cleanvars($_POST['order_no'])
							,'id_vendor'		=>	cleanvars($_POST['id_vendor'])
							,'id_business'		=>	cleanvars($_POST['id_business'])
							,'total'			=>	cleanvars($_POST['total_amount'])
							,'tax'				=>	cleanvars($_POST['total_tax_amount'])
							,'grand_total'		=>	cleanvars($_POST['grand_total'])
							,'advance'			=>	cleanvars($_POST['advance'])
							,'balance'			=>	cleanvars($_POST['balance'])
							,'payment_method'	=>	cleanvars($_POST['payment_method'])
							,'id_businessact'	=>	cleanvars($_POST['id_businessact'])
							,'dated'			=>	cleanvars($_POST['dated'])
							,'id_modified'		=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							,'date_modified'	=>	date('Y-m-d H:i:s')
						);
		$sqllms = $dblms->Update(ORDERS , $values , "WHERE order_id  = '".cleanvars($_POST['order_id'])."'");

		if($sqllms) { 
			$idLatest	=	cleanvars($_POST['order_id']);

			//DELETE ORDER ITEM
            $sqllmsDelOrderDetail	= $dblms->querylms("DELETE 
                                                        FROM ".ORDERDETAIL." 
                                                        WHERE id_order = '".cleanvars($idLatest)."'");

			//ITERATE OVER ORDER ITEM ARRAY
			for($i=0; $i<=sizeof($_POST['id_product']); $i++){
				//CHECK IF ID ITEM IS NOT EMPTY
				if(!empty($_POST['id_product'][$i])) {

					$foreign_ids = explode("|",$_POST['id_product'][$i]);

					$values = array(
									'id_order'				=>  $idLatest 
									,'id_product'			=>  cleanvars($foreign_ids[0]) 
									,'id_subcat'			=>  cleanvars($foreign_ids[1]) 
									,'id_cat'				=>  cleanvars($foreign_ids[2])
									,'id_brand'				=>  cleanvars($_POST['id_brand'][$i]) 
									,'item_quantity'		=>  cleanvars($_POST['unit_item_quantity'][$i])
									,'unit_price'			=>  cleanvars($_POST['unit_price'][$i]) 
									,'total_price'			=>  cleanvars($_POST['unit_total_price'][$i])
									,'item_tax_percentage'	=>  cleanvars($_POST['unit_tax_percentage'][$i])
									,'item_tax_amount'		=>  cleanvars($_POST['unit_total_tax_amount'][$i])
								   );
					$sqllmsOrderDetail  = $dblms->Insert(ORDERDETAIL , $values);
				}
			}

			
			//CHECK IF DEPOSIT SLIP FILE IS NOT EMPTY
			if(!empty($_FILES['deposit_slip']['name'])) {

				//File Extension
				$path_parts	= pathinfo($_FILES["deposit_slip"]["name"]);
				$extension	= strtolower($path_parts['extension']);

				//Check File extension
				if(in_array($extension , array('jpeg','jpg', 'png',  'JPEG' , 'JPG' , 'PNG'))) {

					//File Path
					$img_dir 	= 'uploads/images/deposit-slip/';
				
					//Set File Name
					$originalImage	= $img_dir.to_seo_url(cleanvars($_POST['order_no'])).'-'.$idLatest.".".($extension);
					$img_fileName	= to_seo_url(cleanvars($_POST['order_no'])).'-'.$idLatest.".".($extension);

					//Update File Name in DB
					$dataImage = array(
						'deposit_slip'	=> $img_fileName, 
					);
				
					$sqllmsUpdatePicture = $dblms->Update(ORDERS, $dataImage, "WHERE order_id = '".$idLatest."'");

					unset($sqllmsUpdatePicture);

					//Move File to the Directory
					$mode = '0644';
					move_uploaded_file($_FILES['deposit_slip']['tmp_name'],$originalImage);
					chmod ($originalImage, octdec($mode));
				}
			}
			//END OF DEPOSIT SLIP FILE CHECK

			$remarks = 'Update Order#:'.cleanvars($idLatest);
			$values = array (
								"id_user"	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
								,"filename"	=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
								,"action"	=>	'2'
								,"dated"	=>	date('Y-m-d h:i:s')
								,"ip"		=>	cleanvars($ip)
								,"remarks"	=>	cleanvars($remarks)
							);
			$sqllms  = $dblms->insert(LOGS, $values);
			alert_msg('info', 'Success', 'Order Updated Successfully.');
			header("Location: orders.php", true, 301);
			exit();
		}
	}

	// DELETE ORDERS
	if(isset($_POST['submit_delete'])) {
		
		$values = array(
							'id_deleted'	=>	cleanvars($_SESSION['userlogininfo']['LOGINIDA'])
							,'is_deleted'	=>	'1'
							,'ip_deleted'	=>	cleanvars($ip)
							,'date_deleted'	=>	date('Y-m-d H:i:s')
					   );
		$sqlDel = $dblms->Update(ORDERS , $values , "WHERE order_id  = '".cleanvars($_POST['order_id'])."'");

		if($sqlDel) { 
			$remarks = 'Delete Order#:'.cleanvars($_POST['order_id']);
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
			alert_msg('success', 'Success', 'Order deleted Successfully.');
			header("Location: orders.php", true, 301);
			exit();
		}
	}
?>