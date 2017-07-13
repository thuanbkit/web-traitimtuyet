<?php 
$sliders_size=count($sliders);	
 
$this->document->addScript('catalog/view/javascript/kwicks-master/jquery.kwicks.js');
$this->document->addStyle('catalog/view/javascript/kwicks-master/jquery.kwicks.css');
?>

<div class="slideshow">
  <div id="slideshow<?php echo $module; ?>">
   
   <ul class='kwicks kwicks-vertical'>
			<li>
				
				<ul class='kwicks kwicks-horizontal'>
					 <?php 
						$i=0;
						
						foreach ($sliders as $slider) { ?>
							<?php if($i % 2 == 0) { ?>
								<li><a href="<?php echo $slider['link']; ?>"><img src="<?php echo $slider['image']; ?>" alt="<?php echo $slider['title']; ?>"/></a></li> 
							<?php } $i++; ?>
						<?php } ?>
				</ul>
			</li>
			
			<li>
				<ul class='kwicks kwicks-horizontal'>
					<?php 
						$i=0;
						
						foreach ($sliders as $slider) { ?>
							 
							<?php if($i % 2 != 0) { ?>
								<li><a href="<?php echo $slider['link']; ?>"><img src="<?php echo $slider['image']; ?>" alt="<?php echo $slider['title']; ?>"/></a></li> 
							<?php } $i++; ?>
						<?php }  ?>
				</ul>
			</li>
		</ul>

 
	
  </div>
</div>
	<style type='text/css'>
			.slideshow ul {
				padding:0px;
				margin:0px;
			}
			.slideshow ul li{
				list-style:none;
				padding:0px;
				margin:0px;
			}
				.kwicks-vertical {
				width: 1176px;
				height: 364px;
			}
			.kwicks-vertical > li {
				height: 64px;
				margin-top: 5px;
			}
			.kwicks-horizontal {
				width: 1176px;
				height: 100%;
			}
			.kwicks-horizontal > li {
				height: 100%;
				width: 876px;
				float: left;
				margin-left: 5px;
				background-color: #ffaa00;
			}
		</style>
		<script type='text/javascript'>
			$(function() {
				$('.kwicks-vertical').kwicks({
					maxSize : 295,
					spacing : 5,
					isVertical: true,
					behavior: 'menu',
					selectOnClick: false
				});

				$('.kwicks-horizontal').kwicks({
					maxSize: 1026,
					spacing: 5,
					behavior: 'menu',
					selectOnClick: false
				});
			});
		</script>