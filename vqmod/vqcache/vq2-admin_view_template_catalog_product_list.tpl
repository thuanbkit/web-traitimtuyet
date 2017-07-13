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

			<!-- Admin Enhanced -->
<?php if ($eprod7 == 1) { ?>
    <div class="heading2">
      <h1><img src="view/image/product.png" alt="" /> <?php echo $heading_title; ?></h1>
	  <div class="buttons2">
	  <?php if ($emisc3 == 1) { ?><a onclick="clearFilters();" class="button" style="background: #C30;"><?php echo $button_clear_filters;?></a><?php } ?>
	  <?php if ($eprod2 == 1) { ?><a onclick="$('form').attr('action', '<?php echo $enable; ?>'); $('form').submit();" class="button" style="background: #060;"><?php echo $button_enable; ?></a> <a onclick="$('form').attr('action', '<?php echo $disable; ?>'); $('form').submit();" class="button" style="background: #900;"><?php echo $button_disable; ?></a><?php } ?><a href="<?php echo $insert; ?>" class="button"><?php echo $button_insert; ?></a><a onclick="$('#form').attr('action', '<?php echo $copy; ?>'); $('#form').submit();" class="button"><?php echo $button_copy; ?></a><a onclick="$('form').submit();" class="button"><?php echo $button_delete; ?></a></div>
	</div>
<?php } ?>
			<!-- Admin Enhanced -->
			
    <div class="heading">
      <h1><img src="view/image/product.png" alt="" /> <?php echo $heading_title; ?></h1>
      
			<!-- Admin Enhanced -->
			<?php if ($eprod2 == 1 || $emisc3 == 1) { ?><div class="buttons"><?php if ($emisc3 == 1) { ?><a onclick="clearFilters();" class="button" style="background: #C30;"><?php echo $button_clear_filters;?></a><?php } ?><?php if ($eprod2 == 1) { ?><a onclick="$('form').attr('action', '<?php echo $enable; ?>'); $('form').submit();" class="button" style="background: #060;"><?php echo $button_enable; ?></a> <a onclick="$('form').attr('action', '<?php echo $disable; ?>'); $('form').submit();" class="button" style="background: #900;"><?php echo $button_disable; ?></a><?php } ?><?php } else { ?><div class="buttons"><?php } ?>
			<!-- Admin Enhanced -->
			<a href="<?php echo $insert; ?>" class="button"><?php echo $button_insert; ?></a><a onclick="$('#form').attr('action', '<?php echo $copy; ?>'); $('#form').submit();" class="button"><?php echo $button_copy; ?></a><a onclick="$('form').submit();" class="button"><?php echo $button_delete; ?></a></div>
    </div>
             
<!-- Admin Enhanced -->
<?php if ($eprod4 == 1) { ?>
<div class="content">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding-bottom:10px; text-align:left;">
		 <?php if ($eprod4 == 1) { ?>
		 <?php echo $text_ecfilter; ?>:
		 <select name="filter_category_id" onchange="filter();" style="width: 18em;">>
         	<option value=""><?php echo $text_eallcats; ?></option>
            <?php foreach($categories as $c) { ?>
            <option value="<?php echo $c['category_id']?>" <?php echo ($c['category_id'] == $filter_category_id ? 'selected' : '') ?>><?php echo $c['name'] ?></option>
             <?php } ?>
          </select>
		  <?php } ?>
	</td>
  </tr>
</table>
<?php } else { ?>
<div class="content">
<?php } ?>
<!-- Admin Enhanced -->
            
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
              <td class="center"><?php echo $column_image; ?></td>
              <td class="left"><?php if ($sort == 'pd.name') { ?>
                <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
                <?php } ?></td>
              <td class="left"><?php if ($sort == 'p.model') { ?>
                <a href="<?php echo $sort_model; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_model; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_model; ?>"><?php echo $column_model; ?></a>
                <?php } ?></td>
              <td class="left"><?php if ($sort == 'p.price') { ?>
                <a href="<?php echo $sort_price; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_price; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_price; ?>"><?php echo $column_price; ?></a>
                <?php } ?></td>
              <td class="right"><?php if ($sort == 'p.quantity') { ?>
                <a href="<?php echo $sort_quantity; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_quantity; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_quantity; ?>"><?php echo $column_quantity; ?></a>
                <?php } ?></td>
              
              <!-- Admin Enhanced -->
              <?php if ($eprod1 == 1) { ?><td class="center"><?php } else { ?><td class="left"><?php } ?>
			  <!-- Admin Enhanced -->
			<?php if ($sort == 'p.status') { ?>
                <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                <?php } ?></td>
              
              <!-- Admin Enhanced -->
              <?php if ($eprod1 == 1) { ?><td class="center"><?php echo $column_action; ?></td><?php } else { ?><td class="right"><?php echo $column_action; ?></td><?php } ?>
			  <!-- Admin Enhanced -->
			
            </tr>
          </thead>
          <tbody>
            <tr class="filter">
              <td></td>
              <td></td>
              <td><input type="text" name="filter_name" value="<?php echo $filter_name; ?>" /></td>
              <td><input type="text" name="filter_model" value="<?php echo $filter_model; ?>" /></td>
              <td align="left"><input type="text" name="filter_price" value="<?php echo $filter_price; ?>" size="8"/></td>
              <td align="right">
              <!-- Admin Enhanced -->
              <?php if ($eprod1 == 1) { ?><input type="text" name="filter_quantity" value="<?php echo $filter_quantity; ?>" style="text-align: right;" size="5" /><?php } else { ?><input type="text" name="filter_quantity" value="<?php echo $filter_quantity; ?>" style="text-align: right;" /><?php } ?>
			  <!-- Admin Enhanced -->
			</td>
              
              <!-- Admin Enhanced -->
              <?php if ($eprod1 == 1) { ?><td class="center"><select name="filter_status"><?php } else { ?><td><select name="filter_status"><?php } ?>
			  <!-- Admin Enhanced -->
			
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
              
              <!-- Admin Enhanced -->
              <?php if ($eprod1 == 1) { ?><td class="center"><a onclick="filter();" class="button"><?php echo $button_filter; ?></a></td><?php } else { ?><td align="right"><a onclick="filter();" class="button"><?php echo $button_filter; ?></a></td><?php } ?>
			  <!-- Admin Enhanced -->
			
            </tr>
            <?php if ($products) { ?>
            <?php foreach ($products as $product) { ?>
            <tr>
              <td style="text-align: center;"><?php if ($product['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $product['product_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $product['product_id']; ?>" />
                <?php } ?></td>
              <td class="center"><img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" style="padding: 1px; border: 1px solid #DDDDDD;" /></td>
              
              <!-- Admin Enhanced -->
              <?php if (($this->user->hasPermission('modify', 'catalog/product') && $eprod1 == 1)) { ?>
			  <td class="left">
              	<span class="edit-me2" id="name-<?php echo $product['product_id']; ?>" value="<?php echo $product['product_id']; ?>">
    			<input type="text" value="<?php echo $product['name']; ?>" />&nbsp;
   				<a onclick="save_name(<?php echo $product['product_id']; ?>)"><?php echo $text_esave ?></a>&nbsp
    			<a onclick="close_name(<?php echo $product['product_id']; ?>)"; return false;><?php echo $text_ecancel ?></a>
				</span>
                <span style="color: #333;" title="Click to edit" class="tooltip"><?php echo $product['name']; ?></span></td>
				<?php } else { ?>
              <td class="left"><?php echo $product['name']; ?></td>				
				<?php } ?>
			  <!-- Admin Enhanced -->
			
              
              <!-- Admin Enhanced -->
              <?php if (($this->user->hasPermission('modify', 'catalog/product') && $eprod1 == 1)) { ?>
			  <td style="text-align:left;">
              	<span class="edit-me2" id="model-<?php echo $product['product_id']; ?>" value="<?php echo $product['product_id']; ?>">
    			<input type="text" value="<?php echo $product['model']; ?>" />&nbsp;
   				<a onclick="save_model(<?php echo $product['product_id']; ?>)"><?php echo $text_esave ?></a>&nbsp;
    			<a onclick="close_model(<?php echo $product['product_id']; ?>)"; return false;><?php echo $text_ecancel ?></a>
				</span>
                <span style="color: #000;" title="Click to edit" class="tooltip"><?php echo $product['model']; ?></span></td>
				<?php } else { ?>
              <td class="left"><?php echo $product['model']; ?></td>				
				<?php } ?>
			  <!-- Admin Enhanced -->
			
              
              <!-- Admin Enhanced -->
		<?php if (($this->user->hasPermission('modify', 'catalog/product') && $eprod1 == 1)) { ?>
		<td style="text-align:left;">
		<table style="width:100%; padding:0; border:none;" cellpadding="0" cellspacing="0" border="0">	
			<?php if ($product['special']) { ?>
			<tr>  			  
			  <td style="border:none; padding-left:0; padding-right:0; background:none;">				
				<span class="edit-me2" id="price-<?php echo $product['product_id']; ?>" value="<?php echo $product['product_id']; ?>">
    			<input type="text" value="<?php echo $product['price']; ?>" size="8" />&nbsp;
   				<a onclick="save_price(<?php echo $product['product_id']; ?>)"><?php echo $text_esave ?></a>&nbsp;
    			<a onclick="close_price(<?php echo $product['product_id']; ?>)"; return false;><?php echo $text_ecancel ?></a>
				</span>
				<span style="padding:5px 0 5px 0;" title="Click to edit" class="tooltip"><?php echo $product['price']; ?></span>
			  </td>
			 </tr>
			 <tr>
			  <td style="border:none; padding-left:0; padding-right:0; background:none;">
				<span class="edit-me2" id="special-<?php echo $product['product_id']; ?>" value="<?php echo $product['product_id']; ?>">
				<input type="text" value="<?php echo $product['special']; ?>" size="8" />&nbsp;
   				<a onclick="save_special(<?php echo $product['product_id']; ?>)"><?php echo $text_esave ?></a>&nbsp;
    			<a onclick="close_special(<?php echo $product['product_id']; ?>)"; return false;><?php echo $text_ecancel ?></a>
				</span>                
                <span style="color: #b00; padding:5px 0 5px 0;" title="Click to edit" class="tooltip"><?php echo $product['special']; ?></span>
               </td>
			 </tr> 
			  <?php } else { ?>
			 <tr>  			  
			  <td style="border:none; padding-left:0; padding-right:0;">
			 	<span class="edit-me2" id="price-<?php echo $product['product_id']; ?>" value="<?php echo $product['product_id']; ?>">
    			<input type="text" value="<?php echo $product['price']; ?>" size="8" />&nbsp;
   				<a onclick="save_price(<?php echo $product['product_id']; ?>)"><?php echo $text_esave ?></a>&nbsp;
    			<a onclick="close_price(<?php echo $product['product_id']; ?>)"; return false;><?php echo $text_ecancel ?></a>
				</span>
                <span style="color: #000;" title="Click to edit" class="tooltip"><?php echo $product['price']; ?></span>
                <?php } ?>
			  </td>
			</tr>
		</table>
		</td>				
<?php } else { ?>
              <td class="left">
			  	<?php if ($product['special']) { ?>
                <span style="text-decoration: line-through;"><?php echo $product['price']; ?></span>
                <span style="color: #b00;"><?php echo $product['special']; ?></span>
                <?php } else { ?>
                <?php echo $product['price']; ?>
                <?php } ?>
			  </td>				
<?php } ?>
			  <!-- Admin Enhanced -->
			





              
              <!-- Admin Enhanced -->
              <?php if (($this->user->hasPermission('modify', 'catalog/product') && $eprod1 == 1)) { ?>
			  <td style="text-align:right;">
    			<span class="edit-me" id="quantity-<?php echo $product['product_id']; ?>" value="<?php echo $product['product_id']; ?>">
    			<a onclick="save_quantity(<?php echo $product['product_id']; ?>)"><?php echo $text_esave ?></a>&nbsp;
    			<a onclick="close_quantity(<?php echo $product['product_id']; ?>)"; return false;><?php echo $text_ecancel ?></a>&nbsp;
				<input type="text" value="<?php echo $product['quantity']; ?>" size="5" />
				</span>
				<?php if ($product['quantity'] <= 0) { ?>
                <span style="color: #FF0000;" title="Click to edit" class="tooltip"><?php echo $product['quantity']; ?></span>
                <?php } elseif ($product['quantity'] <= 5) { ?>
                <span style="color: #FFA500;" title="Click to edit" class="tooltip"><?php echo $product['quantity']; ?></span>
                <?php } else { ?>
                <span style="color: #008000;" title="Click to edit" class="tooltip"><?php echo $product['quantity']; ?></span>
                <?php } ?>
              </td>
			  <?php } else { ?>
			  <td class="right"><?php if ($product['quantity'] <= 0) { ?>
                <span style="color: #FF0000;"><?php echo $product['quantity']; ?></span>
                <?php } elseif ($product['quantity'] <= 5) { ?>
                <span style="color: #FFA500;"><?php echo $product['quantity']; ?></span>
                <?php } else { ?>
                <span style="color: #008000;"><?php echo $product['quantity']; ?></span>
                <?php } ?></td>
			  <?php } ?>
			  <!-- Admin Enhanced -->
			






              
              <!-- Admin Enhanced -->
			  <?php if (($this->user->hasPermission('modify', 'catalog/product') && $eprod1 == 1)) { ?>
			  <td class="center"><a class="ajaxstatus tooltip"  title="Change Status" id="status-<?php echo $product['product_id']; ?>" style="padding:10px;"><?php echo $product['status2']; ?></a></td>
			  <?php } else { ?>
              <td class="left"><?php echo $product['status']; ?></td>
              <?php } ?>
			  <!-- Admin Enhanced -->
			
              
              <!-- Admin Enhanced -->
              <?php if ($eprod1 == 1) { ?><td class="center"><?php } else { ?><td class="right"><?php } ?>
			  <!-- Admin Enhanced -->
			<?php foreach ($product['action'] as $action) { ?>
                <?php if ($this->user->hasPermission('modify', 'catalog/product')) { ?><a href="<?php echo $action['href']; ?>" title="<?php echo $product['name']; ?>" class="prodeditbox"><span class="tooltip" title="Edit Product"><?php echo $action['text']; ?></span></a>&nbsp;&nbsp;<?php } ?><?php } ?>
      <?php
      $this->load->model('catalog/product');
      $product_store = $this->model_catalog_product->getProductStores($product['product_id']);
      ?>
      <?php if (in_array(0, $product_store)) { ?>
       <a title="View in store" class="tooltip" onClick="window.open('<?php echo $store . 'index.php?route=product/product&product_id=' . $product['product_id']; ?>');"><?php echo $text_eview; ?></a><br />
       <?php } ?>
          <?php foreach ($stores as $storel) { ?>
            <?php if (in_array($storel['id'], $product_store)) { ?>
             <a title="View in store" class="tooltip" onClick="window.open('<?php echo $storel['href'] . 'index.php?route=product/product&product_id=' . $product['product_id']; ?>');"><?php echo $text_eview; ?></a><br />
           <?php } ?>
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
function clearFilters() {
	url = 'index.php?route=catalog/product&token=<?php echo $token; ?>';
	
	var filter_category_id = '';	
	if (filter_category_id) {
		url += '&filter_category_id=' + encodeURIComponent(filter_category_id);
	}
	
	var filter_manufacturer = '';	
	if (filter_manufacturer) {
		url += '&filter_manufacturer=' + encodeURIComponent(filter_manufacturer);
	}
	
	var filter_name = '';	
	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}
	
	var filter_model = '';	
	if (filter_model) {
		url += '&filter_model=' + encodeURIComponent(filter_model);
	}
	
	var filter_price = '';	
	if (filter_price) {
		url += '&filter_price=' + encodeURIComponent(filter_price);
	}
	
	var filter_quantity = '';	
	if (filter_quantity) {
		url += '&filter_quantity=' + encodeURIComponent(filter_quantity);
	}
	
	var filter_status = '*';	
	if (filter_status != '*') {
		url += '&filter_status=' + encodeURIComponent(filter_status);
	}	

	location = url;
}
function filter() {
	url = 'index.php?route=catalog/product&token=<?php echo $token; ?>';
	
/* Admin Enhanced */
	var filter_category_id = $('select[name=\'filter_category_id\']').attr('value');	
	if (filter_category_id) {
    	url += '&filter_category_id=' + encodeURIComponent(filter_category_id);
	}                

	var filter_manufacturer = $('select[name=\'filter_manufacturer\']').attr('value');	
	if (filter_manufacturer) {
		url += '&filter_manufacturer=' + encodeURIComponent(filter_manufacturer);
	}
	
	var filter_cat_id = $('select[name=\'filter_category_id2\']').attr('value');	
	if (filter_cat_id) {
    	url += '&filter_category_id=' + encodeURIComponent(filter_cat_id);
	}                

	var filter_manuf = $('select[name=\'filter_manufacturer2\']').attr('value');	
	if (filter_manuf) {
		url += '&filter_manufacturer=' + encodeURIComponent(filter_manuf);
	}
	/* Admin Enhanced */
            
	var filter_name = $('input[name=\'filter_name\']').attr('value');
	
	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}
	
	var filter_model = $('input[name=\'filter_model\']').attr('value');
	
	if (filter_model) {
		url += '&filter_model=' + encodeURIComponent(filter_model);
	}
	
	var filter_price = $('input[name=\'filter_price\']').attr('value');
	
	if (filter_price) {
		url += '&filter_price=' + encodeURIComponent(filter_price);
	}
	
	var filter_quantity = $('input[name=\'filter_quantity\']').attr('value');
	
	if (filter_quantity) {
		url += '&filter_quantity=' + encodeURIComponent(filter_quantity);
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
<script type="text/javascript"><!--
$('input[name=\'filter_name\']').autocomplete({
	delay: 500,
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
		$('input[name=\'filter_name\']').val(ui.item.label);
						
		return false;
	},
	focus: function(event, ui) {
      	return false;
   	}
});

$('input[name=\'filter_model\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_model=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.model,
						value: item.product_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('input[name=\'filter_model\']').val(ui.item.label);
						
		return false;
	},
	focus: function(event, ui) {
      	return false;
   	}
});
//--></script> 

				<!-- Admin Enhanced -->
<?php if (($this->user->hasPermission('modify', 'catalog/product') && $eprod1 == 1)) { ?>
<style>
.list .left {padding:0 7px}
.edit-me {
   display:none;
   float:right;
   margin-right: 5px;
   clear:right;
   width:100%;
}
.edit-me input {
   float:right;
   text-align: right;
   cursor: text;
   margin-bottom:5px;
}
.edit-me +span {
   cursor: pointer;
   display: block;
   padding:5px 0;
}
.edit-me +span:hover {
   background: transparent url('view/image/review.png') left center no-repeat;
}
.edit-me2 {
   display:none;
   float:left;
   margin-bottom: 5px;
   clear:right;
   width:100%;
}
.edit-me2 input {
   float:left;
   text-align: left;
   cursor: text;
   margin-bottom:5px;
}
.edit-me2 +span {
   cursor: pointer;
   display: block;
   padding:5px 0;
}
.edit-me2 +span:hover {
   background: transparent url('view/image/review.png') right center no-repeat;
}
</style>
<script type="text/javascript"><!--
$(document).ready(function() {
	$('.edit-me').each(function(index, wrapper) {
		$(this).siblings().click(function() {
			$(wrapper).show();
			$(wrapper).siblings().hide();
		})
	});
	$('.edit-me2').each(function(index, wrapper) {
		$(this).siblings().click(function() {
			$(wrapper).show();
			$(wrapper).siblings().hide();
		})
	});
	$('.edit-me3').each(function(index, wrapper) {
		$(this).siblings().click(function() {
			$(wrapper).show();
			$(wrapper).siblings().hide();
		})
	});
});

function save_name(id) {
	var input_name = $('#name-'+id+' input');
	var name = $(input_name).val();
	$(".success2, .warning2, .error").remove();
	$.ajax({
		url: 'index.php?route=catalog/product/saveName&product_id='+id+'&name='+name+'&token=<?php echo $token; ?>',
		dataType: 'html',
		data: {},
		success: function(data) { 
			$('#name-'+id).next().html(name);
			close_name(id);
			var infotext = data.match(/<div\s+class="success">[\S\s]*?<\/div>/gi);
        	if (infotext) {
            	var infotext = infotext[0].replace(/(<\/?[^>]+>)/gi, "");
            	$("h1").after("<span class='success2'>" + infotext + "</span>");
            	$(".success2").delay(3000).fadeOut("slow");
        	}
		}
	});
}

function close_name(id) {
	$('.edit-me2 input').blur();
	$('#name-'+id).siblings().show();
	$('#name-'+id).hide();
}

function save_model(id) {
	var input_model = $('#model-'+id+' input');
	var model = $(input_model).val();
	$(".success2, .warning2, .error").remove();
	$.ajax({
		url: 'index.php?route=catalog/product/saveModel&product_id='+id+'&model='+model+'&token=<?php echo $token; ?>',
		dataType: 'html',
		data: {},
		success: function(data) { 
			$('#model-'+id).next().html(model);
			close_model(id);
			var infotext = data.match(/<div\s+class="success">[\S\s]*?<\/div>/gi);
        	if (infotext) {
            	var infotext = infotext[0].replace(/(<\/?[^>]+>)/gi, "");
            	$("h1").after("<span class='success2'>" + infotext + "</span>");
            	$(".success2").delay(3000).fadeOut("slow");
        	}
		}
	});
}

function close_model(id) {
	$('.edit-me2 input').blur();
	$('#model-'+id).siblings().show();
	$('#model-'+id).hide();
}

function save_price(id) {
	var input_price = $('#price-'+id+' input');
	var price = $(input_price).val();
	$(".success2, .warning2, .error").remove();
	$.ajax({
		url: 'index.php?route=catalog/product/savePrice&product_id='+id+'&price='+price+'&token=<?php echo $token; ?>',
		dataType: 'html',
		data: {},
		success: function(data) { 
			$('#price-'+id).next().html(price);
			close_price(id);
			var infotext = data.match(/<div\s+class="success">[\S\s]*?<\/div>/gi);
        	if (infotext) {
            	var infotext = infotext[0].replace(/(<\/?[^>]+>)/gi, "");
            	$("h1").after("<span class='success2'>" + infotext + "</span>");
            	$(".success2").delay(3000).fadeOut("slow");
        	}
		}
	});
}

function close_price(id) {
	$('.edit-me2 input').blur();
	$('#price-'+id).siblings().show();
	$('#price-'+id).hide();
}

function save_special(id) {
	var input_special = $('#special-'+id+' input');
	var special = $(input_special).val();
	$(".success2, .warning2, .error").remove();
	$.ajax({
		url: 'index.php?route=catalog/product/saveSpecial&product_id='+id+'&special='+special+'&token=<?php echo $token; ?>',
		dataType: 'html',
		data: {},
		success: function(data) { 
			$('#special-'+id).next().html(special);
			close_special(id);
			var infotext = data.match(/<div\s+class="success">[\S\s]*?<\/div>/gi);
        	if (infotext) {
            	var infotext = infotext[0].replace(/(<\/?[^>]+>)/gi, "");
            	$("h1").after("<span class='success2'>" + infotext + "</span>");
            	$(".success2").delay(3000).fadeOut("slow");
        	}
		}
	});
}

function close_special(id) {
	$('.edit-me2 input').blur();
	$('#special-'+id).siblings().show();
	$('#special-'+id).hide();
}

function save_quantity(id) {
	var input_quantity = $('#quantity-'+id+' input');
	var quantity = $(input_quantity).val();
	$(".success2, .warning2, .error").remove();
	$.ajax({
		url: 'index.php?route=catalog/product/saveQuantity&product_id='+id+'&quantity='+quantity+'&token=<?php echo $token; ?>',
		dataType: 'html',
		data: {},
		success: function(data) { 
			$('#quantity-'+id).next().html(quantity);
			close_quantity(id);
			var infotext = data.match(/<div\s+class="success">[\S\s]*?<\/div>/gi);
        	if (infotext) {
            	var infotext = infotext[0].replace(/(<\/?[^>]+>)/gi, "");
            	$("h1").after("<span class='success2'>" + infotext + "</span>");
            	$(".success2").delay(3000).fadeOut("slow");
        	}
		}
	});
}

function close_quantity(id) {
	$('.edit-me input').blur();
	$('#quantity-'+id).siblings().show();
	$('#quantity-'+id).hide();
}

$('.ajaxstatus').click(function() {
	$(".success2, .warning2, .error").remove();
	var object_id=$(this).attr('id');
	$.ajax({
		url: 'index.php?route=catalog/product/setstatus&token=<?php echo $token; ?>',
		type: 'get',
		data: {object_id:object_id},
		dataType: 'html',
		success: function(html) {
			if(html!=''){				
				$('#'+object_id).html(html);
			}
			$("h1").after("<span class='success2'><?php echo $text_stasaved; ?></span>");
            $(".success2").delay(3000).fadeOut("slow");
		}
	});
});

//--></script>
<?php } ?>
<?php if ($emisc6 == 1) { ?>
<script type="text/javascript">
$(document).ready(function() {
	$('.tooltip').tooltipster({
		theme:'.tooltipster-noir',
		timer: 2500
	});
	$('.tooltip2').tooltipster({
		theme:'.tooltipster-noir',
		offsetY: 20,
		timer: 2500
	});
});
</script>
<?php } ?>
<!-- Admin Enhanced --> 
			
<?php echo $footer; ?>