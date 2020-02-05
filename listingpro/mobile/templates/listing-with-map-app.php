<?php

					$type = 'listing';
					$term_id = '';
					$taxName = '';
					$termID = '';
					$term_ID = '';
					global $paged, $listingpro_options;
					
					
					$taxTaxDisplay = true;
					$TxQuery = '';
					$tagQuery = '';
					$catQuery = '';
					$locQuery = '';
					$taxQuery = '';
					$searchQuery = '';
					$sKeyword = '';
					$priceQuery = '';
					$postsonpage = '';
					if(isset($listingpro_options['listing_per_page'])){
						$postsonpage = $listingpro_options['listing_per_page'];
					}
					else{
						$postsonpage = 10;
					}
					if( !empty($_GET['s']) && isset($_GET['s']) && $_GET['s']=="home" ){
						if( !empty($_GET['lp_s_tag']) && isset($_GET['lp_s_tag'])){
							$lpsTag = sanitize_text_field($_GET['lp_s_tag']);
							$tagQuery = array(
								'taxonomy' => 'list-tags',
								'field' => 'id',
								'terms' => $lpsTag,
								'operator'=> 'IN' //Or 'AND' or 'NOT IN'
							);
						}
						
						if( !empty($_GET['lp_s_cat']) && isset($_GET['lp_s_cat'])){
							$lpsCat = sanitize_text_field($_GET['lp_s_cat']);
							$catQuery = array(
								'taxonomy' => 'listing-category',
								'field' => 'id',
								'terms' => $lpsCat,
								'operator'=> 'IN' //Or 'AND' or 'NOT IN'
							);
							$taxName = 'listing-category';
						}
						
						if( !empty($_GET['lp_s_loc']) && isset($_GET['lp_s_loc'])){							
							$lpsLoc = sanitize_text_field($_GET['lp_s_loc']);
							if(is_numeric($lpsLoc)){
								$lpsLoc = $lpsLoc;
							}
							else{
								$term = listingpro_term_exist($lpsLoc,'location');
								if(!empty($term)){
									$lpsLoc=$term['term_id'];
								}
								else{
									$lpsLoc = '';
								}
							}
							$locQuery = array(
								'taxonomy' => 'location',
								'field' => 'id',
								'terms' => $lpsLoc,
								'operator'=> 'IN' //Or 'AND' or 'NOT IN'
							);
						}
						/* on 3 april by zaheer */
						if( empty($_GET['lp_s_tag']) && empty($_GET['lp_s_cat']) && !empty($_GET['select']) ){
							
							$sKeyword = sanitize_text_field($_GET['select']);
							
						}
						if( empty($_GET['lp_s_loc']) && empty($_GET['lp_s_tag']) && empty($_GET['lp_s_cat']) && empty($_GET['select']) ){
							//$postsonpage = 25;
						}
						/* end on 3 april by zaheer */
						$TxQuery = array(
							'relation' => 'AND',
							$tagQuery,
							$catQuery,
							$locQuery,
						);
					$ad_campaignsIDS = listingpro_get_campaigns_listing( 'lp_top_in_search_page_ads', TRUE,$taxQuery,$TxQuery,$priceQuery,$sKeyword, null, null);	
					}
					else{
						$queried_object = get_queried_object();
						$term_id = $queried_object->term_id;
						$taxName = $queried_object->taxonomy;
						if(!empty($term_id)){
							$termID = get_term_by('id', $term_id, $taxName);
							$termName = $termID->name;
							$term_ID = $termID->term_id;
						}
						
						$TxQuery = array(
							array(
								'taxonomy' => $taxName,
								'field' => 'id',
								'terms' => $termID->term_id,
								'operator'=> 'IN' //Or 'AND' or 'NOT IN'
							),
						);
					$ad_campaignsIDS = listingpro_get_campaigns_listing( 'lp_top_in_search_page_ads', TRUE, $TxQuery,$searchQuery,$priceQuery,$sKeyword, null, null );
					}

					$args=array(
						'post_type' => $type,
						'post_status' => 'publish',
						'posts_per_page' => $postsonpage,
						's'	=> $sKeyword,
						'paged'  => $paged,
						'post__not_in' =>$ad_campaignsIDS,
						'tax_query' => $TxQuery				
					);
					
					$my_query = null;
					$my_query = new WP_Query($args);
					$found = $my_query->found_posts;
					if(($found > 1)){
						$foundtext = esc_html__('Results', 'listingpro');
					}else{
						$foundtext = esc_html__('Result', 'listingpro');
					}
					// Harry Code

					$listing_layout = $listingpro_options['listing_views'];
					$addClassListing = '';
					$icon_markup    =   '';
					 if( $listing_layout == 'list_view' )
					 {
                        $icon_markup    =   '<i class="fa fa-list" aria-hidden="true"></i>';
                    }
                    else
                    {
                        $icon_markup    =   '<i class="fa fa-th-large" aria-hidden="true"></i>';
                    }
					if($listing_layout == 'list_view') {
						$addClassListing = 'listing_list_view';
					}
?>

<script>
    jQuery(document).ready(function(e){
        jQuery('.listing-app-view-bar .right-icons a').click(function(e){
            e.preventDefault();
            var buttonAction    =   jQuery(this).data('action');
            if( buttonAction == 'map_view' )
            {
                if(jQuery(this).hasClass('close-map-view')){
                    jQuery('.map-view-list-container').hide();
                    jQuery('.sidemap-fixed').removeClass('open-map');
                    jQuery(this).removeClass('close-map-view');
                    jQuery(this).html('<i class="fa fa-map-marker" aria-hidden="true"></i>');
					jQuery('.map-view-list-container').slick('unslick');
                }else{
                    jQuery('.sidemap-fixed').addClass('open-map');
                    jQuery(this).html('<?php echo $icon_markup; ?>');
                    jQuery(this).addClass('close-map-view');
                    jQuery('.map-view-list-container').show();
                    jQuery('.map-view-list-container').slick({
                        centerMode: false,
						autoplay: true,
                        centerPadding: '30px',
                        slidesToShow: 1,
                        arrows: false
                    });
                }

            }
        });

        jQuery('.open-app-view').click(function(e){
            e.preventDefault();
            jQuery('.map-view-list-container').hide();
        })
		
    })
</script>

	<!--==================================Section Open=================================-->
	<section class="page-container clearfix section-fixed listing-with-map pos-relative taxonomy" id="<?php echo esc_attr($taxName); ?>">
       <!--modal 7, for app view filters-->
        <div class="md-modal md-effect-3 app-view-filters" id="modal-7">
            <div class="md-content">
                <?php get_template_part('mobile/templates/search/filter-app-view'); ?>
            </div>
            <a class="md-close widget-map-click"><i class="fa fa-close"></i></a>
        </div>

		<div class="md-overlay"></div> <!-- Overlay for Popup -->
	   <div class="listing-app-view-bar">
            <div class="col-xs-1 search-filter">
                <a href="#" class="md-trigger" data-modal="modal-7"><i class="fa fa-filter" aria-hidden="true"></i></a>
				
            </div>
            <div class="col-xs-11 text-right right-icons">
                <a href="#" data-action="map_view" class="map-view-icon"><i class="fa fa-map-marker" aria-hidden="true"></i></a>
                
				<div class="search-filter-attr-filter-inner">
					<div class="search-filter-attr-filter-outer">
						<?php
						$priceOPT = $listingpro_options['enable_price_search_filter'];
						if(!empty($priceOPT) && $priceOPT=='1'){
							$lp_priceSymbol = $listingpro_options['listing_pricerange_symbol'];
							$lp_priceSymbol2 = $lp_priceSymbol.$lp_priceSymbol;
							$lp_priceSymbol3 = $lp_priceSymbol2.$lp_priceSymbol;
							$lp_priceSymbol4 = $lp_priceSymbol3.$lp_priceSymbol;
							?>
							<div class="form-group pricy-form-group margin-right-0">
								
								<div id="lp-find-near-me" class="search-filters form-group margin-right-0">
									<ul>
										<li>
											<a  class="margin-right-0" href="#" class="map-view-icon2"  id="map-view-icon2"><?php echo esc_html__('Price..', 'listingpro'); ?></a>
										</li>
									</ul>
								</div>
								<div class="currency-signs search-filter-attr " id="search-filter-attr-filter">
									<ul>
										<li class="simptip-position-top simptip-movable" data-tooltip="<?php echo esc_html__( 'Inexpensive', 'listingpro' );?>" id="one"><a href="#" data-price="inexpensive"><?php echo $lp_priceSymbol; ?></a></li>
										<li class="simptip-position-top simptip-movable" data-tooltip="<?php echo esc_html__( 'Moderate', 'listingpro' );?>" id="two"><a href="#" data-price="moderate"><?php echo $lp_priceSymbol2; ?></a></li>
										<li class="simptip-position-top simptip-movable" data-tooltip="<?php echo esc_html__( 'Pricey', 'listingpro' );?>" id="three"><a href="#" data-price="pricey"><?php echo $lp_priceSymbol3; ?></a></li>
										<li class="simptip-position-top simptip-movable" data-tooltip="<?php echo esc_html__( 'Ultra High End', 'listingpro' );?>" id="four"><a href="#" data-price="ultra_high_end"><?php echo $lp_priceSymbol4; ?></a></li>
									</ul>
								</div>
							</div>
						<?php } ?>
						<?php
						$openTimeOPT = $listingpro_options['enable_opentime_search_filter'];
						if(!empty($openTimeOPT) && $openTimeOPT=='1'){
							?>
							<div class="search-filters form-group margin-right-0">
								<ul>
									<li id="listing_openTime"><a href="#" data-value="close"><i class="fa fa-clock-o"></i><?php echo esc_html__( 'Open Now', 'listingpro' );?></a></li>
								</ul>
							</div>
						<?php } ?>
						<div id="lp-find-near-me" class="search-filters form-group margin-right-0">
							<ul>
								<li>
									<a  class="btn default near-me-btn" href=""><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo esc_html__('Near Me', 'listingpro'); ?></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="sidemap-container pull-right sidemap-fixed">
            <div class="map-pop map-container3" id="map-section">
                <div id='map' class="mapSidebar"></div>
            </div>
            <a href="#" class="open-img-view open-app-view"><i class="fa fa-file-image-o"></i></a>
        </div>
        <div class="all-list-map"></div>
        <?php
        if( $my_query->have_posts() ) {
            echo '<div class="map-view-list-container">';
            while ($my_query->have_posts()) : $my_query->the_post();
                get_template_part( 'mobile/listing-loop-app-view2' );
            endwhile;
            wp_reset_query();
            echo '</div>';
        } ?>
        <div class=" pull-left post-with-map-container-right">
            <div class="post-with-map-container pull-left">

                <div class="content-grids-wraps">
                    <div class="clearfix lp-list-page-grid" id="content-grids" >
                        <?php
                            $array['features'] = '';
                            ?>
                            <div class="promoted-listings">
                                <?php
                                if( !empty($_GET['s']) && isset($_GET['s']) && $_GET['s']=="home" ){
                                    echo listingpro_get_campaigns_listing( 'lp_top_in_search_page_ads', false,$taxQuery,$TxQuery,$priceQuery,$sKeyword, null, null);
                                }else{
                                    echo listingpro_get_campaigns_listing( 'lp_top_in_search_page_ads', false, $TxQuery,$searchQuery,$priceQuery,$sKeyword, null, null);
                                }
                                ?>
                            <div class="md-overlay"></div>
                            </div>
                            <?php
                            if( $my_query->have_posts() ) {
                                while ($my_query->have_posts()) : $my_query->the_post();
                                    get_template_part( 'mobile/listing-loop-app-view' );
                                endwhile;
                                wp_reset_query();
                            }elseif(empty($ad_campaignsIDS)){
                                ?>
                                    <div class="text-center margin-top-80 margin-bottom-80">
                                        <h2><?php esc_html_e('No Results','listingpro'); ?></h2>
                                        <p><?php esc_html_e('Sorry! There are no listings matching your search.','listingpro'); ?></p>
                                        <p><?php esc_html_e('Try changing your search filters or','listingpro'); ?>
                                        <?php
                                        $currentURL = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                        ?>
                                            <a href="<?php echo esc_url($currentURL); ?>"><?php esc_html_e('Reset Filter','listingpro'); ?></a>
                                        </p>
                                    </div>
                                <?php
                            }

                        ?>
                    <div class="md-overlay"></div>
                    </div>
                </div>

            <?php
                    echo '<div id="lp-pages-in-cats">';
                    echo listingpro_load_more_filter($my_query, '1', $sKeyword);
                    echo '</div>';
             ?>
            <div class="lp-pagination pagination lp-filter-pagination-ajx"></div>
            </div>
            <input type="hidden" id="lp_current_query" value="<?php echo $sKeyword ?>">
        </div>
	</section>