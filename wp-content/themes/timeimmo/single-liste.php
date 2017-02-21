<?php get_header(); ?>


<!-- Titlebar
================================================== -->
<div id="titlebar" class="property-titlebar margin-bottom-0">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- BOUCLE -->
				<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
				<a href="listings-list-with-sidebar.html" class="back-to-listings"></a>
				<div class="property-title">
					<h2><?php the_title() ?><span class="property-badge">For Sale</span></h2>
					<span>
						<a href="#location" class="listing-address">
							<i class="fa fa-map-marker"></i>
							<?php the_field('adresse_du_bien'); ?>
						</a>
					</span>
				</div>

				<div class="property-pricing">
					<div>$420,000</div>
					<div class="sub-price">$770 / sq ft</div>
				</div>

				<?php endwhile; ?>
				<?php else : ?>
				<?php endif; ?>

			</div>
		</div>
	</div>
</div>


<!-- Content
================================================== -->
<div class="container">
	<div class="row margin-bottom-50">
		<div class="col-md-12">
		
			<!-- Slider Container -->
			<div class="property-slider-container">

				<!-- Agent Widget -->
				<div class="agent-widget">
					<div class="agent-title">
						<div class="agent-photo"><img src="images/agent-avatar.jpg" alt="" /></div>
						<div class="agent-details">
							<h4><a href="#">Jennie Wilson</a></h4>
							<span><i class="sl sl-icon-call-in"></i>(123) 123-456</span>
						</div>
						<div class="clearfix"></div>
					</div>

					<input type="text" placeholder="Your Email" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$">
					<input type="text" placeholder="Your Phone">
					<textarea>I'm interested in this property [ID 123456] and I'd like to know more details.</textarea>
					<button class="button fullwidth margin-top-5">Send Message</button>
				</div>
				<!-- Agent Widget / End -->

				<!-- Slider -->
				<div class="property-slider no-arrows">
					<?php $image = get_field('large_image_list');
					if( !empty($image) ): ?>
						<a href="<?php echo $image['url']; ?>" data-background-image="<?php echo $image['url']; ?>" class="item mfp-gallery"></a>
					<?php endif; ?>
					<?php $image = get_field('grande_image_2');
					if( !empty($image) ): ?>
						<a href="<?php echo $image['url']; ?>" data-background-image="<?php echo $image['url']; ?>" class="item mfp-gallery"></a>
					<?php endif; ?>
					<?php $image = get_field('grande_image_3');
					if( !empty($image) ): ?>
						<a href="<?php echo $image['url']; ?>" data-background-image="<?php echo $image['url']; ?>" class="item mfp-gallery"></a>
					<?php endif; ?>
					<?php $image = get_field('grande_image_4');
					if( !empty($image) ): ?>
						<a href="<?php echo $image['url']; ?>" data-background-image="<?php echo $image['url']; ?>" class="item mfp-gallery"></a>
					<?php endif; ?>
					<?php $image = get_field('grande_image_5');
					if( !empty($image) ): ?>
						<a href="<?php echo $image['url']; ?>" data-background-image="<?php echo $image['url']; ?>" class="item mfp-gallery"></a>
					<?php endif; ?>
					<?php $image = get_field('grande_image_6');
					if( !empty($image) ): ?>
						<a href="<?php echo $image['url']; ?>" data-background-image="<?php echo $image['url']; ?>" class="item mfp-gallery"></a>
					<?php endif; ?>
				</div>
				<!-- Slider / End -->

			</div>
			<!-- Slider Container / End -->

			<!-- Slider Thumbs -->
			<div class="property-slider-nav">
					<?php $image = get_field('large_image_list');
					if( !empty($image) ): ?>
						<div class="item"><img src="<?php echo $image['url']; ?>" alt=""></div>
					<?php endif; ?>
					<?php $image = get_field('grande_image_2');
					if( !empty($image) ): ?>
						<div class="item"><img src="<?php echo $image['url']; ?>" alt=""></div>
					<?php endif; ?>
					<?php $image = get_field('grande_image_3');
					if( !empty($image) ): ?>
						<div class="item"><img src="<?php echo $image['url']; ?>" alt=""></div>
					<?php endif; ?>
					<?php $image = get_field('grande_image_4');
					if( !empty($image) ): ?>
						<div class="item"><img src="<?php echo $image['url']; ?>" alt=""></div>
					<?php endif; ?>
					<?php $image = get_field('grande_image_5');
					if( !empty($image) ): ?>
						<div class="item"><img src="<?php echo $image['url']; ?>" alt=""></div>
					<?php endif; ?>
					<?php $image = get_field('grande_image_6');
					if( !empty($image) ): ?>
						<div class="item"><img src="<?php echo $image['url']; ?>" alt=""></div>
					<?php endif; ?>
			</div>

		</div>
	</div>
</div>


<div class="container">
	<div class="row">
		
		<!-- BOUCLE -->
		<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>

		<!-- Property Description -->
		<div class="col-lg-8 col-md-7">
			<div class="property-description">

				<!-- Main Features -->
				<ul class="property-main-features">
					<li>Area <span>1450 sq ft</span></li>
					<li>Rooms <span>4</span></li>
					<li>Bedrooms <span>2</span></li>
					<li>Bathrooms <span>1</span></li>
				</ul>


				<!-- Description -->
				<h3 class="desc-headline">Description</h3>
				<div class="show-more">
					<?php the_content() ?>

					<a href="#" class="show-more-button">Voir plus <i class="fa fa-angle-down"></i></a>
				</div>

				<!-- Details -->
				<h3 class="desc-headline">Details</h3>
				<ul class="property-features margin-top-0">
					<li>Building Age: <span>2 Years</span></li>
					<li>Parking: <span>Attached Garage</span></li>
					<li>Cooling: <span>Central Cooling</span></li>
					<li>Heating: <span>Forced Air, Gas</span></li>
					<li>Sewer: <span>Public/City</span></li>
					<li>Water: <span>City</span></li>
					<li>Exercise Room: <span>Yes</span></li>
					<li>Storage Room: <span>Yes</span></li>
				</ul>


				<!-- Features -->
				<h3 class="desc-headline">Features</h3>
				<ul class="property-features checkboxes margin-top-0">
					<li>Air Conditioning</li>
					<li>Swimming Pool</li>
					<li>Central Heating</li>
					<li>Laundry Room</li>
					<li>Gym</li>
					<li>Alarm</li>
					<li>Window Covering</li>
					<li>Internet</li>
				</ul>


				<!-- Location -->
				<h3 class="desc-headline no-border" id="location">Location</h3>
				<div id="propertyMap-container">
					<div id="propertyMap" data-latitude="40.7427837" data-longitude="-73.11445617675781"></div>
					<a href="#" id="streetView">Street View</a>
				</div>


				<!-- Similar Listings Container -->
				<h3 class="desc-headline no-border margin-bottom-35 margin-top-60">Similar Properties</h3>

				<!-- Layout Switcher -->

				<div class="layout-switcher hidden"><a href="#" class="list"><i class="fa fa-th-list"></i></a></div>
				<div class="listings-container list-layout">

					<!-- Listing Item -->
					<div class="listing-item">

						<a href="#" class="listing-img-container">

							<div class="listing-badges">
								<span>For Rent</span>
							</div>

							<div class="listing-img-content">
								<span class="listing-price">$1700 <i>monthly</i></span>
								<span class="like-icon"></span>
							</div>

							<img src="images/listing-03.jpg" alt="">

						</a>
						
						<div class="listing-content">

							<div class="listing-title">
								<h4><a href="#">Meridian Villas</a></h4>
								<a href="https://www.google.com/maps/place/Waterloo,+Belgium/@50.7034541,4.3629149,13z/data=!3m1!4b1!4m5!3m4!1s0x47c3d1c32d7f21d9:0x40099ab2f4d7280!8m2!3d50.71469!4d4.3991?hl=en" class="listing-address popup-gmaps">
									<i class="fa fa-map-marker"></i>
									778 Country St. Panama City, FL
								</a>

								<a href="#" class="details button border">Details</a>
							</div>

							<ul class="listing-details">
								<li>1450 sq ft</li>
								<li>1 Bedroom</li>
								<li>2 Rooms</li>
								<li>2 Rooms</li>
							</ul>

							<div class="listing-footer">
								<a href="#"><i class="fa fa-user"></i> Chester Miller</a>
								<span><i class="fa fa-calendar-o"></i> 4 days ago</span>
							</div>

						</div>
						<!-- Listing Item / End -->

					</div>
					<!-- Listing Item / End -->


					<!-- Listing Item -->
					<div class="listing-item">

						<a href="#" class="listing-img-container">

							<div class="listing-badges">
								<span>For Sale</span>
							</div>

							<div class="listing-img-content">
								<span class="listing-price">$420,000 <i>$770 / sq ft</i></span>
								<span class="like-icon"></span>
							</div>

							<div><img src="images/listing-04.jpg" alt=""></div>

						</a>
						
						<div class="listing-content">

							<div class="listing-title">
								<h4><a href="#">Selway Apartments</a></h4>
								<a href="https://maps.google.com/maps?q=221B+Baker+Street,+London,+United+Kingdom&hl=en&t=v&hnear=221B+Baker+St,+London+NW1+6XE,+United+Kingdom" class="listing-address popup-gmaps">
									<i class="fa fa-map-marker"></i>
									33 William St. Northbrook, IL
								</a>

								<a href="#" class="details button border">Details</a>
							</div>

							<ul class="listing-details">
								<li>540 sq ft</li>
								<li>1 Bedroom</li>
								<li>3 Rooms</li>
								<li>2 Bathroom</li>
							</ul>

							<div class="listing-footer">
								<a href="#"><i class="fa fa-user"></i> Kristen Berry</a>
								<span><i class="fa fa-calendar-o"></i> 3 days ago</span>
							</div>

						</div>
						<!-- Listing Item / End -->

					</div>
					<!-- Listing Item / End -->


					<!-- Listing Item -->
					<div class="listing-item">

						<a href="#" class="listing-img-container">
							<div class="listing-badges">
								<span>For Sale</span>
							</div>

							<div class="listing-img-content">
								<span class="listing-price">$535,000 <i>$640 / sq ft</i></span>
								<span class="like-icon"></span>
							</div>

							<img src="images/listing-05.jpg" alt="">
						</a>
						
						<div class="listing-content">

							<div class="listing-title">
								<h4><a href="#">Oak Tree Villas</a></h4>
								<a href="https://maps.google.com/maps?q=221B+Baker+Street,+London,+United+Kingdom&hl=en&t=v&hnear=221B+Baker+St,+London+NW1+6XE,+United+Kingdom" class="listing-address popup-gmaps">
									<i class="fa fa-map-marker"></i>
									71 Lower River Dr. Bronx, NY
								</a>

								<a href="#" class="details button border">Details</a>
							</div>

							<ul class="listing-details">
								<li>350 sq ft</li>
								<li>1 Bedroom</li>
								<li>2 Rooms</li>
								<li>1 Bathroom</li>
							</ul>

							<div class="listing-footer">
								<a href="#"><i class="fa fa-user"></i> Mabel Gagnon</a>
								<span><i class="fa fa-calendar-o"></i> 4 days ago</span>
							</div>

						</div>
						<!-- Listing Item / End -->

					</div>
					<!-- Listing Item / End -->

				</div>
				<!-- Similar Listings Container / End -->

			</div>
		</div>
		<!-- Property Description / End -->

		<?php endwhile; ?>
		<?php else : ?>
		<?php endif; ?>


		<!-- Sidebar -->
		<div class="col-lg-4 col-md-5">
			<div class="sidebar sticky right">

				<!-- Widget -->
				<div class="widget margin-bottom-35">
					<button class="widget-button"><i class="sl sl-icon-printer"></i> Print</button>
					<button class="widget-button save" data-save-title="Save" data-saved-title="Saved"><span class="like-icon"></span></button>
				</div>
				<!-- Widget / End -->


				<!-- Widget -->
				<div class="widget">
					<h3 class="margin-bottom-35">Featured Properties</h3>

					<div class="listing-carousel outer">
						<!-- Item -->
						<div class="item">
							<div class="listing-item compact">

								<a href="#" class="listing-img-container">

									<div class="listing-badges">
										<span class="featured">Featured</span>
										<span>For Sale</span>
									</div>

									<div class="listing-img-content">
										<span class="listing-compact-title">Eagle Apartments <i>$275,000</i></span>

										<ul class="listing-hidden-content">
											<li>Area <span>530 sq ft</span></li>
											<li>Rooms <span>3</span></li>
											<li>Beds <span>1</span></li>
											<li>Baths <span>1</span></li>
										</ul>
									</div>

									<img src="images/listing-01.jpg" alt="">
								</a>

							</div>
						</div>
						<!-- Item / End -->

						<!-- Item -->
						<div class="item">
							<div class="listing-item compact">

								<a href="#" class="listing-img-container">

									<div class="listing-badges">
										<span class="featured">Featured</span>
										<span>For Sale</span>
									</div>

									<div class="listing-img-content">
										<span class="listing-compact-title">Selway Apartments <i>$245,000</i></span>

										<ul class="listing-hidden-content">
											<li>Area <span>530 sq ft</span></li>
											<li>Rooms <span>3</span></li>
											<li>Beds <span>1</span></li>
											<li>Baths <span>1</span></li>
										</ul>
									</div>

									<img src="images/listing-02.jpg" alt="">
								</a>

							</div>
						</div>
						<!-- Item / End -->

						<!-- Item -->
						<div class="item">
							<div class="listing-item compact">

								<a href="#" class="listing-img-container">

									<div class="listing-badges">
										<span class="featured">Featured</span>
										<span>For Sale</span>
									</div>

									<div class="listing-img-content">
										<span class="listing-compact-title">Oak Tree Villas <i>$325,000</i></span>

										<ul class="listing-hidden-content">
											<li>Area <span>530 sq ft</span></li>
											<li>Rooms <span>3</span></li>
											<li>Beds <span>1</span></li>
											<li>Baths <span>1</span></li>
										</ul>
									</div>

									<img src="images/listing-03.jpg" alt="">
								</a>

							</div>
						</div>
						<!-- Item / End -->
					</div>

				</div>
				<!-- Widget / End -->

				<!-- Widget -->
				<div class="widget margin-bottom-40">
					<h3 class="margin-top-0 margin-bottom-35">Find New Home</h3>

					<!-- Row -->
					<div class="row with-forms">
						<!-- Status -->
						<div class="col-md-12">
							<select data-placeholder="Any Status" class="chosen-select-no-single" >
								<option>Any Status</option>	
								<option>For Sale</option>
								<option>For Rent</option>
							</select>
						</div>
					</div>
					<!-- Row / End -->


					<!-- Row -->
					<div class="row with-forms">
						<!-- Type -->
						<div class="col-md-12">
							<select data-placeholder="Any Type" class="chosen-select-no-single" >
								<option>Any Type</option>	
								<option>Apartments</option>
								<option>Houses</option>
								<option>Commercial</option>
								<option>Garages</option>
								<option>Lots</option>
							</select>
						</div>
					</div>
					<!-- Row / End -->


					<!-- Row -->
					<div class="row with-forms">
						<!-- States -->
						<div class="col-md-12">
							<select data-placeholder="All States" class="chosen-select" >
								<option>All States</option>	
								<option>Alabama</option>
								<option>Alaska</option>
								<option>Arizona</option>
								<option>Arkansas</option>
								<option>California</option>
								<option>Colorado</option>
								<option>Connecticut</option>
								<option>Delaware</option>
								<option>Florida</option>
								<option>Georgia</option>
								<option>Hawaii</option>
								<option>Idaho</option>
								<option>Illinois</option>
								<option>Indiana</option>
								<option>Iowa</option>
								<option>Kansas</option>
								<option>Kentucky</option>
								<option>Louisiana</option>
								<option>Maine</option>
								<option>Maryland</option>
								<option>Massachusetts</option>
								<option>Michigan</option>
								<option>Minnesota</option>
								<option>Mississippi</option>
								<option>Missouri</option>
								<option>Montana</option>
								<option>Nebraska</option>
								<option>Nevada</option>
								<option>New Hampshire</option>
								<option>New Jersey</option>
								<option>New Mexico</option>
								<option>New York</option>
								<option>North Carolina</option>
								<option>North Dakota</option>
								<option>Ohio</option>
								<option>Oklahoma</option>
								<option>Oregon</option>
								<option>Pennsylvania</option>
								<option>Rhode Island</option>
								<option>South Carolina</option>
								<option>South Dakota</option>
								<option>Tennessee</option>
								<option>Texas</option>
								<option>Utah</option>
								<option>Vermont</option>
								<option>Virginia</option>
								<option>Washington</option>
								<option>West Virginia</option>
								<option>Wisconsin</option>
								<option>Wyoming</option>
							</select>
						</div>
					</div>
					<!-- Row / End -->


					<!-- Row -->
					<div class="row with-forms">
						<!-- Cities -->
						<div class="col-md-12">
							<select data-placeholder="All Cities" class="chosen-select" >
								<option>All Cities</option>
								<option>New York</option>
								<option>Los Angeles</option>
								<option>Chicago</option>
								<option>Brooklyn</option>
								<option>Queens</option>
								<option>Houston</option>
								<option>Manhattan</option>
								<option>Philadelphia</option>
								<option>Phoenix</option>
								<option>San Antonio</option>
								<option>Bronx</option>
								<option>San Diego</option>
								<option>Dallas</option>
								<option>San Jose</option>
							</select>
						</div>
					</div>
					<!-- Row / End -->


					<!-- Row -->
					<div class="row with-forms">

						<!-- Min Area -->
						<div class="col-md-6">
							<select data-placeholder="Beds" class="chosen-select-no-single" >
								<option label="blank"></option>	
								<option>Beds (Any)</option>	
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
							</select>
						</div>

						<!-- Max Area -->
						<div class="col-md-6">
							<select data-placeholder="Baths" class="chosen-select-no-single" >
								<option label="blank"></option>	
								<option>Baths (Any)</option>	
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
							</select>
						</div>

					</div>
					<!-- Row / End -->

					<br>

					<!-- Area Range -->
					<div class="range-slider">
						<label>Area Range</label>
						<div id="area-range" data-min="0" data-max="1500" data-unit="sq ft"></div>
						<div class="clearfix"></div>
					</div>

					<br>
					
					<!-- Price Range -->
					<div class="range-slider">
						<label>Price Range</label>
						<div id="price-range" data-min="0" data-max="400000" data-unit="$"></div>
						<div class="clearfix"></div>
					</div>



					<!-- More Search Options -->
					<a href="#" class="more-search-options-trigger margin-bottom-10 margin-top-30" data-open-title="Additional Features" data-close-title="Additional Features"></a>

					<div class="more-search-options relative">

						<!-- Checkboxes -->
						<div class="checkboxes one-in-row margin-bottom-10">
					
							<input id="check-2" type="checkbox" name="check">
							<label for="check-2">Air Conditioning</label>

							<input id="check-3" type="checkbox" name="check">
							<label for="check-3">Swimming Pool</label>

							<input id="check-4" type="checkbox" name="check" >
							<label for="check-4">Central Heating</label>

							<input id="check-5" type="checkbox" name="check">
							<label for="check-5">Laundry Room</label>	


							<input id="check-6" type="checkbox" name="check">
							<label for="check-6">Gym</label>

							<input id="check-7" type="checkbox" name="check">
							<label for="check-7">Alarm</label>

							<input id="check-8" type="checkbox" name="check">
							<label for="check-8">Window Covering</label>
					
						</div>
						<!-- Checkboxes / End -->

					</div>
					<!-- More Search Options / End -->

					<button class="button fullwidth margin-top-30">Search</button>


				</div>
				<!-- Widget / End -->

			</div>
		</div>
		<!-- Sidebar / End -->

	</div>
</div>


<?php get_footer(); ?>