<?php 	
$this->document->addScript('catalog/view/javascript/osdemslide/jquery.cycle.all.js');
$this->document->addStyle('catalog/view/javascript/osdemslide/style.css');?>

<div id="Slider<?php echo $module; ?>" class="Slider" style="width: <?php echo $width; ?>px; height: <?php echo $height; ?>px;">		
<a id="SliderLink<?php echo $module; ?>" href="#"><div id="bigImages<?php echo $module; ?>" class="bigImages">
<?php 
	$i=0;
	foreach ($sliders as $slider) { ?>
		<img id="big<?php echo $module; ?>_<?php echo $i;?>" src="<?php echo $slider['image'];?>" class="bigImage" />
<?php $i++; } ?>
		</div></a>
	<div id="smallImages<?php echo $module; ?>" class="smallImages">
	<?php 
	$j=0;
	foreach ($sliders as $slider) { ?>
		<div id="small<?php echo $module; ?>_<?php echo $j;?>" class="smallImage"><img src="<?php echo $slider['thumb2'];?>" ></div>
<?php $j++; } ?>
		</div>	
	</div>		
		<p id="sliderLinks" style="display:none;">
		<?php 
	$k=0;
	foreach ($sliders as $slider) { ?>
			<a href="<?php echo $slider['link'];?>" id="small<?php echo $module; ?>_<?php echo $k; ?>"></a>
			<?php $k++; } ?>
			</p>


<script type="text/javascript">
		$(document).ready(function() {

			$('div#bigImages<?php echo $module; ?>').cycle({	fx: 'fade',
										speed: <?php echo $velocity;?>,
										timeout: <?php echo $duration;?>,
										fit: 1,
										pause:         1,
										height: <?php echo ($height-60);?>,
										width:  <?php echo ($width-30);?>,
										containerResize: 1,
										before:   onBefore<?php echo $module; ?> });
		}); 
		$('div#smallImages<?php echo $module; ?> div[id^="small<?php echo $module; ?>_"]').mouseover(function() {
			$('div#bigImages<?php echo $module; ?>').cycle('pause');
			$('div[id^="small<?php echo $module; ?>_"]').css('background','url("catalog/view/javascript/osdemslide/small.png") no-repeat');
			$(this).css('background','url("catalog/view/javascript/osdemslide/small_bg.png") no-repeat');
			var bigID=$(this).attr('id').replace('small<?php echo $module; ?>_','big<?php echo $module; ?>_');
			var newSliderLink=$('a[id='+$(this).attr('id')+']').attr('href');
			$('a#SliderLink<?php echo $module; ?>').attr('href',newSliderLink);
			$('div#bigImages<?php echo $module; ?> img[id!='+bigID+']').css({'display':'none','opacity':'0'});
			$('div#bigImages<?php echo $module; ?> img[id='+bigID+']').css({'display':'block','opacity':'1'});
			
		});	
		$('div#smallImages<?php echo $module; ?> div[id^="small<?php echo $module; ?>_"]').mouseout (function() { $('div#bigImages<?php echo $module; ?>').cycle('resume'); });		
		

		function onBefore<?php echo $module; ?>(curr, next, opts) {
			var smallID = next.id.replace('big<?php echo $module; ?>_','small<?php echo $module; ?>_');
			var newSliderLink=$('a[id='+smallID+']').attr('href');
			
			$('div#smallImages<?php echo $module; ?> div[id!='+smallID+']').css('background','url("catalog/view/javascript/osdemslide/small.png") no-repeat');
			$('div#'+smallID+'').css('background','url("catalog/view/javascript/osdemslide/small_bg.png") no-repeat');
			$('a#SliderLink<?php echo $module; ?>').attr('href',newSliderLink);
		}
		</script>
