<?php 
$sliders_size=count($sliders);	
$this->document->addScript('catalog/view/javascript/kwicks/jquery.easing.1.3.js');
$this->document->addScript('catalog/view/javascript/kwicks/jquery.kwicks.min.js');
$this->document->addStyle('catalog/view/javascript/kwicks/style.css');?>
<div class="slideshow">
  <div id="slideshow<?php echo $module; ?>" style="width: <?php echo $width; ?>px; height: <?php echo $height; ?>px; margin-bottom:5px;">
  <ul id="kwicks_<?php echo $module; ?>" class="kwicks kwicks-horizontal" >
    <?php 
	$i=0;
	
	foreach ($sliders as $slider) { ?>
    <?php if ($slider['link']) { ?>
	
    <li id="kwick_<?php echo $module; ?>_<?php echo $i;?>"><a href="<?php echo $slider['link']; ?>"><img src="<?php echo $slider['image']; ?>" alt="<?php echo $slider['title']; ?>"/></a></li>
    <?php } else { ?>
    <li id="kwick_<?php echo $module; ?>_<?php echo $i;?>"><img src="<?php echo $slider['image']; ?>" alt="<?php echo $slider['title']; ?>" /></li>
    <?php } ?>
    <?php $i++; } ?>
	</ul>
  </div>
</div>
<script type="text/javascript"><!--
$(document).ready(function() {
$('ul#kwicks_<?php echo $module; ?>').kwicks({
					size : <?php echo ($width/$sliders_size); ?>,
					maxSize : <?php echo $width-50; ?>,
					spacing : 1,
					duration: <?php echo $velocity;?>,
					easing: 'easeOutBounce',
					behavior: 'menu'
				});
});
--></script>