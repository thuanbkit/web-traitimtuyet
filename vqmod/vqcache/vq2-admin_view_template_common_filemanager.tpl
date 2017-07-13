<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<script type="text/javascript" src="view/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />
<script type="text/javascript" src="view/javascript/jquery/ui/external/jquery.bgiframe-2.1.2.js"></script>
<script type="text/javascript" src="view/javascript/jquery/jstree/jquery.tree.min.js"></script>
<script type="text/javascript" src="view/javascript/jquery/ajaxupload.js"></script>
<script type="text/javascript" src="view/javascript/jquery/jstree/lib/jquery.cookie.js"></script>
<script type="text/javascript" src="view/javascript/jquery/jstree/plugins/jquery.tree.cookie.js"></script>
<style type="text/css">@import url(view/javascript/plupload/js/jquery.ui.plupload/css/jquery.ui.plupload.css);</style>
<script type="text/javascript" src="view/javascript/plupload/js/plupload.full.js"></script>
<script type="text/javascript" src="view/javascript/plupload/js/jquery.ui.plupload/jquery.ui.plupload.js"></script>
<style type="text/css">
body {
	padding: 0;
	margin: 0;
	background: #F7F7F7;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
img {
	border: 0;
}
#container {
	padding: 0px 10px 7px 10px;
	height: 350px;
}
#menu {
	clear: both;
	height: 29px;
	margin-bottom: 3px;
}
#column-left {
	background: #FFF;
	border: 1px solid #CCC;
	float: left;
	width: 20%;
	height: 445px;
	overflow: auto;
}
#column-right {
	background: #FFF;
	border: 1px solid #CCC;
	float: right;
	width: 78%;
	height: 445px;
	overflow: auto;
	text-align: center;
}
#column-right div {
	text-align: left;
	padding: 5px;
}
#column-right a {
	display: inline-block;
	text-align: center;
	border: 1px solid #EEEEEE;
	cursor: pointer;
	margin: 5px;
	padding: 5px;
}
#column-right a.selected {
	border: 1px solid #7DA2CE;
	background: #EBF4FD;
}
#column-right input {
	display: none;
}
#dialog {
	display: none;
}
.button {
	display: block;
	float: left;
	padding: 8px 5px 8px 25px;
	margin-right: 5px;
	background-position: 5px 6px;
	background-repeat: no-repeat;
	cursor: pointer;
}
.button:hover {
	background-color: #EEEEEE;
}
.thumb {
	padding: 5px;
	width: 105px;
	height: 105px;
	background: #F7F7F7;
	border: 1px solid #CCCCCC;
	cursor: pointer;
	cursor: move;
	position: relative;
}

#updateImage a { 
width: 130px; 
height: 16px; 
background: url(view/javascript/jquery/ui/themes/ui-lightness/images/ui-bg_gloss-wave_35_f6a828_500x100.png) repeat; 
color: #fbfbfb; 
text-align: center; 
padding: 5px; 
line-height: 16px; 
font-size: 115%; 
font-weight: bold; 
margin: auto; 
border-radius: 5px;  
border: 1px solid #ddd; 
background-position: 0px -50px;}

#updateImage a:hover { background-position: 0px 0px; }

button.btn {float: left; font-size: 10px; margin-top: 6px;}

.fileName { display: block;}

.fileSize { clear: both; display: block; }

.btnExtra { width: 58px; font-size: 9px; margin: 3px; }

#search { width:145px; padding: 5px;  margin: 3px auto; border: 2px solid #ddd; border-radius: 8px; font-size: 12px;}

#searchBox { position: fixed; right: 10px; bottom:-3px; background: #ddd; padding: 2px;  border-radius: 3px; box-shadow: -1px -1px 2px #ccc;}

#lblSearch { font-size: 9px; display: inline; }

#visualFeedback { width: 240px;  position: fixed; right: 30px; top: 35px; border: 2px solid #fbfbfb; z-index: 99; background: #000; border-radius: 8px; box-shadow: 0px 0px 10px #ccc; overflow: hidden; display: none; }
#visualFeedback span{ font-size: 12px; color: #fbfbfb;  font-weight: bold; padding: 13px; display: block; }

</style>
</head>
<body>
<div id="container">
  <div id="menu"><a id="create" class="button" style="background-image: url('view/image/filemanager/folder.png');"><?php echo $button_folder; ?></a><a id="delete" class="button" style="background-image: url('view/image/filemanager/edit-delete.png');"><?php echo $button_delete; ?></a><a id="move" class="button" style="background-image: url('view/image/filemanager/edit-cut.png');"><?php echo $button_move; ?></a><a id="copy" class="button" style="background-image: url('view/image/filemanager/edit-copy.png');"><?php echo $button_copy; ?></a><a id="rename" class="button" style="background-image: url('view/image/filemanager/edit-rename.png');"><?php echo $button_rename; ?></a><a id="upload" class="button" style="background-image: url('view/image/filemanager/upload.png');"><?php echo $button_upload; ?></a><a id="uploadmulti" class="button" style="background-image: url('view/image/filemanager/upload.png');"><?php echo $button_upload; ?>+</a><a id="refresh" class="button" style="background-image: url('view/image/filemanager/refresh.png');"><?php echo $button_refresh; ?></a>
  <div id="updateImage" file="" style="float: right;"><a class="button">Insert</a></div></div>
  <div id="column-left"></div>
  <div id="column-right"></div>
  <div id="toolset">
  <button id="btnExpand" class="btn">Expand Tree</button>
  <button id="btnCollapse"  class="btn">Collapse Tree</button>
  <button id="btnListView" class="btn">ListView</button>
  <button id="btnThumbView" class="btn">ThumbView</button>
  <button id="btnTextView" class="btn">TextView</button>

  </div>
	<div id="searchBox">
	<label for="search" id="lblSearch">Search:</label>
	<input type="text" size="20" maxlength="20" id="search" name="search"/></div>
</div>
<script type="text/javascript"><!--
/*
***********************************************
*          ImageManager+ for Opencart         *
***********************************************
*/
$(document).ready(function() { 

	$('#toolset button:first').button({
            icons: {
                primary: "ui-icon-plus"
            }}).next().button({
            icons: {
                primary: "ui-icon-minus"
            }}).next().button({
            icons: {
                primary: "ui-icon-grip-dotted-horizontal"
            }}).next().button({
            icons: {
                primary: "ui-icon-image"
            }}).next().button({
            icons: {
                primary: "ui-icon-pencil"
            }})
			
	$('input#search').focus();

	function truncate(name, len) {
    var ext = name.substring(name.lastIndexOf(".") + 1, name.length).toLowerCase();
    var filename = name.replace('.' + ext,'');
    if(filename.length <= len) {
        return name;
    }
    filename = filename.substr(0, len) + (name.length > len ? '<span style="color: red;">&laquo;</span>' : '');
    return filename + '.' + ext;
	};
	
	function feedback(message, color) {
	
	$('#visualFeedback').stop().remove();
	html = '<div id="visualFeedback" class="draggable"></div>';
	$('#container').prepend(html);
	$( ".draggable" ).draggable({cursor : "move", revert : true});
	var box = $('#visualFeedback');
	box.css('background-color', ''+color+'').html('<span>'+message+'</span>').fadeIn(400).delay(2000).fadeOut(1500);
	box.hover(function() {
		$(this).stop(true, true).fadeIn();
		}, function() {
		$(this).fadeOut(1000);
		});
	};
	
	$('#column-left').tree({
		plugins : {
			cookie : {}
				},	
		data: { 
			type: 'json',
			async: true, 
			opts: { 
				method: 'post', 
				url: 'index.php?route=common/filemanager/directory&token=<?php echo $token; ?>'
			} 
		},
		selected: 'top',
		ui: {		
			theme_name: 'classic',
			animation: 700
		},	
		types: { 
			'default': {
				clickable: true,
				creatable: false,
				renameable: false,
				deletable: false,
				draggable: false,
				max_children: -1,
				max_depth: -1,
				valid_children: 'all'
			}
		},
		callback: {
			beforedata: function(NODE, TREE_OBJ) { 
				if (NODE == false) {
					TREE_OBJ.settings.data.opts.static = [ 
						{
							data: 'image',
							attributes: { 
								'id': 'top',
								'directory': ''
							}, 
							state: 'closed'
						}
					];
					
					return { 'directory': '' } 
					$('#column-left a.clicked').prepend('(' + json.length + ')');
				} else {
					TREE_OBJ.settings.data.opts.static = false;  
					
					return { 'directory': $(NODE).attr('directory') } 
				}
			},		
			onselect: function (NODE, TREE_OBJ) {
				var dr;
				var tree = $.tree.reference('#column-left a');
				window.dr = $(tree.selected).attr('directory');
				feedback('<img src="view/image/loading.gif" class="loading" style="" /><span style="padding-left: 10px; display: inline;">Loading ...</span>', 'red');
				
				$.ajax({
					url: 'index.php?route=common/filemanager/files&token=<?php echo $token; ?>',
					type: 'post',
					data: 'directory=' + encodeURIComponent($(NODE).attr('directory')),
					dataType: 'json',
					success: function(json) {
						html = '<div>';
						
						if (json.length == 0) {
						
							feedback('No files found!', 'red');
							} else {
							feedback(json.length + " files found.", 'green');
							for (i = 0; i < json.length; i++) {
								name = '';
								
								filename = json[i]['filename'];
																
								name += truncate(filename, 20);
								size = json[i]['size']; 
								html += '<a  file="' + json[i]['file'] + '" style="display: none; float: left;" title="' + filename +'"><span class="fileName">' + name + '</span><span class="fileSize">' + size + '</span><input type="hidden" name="image" value="' + json[i]['file'] + '" /></a>';
							}
						}
						
						html += '</div>';
						
						$('#column-right').html(html);

					$('#column-right a').each(function(index, element) {
							$.ajax({
								url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent('data/' + $(element).find('input[name=\'image\']').attr('value')),
								dataType: 'html',
								success: function(html) {
									$(element).prepend('<img src="' + html + '" title="" style="" /><br />');
									
									$(element).fadeIn();
								}
							});
						}); 
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				}); 
			},
				onopen: function(NODE, TREE_OBJ) {
				var tr = $('#column-left li#top li[directory]');
				tr.each(function(index, domEle) {
				dd = $(domEle).attr('directory');
				dd = dd.replace(/\//g, ""); 
				dd = dd.replace(" ", ""); 
				$(domEle).attr('id', dd);
				});
				var myTree = $.tree.reference('#column-left');
				var cc = $.cookie('selected');
				var bb = '#' + cc;
				myTree.select_branch(bb);
				
				} //end onopen
		}
	});	
	
	$('input#search').click(function() {
	var x = $('#column-right span.fileName');
	x.each(function() {
		$(this).parent().css('display', '');
		$(this).parent().css('display', '');
		$(this).parent().next().css('display', '');
	});
	search.value = "";
	});
	
$('input#search').keyup(function(event) {
		$('input#search').focus();
		var search_text = $('input#search').val();
		var rg = new RegExp(search_text,'i');
		$('#column-right span.fileName').each(function(){
 			if($.trim($(this).html()).search(rg) == -1) {
				$(this).parent().css('display', 'none');
				$(this).parent().next().css('display', 'none');
				$(this).parent().next().next().css('display', 'none');
			}	
			else {
				$(this).parent().css('display', '');
				$(this).parent().next().css('display', '');
				$(this).parent().next().next().css('display', '');
			}
		});
	});

	$('#btnExpand').click( function() {
		var myTree= $.tree.focused();
        myTree.open_all('#top');
		myTree.refresh(myTree.selected);
	});
	
	$('#btnCollapse').click( function() {
		var myTree= $.tree.focused();
        myTree.close_all('#top');
		myTree.refresh(myTree.selected);
	});

	$('#btnTextView').click( function() {
		$('#column-right a img').hide();
		
	$('#column-right a').each(function(index, e2) {
			$('span.fileSize').hide();
			$(e2).css({
			'width' : '30%',
			'height' : '20px',
			'padding' : '0',
			'float' : 'left',
			'text-align' : 'left'
			});
			$('span.fileName').css({
			'margin-top' : '-10px',
			'margin-left' : '15px',
			});
		});
	});	
	
	$('#btnListView').click( function() {
		$('#column-right a img').show();
		$('#column-right a img').each(function(index, e1) {
			$(e1).css({
			'width' : '35px',
			'height' : '35px',
			'float' : 'left',
			'padding' : '3px',
			'text-align' : 'center'
			});
		});
		
	$('#column-right a').each(function(index, e2) {
			$('span.fileSize').hide();
			$(e2).css({
			'width' : '30%',
			'height' : '40px',
			'padding' : '0',
			'float' : 'left',
			'text-align' : 'center'
			});
			$('span.fileName').css({
			'margin-top' : '',
			'margin-left' : '',
			});
		});
	
		
	});
	
	$('#btnThumbView').click( function() {
		$('#column-right a img').show();
		$('#column-right a img').each(function(index, e1) {
			$(e1).css({
			'width' : 'auto',
			'height' : 'auto',
			'float' : 'none',
			'padding' : '0px',
			});
		});
		
	$('#column-right a').each(function(index, e2) {
			$('span.fileSize').show();
			$(e2).css({
			'width' : 'auto',
			'height' : 'auto',
			'padding' : '5px',
			'margin' : '5px',
			'float' : 'left',
			'text-align' : 'center'
			});
			$('span.fileName').css({
			'margin-top' : '',
			'margin-left' : '',
			});
		});
	});

	$('#column-right a').live('click', function() {
		if ($(this).attr('class') == 'selected') {
			$(this).removeAttr('class');
		} else {
			$('#column-right a').removeAttr('class');
			
			$(this).attr('class', 'selected');
      $('#updateImage').attr('file', $(this).attr('file'));
		}
	});
	
	$('#column-right a').live('dblclick', function() {
		<?php if ($fckeditor) { ?>
		window.opener.CKEDITOR.tools.callFunction(<?php echo $fckeditor; ?>, '<?php echo $directory; ?>' + $(this).find('input[name=\'image\']').attr('value'));
		
		self.close();	
		<?php } else { ?>
		parent.$('#<?php echo $field; ?>').attr('value', 'data/' + $(this).find('input[name=\'image\']').attr('value'));
		parent.$('#dialog').dialog('close');
		
		parent.$('#dialog').remove();	
		<?php } ?>
	});		
						
	$('#create').bind('click', function() {
		var tree = $.tree.focused();
		
		if (tree.selected) {
			$('#dialog').remove();
			
			html  = '<div id="dialog">';
			html += '<?php echo $entry_folder; ?> <input type="text" name="name" value="" /> <input type="button" value="<?php echo $button_submit; ?>" />';
			html += '</div>';
			
			$('#column-right').prepend(html);
			
			$('#dialog').dialog({
				title: '<?php echo $button_folder; ?>',
				resizable: false
			});	
			
			$('#dialog input[type=\'button\']').bind('click', function() {
				$.ajax({
					url: 'index.php?route=common/filemanager/create&token=<?php echo $token; ?>',
					type: 'post',
					data: 'directory=' + encodeURIComponent($(tree.selected).attr('directory')) + '&name=' + encodeURIComponent($('#dialog input[name=\'name\']').val()),
					dataType: 'json',
					success: function(json) {
						if (json.success) {
							$('#dialog').remove();
							
							tree.refresh(tree.selected);
							
							feedback(json.success, 'green');
						} else {
							feedback(json.error, 'red');
						}
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
			});
		} else {
			alert('<?php echo $error_directory; ?>');	
		}
	});

		$('#delete').bind('click', function () {
		var path = $('#column-right a.selected').attr('file');
		var fldr = $('#column-left a.clicked').html();
		fldr = fldr.replace("<ins>&nbsp;</ins>", "");

		if(path==undefined){
         $('#dialog').remove();
		
		html  = '<div id="dialog">';
		html += '<p><strong  style="color: red;">WARNING:</strong> You are trying to delete the folder' + '<span style="font-weight: bold;"> "' + fldr + '"' +'</span><br />';
		html += 'All folders and files under it will be deleted. <strong  style="color: red;">Confirm?</strong></p>';
		html += '</div>';

		$('#column-right').prepend(html);
		
		$( "#dialog" ).dialog({
			resizable: false,
			height:165,
			width: 380,
			modal: true,
			title: 'Folder Delete',
			buttons: {
				"Yes, Delete folder": function() {
			var tree = $.tree.focused();
			
			if (tree.selected) {
				$.ajax({
					url: 'index.php?route=common/filemanager/delete&token=<?php echo $token; ?>',
					type: 'post',
					data: 'path=' + encodeURIComponent($(tree.selected).attr('directory')),
					dataType: 'json',
					success: function(json) {
						if (json.success) {
							var tt = tree.prev(tree.selected);
							tree.refresh(tree.parent(tree.selected));

							tree.select_branch(tt);

							feedback(json.success, 'green');
						} 
						
						if (json.error) {
							feedback(json.error, 'red');
						}
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});			
			} 
			
			$( this ).dialog( "close" );
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		}
		else if (path) {
		var file = path.substring(path.lastIndexOf('/') + 1).toLowerCase();
		
		$('#dialog').remove();
		
		html  = '<div id="dialog">';
		html += '<p>You are about to delete the file: ' + '<span style="font-weight: bold;"> "' + file + '"' +'</span><strong  style="color: red;"> Confirm?</strong></p>';
		html += '</div>';

		$('#column-right').prepend(html);
		
		$( "#dialog" ).dialog({
			resizable: false,
			height: 150,
			width: 420,
			modal: true,
			title: 'File Delete',
			buttons: {
				"Yes, Delete file": function() {
					var tree = $.tree.focused();
			
			$.ajax({
				url: 'index.php?route=common/filemanager/delete&token=<?php echo $token; ?>',
				type: 'POST',
				data: 'path=' + path,
				dataType: 'json',
				success: function(json) {
					if (json.success) {
						var tree = $.tree.focused();
					
						tree.select_branch(tree.selected);

						feedback(json.success, 'green');
					}
					
					if (json.error) {
						feedback(json.error, 'red');
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});	
			
			$( this ).dialog( "close" );
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
	} 
	});
	
	$('#move').bind('click', function() {
		$('#dialog').remove();
		
		html  = '<div id="dialog">';
		html += '<?php echo $entry_move; ?> <select name="to"></select> <input type="button" value="<?php echo $button_submit; ?>" />';
		html += '</div>';

		$('#column-right').prepend(html);
		
		$('#dialog').dialog({
			title: '<?php echo $button_move; ?>',
			resizable: false
		});

		$('#dialog select[name=\'to\']').load('index.php?route=common/filemanager/folders&token=<?php echo $token; ?>');
		
		$('#dialog input[type=\'button\']').bind('click', function() {
			path = $('#column-right a.selected').find('input[name=\'image\']').attr('value');
							 
			if (path) {																
				$.ajax({
					url: 'index.php?route=common/filemanager/move&token=<?php echo $token; ?>',
					type: 'post',
					data: 'from=' + encodeURIComponent(path) + '&to=' + encodeURIComponent($('#dialog select[name=\'to\']').val()),
					dataType: 'json',
					success: function(json) {
						if (json.success) {
							$('#dialog').remove();
							
							var tree = $.tree.focused();
							
							tree.select_branch(tree.selected);
							
							feedback(json.success, 'green');
						}
						
						if (json.error) {
							feedback(json.error, 'red');
						}
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
			} else {
				var tree = $.tree.focused();
				
				$.ajax({
					url: 'index.php?route=common/filemanager/move&token=<?php echo $token; ?>',
					type: 'post',
					data: 'from=' + encodeURIComponent($(tree.selected).attr('directory')) + '&to=' + encodeURIComponent($('#dialog select[name=\'to\']').val()),
					dataType: 'json',
					success: function(json) {
						if (json.success) {
							$('#dialog').remove();
							
							tree.select_branch('#top');
								
							tree.refresh(tree.selected);
							
							feedback(json.success, 'green');
						}						
						
						if (json.error) {
							feedback(json.error, 'red');
						}
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});				
			}
		});
	});

		$('#updateImage').bind('click', function () { 
		
		if ($(this).attr('file') == "") {
		
		$('#dialog').remove();
		
		html  = '<div id="dialog">';
		html += '<p><strong  style="color: red;">WARNING:</strong> No image was selected. ';
		html += 'Please select an image. </p>';
		html += '</div>';

		$('#column-right').prepend(html);
		
		$( "#dialog" ).dialog({
			resizable: false,
			height: 130,
			width: 380,
			modal: true,
			title: 'No image selected',
			buttons: {
				"Ok": function() {
					$('#dialog').remove();
					}
					}
					})
					}
					 else {
	
		<?php if ($fckeditor) { ?>
		window.opener.CKEDITOR.tools.callFunction(<?php echo $fckeditor; ?>, '<?php echo $directory; ?>' + $(this).attr('file'));
		
		self.close();	
		<?php } else { ?>
		//parent.$('#<?php echo $field; ?>').attr('value', 'data/' + $(this).find('input[name=\'image\']').attr('value'));
		parent.$('#<?php echo $field; ?>').attr('value', 'data/' + $(this).attr('file'));
		parent.$('#dialog').dialog('close');
		
		parent.$('#dialog').remove();	
		<?php } ?>
	};
	
	});
	$('#copy').bind('click', function() {
		$('#dialog').remove();
		
		html  = '<div id="dialog">';
		html += '<?php echo $entry_copy; ?> <input type="text" name="name" value="" /> <input type="button" value="<?php echo $button_submit; ?>" />';
		html += '</div>';

		$('#column-right').prepend(html);
		
		$('#dialog').dialog({
			title: '<?php echo $button_copy; ?>',
			resizable: false
		});
		
		$('#dialog select[name=\'to\']').load('index.php?route=common/filemanager/folders&token=<?php echo $token; ?>');
		
		$('#dialog input[type=\'button\']').bind('click', function() {
			path = $('#column-right a.selected').find('input[name=\'image\']').attr('value');
							 
			if (path) {																
				$.ajax({
					url: 'index.php?route=common/filemanager/copy&token=<?php echo $token; ?>',
					type: 'post',
					data: 'path=' + encodeURIComponent(path) + '&name=' + encodeURIComponent($('#dialog input[name=\'name\']').val()),
					dataType: 'json',
					success: function(json) {
						if (json.success) {
							$('#dialog').remove();
							
							var tree = $.tree.focused();
							
							tree.select_branch(tree.selected);
							
							feedback(json.success, 'green');
						}						
						
						if (json.error) {
							feedback(json.error, 'red');
						}
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
			} else {
				var tree = $.tree.focused();
				
				$.ajax({
					url: 'index.php?route=common/filemanager/copy&token=<?php echo $token; ?>',
					type: 'post',
					data: 'path=' + encodeURIComponent($(tree.selected).attr('directory')) + '&name=' + encodeURIComponent($('#dialog input[name=\'name\']').val()),
					dataType: 'json',
					success: function(json) {
						if (json.success) {
							$('#dialog').remove();
							
							tree.select_branch(tree.parent(tree.selected));
							
							tree.refresh(tree.selected);
							
							feedback(json.success, 'green');
						} 						
						
						if (json.error) {
							feedback(json.error, 'red');
						}
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});				
			}
		});	
	});
	
	$('#rename').bind('click', function() {
		$('#dialog').remove();
		
		html  = '<div id="dialog">';
		html += '<?php echo $entry_rename; ?> <input type="text" name="name" value="" /> <input type="button" value="<?php echo $button_submit; ?>" />';
		html += '</div>';

		$('#column-right').prepend(html);
		
		$('#dialog').dialog({
			title: '<?php echo $button_rename; ?>',
			resizable: false
		});
		
		$('#dialog input[type=\'button\']').bind('click', function() {
			path = $('#column-right a.selected').find('input[name=\'image\']').attr('value');
							 
			if (path) {		
				$.ajax({
					url: 'index.php?route=common/filemanager/rename&token=<?php echo $token; ?>',
					type: 'post',
					data: 'path=' + encodeURIComponent(path) + '&name=' + encodeURIComponent($('#dialog input[name=\'name\']').val()),
					dataType: 'json',
					success: function(json) {
						if (json.success) {
							$('#dialog').remove();
							
							var tree = $.tree.focused();
					
							tree.select_branch(tree.selected);
							
							feedback(json.success, 'green');
						} 
						
						if (json.error) {
							feedback(json.error, 'red');
						}
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});			
			} else {
				var tree = $.tree.focused();
				
				$.ajax({ 
					url: 'index.php?route=common/filemanager/rename&token=<?php echo $token; ?>',
					type: 'post',
					data: 'path=' + encodeURIComponent($(tree.selected).attr('directory')) + '&name=' + encodeURIComponent($('#dialog input[name=\'name\']').val()),
					dataType: 'json',
					success: function(json) {
						if (json.success) {
							$('#dialog').remove();
								
							tree.select_branch(tree.parent(tree.selected));
							
							tree.refresh(tree.selected);
							
							feedback(json.success, 'green');
						} 
						
						if (json.error) {
							feedback(json.error, 'red');
						}
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
			}
		});		
	});
	
	new AjaxUpload('#upload', {
		action: 'index.php?route=common/filemanager/upload&token=<?php echo $token; ?>',
		name: 'image',
		autoSubmit: false,
		responseType: 'json',
		onChange: function(file, extension) {
			var tree = $.tree.focused();
			
			if (tree.selected) {
				this.setData({'directory': $(tree.selected).attr('directory')});
			} else {
				this.setData({'directory': ''});
			}
			
			this.submit();
		},
		onSubmit: function(file, extension) {
			$('#upload').append('<img src="view/image/loading.gif" class="loading" style="padding-left: 5px;" />');
		},
		onComplete: function(file, json) {
			if (json.success) {
				var tree = $.tree.focused();
					
				tree.select_branch(tree.selected);
				
				feedback(json.success, 'green');
			}
			
			if (json.error) {
				feedback(json.error, 'red');
			}
			
			$('.loading').remove();	
		}
	});
	
	$('#refresh').bind('click', function() {
		var tree = $.tree.focused();
		
		tree.refresh(tree.selected);
	});
	
			// ++++++++++++ Begin Upload+ main code	++++++++++++++

				var dr;
				var tree = $.tree.reference('#column-left a');
				$('#column-left a').live('click', function() {
				window.dr = $(tree.selected).attr('directory');
				})
				
	$('#uploadmulti').click(function() { 
		
			html  = '<div id="uploadMulti" title="Upload+ : Multiple File Upload">';
			html += '<div id="uploader"></div>';
			html += '</div>';
			
			$('#column-left').prepend(html);
		
		$('#uploadMulti').dialog({ 
		height: '355', 
		width: '760', 
		modal: true,
		resizable: false,
		create: function(event, ui) {
		
		var tree = $.tree.focused();
		
		$("#uploader").plupload({
		
		runtimes : 'flash,html5',
		url : 'index.php?route=common/filemanager/multi&token=<?php echo $token; ?>&directory=' + window.dr,
		max_file_size : '5mb', // allowed by OC '300kb', 
		chunk_size : '1mb',
		unique_names : false,

		resize : {width : 800, height : 600, quality : 90},
		
		filters : [
			{title : "Allowed files", extensions : "jpg,gif,png,pdf,zip,swf"} //,
		],

		flash_swf_url : 'view/javascript/plupload/js/plupload.flash.swf',
		silverlight_xap_url : 'view/javascript/plupload/js/plupload.silverlight.xap'
	});

	$('form').submit(function(e) {
        var uploader = $('#uploader').plupload('getUploader');
		var tree = $.tree.reference('#column-left');
		
        if (uploader.files.length > 0) {
            
            uploader.bind('StateChanged', function() {
                if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) {
                    $('form')[0].submit();
                }
            });
			                
            uploader.start();

        } else
            alert('You must at least upload one file.');

        return false;

		});
			},
			
			close: function(event, ui) {
				var tree = $.tree.reference('#column-left');
				//tree.refresh(tree.selected); // doesnt work at times 
				tree.refresh(); // works all the time but takes time to refresh the whole tree
				var uploader = $('#uploader').plupload('getUploader');
				
				$('#uploadMulti').remove();
				
			}
			
			})
				
		})

		// end Upload+ main code
});
//--></script>
</body>
</html>












































































































































































































































































































































































































































































































































































































































































