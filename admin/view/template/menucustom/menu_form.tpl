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
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <div id="tabs" class="htabs"><a href="#tab-general"><?php echo $tab_general; ?></a><a href="#tab-data"><?php echo $tab_data; ?></a></div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-general">
          <div id="languages" class="htabs">
            <?php foreach ($languages as $language) { ?>
            <a href="#language<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
            <?php } ?>
          </div>
          <?php foreach ($languages as $language) { ?>
          <div id="language<?php echo $language['language_id']; ?>">
            <table class="form">
              <tr>
                <td><span class="required">*</span> <?php echo $entry_name; ?></td>
                <td><input type="text" name="menu_description[<?php echo $language['language_id']; ?>][name]" size="100" value="<?php echo isset($menu_description[$language['language_id']]) ? $menu_description[$language['language_id']]['name'] : ''; ?>" />
                  <?php if (isset($error_name[$language['language_id']])) { ?>
                  <span class="error"><?php echo $error_name[$language['language_id']]; ?></span>
                  <?php } ?></td>
              </tr>
			  <tr>
                <td><?php echo $entry_description; ?></td>
                <td><textarea name="menu_description[<?php echo $language['language_id']; ?>][description]" id="description<?php echo $language['language_id']; ?>"><?php echo isset($menu_description[$language['language_id']]) ? $menu_description[$language['language_id']]['description'] : ''; ?></textarea></td>
              </tr>
            </table>
          </div>  
          <?php } ?>
        </div>
        <div id="tab-data">
          <table class="form">
            <tr>
              <td><?php echo $entry_parent; ?></td>
              <td><select name="parent_id">
                  <option value="0"><?php echo $text_none; ?></option>
                  <?php foreach ($menus as $menu) { ?>
                  <?php if ($menu['menu_id'] == $parent_id) { ?>
                  <option value="<?php echo $menu['menu_id']; ?>" selected="selected"><?php echo $menu['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $menu['menu_id']; ?>"><?php echo $menu['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
			
            </tr>
			<tr>
              <td></td>
              <td>
				<select name="chossen_id" id="myOptions"> 
					   <option value="0"<?php  if ($chossen_id == 0) { ?> selected="selected" <?php } ?>><?php echo $text_home; ?></option>
					   <option value="1"<?php  if ($chossen_id == 1) { ?> selected="selected" <?php } ?>><?php echo $text_news; ?></option>
					   <option value="2"<?php  if ($chossen_id == 2) { ?> selected="selected" <?php } ?>><?php echo $text_category; ?></option>
					   <option value="3"<?php  if ($chossen_id == 3) { ?> selected="selected" <?php } ?>><?php echo $text_other; ?></option>   
					   <option value="4"<?php  if ($chossen_id == 4) { ?> selected="selected" <?php } ?>><?php echo $text_contact; ?></option>   
					   <option value="5"<?php  if ($chossen_id == 5) { ?> selected="selected" <?php } ?>><?php echo $text_abouts; ?></option>
					   <option value="6"<?php  if ($chossen_id == 6) { ?> selected="selected" <?php } ?>><?php echo $text_allproduct; ?></option>
					   <option value="7"<?php  if ($chossen_id == 7) { ?> selected="selected" <?php } ?>><?php echo $text_special; ?></option>
					   <option value="8"<?php  if ($chossen_id == 8) { ?> selected="selected" <?php } ?>><?php echo $text_information; ?></option>
					   <option value="9"<?php  if ($chossen_id == 9) { ?> selected="selected" <?php } ?>><?php echo $text_allnews; ?></option>
					   <option value="10"<?php  if ($chossen_id == 10) { ?> selected="selected" <?php } ?>><?php echo $text_allinformation; ?></option>
				</select>
				<!---->
					<select name="category_id_chossen_new" id="cat_new_op" class="hiddenField">
						  <option value="0"><?php echo $text_none; ?></option>
						  <?php foreach ($categories_new as $category_new) { ?>
						  
						  <?php if ($category_new['news_category_id'] == $category_category_id) { ?>
						  <option value="<?php echo $category_new['news_category_id']; ?>" selected="selected"><?php echo $category_new['name']; ?></option>
						  <?php } else { ?>
						  <option value="<?php echo $category_new['news_category_id']; ?>"><?php echo $category_new['name']; ?></option>
						  <?php } ?>
						  <?php } ?>
					</select>
					<select name="category_id_chossen_pro" id="cat_pro_op" class="hiddenField">
						  <option value="0"><?php echo $text_none; ?></option>
						  <?php foreach ($categories_pro as $category_pro) { ?>
						  <?php if ($category_pro['category_id'] == $category_category_id) { ?>
						  <option value="<?php echo $category_pro['category_id']; ?>" selected="selected"><?php echo $category_pro['name']; ?></option>
						  <?php } else { ?>
						  <option value="<?php echo $category_pro['category_id']; ?>"><?php echo $category_pro['name']; ?></option>
						  <?php } ?>
						  <?php } ?>
					</select>
					<select name="category_id_chossen_info" id="information_op" class="hiddenField">
						  <option value="0"><?php echo $text_none; ?></option>
						  
						  <?php foreach ($list_informations as $list_information) { ?>
							  <?php if ($list_information['information_id'] == $category_category_id) { ?>
							  <option value="<?php echo $list_information['information_id']; ?>" selected="selected"><?php echo $list_information['title']; ?></option>
							  <?php } else { ?>
							  <option value="<?php echo $list_information['information_id']; ?>"><?php echo $list_information['title']; ?></option>		
							  <?php } ?>
							
						  <?php }?>
					</select>
					<input type="text" class="hiddenField" id="myTextBox" name="value_chossen" value="<?php echo $category_id_chossen; ?>"  />
					
					<input type="text" disabled="true" name="value" value="<?php echo $category_id_chossen; ?>" />
					
			  </td>
            </tr>
            <tr>
              <td><?php echo $entry_image; ?></td>
              <td valign="top"><div class="image"><img src="<?php echo $thumb; ?>" alt="" id="thumb" />
                <input type="hidden" name="image" value="<?php echo $image; ?>" id="image" />
                <br /><a onclick="image_upload('image', 'thumb');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb').attr('src', '<?php echo $no_image; ?>'); $('#image').attr('value', '');"><?php echo $text_clear; ?></a></div></td>
            </tr>
            <tr>
              <td><?php echo $entry_top; ?></td>
              <td><?php if ($top) { ?>
                <input type="checkbox" name="top" value="1" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="top" value="1" />
                <?php } ?></td>
            </tr>
            <tr>
              <td><?php echo $entry_column; ?></td>
              <td><input type="text" name="column" value="<?php echo $column; ?>" size="1" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_sort_order; ?></td>
              <td><input type="text" name="sort_order" value="<?php echo $sort_order; ?>" size="1" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_status; ?></td>
              <td><select name="status">
                  <?php if ($status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></td>
            </tr>
          </table>
        </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script> 
<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
CKEDITOR.replace('description<?php echo $language['language_id']; ?>', {
	filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
});
<?php } ?>
//--></script> 
<script type="text/javascript"><!--
function image_upload(field, thumb) {
	$('#dialog').remove();
	
	$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
	$('#dialog').dialog({
		title: '<?php echo $text_image_manager; ?>',
		close: function (event, ui) {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).val()),
					dataType: 'text',
					success: function(data) {
						$('#' + thumb).replaceWith('<img src="' + data + '" alt="" id="' + thumb + '" />');
					}
				});
			}
		},	
		bgiframe: false,
		width: 800,
		height: 400,
		resizable: false,
		modal: false
	});
};
//--></script> 
<script type="text/javascript"><!--
$('#tabs a').tabs(); 
$('#languages a').tabs();

$(document).ready(function(){
	
     $('#myOptions').change(function(){
        $(this).val() == "1" ? $('#cat_new_op').show() : $('#cat_new_op').hide();
		$(this).val() == "2" ? $('#cat_pro_op').show() : $('#cat_pro_op').hide();
		$(this).val() == "3" ? $('#myTextBox').show() : $('#myTextBox').hide();
		$(this).val() == "8" ? $('#information_op').show() : $('#information_op').hide();
     });
	 <?php  if ($chossen_id == 1) { ?> 
		$('#cat_new_op').show() 
	<?php } ?>
	<?php  if ($chossen_id == 2) { ?> 
		$('#cat_pro_op').show() 
	<?php } ?>
	<?php  if ($chossen_id == 8) { ?> 
		$('#information_op').show() 
	<?php } ?>
});
//--></script>
<style>
	.hiddenField{
		display: none;
	}

</style>
<?php echo $footer; ?>