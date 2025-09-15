<?php 
	include("../include/dbsetting/lms_vars_config.php");
	include("../include/dbsetting/classdbconection.php");
	include("../include/functions/functions.php");
	$dblms = new dblms();

 	date_default_timezone_set("Asia/Karachi");
	
	if(isset($_POST)){ 

		$data_arr = json_decode(file_get_contents('php://input'), true);
		$data_arr = $_POST;
	
		if($data_arr['method_name'] == "get_home") {

			

			// SLIDER DATA
			$condition = array ( 
									'select' 	=> "slider_img, slider_title, slider_description",
									'where' 	=> array( 
															 'is_deleted'		=> 0 
															,'slider_status' 	=> 1 
														), 
									'order_by' 		=> 'slider_id ASC',
									'return_type' 	=> 'all' 
							   ); 
			$sliders	= $dblms->getRows(SLIDER, $condition);
			
			$dataSlider = array();
			foreach($sliders as $row):
				$arraySlider['title']	= $row['slider_title'];
				$arraySlider['detail']	= $row['slider_description'];
				$arraySlider['image']	= SITE_URL.'uploads/images/slider/'.$row['slider_img'];
				array_push($dataSlider, $arraySlider);
			endforeach;
			
			$data['slider'] 		= $dataSlider;

			// CATEGORIES DATA
			$condition = array ( 
									'select' 	=> "cat_id, cat_name, cat_image, cat_description",
									'where' 	=> array( 
															'is_deleted' => 0 
															,'cat_status' => 1 
														), 
									'order_by' 		=> 'cat_ordering ASC',
									'return_type' 	=> 'all' 
								); 
			$categories 	= $dblms->getRows(CATEGORIES, $condition);

			$dataCategories = array();
			foreach($categories as $row):
				// GET SUB CATEGORIES
				$condition = array ( 
										'select' 	=> 'subcat_id, subcat_name, subcat_image, subcat_description',
										'where' 	=> array( 
																 'is_deleted'		=> 0 
																, 'subcat_status'	=> 1 
																, 'id_cat'			=> $row['cat_id']
															), 
										'order_by' 		=> 'subcat_ordering ASC',
										'return_type' 	=> 'all' 
								); 
				$subcategories 	= $dblms->getRows(SUB_CATEGORIES, $condition);
				$dataSubCategories = array();
				foreach($subcategories as $sub_cat):
					$arraySubCat['sub_pro_id']		= $sub_cat['subcat_id'];
					$arraySubCat['sub_pro_name']	= $sub_cat['subcat_name'];
					$arraySubCat['sub_pro_detail']	= $sub_cat['subcat_description'];
					$arraySubCat['sub_pro_image']	= SITE_URL.'uploads/images/donation/subcategories/'.$sub_cat['subcat_image'];		
			
					array_push($dataSubCategories, $arraySubCat);
				endforeach;
				$arrayCat['pro_id']			= $row['cat_id'];
				$arrayCat['pro_name']		= $row['cat_name'];
				$arrayCat['pro_detail']		= $row['cat_description'];
				$arrayCat['pro_image']		= SITE_URL.'uploads/images/donation/categories/'.$row['cat_image'];
				$arrayCat['sub_pro_list']	= $dataSubCategories;
				array_push($dataCategories, $arrayCat);
			endforeach;

			$data['projects'] = $dataCategories;

	

			// Get quote_card
			
		
			$dataquotecard = array();
		
				$quotecard['qoute']		= "“Give in your zakah collections to the people who long on to your help all year long. Have Apportion Relief Foundation deal with your zakah collection”";
				$quotecard['image']		= "https://arf.org.pk/assets/images/about/about_bg.jpg";
				array_push($dataquotecard, $quotecard);
		

			$data['quote_card'] 		= $dataquotecard;
			$data['phone_number'] 		= "+923260877829";
			$data['whatsapp_number'] 	= "";
			

			// EVENTS DATA
			$condition = array ( 
							'select' 	=> "".EVENTS.".event_id, ".EVENTS.".event_short_title, ".EVENTS.".event_brief_title, ".EVENTS.".event_start_date, ".EVENTS.".event_end_date,".EVENTS.".event_start_time,".EVENTS.".event_end_time,".EVENTS.".event_thumbnail,".EVENTS.".event_image,".EVENTS.".event_address,".EVENTS.".event_description,".ORGANIZATIONS.".org_name,".ORGANIZATIONS.".org_image",
							'join' 		    => 'INNER JOIN '.ORGANIZATIONS.' ON '.EVENTS.'.id_org = '.ORGANIZATIONS.'.org_id',
							'where' 	=> array( 
													''.EVENTS.'.event_status'       => 1 ,
													''.EVENTS.'.is_deleted'         => 0 ,
												), 
							'order_by' 		=> 'event_ordering  ASC',
							'return_type' 	=> 'all' 
						); 
			$events 	= $dblms->getRows(EVENTS, $condition);
			
			$dataEvent = array();
			foreach($events as $row):
				$arrayEvent['event_id']				=	$row['event_id'];
				$arrayEvent['heading_main']			=	$row['event_short_title'];
				$arrayEvent['heading_descriptive']	=	$row['event_brief_title'];
				$arrayEvent['thumbnail']			=	SITE_URL.'uploads/images/events/thumbnails/'.$row['event_thumbnail'];
				$arrayEvent['image']				=	SITE_URL.'uploads/images/events/'.$row['event_image'];
				$arrayEvent['date']					=	date('d', strtotime($row['event_start_date']));
				$arrayEvent['month']				=	date('M', strtotime($row['event_start_date']));
				$arrayEvent['start_date']			=	date('d M, Y', strtotime($row['event_start_date']));
				$arrayEvent['end_date']				=	date('d M, Y', strtotime($row['event_end_date']));
				$arrayEvent['start_time']			=	date('h:i A', strtotime($row['event_end_time']));
				$arrayEvent['end_time']				=	date('h:i A', strtotime($row['event_end_time']));
				$arrayEvent['event_location']		=	$row['event_address'];
				$arrayEvent['description']			=	html_entity_decode($row['event_description']);
				$arrayEvent['organizer_name']		=	$row['org_name'];
				$arrayEvent['organizer_image']		=	SITE_URL.'uploads/images/organizations/'.$row['org_image'];
				array_push($dataEvent, $arrayEvent);
			endforeach;
			
			$data['events'] = $dataEvent;		

			header( 'Content-Type: application/json; charset=utf-8' );
			echo $val= str_replace('\\/', '/', json_encode($data,JSON_UNESCAPED_UNICODE));
			die();
		} elseif($data_arr['method_name'] == "get_projects"){

			// CATEGORIES DATA
			$condition = array ( 
									'select' 	=> "cat_id, cat_name, cat_image, cat_description",
									'where' 	=> array( 
															'is_deleted' => 0 
															,'cat_status' => 1 
														), 
									'order_by' 		=> 'cat_ordering ASC',
									'return_type' 	=> 'all' 
								); 
			$categories 	= $dblms->getRows(CATEGORIES, $condition);

			$dataCategories = array();
			foreach($categories as $row):
				// GET SUB CATEGORIES
				$condition = array ( 
										'select' 	=> 'subcat_id, subcat_name, subcat_image, subcat_description',
										'where' 	=> array( 
																 'is_deleted'		=> 0 
																, 'subcat_status'	=> 1 
																, 'id_cat'			=> $row['cat_id']
															), 
										'order_by' 		=> 'subcat_ordering ASC',
										'return_type' 	=> 'all' 
								); 
				$subcategories 	= $dblms->getRows(SUB_CATEGORIES, $condition);
				$dataSubCategories = array();
				foreach($subcategories as $sub_cat):
					$arraySubCat['sub_pro_id']		= $sub_cat['subcat_id'];
					$arraySubCat['sub_pro_name']	= $sub_cat['subcat_name'];
					$arraySubCat['sub_pro_detail']	= $sub_cat['subcat_description'];
					$arraySubCat['sub_pro_image']	= SITE_URL.'uploads/images/donation/subcategories/'.$sub_cat['subcat_image'];
					array_push($dataSubCategories, $arraySubCat);
				endforeach;
				$arrayCat['pro_id']			= $row['cat_id'];
				$arrayCat['pro_name']		= $row['cat_name'];
				$arrayCat['pro_detail']		= $row['cat_description'];
				$arrayCat['pro_image']		= SITE_URL.'uploads/images/donation/categories/'.$row['cat_image'];
				$arrayCat['sub_pro_list']	= $dataSubCategories;
				array_push($dataCategories, $arrayCat);
			endforeach;
			
			$data['projects'] 	= $dataCategories;
			

			header( 'Content-Type: application/json; charset=utf-8' );
			echo $val= str_replace('\\/', '/', json_encode($data,JSON_UNESCAPED_UNICODE));

		
		} elseif($data_arr['method_name'] == "get_faqs"){


			// FAQS DATA
			$condition = array ( 
									'select' 	=> "faq_question, faq_answer",
									'where' 	=> array( 
															 'is_deleted'	=> 0 
															,'faq_status' 	=> 1 
														), 
									'order_by' 		=> 'faq_ordering ASC',
									'return_type' 	=> 'all' 
							   ); 
			$faqs	= $dblms->getRows(FAQS, $condition);
			
			$dataFAQ = array();
			foreach($faqs as $row):
				$arrayFAQ['faq_title']		=	$row['faq_question'];
				$arrayFAQ['faq_subtitle']	=	$row['faq_answer'];
				array_push($dataFAQ, $arrayFAQ);
			endforeach;
			
			$data['faq_list'] 		= $dataFAQ;

			header( 'Content-Type: application/json; charset=utf-8' );
			echo $val= str_replace('\\/', '/', json_encode($data,JSON_UNESCAPED_UNICODE));

		} elseif($data_arr['method_name'] == "get_team"){


			
			$dataTeams = array();
			  foreach ($TEAM as $inkey => $val):
				$arrayteam['name']			= $val['name'];
				$arrayteam['desgination']	= $val['designation'];
				$arrayteam['photo']			= "https://arf.org.pk/uploads/images/team_m/".$val['img'];
				array_push($dataTeams, $arrayteam);
			endforeach;
			
			$data['team'] 		= $dataTeams;

			header( 'Content-Type: application/json; charset=utf-8' );
			echo $val= str_replace('\\/', '/', json_encode($data,JSON_UNESCAPED_UNICODE));

		} elseif($data_arr['method_name'] == "get_contact"){


			$data['address'] 		= "Office # 483 1st Floor, Block 2 Sector B-II, Near Chandni Chowk, Township Lahore";
			$data['email'] 			= "apportionrfoundation@gmail.com";
			$data['phone'] 			= "042335110080, 03260877829";
			$data['facebook_url'] 	= "https://facebook.com/arf.org.pk";
			$data['youtube_url'] 	= "https://www.youtube.com/@apportionrelieffoundation";
			$data['instagram_url'] 	= "";
			$data['twitter_url'] 	= "https://x.com/";
			$data['location'] 		= "31.455495777288583, 74.3092428220895";

			header( 'Content-Type: application/json; charset=utf-8' );
			echo $val= str_replace('\\/', '/', json_encode($data,JSON_UNESCAPED_UNICODE));

		} elseif($data_arr['method_name'] == "get_events"){


			// EVENTS DATA
			$condition = array ( 
							'select' 	=> "".EVENTS.".event_id, ".EVENTS.".event_short_title, ".EVENTS.".event_brief_title, ".EVENTS.".event_start_date, ".EVENTS.".event_end_date,".EVENTS.".event_start_time,".EVENTS.".event_end_time,".EVENTS.".event_thumbnail,".EVENTS.".event_image,".EVENTS.".event_address,".EVENTS.".event_description,".ORGANIZATIONS.".org_name,".ORGANIZATIONS.".org_image",
							'join' 		    => 'INNER JOIN '.ORGANIZATIONS.' ON '.EVENTS.'.id_org = '.ORGANIZATIONS.'.org_id',
							'where' 	=> array( 
													''.EVENTS.'.event_status'       => 1 ,
													''.EVENTS.'.is_deleted'         => 0 ,
												), 
							'order_by' 		=> 'event_ordering  ASC',
							'return_type' 	=> 'all' 
						); 
			$events 	= $dblms->getRows(EVENTS, $condition);
			
			$dataEvent = array();
			foreach($events as $row):
				$arrayEvent['event_id']				=	$row['event_id'];
				$arrayEvent['heading_main']			=	$row['event_short_title'];
				$arrayEvent['heading_descriptive']	=	$row['event_brief_title'];
				$arrayEvent['thumbnail']			=	SITE_URL.'uploads/images/events/thumbnails/'.$row['event_thumbnail'];
				$arrayEvent['image']				=	SITE_URL.'uploads/images/events/'.$row['event_image'];
				$arrayEvent['date']					=	date('d', strtotime($row['event_start_date']));
				$arrayEvent['month']				=	date('M', strtotime($row['event_start_date']));
				$arrayEvent['start_date']			=	date('d M, Y', strtotime($row['event_start_date']));
				$arrayEvent['end_date']				=	date('d M, Y', strtotime($row['event_end_date']));
				$arrayEvent['start_time']			=	date('h:i A', strtotime($row['event_end_time']));
				$arrayEvent['end_time']				=	date('h:i A', strtotime($row['event_end_time']));
				$arrayEvent['event_location']		=	$row['event_address'];
				$arrayEvent['description']			=	html_entity_decode($row['event_description']);
				$arrayEvent['organizer_name']		=	$row['org_name'];
				$arrayEvent['organizer_image']		=	SITE_URL.'uploads/images/organizations/'.$row['org_image'];
				array_push($dataEvent, $arrayEvent);
			endforeach;
			
			$data['events'] 		= $dataEvent;

			header( 'Content-Type: application/json; charset=utf-8' );
			echo $val= str_replace('\\/', '/', json_encode($data,JSON_UNESCAPED_UNICODE));

		} elseif($data_arr['method_name'] == "get_distribution_places"){


			// DISTRIBUTION PLACES DATA
			$condition = array ( 
									'select'        =>  ''.DISTRIBUTION_PLACES.'.place_id, '.DISTRIBUTION_PLACES.'.place_latitude, '.DISTRIBUTION_PLACES.'.place_longitude, '.DISTRIBUTION_PLACES.'.place_address, '.DISTRIBUTION_PLACES.'.place_people_fed, '.DISTRIBUTION_PLACES.'.place_image, '.DISTRIBUTION_PLACES.'.place_description, '.DISTRIBUTION_PLACES.'.place_youtube_code, '.DISTRIBUTION_PLACES.'.place_geo_location, '.DISTRIBUTION_PLACES.'.place_phone',
									'where'         =>  array( 
																 ''.DISTRIBUTION_PLACES.'.is_deleted' 	=> 0
																,''.DISTRIBUTION_PLACES.'.place_status' => 1
															), 
									'order_by' 		=>  ''.DISTRIBUTION_PLACES.'.place_ordering ASC',
									'return_type'   =>  'all'
							   ); 
			$distributionPlaces 	= $dblms->getRows(DISTRIBUTION_PLACES, $condition);
			
			$dataDP = array();
			foreach($distributionPlaces as $row):

				// GET DISTRIBUTION PLACE IAMGES AND VIDEOS FROM GALLERY
				$conditionCG = array ( 
									'select' 	=> 'gal_image_video, id_file_type',
									'where' 	=> array( 
															'is_deleted' 		=> 	0 
															,'gal_status' 		=> 	1 
															,'id_place ' 		=> 	$row['place_id'] 
														), 
									'order_by' 		=> 'gal_ordering ASC',
									'return_type' 	=> 'all' 
								); 
				$galleryData   = $dblms->getRows(GALLERY, $conditionCG);
				$images = array();
				$videos = array();
				foreach($galleryData as $gal):
					// CHECK FILE FORMAT (IMAGE OR VIDEO)
					if($gal['id_file_type'] == '1'){
						$img	=	SITE_URL.'uploads/images/gallery/'.$gal['gal_image_video'];
						array_push($images, $img);
					}else{
						array_push($videos, $gal['gal_image_video']);
					}
				endforeach;
				$arrayDP['place_id']			=	$row['place_id'];
				$arrayDP['place_image']			=	SITE_URL.'uploads/images/distribution_places/'.$row['place_image'];
				$arrayDP['location_title']		=	$row['place_address'];
				$arrayDP['locaion_long']		=	$row['place_longitude'];
				$arrayDP['location_lat']		=	$row['place_latitude'];
				$arrayDP['main_video']			=	$row['place_youtube_code'];
				$arrayDP['gallery_images']		=	$images;
				$arrayDP['gallery_videos']		=	$videos;
				$arrayDP['geo_location']		=	$row['place_geo_location'];
				$arrayDP['phone']				=	$row['place_phone'];
				$arrayDP['people_fed']			=	$row['place_people_fed'];
				$arrayDP['description']			=	html_entity_decode($row['place_description']);
				array_push($dataDP, $arrayDP);
			endforeach;
			
			$data['distribution_places_info'] 		= $dataDP;

			header( 'Content-Type: application/json; charset=utf-8' );
			echo $val= str_replace('\\/', '/', json_encode($data,JSON_UNESCAPED_UNICODE));

		} elseif($data_arr['method_name'] == "get_about"){


			$condition = array ( 
									'select' 		=> "about_image, about_title, about_description, our_mission, our_vision, our_values",
									'order_by' 		=> 'about_id ASC',
									'return_type' 	=> 'single' 
								); 
			$about 	= $dblms->getRows(ABOUT, $condition);

			$data['title']			=	$about['about_title'];
			$data['description']	=	str_replace(array("\r", "\n"), "", html_entity_decode($about['about_description']));
			$data['image']			=	SITE_URL.'uploads/images/about/'.$about['about_image'];
			$data['our_values']		=	$about['our_values'];
			$data['our_mission']	=	$about['our_mission'];
			$data['our_vision']		=	$about['our_vision'];

			header( 'Content-Type: application/json; charset=utf-8' );
			echo $val= str_replace('\\/', '/', json_encode($data,JSON_UNESCAPED_UNICODE));

		}  elseif($data_arr['method_name'] == "submit_query"){

			if(!empty($data_arr['name']) && !empty($data_arr['email']) && !empty($data_arr['phone']) && !empty($data_arr['subject']) && !empty($data_arr['message']) ){

				$data['success'] = true;	
				$data['title'] 	 = "Success";
				$data['MSG'] 	 = "Successfully Submitted!";
			
			}else{
				$data['success'] = false;	
				$data['title'] 	 = "Error";
				$data['MSG'] 	 = "Please try again";
			}
			header( 'Content-Type: application/json; charset=utf-8' );
			echo $val= str_replace('\\/', '/', json_encode($data,JSON_UNESCAPED_UNICODE));

		}  elseif($data_arr['method_name'] == "submit_form"){

			if(!empty($data_arr['id']) && !empty($data_arr['name']) && !empty($data_arr['cnic']) && !empty($data_arr['phone']) && !empty($data_arr['email']) && !empty($data_arr['amount'])){

				$arrayid 	= explode('|', $data_arr['id'] );
				$id			=	$arrayid[0];
				$id_type	=	$arrayid[1];

				if($id_type == '3'){
					// CHECK SUB CATEGORIES
					$condition = array ( 
										'select' 	=> 'subcat_id',
										'where' 	=> array( 
																 'is_deleted'		=> 0 
																,'subcat_id'		=> $id
															), 
										'return_type' 	=> 'count' 
									   ); 
					$chkDataExist 	= $dblms->getRows(SUB_CATEGORIES, $condition);

				}elseif ($id_type == '2'){
					// CHECK CAUSES DATA
					$conditionCause = array ( 
												'select' 	=> 'pc_id',
												'where' 	=> array( 
																		 'is_deleted'	=> 0 
																		,'id_type' 		=> 2 
																		,'pc_id' 		=> $id 
																	), 
												'return_type' 	=> 'count' 
											); 
					$chkDataExist = $dblms->getRows(PACKAGES_CAUSES, $conditionCause);
				}

				if($chkDataExist > 0){

					$values = array(
										'status'			=>	'1'
										,'id_type'			=>	$id_type
										,'id_pc_subcat' 	=>	$id
										,'dated' 			=>	date('Y-m-d')
										,'fullname' 		=>	cleanvars($data_arr['name'])
										,'cnic' 			=>	cleanvars($data_arr['cnic'])
										,'phone' 			=>	cleanvars($data_arr['phone'])
										,'email' 			=>	cleanvars($data_arr['email'])
										,'amount' 			=>	cleanvars($data_arr['amount'])
										,'date_added'		=>	date('Y-m-d H:i:s')
									); 

					$sqllms		=	$dblms->insert(DONATIONS, $values);

					if($sqllms) { 

						$id    =	$dblms->lastestid();
						$remarks = 'Add Donation Through Mobile APP#:'.$id ;
						$values = array (
											 "filename"	=>	strstr(basename($_SERVER['REQUEST_URI']), '.php', true)
											,"action"	=>	'1'
											,"dated"	=>	date('Y-m-d h:i:s')
											,"ip"		=>	cleanvars($ip)
											,"remarks"	=>	cleanvars($remarks)
										);
						$sqllms  = $dblms->insert(LOGS, $values);
		
						$data['success'] = true;	
						$data['title'] 	 = "Success";
						$data['MSG'] 	 = "Successfully Submitted!";
					}else{
						$data['success'] = false;	
						$data['title'] 	 = "Error";
						$data['MSG'] 	 = "Please try again";
					}

				}else{
					$data['success'] = false;	
					$data['title'] 	 = "Error";
					$data['MSG'] 	 = "Please try again";
				}
			
			}else{
				$data['success'] = false;	
				$data['title'] 	 = "Error";
				$data['MSG'] 	 = "Please try again";
			}
			header( 'Content-Type: application/json; charset=utf-8' );
			echo $val= str_replace('\\/', '/', json_encode($data,JSON_UNESCAPED_UNICODE));

		}  elseif($data_arr['method_name'] == "get_donation_form"){
			// GET BANK INSTRUCTIONS
			$instructions	=	get_DonationSteps();

			$dataInstruction = array();
			foreach($instructions as $key => $inst):
				if($key != 'Note') {
					array_push($dataInstruction, $inst);
				}else{
					$data['note'] =	$inst;
				}
			endforeach;

			$data['instructions_list']	=	$dataInstruction;
			// GET PURPOSES
			$condition = array ( 
									'select' 	=> 'subcat_id, subcat_name, subcat_icon',
									'where' 	=> array( 
															'is_deleted'		=> 0 
															,'subcat_status'	=> 1 
														), 
									'order_by' 		=> 'id_cat ASC',
									'return_type' 	=> 'all' 
								); 
			$purposes 	= $dblms->getRows(SUB_CATEGORIES, $condition);
			$dataPurposes = array();
			foreach($purposes as $sub_cat):
				$arrayPurpose['id']		=	$sub_cat['subcat_id'].'|3';
				$arrayPurpose['title']	=	$sub_cat['subcat_name'];
				array_push($dataPurposes, $arrayPurpose);
			endforeach;


			$data['purpose_list']	=	$dataPurposes;

			header( 'Content-Type: application/json; charset=utf-8' );
			echo $val= str_replace('\\/', '/', json_encode($data,JSON_UNESCAPED_UNICODE));

		}else{
		    $data['success'] = false;	
			$data['MSG'] 	 = "Invalid Method!";
			
			header( 'Content-Type: application/json; charset=utf-8' );
			echo $val= str_replace('\\/', '/', json_encode($data,JSON_UNESCAPED_UNICODE));
			die();
		}	
	}
?>