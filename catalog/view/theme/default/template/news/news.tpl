<?php echo $header; ?><?php echo $content_top; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <div class="product-info">
  <h2><?php echo $heading_title; ?></h2>
  <div style="margin-bottom: 10px;	color: gray; font-size: 11px;"><?php echo $text_post_on; ?> <?php echo $date_added; ?> - <?php echo $text_viewed; ?> <?php echo $viewed; ?></div>
  <div style="margin-top: 15px; margin-bottom: 20px; font-weight: bold;"><?php echo $short_description; ?></div>
  <?php echo $description; ?>
  
  <?php if ($tags) { ?>
  <div class="tags"><b><?php echo $text_tags; ?></b>
    <?php foreach ($tags as $tag) { ?>
    <a href="<?php echo $tag['href']; ?>"><?php echo $tag['tag']; ?></a>,
    <?php } ?>
  </div>
  <?php } ?> 
  
  <div class="share" style="margin-top: 30px;"><!-- AddThis Button BEGIN -->
    <div class="addthis_default_style"><a class="addthis_button_compact"><?php echo $text_share; ?></a> <a class="addthis_button_email"></a><a class="addthis_button_print"></a> <a class="addthis_button_facebook"></a> <a class="addthis_button_twitter"></a></div>
    <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js"></script> 
    <!-- AddThis Button END -->   
  <?php if ($allow_comment) { ?>
    <span style="padding-left: 30px;"><a href="<?php echo $current_url; ?>#comments" class="scroll"><?php echo $total_comments; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?php echo $current_url; ?>#comment-title" class="scroll"><?php echo $text_write; ?></a></span>
  <?php } ?>
  </div><br />  
  
  <?php if ($news) { ?>
      <div style="font-size: 13px; font-weight: bold; margin-top: 30px;"><?php echo $tab_related; ?></div>
      <div><ul>
      	<?php foreach ($news as $related_news) { ?>
      		<li style="padding: 2px;"><a href="<?php echo $related_news['href']; ?>"><?php echo $related_news['name']; ?></a> <span style="color: gray; font-size: 11px;">(<?php echo $related_news['date_added']; ?>)</span></li>
      	<?php } ?>
     	</ul></div>
   <?php } ?>
   
   <?php if ($other_news) { ?>
      <div style="font-size: 13px; font-weight: bold; margin-top: 30px;"><?php echo $tab_others; ?></div>
      <div><ul>
      	<?php foreach ($other_news as $other_news_item) { ?>
      		<li style="padding: 2px;"><a href="<?php echo $other_news_item['href']; ?>"><?php echo $other_news_item['name']; ?></a> <span style="color: gray; font-size: 11px;">(<?php echo $other_news_item['date_added']; ?>)</span></li>
      	<?php } ?>
     	</ul></div>
   <?php } ?>
   
   <?php if ($allow_comment) { ?>
  <div id="comments" style="margin-top: 40px;"><h2><?php echo $tab_comment; ?></h2>
    <div id="comment"></div><br />
    <h2 id="comment-title"><?php echo $text_write; ?></h2>
    <b><?php echo $entry_name; ?></b><br />
    <input type="text" name="name" value="<?php echo $customer_name; ?>" />
    <br /><br />
    <b><?php echo $entry_email; ?></b><br />
    <input type="text" name="email" value="<?php echo $customer_email; ?>" />
    <br /><br />
    <b><?php echo $entry_comment; ?></b>
    <textarea name="text" cols="40" rows="8" style="width: 98%;"></textarea><br />
    <br />    
    <b><?php echo $entry_captcha; ?></b><br />
    <input type="text" name="captcha" value="" />
    <br />
    <img src="index.php?route=news/news/captcha" alt="" id="captcha" /><br />
    <br />   
     <div class="left"><a id="button-comment" class="button"><span><?php echo $button_send; ?></span></a></div>    
  </div>
  <?php } ?>
   
   <div style="margin-bottom: 20px;"></div>
  <div class="buttons">
    <div class="right"><a href="<?php echo $continue; ?>" class="button"><span><?php echo $button_continue; ?></span></a></div>
  </div>
  <?php echo $content_bottom; ?></div></div>
  <script type="text/javascript"><!--
$('.fancybox').fancybox({cyclic: true});
//--></script>
<?php if ($allow_comment) { ?>
<script type="text/javascript"><!--
$('#comment .pagination a').live('click', function() {
	$('#comment').slideUp('slow');
		
	$('#comment').load(this.href);
	
	$('#comment').slideDown('slow');
	
	return false;
});			

$('#comment').load('index.php?route=news/news/comment&news_id=<?php echo $news_id; ?>');

$('#button-comment').bind('click', function() {
	$.ajax({
		type: 'POST',
		url: 'index.php?route=news/news/write&news_id=<?php echo $news_id; ?>&approved=<?php echo $approved; ?>',
		dataType: 'json',
		data: 'name=' + encodeURIComponent($('input[name=\'name\']').val()) + '&email=' + encodeURIComponent($('input[name=\'email\']').val()) + '&text=' + encodeURIComponent($('textarea[name=\'text\']').val()) + '&captcha=' + encodeURIComponent($('input[name=\'captcha\']').val()),
		beforeSend: function() {
			$('.success, .warning').remove();
			$('#button-comment').attr('disabled', true);
			$('#comment-title').after('<div class="attention"><img src="catalog/view/theme/default/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
		},
		complete: function() {
			$('#button-comment').attr('disabled', false);
			$('.attention').remove();
		},
		success: function(data) {
			if (data.error) {
				$('#comment-title').after('<div class="warning">' + data.error + '</div>');
			}
			
			if (data.success) {
				$('#comment-title').after('<div class="success">' + data.success + '</div>');
								
				$('input[name=\'name\']').val('');
				$('input[name=\'email\']').val('');
				$('textarea[name=\'text\']').val('');
				$('input[name=\'captcha\']').val('');
			}
		}
	});
});
//--></script>
<script type="text/javascript"><!--
jQuery(document).ready(function($) {
 
	$(".scroll").click(function(event){		
		event.preventDefault();
		$('html,body').animate({scrollTop:$(this.hash).offset().top}, 500);
	});
});
//--></script>
<?php } ?>
<?php echo $footer; ?>