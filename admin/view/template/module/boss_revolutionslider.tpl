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
    <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
    <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
  </div>
  <div class="content">
   <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
		<div class="vtabs" id="slidevtabs"> 
		<?php $module_row = 1;?>
		<?php foreach($modules as $module) {?>
			<a href="#tab<?php echo $module_row ; ?>" id="tabtitle<?php echo $module_row ; ?>"><?php echo $text_module; echo $module_row;?>&nbsp;<img src="view/image/delete.png" alt="" 
			onclick="$('.vtabs a:first').trigger('click'); $('#tabtitle<?php echo $module_row; ?>').remove(); $('#tab<?php echo $module_row; ?>').remove(); return false;" /></a>
			<?php $module_row++; ?>
		<?php } ?>
		
			<span class="addModule"><?php echo $button_add_module; ?> &nbsp;<img src="view/image/add.png" alt="" onclick="addModule();"/></span>
		</div>
		<?php $module_row = 1;?>
		<?php foreach ($modules as $module) {?>
		<div id="tab<?php echo $module_row;?>" class="vtabs-content">
			<div id="tabcontent<?php echo $module_row;?>" class="htabs">
				<a href="#configinformation<?php echo $module_row;?>"><?php echo $module_config_info; ?></a>
				<a href="#sliderlist<?php echo $module_row;?>"><?php echo $module_slider_list; ?></a>
				<a href="#configoption<?php echo $module_row;?>"><?php echo $module_config_option; ?></a>
			</div>
			<div id="configinformation<?php echo $module_row;?>" class="htabs-content">
				<table class="form">
					<tr><td><?php echo $entry_image; ?></td>
					<td class="left"><input type="text" name="boss_revolutionslider_module[<?php echo $module_row;?>][image_width]" value="<?php echo $module['image_width']; ?>" size="3" /> <input type="text" name="boss_revolutionslider_module[<?php echo $module_row;?>][image_height]" value="<?php echo $module['image_height']; ?>" size="3" /> </td></tr>
					
					<tr><td><?php echo $entry_layout; ?></td><td class="left">
					<select name="boss_revolutionslider_module[<?php echo $module_row;?>][layout_id]">
					<?php foreach($layouts as $layout) {?>
					<option value="<?php echo $layout['layout_id']?>" <?php if($module['layout_id'] == $layout['layout_id']) echo "selected=selected"?> ><?php echo addslashes($layout['name']); ?></option><?php } ?>
					</select></td></tr>
					
					<tr><td><?php echo $entry_position; ?></td><td class="left">
					 <select name="boss_revolutionslider_module[<?php echo $module_row;?>][position]">
					  <option value="slideshow" <?php if($module['position'] == "slideshow") echo "selected=selected" ?>><?php echo $text_slideshow; ?></option>
					  <option value="content_top" <?php if($module['position'] == "content_top") echo "selected=selected" ?>><?php echo $text_content_top; ?></option>
					  <option value="content_bottom" <?php if($module['position'] == "content_bottom") echo "selected=selected" ?>><?php echo $text_content_bottom; ?></option>
					 </select></td></tr>
					
					<tr><td><?php echo $entry_status; ?></td><td class="left">
					<select name="boss_revolutionslider_module[<?php echo $module_row;?>][status]">
						<option value="1" <?php if($module['status'] == "1") echo "selected=selected" ?>><?php echo $text_enabled; ?></option>
						<option value="0" <?php if($module['status'] == "0") echo "selected=selected" ?>><?php echo $text_disabled; ?></option>
					</select></td></tr>
					
					<tr><td><?php echo $entry_sort_order; ?></td><td class="left"><input type="text" name="boss_revolutionslider_module[<?php echo $module_row;?>][sort_order]" value="<?php echo $module['sort_order'];?>" size="3" /></td></tr>
				
				  <tr>
						<td><?php echo $entry_store; ?></td>
						<td><div class="scrollbox">
						  <?php $class = 'even'; ?>
						  <div class="<?php echo $class; ?>">
							<?php if (isset($module['store_id']) && in_array(0, $module['store_id'])) { ?>
							<input type="checkbox" name="boss_revolutionslider_module[<?php echo $module_row;?>][store_id][]" value="0" checked="checked" />
							<?php } else { ?>
							<input type="checkbox" name="boss_revolutionslider_module[<?php echo $module_row;?>][store_id][]" value="0" />
							<?php } ?>
							<?php echo $text_default; ?>
						  </div>
						  <?php foreach ($stores as $store) { ?>
						  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
						  <div class="<?php echo $class; ?>">
							<?php if (isset($module['store_id']) && in_array($store['store_id'], $module['store_id'])) { ?>
							<input type="checkbox" name="boss_revolutionslider_module[<?php echo $module_row;?>][store_id][]" value="<?php echo $store['store_id']; ?>" checked="checked" />
							<?php echo $store['name']; ?>
							<?php } else { ?>
							<input type="checkbox" name="boss_revolutionslider_module[<?php echo $module_row;?>][store_id][]" value="<?php echo $store['store_id']; ?>" />
							<?php echo $store['name']; ?>
							<?php } ?>
						  </div>
						  <?php } ?>
						</div></td>
					</tr>
				  
				</table>
			</div>
			<div id="sliderlist<?php echo $module_row;?>" class="htabs-content">
			<?php $slide_row = 1;?>
			
			<?php if (isset($module['slide'])) {?>
				<ul id="revlslide_slide<?php echo $module_row;?>" class="revlslide_slide" style="padding-left:7px">
				<?php foreach($module['slide'] as $slide) {?>
					<li class="ui-state-default dcjq-parent-li" style="overflow:hidden" id="slide-row<?php echo $module_row;?>-opt-row<?php echo $slide_row;?>">
						<span class="expand"><?php echo $text_slide;?> <?php echo $slide_row;?><a style="float: right" onclick="$('#slide-row<?php echo $module_row;?>-opt-row<?php echo $slide_row;?>').remove();"><img src="view/image/delete.png" /></a></span>
						<ul style="margin:15px 0">
							<div class="vtabs" id="tabAddSlide<?php echo $module_row;?><?php echo $slide_row;?>" style="margin-left:-42px">
								<a href="#generalSlide<?php echo $module_row;?><?php echo $slide_row;?>"><?php echo $text_general; ?></a>
								<a href="#animationSlide<?php echo $module_row;?><?php echo $slide_row;?>"><?php echo $text_animation; ?></a>
								<a href="#captionSlide<?php echo $module_row;?><?php echo $slide_row;?>"><?php echo $text_caption; ?></a>
							</div>
							<div id="generalSlide<?php echo $module_row;?><?php echo $slide_row;?>" class="vtabs-content">
								<table class="form">
									<tr><td><?php echo $text_background; ?></td>
									<td class="left">
										<input type="radio" name="boss_revolutionslider_module[<?php echo $module_row;?>][slide][<?php echo $slide_row;?>][type_background]" value="image_bg" <?php if($slide['type_background'] == "image_bg") echo "checked=checked";?> onclick="changeContentBackground('image_bg',<?php echo $module_row;?>,<?php echo $slide_row;?>)"/><?php echo $text_image;?>
										<input type="radio" name="boss_revolutionslider_module[<?php echo $module_row;?>][slide][<?php echo $slide_row;?>][type_background]" value="color_bg" <?php if($slide['type_background'] == "color_bg") echo "checked=checked";?> onclick="changeContentBackground('color_bg',<?php echo $module_row;?>,<?php echo $slide_row;?>)"/><?php echo $text_color;?>
										<input type="radio" name="boss_revolutionslider_module[<?php echo $module_row;?>][slide][<?php echo $slide_row;?>][type_background]" value="transparent_bg" <?php if($slide['type_background'] == "transparent_bg") echo "checked=checked";?> onclick="changeContentBackground('transparent_bg',<?php echo $module_row;?>,<?php echo $slide_row;?>)"/><?php echo $text_transparent;?></td></tr>
										<tr id="tr_content_background<?php echo $module_row;?><?php echo $slide_row;?>"><td><?php echo $text_image; ?></td>
										<?php if($slide['type_background'] == "image_bg") { ?>
											<td class="left"><div class="image">
												<img src="<?php echo $slide['thumb']; ?>" alt="" id="thumb<?php echo $module_row;?><?php echo $slide_row;?>" />
												<input type="hidden" name="boss_revolutionslider_module[<?php echo $module_row;?>][slide][<?php echo $slide_row;?>][background]" value="<?php echo $slide['background']; ?>" id="image<?php echo $module_row;?><?php echo $slide_row;?>" /><br /><a onclick="image_upload('image<?php echo $module_row;?><?php echo $slide_row;?>', 'thumb<?php echo $module_row;?><?php echo $slide_row;?>');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb<?php echo $module_row;?><?php echo $slide_row;?>').attr('src','<?php echo $no_image; ?>'); $('#image<?php echo $module_row;?><?php echo $slide_row;?>').attr('value', '')"><?php echo $text_clear; ?></a></div></td>
										<?php } ?>
										<?php if($slide['type_background'] == "color_bg") { ?>
											<td><?php echo $text_color; ?></td><td class="left">
											<input id="color_bg<?php echo $module_row;?><?php echo $slide_row;?>"  type="text" name="boss_revolutionslider_module[<?php echo $module_row;?>][slide][<?php echo $slide_row;?>][background]" onfocus="colorEvent('color_bg<?php echo $module_row;?><?php echo $slide_row;?>);EYE.register(colorEvent, 'init');" value="<?php echo $slide['background']?>" style="background-color:<?php echo $slide['background'];?>"/></td>
										<?php } ?>
										<?php if($slide['type_background'] == "transparent_bg") { ?>
											<input type="hidden" name="boss_revolutionslider_module[<?php echo $module_row;?>][slide][<?php echo $slide_row;?>][background]" value="<?php echo $slide['background']?>"/>
										<?php } ?>
										</tr>
										<tr><td><?php echo $text_url;?></td><td><input name="boss_revolutionslider_module[<?php echo $module_row;?>][slide][<?php echo $slide_row;?>][url]" value="<?php echo $slide['url'];?>"/></td></tr>
										<tr><td><?php echo $entry_status; ?></td><td class="left">
										  <select name="boss_revolutionslider_module[<?php echo $module_row;?>][slide][<?php echo $slide_row;?>][status]">
											<option value="1" <?php if($slide['status'] == 1) echo "selected=selected";?> ><?php echo $text_enabled; ?></option>
											<option value="0" <?php if($slide['status'] == 0) echo "selected=selected";?> ><?php echo $text_disabled; ?></option>
										  </select></td></tr>
								</table>
							</div>
							<div id="animationSlide<?php echo $module_row;?><?php echo $slide_row;?>" class="vtabs-content">
								<table class="form">
									 <tr><td><?php echo $text_transition?></td><td><select name="boss_revolutionslider_module[<?php echo $module_row;?>][slide][<?php echo $slide_row;?>][transitions]">
									  <?php foreach($transitions as $tran) {?>
										<option value="<?php echo $tran;?>" <?php if($slide['transitions'] == $tran)echo "selected=selected"; ?>><?php echo $tran;?></option>
									  <?php }?>
									  </select><p><?php echo $text_transition_des;?></p></td></tr>
	  
									  <tr><td><?php echo $text_slot_amount;?></td><td><input name="boss_revolutionslider_module[<?php echo $module_row;?>][slide][<?php echo $slide_row;?>][slotamount]" value="<?php echo $slide['slotamount']?>"/><p><?php echo $text_slot_amount_des;?></p>
									  </td></tr>
									  
									  <tr><td><?php echo $text_master_speed;?></td><td><input name="boss_revolutionslider_module[<?php echo $module_row;?>][slide][<?php echo $slide_row;?>][masterspeed]" value="<?php echo $slide['masterspeed']?>"/><p><?php echo $text_master_speed_des;?></p>
									  </td></tr>
	  
									 <tr><td><?php echo $text_target?></td><td><select name="boss_revolutionslider_module[<?php echo $module_row;?>][slide][<?php echo $slide_row;?>][target]">
									  <option value="_self" <?php if($slide['target'] == '_self')echo "selected=selected"; ?>>_self</option>
									  <option value="_blank" <?php if($slide['target'] == '_blank')echo "selected=selected"; ?>>_blank</option>
									  </select><p><?php echo $text_target_des;?></p></td></tr>
									  
									  <tr><td><?php echo $text_delay;?></td><td><input name="boss_revolutionslider_module[<?php echo $module_row;?>][slide][<?php echo $slide_row;?>][delay]" value="<?php echo $slide['delay']?>"/><p><?php echo $text_delay_des;?></p>
									  </td></tr>
									  
									  <tr><td><?php echo $text_enable_link; ?></td><td>
									  <select name="boss_revolutionslider_module[<?php echo $module_row;?>][slide][<?php echo $slide_row;?>][enablelink]">
									  <option value="1" <?php if($slide['enablelink'] == 1)echo "selected=selected"; ?>><?php echo $text_enabled; ?></option>
									  <option value="0" <?php if($slide['enablelink'] == 0)echo "selected=selected"; ?>><?php echo $text_disabled; ?></option>
									  </select></td></tr>
									  
									  <tr><td><?php echo $text_full_video; ?></td><td>
									  <select name="boss_revolutionslider_module[<?php echo $module_row;?>][slide][<?php echo $slide_row;?>][enablefullvideo]">
									  <option value="1" <?php if($slide['enablefullvideo'] == 1)echo "selected=selected"; ?>><?php echo $text_enabled; ?></option>
									  <option value="0" <?php if($slide['enablefullvideo'] == 0)echo "selected=selected"; ?>><?php echo $text_disabled; ?></option>
									  </select></td></tr>
									  
								</table>
							</div>
							<div id="captionSlide<?php echo $module_row;?><?php echo $slide_row;?>" class="vtabs-content">
								<?php $caption_row = 1;?>
								<?php if (isset($slide['caption'])) {?>
								<?php foreach($slide['caption'] as $caption) {?>
									<li class="ui-state-default bt-expand dcjq-parent-li" id="caption-row<?php echo $module_row;?><?php echo $slide_row;?><?php echo $caption_row;?>" style="margin-left:-30px;">
									<span><?php echo $text_caption;?> <?php echo $caption_row;?>
									<a style="float: right" onclick="$('#caption-row<?php echo $module_row;?><?php echo $slide_row;?><?php echo $caption_row;?>').remove();" title="<?php echo $text_remove_caption;?>"><img src="view/image/delete.png" /></a></span>
									<ul class="content_caption active" id="content_caption<?php echo $module_row;?><?php echo $slide_row;?><?php echo $caption_row;?>">
										<table class="form">
											<tr><td><?php echo $text_type_caption; ?></td>
											<td class="left">
												<input type="radio" name="boss_revolutionslider_module[<?php echo $module_row;?>][slide][<?php echo $slide_row;?>][caption][<?php echo $caption_row;?>][type_caption]" value="text_caption" onclick="changeContentCaption('text_caption',<?php echo $module_row;?>,<?php echo $slide_row;?>,<?php echo $caption_row;?>)" <?php if($caption['type_caption'] == "text_caption") echo "checked=checked"; ?>/><?php echo $text_text_caption;?>
												
												<input type="radio" name="boss_revolutionslider_module[<?php echo $module_row;?>][slide][<?php echo $slide_row;?>][caption][<?php echo $caption_row;?>][type_caption]" value="image_caption" onclick="changeContentCaption('image_caption',<?php echo $module_row;?>,<?php echo $slide_row;?>,<?php echo $caption_row;?>)" <?php if($caption['type_caption'] == "image_caption") echo "checked=checked"; ?>/><?php echo $text_image_caption;?>
												
												<input type="radio" name="boss_revolutionslider_module[<?php echo $module_row;?>][slide][<?php echo $slide_row;?>][caption][<?php echo $caption_row;?>][type_caption]" value="video_caption" onclick="changeContentCaption('video_caption',<?php echo $module_row;?>,<?php echo $slide_row;?>,<?php echo $caption_row;?>)" <?php if($caption['type_caption'] == "video_caption") echo "checked=checked"; ?>/><?php echo $text_video_caption;?></td></tr>
												
												<tr id="tr_content_caption<?php echo $module_row;?><?php echo $slide_row;?><?php echo $caption_row;?>">
												
												<?php if($caption['type_caption'] == 'text_caption') { ?>
												<td><?php echo $text_text; ?></td><td class="left">
												<?php foreach($languages as $language) { ?>
												<textarea style="width:90%; height:60px;" name="boss_revolutionslider_module[<?php echo $module_row;?>][slide][<?php echo $slide_row;?>][caption][<?php echo $caption_row;?>][text_caption][<?php echo $language['language_id']; ?>]"><?php echo $caption['text_caption'][$language['language_id']];?></textarea> 
												<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><br /><?php } ?></td>
												<?php } ?>
												
												<?php if($caption['type_caption'] == 'image_caption') {?>
												<td><?php echo $text_image; ?></td>
												<td class="left"><div class="image"><img src="<?php echo $caption['thumb']; ?>" alt="" id="thumb<?php echo $module_row;?><?php echo $slide_row;?><?php echo $caption_row;?>" />
												<input type="hidden" name="boss_revolutionslider_module[<?php echo $module_row;?>][slide][<?php echo $slide_row;?>][caption][<?php echo $caption_row;?>][image_caption]" value="<?php echo $caption['image_caption'];?>" id="image<?php echo $module_row;?><?php echo $slide_row;?><?php echo $caption_row;?>" /><br />
												<a onclick="image_upload('image<?php echo $module_row;?><?php echo $slide_row;?><?php echo $caption_row;?>', 'thumb<?php echo $module_row;?><?php echo $slide_row;?><?php echo $caption_row;?>');"><?php echo $text_browse; ?>
												</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb<?php echo $module_row;?><?php echo $slide_row;?><?php echo $caption_row;?>').attr('src', '<?php echo $no_image; ?>'); $('#image<?php echo $module_row;?><?php echo $slide_row;?><?php echo $caption_row;?>').attr('value', '');"><?php echo $text_clear; ?></a></div></td>
												<?php } ?>
												<?php if($caption['type_caption'] == 'video_caption') {?>
													<td><?php echo $text_video; ?></td>
													<td class="left"><?php echo $text_video_type; ?><select name="boss_revolutionslider_module[<?php echo $module_row;?>][slide][<?php echo $slide_row;?>][caption][<?php echo $caption_row;?>][video_caption][type]">
													<option value="youtube" <?php if($caption['video_caption']['type'] == "youtube") echo "selected=selected";?> >Youtube</option>
													<option value="vimeo" <?php if($caption['video_caption']['type'] == "vimeo") echo "selected=selected";?>>vimeo</option></select>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $text_video_id; ?><?php foreach ($languages as $language) { ?><input name="boss_revolutionslider_module[<?php echo $module_row;?>][slide][<?php echo $slide_row;?>][caption][<?php echo $caption_row;?>][video_caption][id][<?php echo $language['language_id']; ?>]" value="<?php echo $caption['video_caption']['id'][$language['language_id']];?>" /><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><br /><br /><?php } ?>
													W
													<input type="text" name="boss_revolutionslider_module[<?php echo $module_row;?>][slide][<?php echo $slide_row;?>][caption][<?php echo $caption_row;?>][video_caption][width]" value="<?php echo $caption['video_caption']['width'];?>" /> x
													
													H <input type="text" name="boss_revolutionslider_module[<?php echo $module_row;?>][slide][<?php echo $slide_row;?>][caption][<?php echo $caption_row;?>][video_caption][height]" value="<?php echo $caption['video_caption']['height'];?>" />
													</td>
													
												<?php } ?>
												</tr>
												<tr><td><?php echo $text_datax; ?></td><td class="left"><input type="text" name="boss_revolutionslider_module[<?php echo $module_row;?>][slide][<?php echo $slide_row;?>][caption][<?php echo $caption_row;?>][datax]" value="<?php echo $caption['datax'];?>"/><p><?php echo $text_datax_des;?></p></td></tr> 
												<tr><td><?php echo $text_datay; ?></td><td class="left"><input type="text" name="boss_revolutionslider_module[<?php echo $module_row;?>][slide][<?php echo $slide_row;?>][caption][<?php echo $caption_row;?>][datay]" value="<?php echo $caption['datay'];?>"/><p><?php echo $text_datay_des;?></p></td></tr>
												
												<tr><td><?php echo $text_class_css; ?></td><td class="left"><select name="boss_revolutionslider_module[<?php echo $module_row;?>][slide][<?php echo $slide_row;?>][caption][<?php echo $caption_row;?>][class_css]">
											  <?php foreach($class_css as $class) {?>
												<option value="<?php echo $class;?>" <?php if($caption['class_css'] == $class) echo "selected=selected";?>><?php echo $class;?></option>
											  <?php } ?>
											  </select><p><?php echo $text_class_css_des;?></p></td></tr> 
											  
											  <tr><td><?php echo $text_data_speed; ?></td><td class="left"><input type="text" name="boss_revolutionslider_module[<?php echo $module_row;?>][slide][<?php echo $slide_row;?>][caption][<?php echo $caption_row;?>][dataspeed]" value="<?php echo $caption['dataspeed']?>"/><p><?php echo $text_data_speed_des;?></p></td></tr>
											  
											  <tr><td><?php echo $text_data_start; ?></td><td class="left"><input type="text" name="boss_revolutionslider_module[<?php echo $module_row;?>][slide][<?php echo $slide_row;?>][caption][<?php echo $caption_row;?>][datastart]" value="<?php echo $caption['datastart']?>"/><p><?php echo $text_data_start_des;?></p></td></tr>
											  
											  <tr><td><?php echo $text_data_end; ?></td><td class="left"><input type="text" name="boss_revolutionslider_module[<?php echo $module_row;?>][slide][<?php echo $slide_row;?>][caption][<?php echo $caption_row;?>][dataend]" value="<?php echo $caption['dataend']?>"/><p><?php echo $text_data_end_des;?></p></td></tr>
											  
											 <tr><td><?php echo $text_data_after_speed; ?></td><td class="left"><input type="text" name="boss_revolutionslider_module[<?php echo $module_row;?>][slide][<?php echo $slide_row;?>][caption][<?php echo $caption_row;?>][dataafterspeed]" value="<?php echo $caption['dataafterspeed']?>"/><p><?php echo $text_data_after_speed_des;?></p></td></tr>
											 
											 <tr><td><?php echo $text_incom_animation; ?></td><td class="left"><select name="boss_revolutionslider_module[<?php echo $module_row;?>][slide][<?php echo $slide_row;?>][caption][<?php echo $caption_row;?>][incom_animation]">
											  <?php foreach($incom_animation as $key=>$value) {?>
												<option value="<?php echo $key;?>" <?php if($caption['incom_animation']== $key) echo "selected=selected"; ?>><?php echo $value;?></option>
											  <?php } ?>
											  </select><p><?php echo $text_incom_animation_des;?></p></td></tr>
											
											  <tr><td><?php echo $text_outgo_animation; ?></td><td class="left"><select name="boss_revolutionslider_module[<?php echo $module_row;?>][slide][<?php echo $slide_row;?>][caption][<?php echo $caption_row;?>][outgo_animation]">
											  <?php foreach($outgo_animation as $key=>$value) {?>
											<option value="<?php echo $key;?>" <?php if($caption['outgo_animation']== $key) echo "selected=selected"; ?>><?php echo $value;?></option>
											  <?php } ?>
											  </select><p><?php echo $text_outgo_animation_des;?></p></td></tr> 
											  
											  <tr><td><?php echo $text_easing; ?></td><td class="left"><select name="boss_revolutionslider_module[<?php echo $module_row;?>][slide][<?php echo $slide_row;?>][caption][<?php echo $caption_row;?>][easing]">
											  <?php foreach($easing as $e) {?>
											  <option value="<?php echo $e;?>" <?php if($caption['easing'] == $e) echo "selected=selected";?>><?php echo $e;?></option>
											  <?php } ?>
											  </select><p><?php echo $text_easing_des;?></p></td></tr>
											  
											  <tr><td><?php echo $text_endeasing; ?></td><td class="left"><select name="boss_revolutionslider_module[<?php echo $module_row;?>][slide][<?php echo $slide_row;?>][caption][<?php echo $caption_row;?>][endeasing]">
											  <?php foreach($easing as $e) {?>
											  <option value="<?php echo $e;?>" <?php if($caption['endeasing'] == $e) echo "selected=selected";?>><?php echo $e;?></option>
											  <?php } ?>
											</select><p><?php echo $text_endeasing_des;?></p></td></tr>
											 
											 <tr><td><?php echo $text_under_width; ?></td><td class="left"><input type="checkbox" name="boss_revolutionslider_module[<?php echo $module_row;?>][slide][<?php echo $slide_row;?>][caption][<?php echo $caption_row;?>][hideunderwidth]" <?php if(isset($caption['hideunderwidth'])) echo "checked=checked";?> /><p><?php echo $text_under_width_des;?></p></td></tr>
											 
										</table>
									</ul>
									</li>
								<?php $caption_row++;?>
								<?php } ?>
								<?php } ?>
								<a onclick="addCaption(this,<?php echo $module_row;?>,<?php echo $slide_row;?>,<?php echo $caption_row;?>);" class="button" style="color:#FFF "><?php echo $button_add_caption; ?></a>
							</div>
						</ul>
					</li>
					<?php $slide_row++ ; ?>
				<?php } ?>
				</ul>
			<?php } ?>
			<a onclick="addSlider(this,<?php echo $module_row;?>,<?php echo $slide_row;?>);" class="button"><?php echo $button_add_slider; ?></a>
			</div>
			
			
			<?php $option = $module['option'];?>
			<div id="configoption<?php echo $module_row;?>" class="htabs-content">
				<ul id="revlslide_setting<?php echo $module_row;?>" class="revlslide_setting">
					<li class="ui-state-default">
						<span class="expand"><?php echo $text_general;?></span>
						<ul>
							<li>
								<table class="form">
									<tr> <td><label><?php echo $text_delay;?></label></td><td><input type="text" value="<?php echo $option['delay'];?>" name="boss_revolutionslider_module[<?php echo $module_row;?>][option][delay]"><br /><p class="clear"><?php echo $text_delay_option_des;?></p></td></tr>
									<tr> <td><label><?php echo $text_startheight_option;?></label></td><td><input type="text" value="<?php echo $option['startheight']?>" name="boss_revolutionslider_module[<?php echo $module_row;?>][option][startheight]"><p class="clear"><?php echo $text_startheight_option_des;?></p></td></tr>
									
									<tr> <td><label><?php echo $text_startwidth_option;?></label></td><td><input type="text" value="<?php echo $option['startwidth']?>" name="boss_revolutionslider_module[<?php echo $module_row;?>][option][startwidth]"><p class="clear"><?php echo $text_startwidth_option_des;?></p></td></tr>
									
									<tr> <td><label><?php echo $text_touchenabled;?></label></td><td><select name="boss_revolutionslider_module[<?php echo $module_row;?>][option][touchenabled]">
										<option value="on" <?php if($option['touchenabled'] == "on") echo "selected=selected";?>><?php echo $text_enabled; ?></option>
										<option value="off" <?php if($option['touchenabled'] == "off") echo "selected=selected";?>><?php echo $text_disabled; ?></option></select><br /><p class="clear"><?php echo $text_touchenabled_des;?></p></td></tr>
										
									<tr><td><label><?php echo $text_onhoverstop;?></label></td><td><select name="boss_revolutionslider_module[<?php echo $module_row;?>][option][onhoverstop]"><option value="on" <?php if($option['onhoverstop'] == "on") echo "selected=selected";?>><?php echo $text_enabled; ?></option><option value="off" <?php if($option['onhoverstop'] == "off") echo "selected=selected";?>><?php echo $text_disabled; ?></option></select><br /><p class="clear"><?php echo $text_onhoverstop_des;?></p></td></tr>
									
									<tr><td><label><?php echo $text_fullwidth;?></label></td><td><select name="boss_revolutionslider_module[<?php echo $module_row;?>][option][fullwidth]">
									<option value="on" <?php if($option['fullwidth'] == "on") echo "selected=selected";?>><?php echo $text_enabled; ?></option>
									<option value="off" <?php if($option['fullwidth'] == "off") echo "selected=selected";?>><?php echo $text_disabled; ?></option></select><br /><p class="clear"><?php echo $text_fullwidth_des;?></p></td></tr>
									
									<tr><td><label><?php echo $text_timeline;?></label></td><td><select name="boss_revolutionslider_module[<?php echo $module_row;?>][option][timeline]">
										<option value="1" <?php if($option['timeline'] == 1) echo "selected=selected";?> ><?php echo $text_enabled; ?></option>
										<option value="0" <?php if($option['timeline'] == 0) echo "selected=selected";?>><?php echo $text_disabled; ?></option>
									</select><br /><p class="clear"><?php echo $text_timeline_des;?></p></td></tr>
									
									<tr> <td><label><?php echo $text_timerlineposition;?></label></td><td><select name="boss_revolutionslider_module[<?php echo $module_row;?>][option][timerlineposition]">
									<option value="top" <?php if($option['timerlineposition'] == "top") echo "selected=selected";?>>Top</option><option value="bottom" <?php if($option['timerlineposition'] == "bottom") echo "selected=selected";?>>Bottom</option></select><br /><p class="clear"><?php echo $text_timerlineposition_des;?></p></td></tr>
									
									<tr> <td><label><?php echo $text_shadow;?></label></td><td><select name="boss_revolutionslider_module[<?php echo $module_row;?>][option][shadow]">
										<option value="0" <?php if($option['shadow'] == 0) echo "selected=selected";?>>0</option>
										<option value="1" <?php if($option['shadow'] == 1) echo "selected=selected";?>>1</option>
										<option value="2" <?php if($option['shadow'] == 2) echo "selected=selected";?>>2</option>
										<option value="3" <?php if($option['shadow'] == 3) echo "selected=selected";?>>3</option>
										</select><br /><p class="clear"><?php echo $text_shadow_des;?></p></td></tr>
								</table>
							</li>
						</ul>
					</li>
					<li class="ui-state-default">
					<span class="expand"><?php echo $text_navigation;?></span>
						<ul>
							<li>
								<table class="form">
									<tr><td><label><?php echo $text_navigation_type;?></label></td><td><?php $navigationtypes = array( 'bullet','thumb', 'none'); ?><select name="boss_revolutionslider_module[<?php echo $module_row;?>][option][navigationtype]">
									<?php foreach ($navigationtypes as $key) { ?><?php ($key ==  $option['navigationtype']) ? $selected = 'selected' : $selected=''; ?><option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $key; ?></option><?php } ?></select><p class="clear"> <?php echo $text_navigation_type_des;?></p></td></tr>
									
									<tr><td><label><?php echo $text_navigation_arrow;?></label></td><td><?php $navigationarrows = array( 'nexttobullets','solo', 'none'); ?><select name="boss_revolutionslider_module[<?php echo $module_row;?>][option][navigationarrow]"><?php foreach ($navigationarrows as $key) { ?><?php ($key == $option['navigationarrow']) ? $selected = 'selected' : $selected=''; ?><option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $key; ?></option><?php } ?></select><p class="clear"><?php echo $text_navigation_arrow_des;?></p></td></tr>
									
									<tr><td><label><?php echo $text_navigation_style;?></label></td><td><?php $navigationstyles = array( 'round','navbar', 'round-old', 'square-old', 'navbar-old'); ?><select name="boss_revolutionslider_module[<?php echo $module_row;?>][option][navigationstyle]"><?php foreach ($navigationstyles as $key) { ?><?php ($key ==  $option['navigationstyle']) ? $selected = 'selected' : $selected=''; ?><option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $key; ?></option><?php } ?></select><p class="clear"><?php echo $text_navigation_style_des;?></p></td></tr>
									
									<tr><td><label><?php echo $text_navigationhalign;?></label></td><td><?php $navigationhaligns = array( 'left','center', 'right' ); ?><select name="boss_revolutionslider_module[<?php echo $module_row;?>][option][navigationhalign]"><?php foreach ($navigationhaligns as $key) { ?><?php ($key ==  $option['navigationhalign']) ? $selected = 'selected' : $selected=''; ?><option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $key; ?></option><?php } ?></select><p class="clear"><?php echo $text_navigationhalign_des;?></p></td></tr>
									
									<tr><td><label><?php echo $text_navigationvalign;?></label></td><td><?php $navigationvaligns = array( 'top','center', 'bottom' ); ?><select name="boss_revolutionslider_module[<?php echo $module_row;?>][option][navigationvalign]"><?php foreach ($navigationvaligns as $key) { ?><?php ($key == $option['navigationvalign']) ? $selected = 'selected' : $selected=''; ?><option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $key; ?></option><?php } ?></select><p class="clear"><?php echo $text_navigationvalign_des;?></p></td></tr>
									
									<tr><td><label><?php echo $text_navigationhoffset;?></label></td><td><input type="text" name="boss_revolutionslider_module[<?php echo $module_row;?>][option][navigationhoffset]" value="<?php echo $option['navigationhoffset'];?>"/><p class="clear"><?php echo $text_navigationhoffset_des;?></p></td></tr>
									
									<tr><td><label><?php echo $text_navigationvoffset;?></label></td><td><input type="text" name="boss_revolutionslider_module[<?php echo $module_row;?>][option][navigationvoffset]" value="<?php echo $option['navigationvoffset'];?>"/><p class="clear"><?php echo $text_navigationvoffset_des;?></p></td></tr>
									
									<tr><td><label><?php echo $text_soloarrowlefthalign;?></label></td><td><?php $soloarrowlefthaligns = array( 'left','center', 'right' ); ?><select name="boss_revolutionslider_module[<?php echo $module_row;?>][option][soloarrowlefthalign]" id="soloarrowlefthalign"><?php foreach ($soloarrowlefthaligns as $key) { ?><?php ($key ==  $option['soloarrowlefthalign']) ? $selected = 'selected' : $selected=''; ?><option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $key; ?></option><?php } ?></select><p class="clear"><?php echo $text_soloarrowlefthalign_des;?></p></td></tr>
									
									<tr><td><label><?php echo $text_soloarrowleftvalign;?></label></td><td><?php $soloarrowleftvaligns = array( 'top','center', 'bottom' ); ?><select name="boss_revolutionslider_module[<?php echo $module_row;?>][option][soloarrowleftvalign]" id="soloarrowleftvalign"><?php foreach ($soloarrowleftvaligns as $key) { ?><?php ($key == $option['soloarrowleftvalign']) ? $selected = 'selected' : $selected=''; ?><option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $key; ?></option><?php } ?></select><p class="clear"><?php echo $text_soloarrowleftvalign_des;?></p></td></tr>
									
									<tr><td><label><?php echo $text_soloarrowlefthoffset;?></label></td><td><input type="text" value="<?php echo $option['soloarrowlefthoffset']?>" name="boss_revolutionslider_module[<?php echo $module_row;?>][option][soloarrowlefthoffset]"><p class="clear"><?php echo $text_soloarrowlefthoffset_des;?></p></td></tr>
									
									<tr><td><label><?php echo $text_soloarrowleftvoffset;?></label></td><td><input type="text" value="<?php echo $option['soloarrowleftvoffset']?>" name="boss_revolutionslider_module[<?php echo $module_row;?>][option][soloarrowleftvoffset]"><p class="clear"><?php echo $text_soloarrowleftvoffset_des;?></p></td></tr>
									
									<tr><td><label><?php echo $text_soloarrowrighthalign;?></label></td><td><?php $soloarrowrighthaligns = array( 'left','center', 'right' ); ?><select name="boss_revolutionslider_module[<?php echo $module_row;?>][option][soloarrowrighthalign]"><?php foreach ($soloarrowrighthaligns as $key) { ?><?php ($key == $option['soloarrowrighthalign']) ? $selected = 'selected' : $selected=''; ?><option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $key; ?></option><?php } ?></select><p class="clear"><?php echo $text_soloarrowrighthalign_des;?></p></td></tr>
									
									<tr><td><label><?php echo $text_soloarrowrightvalign;?></label></td><td><?php $soloarrowrightvaligns = array( 'top','center', 'bottom' ); ?><select name="boss_revolutionslider_module[<?php echo $module_row;?>][option][soloarrowrightvalign]"><?php foreach ($soloarrowrightvaligns as $key) { ?><?php ($key == $option['soloarrowrightvalign']) ? $selected = 'selected' : $selected=''; ?><option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $key; ?></option><?php } ?></select><p class="clear"><?php echo $text_soloarrowrightvalign_des;?></p></td></tr>
									
									<tr><td><label><?php echo $text_soloarrowrighthoffset;?></label></td><td><input type="text" value="<?php echo $option['soloarrowrighthoffset'];?>" name="boss_revolutionslider_module[<?php echo $module_row;?>][option][soloarrowrighthoffset]"><p class="clear"><?php echo $text_soloarrowrighthoffset_des;?></p></td></tr>
									
									<tr><td><label><?php echo $text_soloarrowrightvoffset;?></label></td><td><input type="text" value="<?php echo $option['soloarrowrightvoffset'];?>" name="boss_revolutionslider_module[<?php echo $module_row;?>][option][soloarrowrightvoffset]"><p class="clear"><?php echo $text_soloarrowrightvoffset_des;?></p></td></tr>
								</table>
							</li>
						</ul>
					</li>
					<li class="ui-state-default">
					<span class="expand"><?php echo $text_thumbnails;?></span>
						<ul>
							<li>
								<table class="form">
									<tr><td><label><?php echo $text_timehidethumbnail;?></label></td><td><input type="text" value="<?php echo $option['timehidethumbnail'];?>" name="boss_revolutionslider_module[<?php echo $module_row;?>][option][timehidethumbnail]"><p class="clear"><?php echo $text_timehidethumbnail_des;?></p></td></tr><tr>
									
									<td><label><?php echo $text_thumbnailwidth;?></label></td><td><input type="text" value="<?php echo $option['thumbnailwidth'];?>" name="boss_revolutionslider_module[<?php echo $module_row;?>][option][thumbnailwidth]"><p class="clear"><?php echo $text_thumbnailwidth_des;?></p></td></tr>
									
									<tr><td><label><?php echo $text_thumbnailheight;?></label></td><td><input type="text" value="<?php echo $option['thumbnailheight'];?>" name="boss_revolutionslider_module[<?php echo $module_row;?>][option][thumbnailheight]"><p class="clear"><?php echo $text_thumbnailheight_des;?></p></td></tr>
									
									<tr><td><label><?php echo $text_thumbamount;?></label></td><td><input type="text" value="<?php echo $option['thumbamount'];?>" name="boss_revolutionslider_module[<?php echo $module_row;?>][option][thumbamount]"><p class="clear"><?php echo $text_thumbamount_des;?></p></td></tr>
								</table>
							</li>
						</ul>
					</li>
					<li class="ui-state-default">
						<span class="expand"><?php echo $text_visibility; ?></span>
						<ul>
							<li>
								<table class="form">
									<tr><td><label><?php echo $text_hidecapptionatlimit;?></label></td><td><input type="text" value="<?php echo $option['hidecapptionatlimit'];?>" name="boss_revolutionslider_module[<?php echo $module_row;?>][option][hidecapptionatlimit]"><p class="clear"><?php echo $text_hidecapptionatlimit_des;?></p></td></tr>
									
									<tr><td><label><?php echo $text_hideallcapptionatlimit;?></label></td><td><input type="text" value="<?php echo $option['hideallcapptionatlimit'];?>" name="boss_revolutionslider_module[<?php echo $module_row;?>][option][hideallcapptionatlimit]"><p class="clear"><?php echo $text_hideallcapptionatlimit_des;?></p></td></tr>
									
									<tr><td><label><?php echo $text_hideslideratlimit;?></label></td><td><input type="text" value="<?php echo $option['hideslideratlimit'];?>" name="boss_revolutionslider_module[<?php echo $module_row;?>][option][hideslideratlimit]"><p class="clear"><?php echo $text_hideslideratlimit_des;?></p></td></tr>
								</table>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>

		<?php $module_row++; ?>
		<?php } ?>
   </form>
  </div>
</div>
</div>

<script type="text/javascript"><!--
<!-- TABS -->

var module_row = <?php echo $module_row; ?>;
	<?php if(!empty($modules)){ ?>
$('#slidevtabs a').tabs();
<?php } ?>
	$(window).ready(function(){
		$('#revlslide_slide' + (module_row - 1) + '').dcAccordion({
			menuClose: false,
			autoClose: true,
			saveState: false,
			disableLink: false,	
			classExpand : 'bt-expand',
			autoExpand: true,
			});

	});

	// add module
    function addModule() {
	  html_tab = '<a href="#tab' + module_row + '" id="tabtitle' + module_row + '"><?php echo $module_stt; ?> ' + module_row  + '&nbsp;<img src="view/image/delete.png" alt="" onclick="$(\'.vtabs a:first\').trigger(\'click\'); $(\'#tabtitle' + module_row + '\').remove(); $(\'#tab' + module_row + '\').remove(); return false;" /></a>';
      html = '<div id="tab' + module_row + '" class="vtabs-content">';
	  
	  html += '<div id="tabcontent' + module_row + '" class="htabs">';
	  html += '<a href="#configinformation' + module_row + '"><?php echo $module_config_info; ?></a>';
	  html += '<a href="#sliderlist' + module_row  + '"><?php echo $module_slider_list; ?></a>';
	  html += '<a href="#configoption' + module_row + '"><?php echo $module_config_option; ?></a>';
	  html += '</div>';
	  
	  
	  html += '<div id="sliderlist' + module_row  + '" class="htabs-content">';
	  html += '<a onclick="addSlider(this,' + module_row +',1);" class="button"><?php echo $button_add_slider; ?></a>';
	  html += '</div>';
	   html += '<div id="configinformation' + module_row + '" class="htabs-content">';
	  html += '<table class="form">';
	  
	  html += '<tr><td><?php echo $entry_image; ?></td>';
	  html += '<td class="left"><input type="text" name="boss_revolutionslider_module[' + module_row + '][image_width]" value="1180" size="3" /> <input type="text" name="boss_revolutionslider_module[' + module_row + '][image_height]" value="500" size="3" /> </td></tr> ';
	  
	  html += '<tr><td><?php echo $entry_layout; ?></td><td class="left">';
	  html += '<select name="boss_revolutionslider_module[' + module_row + '][layout_id]">';
	  <?php foreach($layouts as $layout) {?>
	  html += '<option value="<?php echo $layout['layout_id']?>"><?php echo addslashes($layout['name']); ?></option>';
	  <?php } ?>
	  html += '</select></td></tr>';
	  
	  html += '<tr><td><?php echo $entry_position; ?></td><td class="left">';
	  html += '<select name="boss_revolutionslider_module[' + module_row + '][position]">';
	  html += '<option value="slideshow"><?php echo $text_slideshow; ?></option>';
	  html += '<option value="content_top"><?php echo $text_content_top; ?></option>';
	  html += '<option value="content_bottom"><?php echo $text_content_bottom; ?></option>';
	  html += '</select></td></tr>';
	  
	  html += '<tr><td><?php echo $entry_status; ?></td><td class="left">';
	  html += '<select name="boss_revolutionslider_module[' + module_row + '][status]">';
	  html += '<option value="1" selected="selected"><?php echo $text_enabled; ?></option>';
	  html += '<option value="0"><?php echo $text_disabled; ?></option>';
	  html += '</select></td></tr>';
	  
	  html += '<tr><td><?php echo $entry_sort_order; ?></td><td class="left"><input type="text" name="boss_revolutionslider_module[' + module_row + '][sort_order]" value="" size="3" /></td></tr>';
	  html += '<tr><td><?php echo $entry_store; ?></td><td><div class="scrollbox"><input type="checkbox" name="boss_revolutionslider_module[' + module_row + '][store_id][]" value="0" checked="checked" /><?php echo $text_default; ?>';
	  <?php foreach ($stores as $store) {?>
	  html += '<input type="checkbox" name="boss_revolutionslider_module[' + module_row + '][store_id][]" value="<?php echo $store['store_id'];?>" /><?php echo $store['name'] ?>';
	  <?php }?>
	  html += '</div></td></tr>';
	  
	  //
	  html += '</table></div>';
	  html += '<div id="configoption' + module_row  + '" class="htabs-content">';
	 html += '<ul id="revlslide_setting'+ module_row + '" class="revlslide_setting">';
	  
	  html += '<li class="ui-state-default">';
	  html += '<span class="expand"><?php echo $text_general;?></span>';
	  html += '<ul>';
	  //
	  html += '<li><table class="form"><tr> <td><label><?php echo $text_delay;?></label></td><td><input type="text" value="300" name="boss_revolutionslider_module[' + module_row + '][option][delay]"><br /><p class="clear"><?php echo $text_delay_option_des;?></p></td></tr>';
	  
	  html += '<tr> <td><label><?php echo $text_startheight_option;?></label></td><td><input type="text" value="500" name="boss_revolutionslider_module[' + module_row + '][option][startheight]"><p class="clear"><?php echo $text_startheight_option_des;?></p></td></tr>';
	  
	  html += '<tr> <td><label><?php echo $text_startwidth_option;?></label></td><td><input type="text" value="1180" name="boss_revolutionslider_module[' + module_row + '][option][startwidth]"><p class="clear"><?php echo $text_startwidth_option_des;?></p></td></tr>';
	  
      html += '<tr> <td><label><?php echo $text_touchenabled;?></label></td><td><select name="boss_revolutionslider_module[' + module_row + '][option][touchenabled]"><option value="on" selected="selected"><?php echo $text_enabled; ?></option><option value="off"><?php echo $text_disabled; ?></option></select><br /><p class="clear"><?php echo $text_touchenabled_des;?></p></td></tr>';
	  html += '<tr><td><label><?php echo $text_onhoverstop;?></label></td><td><select name="boss_revolutionslider_module[' + module_row + '][option][onhoverstop]"><option value="1" selected="selected"><?php echo $text_enabled; ?></option><option value="0"><?php echo $text_disabled; ?></option></select><br /><p class="clear"><?php echo $text_onhoverstop_des;?></p></td></tr>';
	  html += '<tr><td><label><?php echo $text_fullwidth;?></label></td><td><select name="boss_revolutionslider_module[' + module_row + '][option][fullwidth]"><option value="on" selected="selected"><?php echo $text_enabled; ?></option><option value="off"><?php echo $text_disabled; ?></option></select><br /><p class="clear"><?php echo $text_fullwidth_des;?></p></td></tr>';
	  html += '<tr><td><label><?php echo $text_timeline;?></label></td><td><select name="boss_revolutionslider_module[' + module_row + '][option][timeline]"><option value="1" selected="selected"><?php echo $text_enabled; ?></option><option value="0"><?php echo $text_disabled; ?></option></select><br /><p class="clear"><?php echo $text_timeline_des;?></p></td></tr>';
      html += '<tr> <td><label><?php echo $text_timerlineposition;?></label></td><td><select name="boss_revolutionslider_module[' + module_row + '][option][timerlineposition]"><option value="top" selected="selected">Top</option><option value="bottom">Bottom</option></select><br /><p class="clear"><?php echo $text_timerlineposition_des;?></p></td></tr>';
	  
	  html += '<tr> <td><label><?php echo $text_shadow;?></label></td><td><select name="boss_revolutionslider_module[' + module_row + '][option][shadow]"><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3" selected="selected">3</option></select><br /><p class="clear"><?php echo $text_shadow_des;?></p></td></tr>';
	  
	  html += '</table>	';
	  html += '</li>';
	  html += '</ul>';
	  html += '</li>';//end general
	  
	  html += '<li class="ui-state-default">';
	  html += '<span class="expand"><?php echo $text_navigation;?></span>';
	  //
	  html += '<ul><li><table class="form">';
	  
	  html += '<tr><td><label><?php echo $text_navigation_type;?></label></td><td><?php $navigationtypes = array( 'bullet','thumb', 'none'); ?><select name="boss_revolutionslider_module[' + module_row + '][option][navigationtype]"><?php foreach ($navigationtypes as $key) { ?><?php ($key ==  'bullet') ? $selected = 'selected' : $selected=''; ?><option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $key; ?></option><?php } ?></select><p class="clear"><?php echo $text_navigation_type_des;?></p></td></tr>';
	  
	  html += '<tr><td><label><?php echo $text_navigation_arrow;?></label></td><td><?php $navigationarrows = array( 'nexttobullets','solo', 'none'); ?><select name="boss_revolutionslider_module[' + module_row + '][option][navigationarrow]" id="navigationarrow"><?php foreach ($navigationarrows as $key) { ?><?php ($key == 'solo') ? $selected = 'selected' : $selected=''; ?><option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $key; ?></option><?php } ?></select><p class="clear"><?php echo $text_navigation_arrow_des;?></p></td></tr>';
	  
	  html += '<tr><td><label><?php echo $text_navigation_style;?></label></td><td><?php $navigationstyles = array( 'round','navbar', 'round-old', 'square-old', 'navbar-old'); ?><select name="boss_revolutionslider_module[' + module_row + '][option][navigationstyle]" id="navigationstyle"><?php foreach ($navigationstyles as $key) { ?><?php ($key ==  'round') ? $selected = 'selected' : $selected=''; ?><option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $key; ?></option><?php } ?></select><p class="clear"><?php echo $text_navigation_style_des;?></p></td></tr>';
	  
	  html += '<tr><td><label><?php echo $text_navigationhalign;?></label></td><td><?php $navigationhaligns = array( 'left','center', 'right' ); ?><select name="boss_revolutionslider_module[' + module_row + '][option][navigationhalign]" id="navigationhalign"><?php foreach ($navigationhaligns as $key) { ?><?php ($key ==  'center') ? $selected = 'selected' : $selected=''; ?><option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $key; ?></option><?php } ?></select><p class="clear"><?php echo $text_navigationhalign_des;?></p></td></tr>';
	  
	  html += '<tr><td><label><?php echo $text_navigationvalign;?></label></td><td><?php $navigationvaligns = array( 'top','center', 'bottom' ); ?><select name="boss_revolutionslider_module[' + module_row + '][option][navigationvalign]" id="navigationvalign"><?php foreach ($navigationvaligns as $key) { ?><?php ($key ==  'bottom') ? $selected = 'selected' : $selected=''; ?><option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $key; ?></option><?php } ?></select><p class="clear"><?php echo $text_navigationvalign_des;?></p></td></tr>';
	  
	  html += '<tr><td><label><?php echo $text_navigationhoffset;?></label></td><td><input type="text" name="boss_revolutionslider_module[' + module_row + '][option][navigationhoffset]" value="0"/><p class="clear"><?php echo $text_navigationhoffset_des;?></p></td></tr>';
	  
	  html += '<tr><td><label><?php echo $text_navigationvoffset;?></label></td><td><input type="text" name="boss_revolutionslider_module[' + module_row + '][option][navigationvoffset]" value="0"/><p class="clear"><?php echo $text_navigationvoffset_des;?></p></td></tr>';
	  
	  
	  html += '<tr><td><label><?php echo $text_soloarrowlefthalign;?></label></td><td><?php $soloarrowlefthaligns = array( 'left','center', 'right' ); ?><select name="boss_revolutionslider_module[' + module_row + '][option][soloarrowlefthalign]"><?php foreach ($soloarrowlefthaligns as $key) { ?><?php ($key ==  'left') ? $selected = 'selected' : $selected=''; ?><option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $key; ?></option><?php } ?></select><p class="clear"><?php echo $text_soloarrowlefthalign_des;?></p></td></tr>';
	  
	  html += '<tr><td><label><?php echo $text_soloarrowleftvalign;?></label></td><td><?php $soloarrowleftvaligns = array( 'top','center', 'bottom' ); ?><select name="boss_revolutionslider_module[' + module_row + '][option][soloarrowleftvalign]"><?php foreach ($soloarrowleftvaligns as $key) { ?><?php ($key ==  'center') ? $selected = 'selected' : $selected=''; ?><option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $key; ?></option><?php } ?></select><p class="clear"><?php echo $text_soloarrowleftvalign_des;?></p></td></tr>';
	  
	  html += '<tr><td><label><?php echo $text_soloarrowlefthoffset;?></label></td><td><input type="text" value="0" name="boss_revolutionslider_module[' + module_row + '][option][soloarrowlefthoffset]"><p class="clear"><?php echo $text_soloarrowlefthoffset_des;?></p></td></tr>';
	  
	  html += '<tr><td><label><?php echo $text_soloarrowleftvoffset;?></label></td><td><input type="text" value="0" name="boss_revolutionslider_module[' + module_row + '][option][soloarrowleftvoffset]"><p class="clear"><?php echo $text_soloarrowleftvoffset_des;?></p></td></tr>';
	  
	  html += '<tr><td><label><?php echo $text_soloarrowrighthalign;?></label></td><td><?php $soloarrowrighthaligns = array( 'left','center', 'right' ); ?><select name="boss_revolutionslider_module[' + module_row + '][option][soloarrowrighthalign]"><?php foreach ($soloarrowrighthaligns as $key) { ?><?php ($key ==  'center') ? $selected = 'selected' : $selected=''; ?><option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $key; ?></option><?php } ?></select><p class="clear"><?php echo $text_soloarrowrighthalign_des;?></p></td></tr>';
	  
	  html += '<tr><td><label><?php echo $text_soloarrowrightvalign;?></label></td><td><?php $soloarrowrightvaligns = array( 'top','center', 'bottom' ); ?><select name="boss_revolutionslider_module[' + module_row + '][option][soloarrowrightvalign]"><?php foreach ($soloarrowrightvaligns as $key) { ?><?php ($key ==  'center') ? $selected = 'selected' : $selected=''; ?><option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $key; ?></option><?php } ?></select><p class="clear"><?php echo $text_soloarrowrightvalign_des;?></p></td></tr>';
	  
	  html += '<tr><td><label><?php echo $text_soloarrowrighthoffset;?></label></td><td><input type="text" value="0" name="boss_revolutionslider_module[' + module_row + '][option][soloarrowrighthoffset]"><p class="clear"><?php echo $text_soloarrowrighthoffset_des;?></p></td></tr>';
	  
      html += '<tr><td><label><?php echo $text_soloarrowrightvoffset;?></label></td><td><input type="text" value="0" name="boss_revolutionslider_module[' + module_row + '][option][soloarrowrightvoffset]"><p class="clear"><?php echo $text_soloarrowrightvoffset_des;?></p></td></tr>';
	  html += '</table></li></ul>';
	  html += '</li>'; //end navigation
	
	  html += '<li class="ui-state-default">';
	  html += '<span class="expand"><?php echo $text_thumbnails;?></span>';
	  html += '<ul><li><table class="form">';
	  
	  html += '<tr><td><label><?php echo $text_timehidethumbnail;?></label></td><td><input type="text" value="10" name="boss_revolutionslider_module[' + module_row + '][option][timehidethumbnail]"><p class="clear"><?php echo $text_timehidethumbnail_des;?></p></td></tr><tr>';
	  
	  html += '<td><label><?php echo $text_thumbnailwidth;?></label></td><td><input type="text" value="50" name="boss_revolutionslider_module[' + module_row + '][option][thumbnailwidth]"><p class="clear"><?php echo $text_thumbnailwidth_des;?></p></td></tr>';
	  
      html += '<tr><td><label><?php echo $text_thumbnailheight;?></label></td><td><input type="text" value="50" name="boss_revolutionslider_module[' + module_row + '][option][thumbnailheight]"><p class="clear"><?php echo $text_thumbnailheight_des;?></p></td></tr>';
	  
	  html += '<tr><td><label><?php echo $text_thumbamount;?></label></td><td><input type="text" value="4" name="boss_revolutionslider_module[' + module_row + '][option][thumbamount]"><p class="clear"><?php echo $text_thumbamount_des;?></p></td></tr>';
	  html += '</table></li></ul>';
	  html += '</li>'; //end thumbnail
	  
	  
	  html += '<li class="ui-state-default">';
	  html += '<span class="expand"><?php echo $text_visibility;?></span>';

	  html += '<ul><li><table class="form">';
	  html += '<tr><td><label><?php echo $text_hidecapptionatlimit;?></label></td><td><input type="text" value="500" name="boss_revolutionslider_module[' + module_row + '][option][hidecapptionatlimit]"><p class="clear"><?php echo $text_hidecapptionatlimit_des;?></p></td></tr>';
	  html += '<tr><td><label><?php echo $text_hideallcapptionatlimit;?></label></td><td><input type="text" value="500" name="boss_revolutionslider_module[' + module_row + '][option][hideallcapptionatlimit]"><p class="clear"><?php echo $text_hideallcapptionatlimit_des;?></p></td></tr><tr>';
      html += '<td><label><?php echo $text_hideslideratlimit;?></label></td><td><input type="text" value="0" name="boss_revolutionslider_module[' + module_row + '][option][hideslideratlimit]"><p class="clear"><?php echo $text_hideslideratlimit_des;?></p></td></tr>';
	  html +='</table></li></ul>'; //end copy
	  html += '</li>';
	  html += '</ul>';
	  html += '</div>';
	  html += '</div>';
	 $('div.vtabs span.addModule').before(html_tab);
	 if($('#tab' + (module_row -1)).length > 0)
		$('#tab' + (module_row -1)).after(html);
	else
		$('.vtabs').after(html);
	$('#slidevtabs a').tabs();
	 $('#tabcontent' + module_row + ' a').tabs();
	 $('#tabAddSlide' + module_row +'1 a').tabs();
	 $('#tabtitle' + module_row).trigger('click');

	 $('#revlslide_setting' + module_row + '').dcAccordion({
		menuClose: false,
		autoClose: true,
		saveState: false,
		disableLink: false,	
		classExpand : 'bt-expand',
		autoExpand: true,
		});
	module_row++;
	
    }
//--></script>
<script type="text/javascript"><!--
   function addSlider(btAdd, module_row, slide_row) {
	  html = '<li class="ui-state-default bt-expand dcjq-parent-li" id="slide-row' + module_row + '-opt-row' + slide_row + '" style="overflow:hidden">';
	  html += '<span onclick="$(\'ul.content_slide\').removeClass(\'active\');$(this).next().addClass(\'active\');$(\'ul.content_slide:not(.active)\').hide();$(this).next().slideToggle(\'slow\');">New Slide';
	  html += '<a style="float: right" onclick="$(\'#slide-row' + module_row  + '-opt-row' + slide_row + '\').remove();"><img src="view/image/delete.png" /></a></span>';
	  html += '<ul class="content_slide active">';
	  //begin content tab slide
	  html += '<div class="vtabs" id="tabAddSlide' + module_row + slide_row + '" style="margin-left:-42px">';
	  html += '<a href="#generalSlide' + module_row + slide_row + '"><?php echo $text_general; ?></a>';
	  html += '<a href="#animationSlide' + module_row + slide_row + '"><?php echo $text_animation; ?></a>';
	  html += '<a href="#captionSlide' + module_row + slide_row + '"><?php echo $text_caption; ?></a>';
	  html += '</div>';
	  html += '<div id="generalSlide' + module_row + slide_row + '" class="vtabs-content">';
	  html += '<table class="form">';
	  
	  html += '<tr><td><?php echo $text_background; ?></td>';
	  html += '<td class="left"><input type="radio" name="boss_revolutionslider_module[' + module_row + '][slide]['+ slide_row+'][type_background]" value="image_bg" checked="checked" onclick="changeContentBackground(\'image_bg\',' + module_row + ',' + slide_row + ')"/><?php echo $text_image;?><input type="radio" name="boss_revolutionslider_module[' + module_row + '][slide]['+ slide_row+'][type_background]" value="color_bg" onclick="changeContentBackground(\'color_bg\',' + module_row + ',' + slide_row + ')"/><?php echo $text_color;?><input type="radio" name="boss_revolutionslider_module[' + module_row + '][slide]['+ slide_row+'][type_background]" value="transparent_bg" onclick="changeContentBackground(\'transparent_bg\',' + module_row + ',' + slide_row + ')"/><?php echo $text_transparent;?></td></tr> ';
	  
	  html += '<tr id="tr_content_background'+ module_row + slide_row +'"><td><?php echo $text_image; ?></td><td class="left"><div class="image"><img src="<?php echo $no_image; ?>" alt="" id="thumb' + module_row + slide_row + '" /><input type="hidden" name="boss_revolutionslider_module[' + module_row + '][slide]['+ slide_row + '][background]" value="" id="image' + module_row + slide_row + '" /><br /><a onclick="image_upload(\'image' + module_row + slide_row + '\', \'thumb' + module_row + slide_row + '\');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$(\'#thumb' + module_row + slide_row + '\').attr(\'src\', \'<?php echo $no_image; ?>\'); $(\'#image' + module_row + slide_row + '\').attr(\'value\', \'\');"><?php echo $text_clear; ?></a></div></td></tr>';
	  
	  html += '<tr><td><?php echo $text_url;?></td><td><input name="boss_revolutionslider_module['+ module_row +'][slide]['+ slide_row +'][url]" value="#"/></td></tr>';
	  
	   html += '<tr><td><?php echo $entry_status; ?></td><td class="left">';
	  html += '<select name="boss_revolutionslider_module['+ module_row +'][slide]['+ slide_row +'][status]">';
	  html += '<option value="1" selected="selected"><?php echo $text_enabled; ?></option>';
	  html += '<option value="0"><?php echo $text_disabled; ?></option>';
	  html += '</select></td></tr>';
	 
	  html += '</table>';
	  html += '</div>'; //general tab
	  html += '<div id="animationSlide' + module_row + slide_row + '" class="vtabs-content">';
	  html += '<table class="form">';
	  
	  html += '<tr><td><?php echo $text_transition?></td><td><select name="boss_revolutionslider_module['+ module_row +'][slide]['+ slide_row +'][transitions]">';
	  <?php foreach($transitions as $tran) {?>
		html +='<option value="<?php echo $tran;?>"><?php echo $tran;?></option>';
	  <?php }?>
	  html += '</select><p><?php echo $text_transition_des;?></p></td></tr>';
	  
	  html += '<tr><td><?php echo $text_slot_amount;?></td><td><input name="boss_revolutionslider_module['+ module_row +'][slide]['+ slide_row +'][slotamount]" value="7"/><p><?php echo $text_slot_amount_des;?></p>';
	  html += '</td></tr>';
	  
	  html += '<tr><td><?php echo $text_master_speed;?></td><td><input name="boss_revolutionslider_module['+ module_row +'][slide]['+ slide_row +'][masterspeed]" value="7"/><p><?php echo $text_master_speed_des;?></p>';
	  html += '</td></tr>';
	  
	  html += '<tr><td><?php echo $text_target?></td><td><select name="boss_revolutionslider_module['+ module_row +'][slide]['+ slide_row +'][target]">';
	  html +='<option value="_self">_self</option>';
	  html +='<option value="_blank">_blank</option>';
	  html += '</select><p><?php echo $text_target_des;?></p></td></tr>';
	  
	  html += '<tr><td><?php echo $text_delay;?></td><td><input name="boss_revolutionslider_module['+ module_row +'][slide]['+ slide_row +'][delay]" value="9400"/><p><?php echo $text_delay_des;?></p>';
	  html += '</td></tr>';
	  
	  html += '<tr><td><?php echo $text_enable_link; ?></td><td>';
	  html += '<select name="boss_revolutionslider_module['+ module_row +'][slide]['+ slide_row +'][enablelink]">';
	  html += '<option value="1" selected="selected"><?php echo $text_enabled; ?></option>';
	  html += '<option value="0"><?php echo $text_disabled; ?></option>';
	  html += '</select></td></tr>';
	  
	  html += '<tr><td><?php echo $text_full_video; ?></td><td>';
	  html += '<select name="boss_revolutionslider_module['+ module_row +'][slide]['+ slide_row +'][enablefullvideo]">';
	  html += '<option value="1" selected="selected"><?php echo $text_enabled; ?></option>';
	  html += '<option value="0"><?php echo $text_disabled; ?></option>';
	  html += '</select></td></tr>';
	  
	  html += '</table></div>'; //animation tab
	  html += '<div id="captionSlide' + module_row + slide_row + '" class="vtabs-content">';
	  html += '<a onclick="addCaption(this,' + module_row + ', ' + slide_row + ',1);" class="button" style="color:#FFF "><?php echo $button_add_caption; ?></a></div>'; //caption tab
		
	  //end content tab slide
	  html += '</ul>';
	  html += '</li>';
	  html += '<a style="float: right; margin-top: 5px;" onclick="$(\'ul.content_slide\').removeClass(\'active\');$(\'ul.content_slide:not(.active)\').hide();addSlider(this,' + module_row + ', ' + (slide_row + 1) + ');" class="button"><?php echo $button_add_slider; ?></a>';
	  $(btAdd).before(html);
	  $(btAdd).remove();
	  $('#tabAddSlide' + module_row + slide_row + ' a').tabs();
	}
//--></script>

<script type="text/javascript"><!--
   function changeContentBackground(type_background,module_row,slide_row) {
		if(type_background == 'image_bg')
		{
			html = '<td><?php echo $text_image; ?></td><td class="left"><div class="image"><img src="<?php echo $no_image; ?>" alt="" id="thumb' + module_row + slide_row + '" /><input type="hidden" name="boss_revolutionslider_module[' + module_row + '][slide]['+ slide_row + '][background]" value="" id="image' + module_row + slide_row + '" /><br /><a onclick="image_upload(\'image' + module_row + slide_row + '\', \'thumb' + module_row + slide_row + '\');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$(\'#thumb' + module_row + slide_row + '\').attr(\'src\', \'<?php echo $no_image; ?>\'); $(\'#image' + module_row + slide_row + '\').attr(\'value\', \'\');"><?php echo $text_clear; ?></a></div></td>';
		}
		else if (type_background == 'color_bg')
		{
			html = '<td><?php echo $text_color; ?></td><td class="left"><input id="color_bg'+ module_row + slide_row + '"  type="text" name="boss_revolutionslider_module[' + module_row + '][slide]['+ slide_row + '][background]" onfocus="colorEvent(\'color_bg' + module_row + slide_row + '\');EYE.register(colorEvent, \'init\');"/></td>';
		}
		else
		{
			html = '<input type="hidden" name="boss_revolutionslider_module[' + module_row + '][slide]['+ slide_row + '][background]" value="image/data/transparent.png"/>';
		}
		$('#tr_content_background' + module_row + slide_row +'').html(html);
   }
//--></script>
<script type="text/javascript"><!--
   function changeContentCaption(type_caption,module_row,slide_row,caption_row) {
		if(type_caption == 'text_caption')
		{
			html = '<td><?php echo $text_text; ?></td><td class="left"><?php foreach ($languages as $language) { ?><textarea style="width:90%; height:60px;" name="boss_revolutionslider_module[' + module_row + '][slide]['+ slide_row+'][caption]['+ caption_row +'][text_caption][<?php echo $language['language_id']; ?>]"></textarea> <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><br /><?php } ?></td>';
		}
		else if (type_caption == 'image_caption')
		{
			html = '<td><?php echo $text_image; ?></td><td class="left"><div class="image"><img src="<?php echo $no_image; ?>" alt="" id="thumb' + module_row + slide_row + caption_row + '" /><input type="hidden" name="boss_revolutionslider_module[' + module_row + '][slide]['+ slide_row+'][caption]['+ caption_row +'][image_caption]" value="" id="image' + module_row + slide_row + caption_row + '" /><br /><a onclick="image_upload(\'image' + module_row + slide_row + caption_row + '\', \'thumb' + module_row + slide_row + caption_row + '\');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$(\'#thumb' + module_row + slide_row + caption_row + '\').attr(\'src\', \'<?php echo $no_image; ?>\'); $(\'#image' + module_row + slide_row + caption_row + '\').attr(\'value\', \'\');"><?php echo $text_clear; ?></a></div></td>';
		}
		else
		{
			html = '<td><?php echo $text_video; ?></td><td class="left"><?php echo $text_video_type; ?><select name="boss_revolutionslider_module[' + module_row + '][slide]['+ slide_row+'][caption]['+ caption_row +'][video_caption][type]"><option value="youtube">Youtube</option><option value="vimeo">vimeo</option></select>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $text_video_id; ?><?php foreach ($languages as $language) { ?><input name="boss_revolutionslider_module[' + module_row + '][slide]['+ slide_row+'][caption]['+ caption_row +'][video_caption][id][<?php echo $language['language_id']; ?>]"/><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><br /><?php } ?>W <input type="text" name="boss_revolutionslider_module['+module_row+'][slide]['+slide_row+'][caption]['+caption_row+'][video_caption][width]" value="100" /> x H <input type="text" name="boss_revolutionslider_module['+module_row+'][slide]['+slide_row+'][caption]['+caption_row+'][video_caption][height]" value="100" /></td>';
		}
		$('#tr_content_caption' + module_row + slide_row + caption_row + '').html(html);
   }
//--></script>
<script type="text/javascript"><!--
   function addCaption(btAddCaption, module_row, slide_row,caption_row) {
      html = '<li class="ui-state-default bt-expand dcjq-parent-li" id="caption-row' + module_row  + slide_row + caption_row + '" style="margin-left:-30px;">';
	  html += '<span onclick="$(\'ul.content_caption\').removeClass(\'active\');$(this).next().addClass(\'active\');$(\'ul.content_caption:not(.active)\').hide();$(this).next().slideToggle(\'slow\');"><?php echo $text_new_caption;?>';
	   html += '<a style="float: right" onclick="$(\'#caption-row' + module_row + slide_row + caption_row +'\').remove();" title="<?php echo $text_remove_caption;?>"><img src="view/image/delete.png" /></a></span>';
	  html += '<ul class="content_caption active" id="content_caption' + module_row + slide_row + caption_row +'">';
	  //
	  html += '<table class="form">';
	  html += '<tr><td><?php echo $text_type_caption; ?></td>';
	  html += '<td class="left"><input type="radio" name="boss_revolutionslider_module[' + module_row + '][slide]['+ slide_row+'][caption]['+ caption_row +'][type_caption]" value="text_caption" checked="checked" onclick="changeContentCaption(\'text_caption\',' + module_row + ',' + slide_row + ',' +caption_row +')"/><?php echo $text_text_caption;?><input type="radio" name="boss_revolutionslider_module[' + module_row + '][slide]['+ slide_row+'][caption]['+ caption_row +'][type_caption]" value="image_caption" onclick="changeContentCaption(\'image_caption\',' + module_row + ',' + slide_row + ',' +caption_row +')"/><?php echo $text_image_caption;?><input type="radio" name="boss_revolutionslider_module[' + module_row + '][slide]['+ slide_row+'][caption]['+ caption_row +'][type_caption]" value="video_caption" onclick="changeContentCaption(\'video_caption\',' + module_row + ',' + slide_row + ',' +caption_row +')"/><?php echo $text_video_caption;?></td></tr> ';
	  
	  html += '<tr id="tr_content_caption' + module_row + slide_row + caption_row + '"><td><?php echo $text_text; ?></td><td class="left"><?php foreach ($languages as $language) { ?><textarea style="width:90%; height:60px;" name="boss_revolutionslider_module[' + module_row + '][slide]['+ slide_row+'][caption]['+ caption_row +'][text_caption][<?php echo $language['language_id']; ?>]"></textarea> <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><br /><?php } ?></td></tr> ';
	  
	  html += '<tr><td><?php echo $text_datax; ?></td><td class="left"><input type="text" name="boss_revolutionslider_module[' + module_row + '][slide]['+ slide_row+'][caption]['+ caption_row +'][datax]" value="100"/><p><?php echo $text_datax_des;?></p></td></tr> ';
	  
	  html += '<tr><td><?php echo $text_datay; ?></td><td class="left"><input type="text" name="boss_revolutionslider_module[' + module_row + '][slide]['+ slide_row+'][caption]['+ caption_row +'][datay]" value="100"/><p><?php echo $text_datay_des;?></p></td></tr> ';
	  
	  html += '<tr><td><?php echo $text_class_css; ?></td><td class="left"><select name="boss_revolutionslider_module[' + module_row + '][slide]['+ slide_row+'][caption]['+ caption_row +'][class_css]">';
	  <?php foreach($class_css as $class) {?>
		html += '<option value="<?php echo $class;?>"><?php echo $class;?></option>';
	  <?php } ?>
	  html +='</select><p><?php echo $text_class_css_des;?></p></td></tr> ';
	  
	  html += '<tr><td><?php echo $text_data_speed; ?></td><td class="left"><input type="text" name="boss_revolutionslider_module[' + module_row + '][slide]['+ slide_row+'][caption]['+ caption_row +'][dataspeed]" value="100"/><p><?php echo $text_data_speed_des;?></p></td></tr>';
	  
	  html += '<tr><td><?php echo $text_data_end; ?></td><td class="left"><input type="text" name="boss_revolutionslider_module[' + module_row + '][slide]['+ slide_row+'][caption]['+ caption_row +'][dataend]" value="100"/><p><?php echo $text_data_end_des;?></p></td></tr>';
	  
	   html += '<tr><td><?php echo $text_data_start; ?></td><td class="left"><input type="text" name="boss_revolutionslider_module[' + module_row + '][slide]['+ slide_row+'][caption]['+ caption_row +'][datastart]" value="100"/><p><?php echo $text_data_start_des;?></p></td></tr>';
	  
	  html += '<tr><td><?php echo $text_data_after_speed; ?></td><td class="left"><input type="text" name="boss_revolutionslider_module[' + module_row + '][slide]['+ slide_row+'][caption]['+ caption_row +'][dataafterspeed]" value="100"/><p><?php echo $text_data_after_speed_des;?></p></td></tr> ';
	  
	  html += '<tr><td><?php echo $text_incom_animation; ?></td><td class="left"><select name="boss_revolutionslider_module[' + module_row + '][slide]['+ slide_row+'][caption]['+ caption_row +'][incom_animation]">';
	  <?php foreach($incom_animation as $key=>$value) {?>
		html += '<option value="<?php echo $key;?>"><?php echo $value;?></option>';
	  <?php } ?>
	  html +='</select><p><?php echo $text_incom_animation_des;?></p></td></tr> ';
	 
	  html += '<tr><td><?php echo $text_outgo_animation; ?></td><td class="left"><select name="boss_revolutionslider_module[' + module_row + '][slide]['+ slide_row+'][caption]['+ caption_row +'][outgo_animation]">';
	  <?php foreach($outgo_animation as $key=>$value) {?>
		html += '<option value="<?php echo $key;?>"><?php echo $value;?></option>';
	  <?php } ?>
	  html +='</select><p><?php echo $text_outgo_animation_des;?></p></td></tr> ';
	  
	  html += '<tr><td><?php echo $text_easing; ?></td><td class="left"><select name="boss_revolutionslider_module[' + module_row + '][slide]['+ slide_row+'][caption]['+ caption_row +'][easing]">';
	  <?php foreach($easing as $e) {?>
		html += '<option value="<?php echo $e;?>"><?php echo $e;?></option>';
	  <?php } ?>
	  html +='</select><p><?php echo $text_easing_des;?></p></td></tr> ';
	  
	  html += '<tr><td><?php echo $text_endeasing; ?></td><td class="left"><select name="boss_revolutionslider_module[' + module_row + '][slide]['+ slide_row+'][caption]['+ caption_row +'][endeasing]">';
	  <?php foreach($easing as $e) {?>
		html += '<option value="<?php echo $e;?>"><?php echo $e;?></option>';
	  <?php } ?>
	  html +='</select><p><?php echo $text_endeasing_des;?></p></td></tr> ';
	  
	  html += '<tr><td><?php echo $text_under_width; ?></td><td class="left"><input type="checkbox" name="boss_revolutionslider_module[' + module_row + '][slide]['+ slide_row+'][caption]['+ caption_row +'][hideunderwidth]" /><p><?php echo $text_under_width_des;?></p></td></tr> ';
	  html += '</table>';
	  html += '</ul>';
	  html += '</li>';
	  html += '<a style="float: right; margin-top: 5px;color:#FFF;" onclick="$(\'ul.content_caption\').removeClass(\'active\');$(\'ul.content_caption:not(.active)\').hide();addCaption(this,' + module_row + ', ' + slide_row + ',' + (caption_row + 1) + ');" class="button"><?php echo $button_add_caption; ?></a>';
	  $(btAddCaption).before(html);
	  $(btAddCaption).remove();
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
	<?php $module_row = 1;?>
	<?php foreach($modules as $module) {?>
		$('#tabcontent<?php echo $module_row;?> a').tabs();
		$('#revlslide_setting<?php echo $module_row;?>').dcAccordion({
			menuClose: false,
			autoClose: true,
			saveState: false,
			disableLink: false,	
			classExpand : 'bt-expand',
			autoExpand: true,
			});
		<?php if (isset($module['slide'])) {?> 
			<?php $slide_row = 1;?>
			<?php foreach($module['slide'] as $slide) {?>
				$('#tabAddSlide<?php echo $module_row;?><?php echo $slide_row;?> a').tabs();
				<?php $slide_row++;?>
			<?php } ?>
		<?php } ?>
		<?php $module_row++;?>
	<?php } ?>
    //--></script> 
<?php echo $footer; ?>