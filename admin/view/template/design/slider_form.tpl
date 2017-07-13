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
      <h1><img src="view/image/slider.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
          <tr>
            <td><span class="required">*</span> <?php echo $entry_name; ?></td>
            <td><input type="text" name="name" value="<?php echo $name; ?>" size="100" />
              <?php if ($error_name) { ?>
              <span class="error"><?php echo $error_name; ?></span>
              <?php } ?></td>
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
		  <tr>
            <td><?php echo $entry_caption; ?></td>
            <td><select name="caption">
                <?php if ($caption) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
          </tr>
        </table>
        <table id="images" class="list">
          <thead>
            <tr>
              <td class="left"><?php echo $entry_sorting; ?></td>
              <td class="left"><?php echo $entry_title; ?></td>
			  <td class="left"><?php echo $entry_subtitle; ?></td>
			  <td class="left"><?php echo $entry_description; ?></td>
			  <td class="left"><?php echo $entry_extra; ?></td>
              <td class="left"><?php echo $entry_link; ?></td>
              <td class="left"><?php echo $entry_image; ?></td>
			  <td class="left"><?php echo $entry_thumbnail; ?></td>
              <td></td>
            </tr>
          </thead>
          <?php $image_row = 0; ?>
          <?php foreach ($slider_images as $slider_image) { ?>
          <tbody id="image-row<?php echo $image_row; ?>">
            <tr>
				<!-- slider mod sorting-->
              <td class="left"><input type="text" size="2" id="image_sorting" name="slider_image[<?php echo $image_row; ?>][sorting]" value="<?php echo $slider_image['sorting']; ?>" /></td>	
				<!-- slider mod end-->			  
              <td class="left"><?php foreach ($languages as $language) { ?>
                <input type="text" name="slider_image[<?php echo $image_row; ?>][slider_image_description][<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($slider_image['slider_image_description'][$language['language_id']]) ? $slider_image['slider_image_description'][$language['language_id']]['title'] : ''; ?>" />
                <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><br />
                <?php if (isset($error_slider_image[$image_row][$language['language_id']])) { ?>
                <span class="error"><?php echo $error_slider_image[$image_row][$language['language_id']]; ?></span>
                <?php } ?>
                <?php } ?></td>
			<!-- slider mod subtitle-->
			  <td class="left"><?php foreach ($languages as $language) { ?>
                <input type="text" name="slider_image[<?php echo $image_row; ?>][slider_image_description][<?php echo $language['language_id']; ?>][subtitle]" value="<?php echo isset($slider_image['slider_image_description'][$language['language_id']]) ? $slider_image['slider_image_description'][$language['language_id']]['subtitle'] : ''; ?>" />
                <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><br />
                <?php } ?></td>
			<!-- slider mod end-->
			<!-- slider mod description-->
			  <td class="left"><?php foreach ($languages as $language) { ?>
                <input type="text" name="slider_image[<?php echo $image_row; ?>][slider_image_description][<?php echo $language['language_id']; ?>][description]" value="<?php echo isset($slider_image['slider_image_description'][$language['language_id']]) ? $slider_image['slider_image_description'][$language['language_id']]['description'] : ''; ?>" />
                <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><br />
                <?php } ?></td>
			<!-- slider mod end-->
			<!-- slider mod extra-->
			  <td class="left"><?php foreach ($languages as $language) { ?>
                <input type="text" name="slider_image[<?php echo $image_row; ?>][slider_image_description][<?php echo $language['language_id']; ?>][extra]" value="<?php echo isset($slider_image['slider_image_description'][$language['language_id']]) ? $slider_image['slider_image_description'][$language['language_id']]['extra'] : ''; ?>" />
                <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><br />
                <?php } ?></td>
			<!-- slider mod end-->
			
              <td class="left"><input type="text" id="image_link" name="slider_image[<?php echo $image_row; ?>][link]" value="<?php echo $slider_image['link']; ?>" /><span class="help"><?php echo $text_link_help; ?></span></td>
              <td class="left"><div class="image"><img src="<?php echo $slider_image['thumb']; ?>" alt="" id="thumb<?php echo $image_row; ?>" />
                  <input type="hidden" name="slider_image[<?php echo $image_row; ?>][image]" value="<?php echo $slider_image['image']; ?>" id="image<?php echo $image_row; ?>"  />
                  <br />
                  <a onclick="image_upload('image<?php echo $image_row; ?>', 'thumb<?php echo $image_row; ?>');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb<?php echo $image_row; ?>').attr('src', '<?php echo $no_image; ?>'); $('#image<?php echo $image_row; ?>').attr('value', '');"><?php echo $text_clear; ?></a></div></td>
				  <!--thumb-->
				<td class="left"><div class="image"><img src="<?php echo $slider_image['thumbnailt']; ?>" alt="" id="thumbnailt<?php echo $image_row; ?>" />
					<input type="hidden" name="slider_image[<?php echo $image_row; ?>][thumbnail]" value="<?php echo $slider_image['thumbnail']; ?>" id="thumbnail<?php echo $image_row; ?>"  />
					<br />
				<a onclick="image_upload('thumbnail<?php echo $image_row; ?>', 'thumbnailt<?php echo $image_row; ?>');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumbnailt<?php echo $image_row; ?>').attr('src', ''); $('#thumbnail<?php echo $image_row; ?>').attr('value', '');"><?php echo $text_clear; ?></a></div></td>
				  <!--thumb end-->
              <td class="left"><a onclick="$('#image-row<?php echo $image_row; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>
            </tr>
          </tbody>
          <?php $image_row++; ?>
          <?php } ?>
          <tfoot>
            <tr>
              <td colspan="6"></td>
              <td class="left"><a onclick="addImage();" class="button"><?php echo $button_add_slider; ?></a></td>
            </tr>
          </tfoot>
        </table>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
var image_row = <?php echo $image_row; ?>;

function addImage() {
    html  = '<tbody id="image-row' + image_row + '">';
	html += '<tr>';
	html += '<td class="left"><input type="text" id="image_sorting" name="slider_image[' + image_row + '][sorting]" value="'+image_row+'" /></td>';
    html += '<td class="left">';
	<?php foreach ($languages as $language) { ?>
	html += '<input type="text" name="slider_image[' + image_row + '][slider_image_description][<?php echo $language['language_id']; ?>][title]" value="" /> <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><br />';
    <?php } ?>
	html += '</td>';
    html += '<td class="left">';
	<?php foreach ($languages as $language) { ?>
	html += '<input type="text" name="slider_image[' + image_row + '][slider_image_description][<?php echo $language['language_id']; ?>][subtitle]" value="" /> <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><br />';
    <?php } ?>
	html += '</td>';
    html += '<td class="left">';
	<?php foreach ($languages as $language) { ?>
	html += '<input type="text" name="slider_image[' + image_row + '][slider_image_description][<?php echo $language['language_id']; ?>][description]" value="" /> <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><br />';
    <?php } ?>
	html += '</td>';
    html += '<td class="left">';
	<?php foreach ($languages as $language) { ?>
	html += '<input type="text" name="slider_image[' + image_row + '][slider_image_description][<?php echo $language['language_id']; ?>][extra]" value="" /> <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><br />';
    <?php } ?>
	html += '</td>';
	html += '<td class="left"><input type="text" id="image_link" name="slider_image[' + image_row + '][link]" value="" /><span class="help"><?php echo $text_link_help; ?></span></td>';	
	html += '<td class="left"><div class="image"><img src="<?php echo $no_image; ?>" alt="" id="thumb' + image_row + '" /><input type="hidden" name="slider_image[' + image_row + '][image]" value="" id="image' + image_row + '" /><br /><a onclick="image_upload(\'image' + image_row + '\', \'thumb' + image_row + '\');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$(\'#thumb' + image_row + '\').attr(\'src\', \'<?php echo $no_image; ?>\'); $(\'#image' + image_row + '\').attr(\'value\', \'\');"><?php echo $text_clear; ?></a></div></td>';
	html += '<td class="left"><div class="image"><img src="" alt="" id="thumbnailt' + image_row + '" /><input type="hidden" name="slider_image[' + image_row + '][thumbnail]" value="" id="thumbnail' + image_row + '" /><br /><a onclick="image_upload(\'thumbnail' + image_row + '\', \'thumbnailt' + image_row + '\');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$(\'#thumbnailt' + image_row + '\').attr(\'src\', \'\'); $(\'#thumbnail' + image_row + '\').attr(\'value\', \'\');"><?php echo $text_clear; ?></a></div></td>';
	html += '<td class="left"><a onclick="$(\'#image-row' + image_row  + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
	html += '</tr>';
	html += '</tbody>'; 
	
	$('#images tfoot').before(html);
	
	image_row++;
}
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
					url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).attr('value')),
					dataType: 'text',
					success: function(data) {
						$('#' + thumb).replaceWith('<img src="' + data + '" alt="" id="' + thumb + '" />');
					}
				});
			}
		},	
		bgiframe: false,
		width: 700,
		height: 400,
		resizable: false,
		modal: false
	});
};
//--></script> 
<script type="text/javascript"><!--
$('input[id=\'image_link\']').live('keydown', function(){

$('input[id=\'image_link\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.product_id
					}
				}));
			}
		});
		
	}, 
	select: function(event, ui) {
	$(this).val('index.php?route=product/product&product_id='+ui.item.value);
		
		
				
		return false;
	}
});
});

//--></script> 
<?php echo $footer; ?>
