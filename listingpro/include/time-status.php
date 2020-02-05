<?php 
				
	/* ============== Check TIme ============ */
	
	if (!function_exists('listingpro_check_time')) {
		function listingpro_check_time($postid,$status = false) {
			$output='';
			$buisness_hours = listing_get_metabox_by_ID('business_hours', $postid);

			if(!empty($buisness_hours) && count($buisness_hours)>0){
				if(!empty($postid)){
					$lat = listing_get_metabox_by_ID('latitude',$postid);
					$long = listing_get_metabox_by_ID('longitude',$postid);
				}
				
				//$timezone = getClosestTimezone($lat, $long);
				$timezone  = get_option('gmt_offset');
				$time = gmdate("H:i", time() + 3600*($timezone+date("I"))); 
				$day =  gmdate("l");
				$time = strtotime($time);
				$lang = get_locale();
				setlocale(LC_ALL, $lang.'.utf-8');
				$day = strftime("%A");
				$day = ucfirst($day);
				foreach($buisness_hours as $key=>$value){
					$keyArray[] = $key;
					if($day == $key){
						$dayName = esc_html__('Today','listingpro');
					}else{
						$dayName = $key;
					}
					$opencheck = $value['open'];
					$open = $value['open'];
					$open = str_replace(' ', '', $open);
					$closecheck = $value['close'];
					$close = $value['close'];
					$close = str_replace(' ', '', $close);
					$open = strtotime($open);
					$close = strtotime($close);
					$newTimeOpen = date('h:i A', $open);
					$newTimeClose = date('h:i A', $close);
					
					if($day == $key){
						if( empty($opencheck) && empty($closecheck) ){
							if($status == false){
								$output = '<span class="grid-opened">'.esc_html__('24 hours open','listingpro').'</span>';
							}else{
								$output = 'open';
							}
						}
						elseif($time > $open && $time < $close){
							if($status == false){
								$output = '<span class="grid-opened">'.esc_html__('Open Now~','listingpro').'</span>';
							}else{
								$output = 'open';
							}
						}else{
							if($status == false){
							$output = '<span class="grid-closed">'.esc_html__('Closed Now!','listingpro').'</span>';
							}else{
								$output = 'close';
							}
						}								
					}								
					
				}
				if(is_array($keyArray) && !in_array($day, $keyArray)){
					$output = '<span class="grid-closed">'.esc_html__('Day Off!','listingpro').'</span>';
				}
			}else{
				if($status == true){
					$output = 'close';
				}
			}
			return $output;
		}
	}