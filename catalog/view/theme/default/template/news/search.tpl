<?php echo $header; ?><?php echo $content_top; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1><?php echo $heading_title; ?></h1>
  <b><?php echo $text_critea; ?></b>
  <div class="content">
    <p><?php echo $entry_search; ?>
      <?php if ($filter_name_news) { ?>
      <input type="text" name="filter_name_news" value="<?php echo $filter_name_news; ?>" />
      <?php } else { ?>
      <input type="text" name="filter_name_news" value="<?php echo $filter_name_news; ?>" onclick="this.value = '';" onkeydown="this.style.color = '000000'" style="color: #999;" />
      <?php } ?>
      <select name="filter_news_category_id">
        <option value="0"><?php echo $text_news_category; ?></option>
        <?php foreach ($categories as $category_1) { ?>
        <?php if ($category_1['news_category_id'] == $filter_news_category_id) { ?>
        <option value="<?php echo $category_1['news_category_id']; ?>" selected="selected"><?php echo $category_1['name']; ?></option>
        <?php } else { ?>
        <option value="<?php echo $category_1['news_category_id']; ?>"><?php echo $category_1['name']; ?></option>
        <?php } ?>
        <?php foreach ($category_1['children'] as $category_2) { ?>
        <?php if ($category_2['news_category_id'] == $filter_news_category_id) { ?>
        <option value="<?php echo $category_2['news_category_id']; ?>" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_2['name']; ?></option>
        <?php } else { ?>
        <option value="<?php echo $category_2['news_category_id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_2['name']; ?></option>
        <?php } ?>
        <?php foreach ($category_2['children'] as $category_3) { ?>
        <?php if ($category_3['news_category_id'] == $filter_news_category_id) { ?>
        <option value="<?php echo $category_3['news_category_id']; ?>" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_3['name']; ?></option>
        <?php } else { ?>
        <option value="<?php echo $category_3['news_category_id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_3['name']; ?></option>
        <?php } ?>
        <?php } ?>
        <?php } ?>
        <?php } ?>
      </select>
      <?php if ($filter_sub_news_category) { ?>
      <input type="checkbox" name="filter_sub_news_category" value="1" id="sub_news_category" checked="checked" />
      <?php } else { ?>
      <input type="checkbox" name="filter_sub_news_category" value="1" id="sub_news_category" />
      <?php } ?>
      <label for="sub_news_category"><?php echo $text_sub_news_category; ?></label>
    </p>
    <?php if ($filter_description) { ?>
    <input type="checkbox" name="filter_description" value="1" id="description" checked="checked" />
    <?php } else { ?>
    <input type="checkbox" name="filter_description" value="1" id="description" />
    <?php } ?>
    <label for="description"><?php echo $entry_description; ?></label>
  </div>
  <div class="buttons">
    <div class="right"><a id="button-search" class="button"><span><?php echo $button_search; ?></span></a></div>
  </div>
  
  <?php if ($news) { ?>
  <div class="product-filter">
  	<div class="display"><h2><?php echo $text_search; ?></h2></div>  
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
    <div>
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
  <?php } else { ?>
  <div class="content"><?php echo $text_empty; ?></div>
  <?php }?>
  <?php echo $content_bottom; ?></div>
<script type="text/javascript"><!--
$('#content input[name=\'filter_name_news\']').keydown(function(e) {
	if (e.keyCode == 13) {
		$('#button-search').trigger('click');
	}
});

$('#button-search').bind('click', function() {
	url = 'index.php?route=news/search';
	
	var filter_name_news = $('#content input[name=\'filter_name_news\']').attr('value');
	
	if (filter_name_news) {
		url += '&filter_name_news=' + encodeURIComponent(filter_name_news);
	}

	var filter_news_category_id = $('#content select[name=\'filter_news_category_id\']').attr('value');
	
	if (filter_news_category_id > 0) {
		url += '&filter_news_category_id=' + encodeURIComponent(filter_news_category_id);
	}
	
	var filter_sub_news_category = $('#content input[name=\'filter_sub_news_category\']:checked').attr('value');
	
	if (filter_sub_news_category) {
		url += '&filter_sub_news_category=true';
	}
		
	var filter_description = $('#content input[name=\'filter_description\']:checked').attr('value');
	
	if (filter_description) {
		url += '&filter_description=true';
	}

	location = url;
});

//--></script> 
<?php echo $footer; ?>