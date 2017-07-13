<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <?php if ($success) { ?>
  <div class="success"><?php echo $success; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/information.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="location = '<?php echo $insert; ?>'" class="button"><span><?php echo $button_insert; ?></span></a><a onclick="$('#form').attr('action', '<?php echo $copy; ?>'); $('#form').submit();" class="button"><span><?php echo $button_copy; ?></span></a><a onclick="$('form').submit();" class="button"><span><?php echo $button_delete; ?></span></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
              <td class="center"><?php echo $column_image; ?></td>
              <td class="left"><?php if ($sort == 'nd.name') { ?>
                <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
                <?php } ?></td>
              <td class="left"><?php echo $column_short_description; ?></td>
              <td class="center"><?php echo $column_viewed; ?></td>              
              <td class="center"><?php if ($sort == 'n.comment') { ?>
                <a href="<?php echo $sort_comment; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_comment; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_comment; ?>"><?php echo $column_comment; ?></a>
                <?php } ?></td>              
              <td class="center"><?php if ($sort == 'n.approved') { ?>
                <a href="<?php echo $sort_approved; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_approved; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_approved; ?>"><?php echo $column_approved; ?></a>
                <?php } ?></td>
              
              <td class="center"><?php if ($sort == 'n.status') { ?>
                <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                <?php } ?></td>
              <td class="center"><?php echo $column_date_added; ?></td>
              <td class="right"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
            <tr class="filter">
              <td></td>
              <td></td>
              <td><input type="text" name="filter_name" value="<?php echo $filter_name; ?>" /></td>
              <td><input type="text" name="filter_short_description" value="<?php echo $filter_short_description; ?>" style="width: 300px;" /></td>
              <td align="left"></td>
              <td align="right"><select name="filter_comment">
                  <option value="*"></option>
                  <?php if ($filter_comment) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <?php } ?>
                  <?php if (!is_null($filter_comment) && !$filter_comment) { ?>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></td>
              <td align="center"><select name="filter_approved">
                  <option value="*"></option>
                  <?php if ($filter_approved) { ?>
                  <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_yes; ?></option>
                  <?php } ?>
                  <?php if (!is_null($filter_approved) && !$filter_approved) { ?>
                  <option value="0" selected="selected"><?php echo $text_no; ?></option>
                  <?php } else { ?>
                  <option value="0"><?php echo $text_no; ?></option>
                  <?php } ?>
                </select></td>
              <td align="right"><select name="filter_status">
                  <option value="*"></option>
                  <?php if ($filter_status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <?php } ?>
                  <?php if (!is_null($filter_status) && !$filter_status) { ?>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></td>
              <td></td>
              <td align="right"><a onclick="filter();" class="button"><span><?php echo $button_filter; ?></span></a></td>
            </tr>
            <?php if ($news) { ?>
            <?php foreach ($news as $news_item) { ?>
            <tr>
              <td style="text-align: center;"><?php if ($news_item['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $news_item['news_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $news_item['news_id']; ?>" />
                <?php } ?></td>
              <td class="center"><img src="<?php echo $news_item['image']; ?>" alt="<?php echo $news_item['name']; ?>" style="padding: 1px; border: 1px solid #DDDDDD;" <?php echo $news_item['width']; ?> <?php echo $news_item['height']; ?> /></td>
              <td class="left"><a href="<?php echo $news_item['name_url']; ?>"><?php echo $news_item['name']; ?></a></td>
              <td class="left"><?php echo $news_item['short_description']; ?></td>
              <td class="center"><?php if ($news_item['viewed'] <= 0) { ?>
              <span style="color: #FF0000;"><?php echo $news_item['viewed']; ?></span>
              <?php } elseif ($news_item['viewed'] <= 5) { ?>
              <span style="color: #FFA500;"><?php echo $news_item['viewed']; ?></span>
              <?php } else { ?>
              <span style="color: #008000;"><?php echo $news_item['viewed']; ?></span>
              <?php } ?></td>
              <td class="right"><?php echo $news_item['comment']; ?></td>
              <td class="right"><?php echo $news_item['approved']; ?></td>
              <td class="right"><?php echo $news_item['status']; ?></td>
              <td class="left"><?php echo $news_item['date_added']; ?></td>
              <td class="right"><?php foreach ($news_item['action'] as $action) { ?>
                [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
                <?php } ?></td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="8"><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </form>
      <div class="pagination"><?php echo $pagination; ?></div>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
function filter() {
	url = 'index.php?route=catalog/news&token=<?php echo $token; ?>';
	
	var filter_name = $('input[name=\'filter_name\']').attr('value');
	
	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}
	
	var filter_short_description = $('input[name=\'filter_short_description\']').attr('value');
	
	if (filter_short_description) {
		url += '&filter_short_description=' + encodeURIComponent(filter_short_description);
	}
	
	var filter_comment = $('select[name=\'filter_comment\']').attr('value');
	
	if (filter_comment != '*') {
		url += '&filter_comment=' + encodeURIComponent(filter_comment);
	}	
	
	var filter_approved = $('select[name=\'filter_approved\']').attr('value');
	
	if (filter_approved != '*') {
		url += '&filter_approved=' + encodeURIComponent(filter_approved);
	}	
	
	var filter_status = $('select[name=\'filter_status\']').attr('value');
	
	if (filter_status != '*') {
		url += '&filter_status=' + encodeURIComponent(filter_status);
	}	

	location = url;
}
//--></script> 
<script type="text/javascript"><!--
$('#form input').keydown(function(e) {
	if (e.keyCode == 13) {
		filter();
	}
});
//--></script> 
<?php echo $footer; ?>