<!--Revolution slider-->
<?php if(isset($slides)) { ?>
	<div class="<?php if($option['fullwidth'] == "on") echo "fullwidthbanner-container"; else echo "bannercontainer";?> ">
	<div class="grid-container">
	<div class=" grid-100 tablet-grid-100 mobile-grid-100">
		<div class="<?php if($option['fullwidth'] == "on") echo "fullwidthbanner"; else echo "banner";?>">
			<ul>
				<?php foreach($slides as $slide) { ?>
					<li <?php if($slide['enablelink'] == 1){ ?> data-link="<?php echo $slide['url'];?>" data-target="<?php echo $slide['target'];?>" <?php } ?>  data-transition="<?php echo $slide['transitions'];?>" data-slotamount="<?php echo $slide['slotamount'];?>" data-masterspeed="<?php echo $slide['masterspeed'];?>"  data-delay="<?php echo $slide['delay'];?>" <?php if ($slide['type_background'] == "image_bg") { ?> data-thumb="<?php echo $slide['thumb'];?>" <?php } ?> >
					<?php if ($slide['type_background'] == "color_bg") { ?>
						<img src="image/data/transparent.png" style="background-color:<?php echo $slide['background'];?>" >
					<?php }else{ ?>
						<img src="<?php echo $slide['background'];?>" >
					<?php } ?>
						<?php if(isset($slide['caption'])){ ?>
							<?php foreach ($slide['caption'] as $caption) {?>
							
								<div class="caption <?php echo $caption['class_css'];?> <?php echo $caption['incom_animation'];?> <?php echo $caption['outgo_animation'];?> <?php if($slide['enablefullvideo'] == 1 && $caption['type_caption'] == "video_caption") echo "fullscreenvideo" ; ?>" data-x="<?php echo $caption['datax'];?>" data-y="<?php echo $caption['datay'];?>" data-speed="<?php echo $caption['dataspeed'];?>" data-start="<?php echo $caption['datastart'];?>" data-easing="<?php echo $caption['easing'];?>"  data-end="<?php echo $caption['dataend'];?>" data-endspeed="<?php echo $caption['dataafterspeed']; ?>" data-endeasing="<?php echo $caption['endeasing'];?>" <?php if(isset($caption['hideunderwidth'])) echo "data-captionhidden=on"; ?> >
									<?php if($caption['type_caption'] == "text_caption")
											echo html_entity_decode($caption['text_caption'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8'); 
										  else if($caption['type_caption'] == "image_caption") {?>
											<img src="<?php echo $caption['image_caption'];?>" alt=""/>
										  <?php } else { ?> 
												<?php if ($caption['video_caption']['type'] == "youtube"){ ?>
													<iframe src="http://www.youtube.com/embed/<?php echo $caption['video_caption']['id'][$this->config->get('config_language_id')];?>?hd=1&amp;wmode=opaque&amp;controls=1&amp;showinfo=0" width="<?php echo $caption['video_caption']['width'];?>" height="<?php echo $caption['video_caption']['height'];?>" ></iframe>
												<?php } else {?>
													<iframe src="http://player.vimeo.com/video/<?php echo $caption['video_caption']['id'][$this->config->get('config_language_id')];?>?title=0&amp;byline=0&amp;portrait=0"></iframe>
												<?php } ?>
										  <?php } ?>
								</div>
								
							<?php } ?>
						<?php }?>
					</li>
				<?php } ?>
			</ul>
			<?php if($option['timeline'] == 1) { ?>
			<div class="tp-bannertimer <?php if($option['timerlineposition'] == "bottom") echo "tp-bottom";?>"></div> 
			<?php } ?>
		</div>
	</div>
	</div>
<script type="text/javascript">
			var api;
			jQuery(document).ready(function() {
			api =  jQuery("<?php if($option['fullwidth'] == "on") echo ".fullwidthbanner"; else echo ".banner";?>").revolution({
					delay:<?php echo $option['delay'];?>,
					startheight:<?php echo $option['startheight'];?>,
					startwidth:<?php echo $option['startwidth'];?>,

					hideThumbs:<?php echo $option['timehidethumbnail'];?>,

					thumbWidth:<?php echo $option['thumbnailwidth'];?>,		// Thumb With and Height and Amount (only if navigation Tyope set to thumb !)
					thumbHeight:<?php echo $option['thumbnailheight'];?>,
					thumbAmount:<?php echo $option['thumbamount'];?>,

					navigationType:"<?php echo $option['navigationtype'];?>",		// bullet, thumb, none - trong
					navigationArrows:"<?php echo $option['navigationarrow'];?>",	// nexttobullets, solo (old name verticalcentered), none - mui ten

					navigationStyle:"<?php echo $option['navigationstyle'];?>",				//round,square,navbar,round-old,square-old,navbar-old, or any from the list in the docu (choose between 50+ different item), custom - hinh cua icon tron
					navigationHAlign:"<?php echo $option['navigationhalign'];?>",				// Vertical Align top,center,bottom
					navigationVAlign:"<?php echo $option['navigationvalign'];?>",					// Horizontal Align left,center,right
					navigationHOffset:<?php echo $option['navigationhoffset'];?>,
					navigationVOffset:<?php echo $option['navigationvoffset'];?>,

					soloArrowLeftHalign:"<?php echo $option['soloarrowlefthalign'];?>",
					soloArrowLeftValign:"<?php echo $option['soloarrowleftvalign'];?>",
					soloArrowLeftHOffset:<?php echo $option['soloarrowlefthoffset'];?>,
					soloArrowLeftVOffset:<?php echo $option['soloarrowleftvoffset'];?>,

					soloArrowRightHalign:"<?php echo $option['soloarrowrighthalign'];?>",
					soloArrowRightValign:"<?php echo $option['soloarrowrightvalign'];?>",
					soloArrowRightHOffset:<?php echo $option['soloarrowrighthoffset'];?>,
					soloArrowRightVOffset:<?php echo $option['soloarrowrightvoffset'];?>,

					touchenabled:"<?php echo $option['touchenabled'];?>",	// Enable Swipe Function : on/off
					onHoverStop:"<?php echo $option['onhoverstop'];?>",	// Stop Banner Timet at Hover on Slide on/off

					stopAtSlide:-1,
					stopAfterLoops:-1,
					
					hideCaptionAtLimit:<?php echo $option['hidecapptionatlimit'];?>,					// It Defines if a caption should be shown under a Screen Resolution ( Basod on The Width of Browser)
					hideAllCaptionAtLilmit:<?php echo $option['hideallcapptionatlimit'];?>,				// Hide all The Captions if Width of Browser is less then this value
					hideSliderAtLimit:<?php echo $option['hideslideratlimit'];?>,					// Hide the whole slider, and stop also functions if Width of Browser is less than this value

					
					shadow:<?php echo $option['shadow'];?>,								//0 = no Shadow, 1,2,3 = 3 Different Art of Shadows  (No Shadow in Fullwidth Version !)
					fullWidth:"<?php echo $option['fullwidth'];?>"							// Turns On or Off the Fullwidth Image Centering in FullWidth Modus
						});
					});
			</script>
<?php } ?>
<script type="text/javascript" src="catalog/view/javascript/bossthemes/boss_revolutionslider/jquery.themepunch.plugins.min.js">
</script>
<script type="text/javascript" src="catalog/view/javascript/bossthemes/boss_revolutionslider/jquery.themepunch.revolution.min.js">
</script>
<?php 
if (file_exists('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/boss_revolutionslider/css/settings.css')) {
			echo '<link rel="stylesheet" type="text/css" href="catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/boss_revolutionslider/css/settings.css" media="screen" />';
		} else {
			echo '<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/boss_revolutionslider/css/settings.css" media="screen" />';
		}
?>
</div>
</div>
<!--Revolution slider-->
 