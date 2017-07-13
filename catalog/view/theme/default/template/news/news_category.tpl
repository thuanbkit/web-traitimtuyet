<?php echo $header; ?><?php echo $content_top; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($thumb || $description) { ?>
  <div class="category-info">
    <h2><?php echo $heading_title; ?></h2>
    <?php if ($thumb) { ?>
    <div class="image"><img src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>" /></div>
    <?php } ?>
    <?php if ($description) { ?>
    <?php echo $description; ?>
    <?php } ?>
  </div>
  <?php } ?>
  <?php if ($categories) { ?>
  <h2><?php echo $text_refine; ?></h2>
  <div class="category-list">
    <?php if (count($categories) <= 5) { ?>
    <ul>
      <?php foreach ($categories as $category) { ?>
      <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
      <?php } ?>
    </ul>
    <?php } else { ?>
    <?php for ($i = 0; $i < count($categories);) { ?>
    <ul>
      <?php $j = $i + ceil(count($categories) / 4); ?>
      <?php for (; $i < $j; $i++) { ?>
      <?php if (isset($categories[$i])) { ?>
      <li><a href="<?php echo $categories[$i]['href']; ?>"><?php echo $categories[$i]['name']; ?></a></li>
      <?php } ?>
      <?php } ?>
    </ul>
    <?php } ?>
    <?php } ?>
  </div>
  <?php } ?>
  <?php if ($news) { ?>
  <div class="product-filter">   
    <div class="limit"><b><?php echo $text_limit; ?></b>
      <select onchange="location = this.value;">
        <?php foreach ($limits as $limits) { ?>
        <?php if ($limits['value'] == $limit) { ?>
        <option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
        <?php } else { ?>
        <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
        <?php } ?>
        <?php } ?>
      </select>
    </div>    
  </div> <br />
  <div class="product-list">
    <?php foreach ($news as $news_item) { ?>
    <div class="item-news">
      <?php if ($news_item['thumb']) { ?>
      <div class="image"><a href="<?php echo $news_item['href']; ?>"><img src="<?php echo $news_item['thumb']; ?>" title="<?php echo $news_item['name']; ?>" alt="<?php echo $news_item['name']; ?>" <?php echo $news_item['width']; ?> <?php echo $news_item['height']; ?> /></a></div>
      <?php } ?>
      <div class="name"><a href="<?php echo $news_item['href']; ?>"><?php echo $news_item['name']; ?></a></div>
      <div style="margin-top: 4px;	margin-bottom: 5px;	color: gray; font-size: 11px;"><?php echo $text_post_on; ?> <?php echo $news_item['date_added']; ?> - <?php echo $text_viewed; ?> <?php echo $news_item['viewed']; ?></div>
      <div class="description"><?php echo $news_item['short_description']; ?></div>
    </div>
    <?php } ?>
  </div>
  <div class="pagination"><?php echo $pagination; ?></div>
  <?php } ?>
  <?php if (!$categories && !$news) { ?>
  <div class="content"><?php echo $text_empty; ?></div>
  <div class="buttons">
    <div class="right"><a href="<?php echo $continue; ?>" class="button"><span><?php echo $button_continue; ?></span></a></div>
  </div>
  <?php } ?>
  <?php echo $content_bottom; ?></div>
<?php echo $footer; ?>