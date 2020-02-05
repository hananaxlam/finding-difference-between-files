<div class="open-hours">
	<!-- <h2><?php echo esc_html__('Opening Hours', 'listingpro');?></h2> -->
	<?php
	global $listingpro_options;
	$listing_mobile_view    =   $listingpro_options['single_listing_mobile_view'];
	$format = $listingpro_options['timing_option'];
		$buisness_hours = listing_get_metabox('business_hours');
		if(!empty($buisness_hours) && is_array($buisness_hours)){
				$lat = listing_get_metabox('latitude');
				$long = listing_get_metabox('longitude');
			//$timezone = getClosestTimezone($lat, $long);
			$timezone  = get_option('gmt_offset');
			$time = gmdate("H:i", time() + 3600*($timezone+date("I"))); 
			$day =  gmdate("l"); 
			$lang = get_locale();
			setlocale(LC_ALL, $lang.'.utf-8');
			$day = strftime("%A");
			$day = ucfirst($day);
			$time = strtotime($time);
			echo '<div class="today-hrs pos-relative"><ul>';
			$dayName = esc_html__('Today','listingpro');
			foreach($buisness_hours as $key=>$value){
				$keyArray[] = $key;
				if($day == $key){
					$opencheck = $value['open'];
					$open = $value['open'];
					$open = str_replace(' ', '', $open);
					$close = $value['close'];
					$closecheck = $value['close'];
					$close = str_replace(' ', '', $close);
					$open = strtotime($open);
					$close = strtotime($close);					
					if(!empty($format) && $format == '24'){
						$newTimeOpen = date("H:i", $open);
						$newTimeClose = date("H:i", $close);
					}else{						
						$newTimeOpen = date('h:i A', $open);
						$newTimeClose = date('h:i A', $close);
					}
					
					echo '<li class="today-timing clearfix"><strong>'.listingpro_icons('todayTime').' '.$dayName.'</strong>';
						if( empty($opencheck) && empty($closecheck) ){
							echo '<span><a class="Opened">'.esc_html__('24 hours open','listingpro').'</a></span>';
						}
						elseif($time > $open && $time < $close){
							echo '<a class="Opened">'.esc_html__('Open Now~','listingpro').'</a>';
						}else{
							echo '<a class="closed">'.esc_html__('Closed Now!','listingpro').'</a>';
						}

						
						if( $listing_mobile_view == 'responsive_view' || !wp_is_mobile() ){
							if( !empty($opencheck) && !empty($closecheck) ){
								echo '<span>'.$newTimeOpen.' - '.$newTimeClose.'</span></li>';
							}
						}
					
				}
			}
			if(is_array($keyArray) && !in_array($day, $keyArray)){
				echo '<li class="today-timing clearfix"><strong>'.listingpro_icons('todayTime').' '.$dayName.'</strong>';
				echo '<span><a class="closed dayoff">'.esc_html__('Day Off!','listingpro').'</a></span></li>';
			}
			echo '</ul>';
			
			if( $listing_mobile_view == 'app_view' && wp_is_mobile() ){
                echo '<a href="#" class="show-all-timings">'.esc_html__('Show More','listingpro').'</a>';
            }
            else{
                echo '<a href="#" class="show-all-timings">'.esc_html__('Show all timings','listingpro').'</a>';
            }
			echo '<ul class="hidding-timings">';
			foreach($buisness_hours as $key=>$value){
				$dayName = $key;
				$opencheck = $value['open'];
				$open = $value['open'];
				$open = str_replace(' ', '', $open);
				$close = $value['close'];
				$closecheck = $value['close'];
				$close = str_replace(' ', '', $close);
				$open = strtotime($open);
				$close = strtotime($close);
				if(!empty($format) && $format == '24'){
					$newTimeOpen = date("H:i", $open);
					$newTimeClose = date("H:i", $close);
				}else{						
					$newTimeOpen = date('h:i A', $open);
					$newTimeClose = date('h:i A', $close);
				}
				echo '<li><strong>'.$dayName.'</strong>';
				if(!empty($opencheck)&& !empty($closecheck)){
					echo '<span>'.$newTimeOpen.' - '.$newTimeClose.'</span></li>';
				}
				else{
					echo '<span class="Opened">'.esc_html__('24 hours open', 'listingpro').'</span></li>';
				}
			}
			echo '</ul>';
			echo '</div>';
		}
	?>
</div>
