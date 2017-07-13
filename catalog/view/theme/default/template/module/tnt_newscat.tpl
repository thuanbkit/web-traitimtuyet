<?php if ($position == 'content_top'  or $position == 'content_bottom') { ?>
<div class="box-news-left">
  <div class="box-heading"><?php echo $cat_name; ?></div>
  <div class="box-content">
    <div class="box-product-left">
      <?php foreach ($newss as $news) { ?>
      <div>
        <?php if ($news['thumb']) { ?>
        <div class="image"><a href="<?php echo $news['href']; ?>"><img src="<?php echo $news['thumb']; ?>" alt="<?php echo $news['name']; ?>" <?php echo $news['width']; ?> <?php echo $news['height']; ?> /></a></div>
        <?php } ?>
        <div class="name"><a href="<?php echo $news['href']; ?>"><?php echo $news['name']; ?></a></div>

         <?php echo $news['short_description'];?>
        
      </div>
      <?php } ?>
    </div>
  </div>
</div>

 <?php } else if ($position == 'column_left' or $position == 'column_right') { ?>                            
  <div class="box-news-left">
  <div class="box-heading"><?php echo $cat_name; ?></div>
  <div class="box-content">
    <div class="box-product-left">
      <?php foreach ($newss as $news) { ?>
      <div>
        <?php if ($news['thumb']) { ?>
        <div class="image"><a href="<?php echo $news['href']; ?>"><img src="<?php echo $news['thumb']; ?>" alt="<?php echo $news['name']; ?>" <?php echo $news['width']; ?> <?php echo $news['height']; ?> /></a></div>
        <?php } ?>
        <div class="name"><a href="<?php echo $news['href']; ?>"><?php echo $news['name']; ?></a></div>

         <?php echo $news['short_description'];?>
        
      </div>
      <?php } ?>
    </div>
  </div>
</div>                          
      
   <?php } ?>
