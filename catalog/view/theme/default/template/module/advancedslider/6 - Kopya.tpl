<?php 	
$this->document->addScript('catalog/view/javascript/kwicks/jquery.easing.1.3.js');
$this->document->addScript('catalog/view/javascript/kwicks/jquery.kwicks.min.js');
$this->document->addStyle('catalog/view/javascript/kwicks/style.css');?>
<div class="slideshow">
  <div id="slideshow<?php echo $module; ?>" style="width: <?php echo $width; ?>px; height: <?php echo $height; ?>px; margin-bottom:5px;">
  <ul id="kwicks_<?php echo $module; ?>" class="kwicks kwicks-horizontal" >
    <?php 
	$i=0;
	$sliders_size=count($sliders);
	foreach ($sliders as $slider) { ?>
    <?php if ($slider['link']) { ?>
	
    <li id="kwick_<?php echo $module; ?>_<?php echo $i;?>" style="width: <?php echo ($width/$sliders_size)+20; ?>px;	height: <?php echo $height; ?>px;"><a href="<?php echo $slider['link']; ?>"><img src="<?php echo $slider['image']; ?>" alt="<?php echo $slider['title']; ?>" /></a></li>
    <?php } else { ?>
    <li id="kwick_<?php echo $module; ?>_<?php echo $i;?>" style="width: <?php echo ($width/$sliders_size)+20; ?>px;	height: <?php echo $height; ?>px;"><img src="<?php echo $slider['image']; ?>" alt="<?php echo $slider['title']; ?>" /></li>
    <?php } ?>
    <?php $i++; } ?>
	</ul>
  </div>
</div>
<script type="text/javascript"><!--
$(document).ready(function() {
$('ul#kwicks_<?php echo $module; ?>').kwicks({
					max : <?php echo $width; ?>,
					spacing : 1,
					duration: <?php echo $velocity;?>,
					easing: 'easeOutBounce'
				});
});
--></script>