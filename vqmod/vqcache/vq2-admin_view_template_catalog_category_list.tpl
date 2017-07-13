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
<?php if ($ecats4 == 1) { ?>
    <div class="heading2">
      <h1><img src="view/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
	  <div class="buttons2"><?php if ($ecats1 == 1) { ?><a onclick="$('form').attr('action', '<?php echo $enable; ?>'); $('form').submit();" class="button" style="background:#060;"><?php echo $button_enable; ?></a> <a onclick="$('form').attr('action', '<?php echo $disable; ?>'); $('form').submit();" class="button" style="background:#900;"><?php echo $button_disable; ?></a><?php } ?><a href="<?php echo $repair; ?>" class="button"><?php echo $button_repair; ?></a><a href="<?php echo $insert; ?>" class="button"><?php echo $button_insert; ?></a><a onclick="$('#form').submit();" class="button"><?php echo $button_delete; ?></a></div>
	</div>
<?php } ?>
			<!-- Admin Enhanced -->
			
    <div class="heading">
      <h1><img src="view/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
      <?php if ($ecats1 == 1) { ?><div class="buttons"><a onclick="$('form').attr('action', '<?php echo $enable; ?>'); $('form').submit();" class="button" style="background:#060;"><?php echo $button_enable; ?></a> <a onclick="$('form').attr('action', '<?php echo $disable; ?>'); $('form').submit();" class="button" style="background:#900;"><?php echo $button_disable; ?></a><?php } else { ?><div class="buttons"><?php } ?><a href="<?php echo $repair; ?>" class="button"><?php echo $button_repair; ?></a><a href="<?php echo $insert; ?>" class="button"><?php echo $button_insert; ?></a><a onclick="$('#form').submit();" class="button"><?php echo $button_delete; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
              
			<?php if ($ecats2 == 1) { ?><td class="left"><?php echo $column_name; ?> <?php echo $text_cenabtot; ?></td><?php } else { ?><td class="left"><?php echo $column_name; ?></td><?php } ?>
			
              <td class="right"><?php echo $column_sort_order; ?></td>

			<?php if ($ecats1 == 1) { ?>
			<td class="center"><?php echo $column_status; ?></td>		
			<?php } ?>
			
              <td class="center"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
            <?php if ($categories) { ?>
            <?php foreach ($categories as $category) { ?>
            <tr>
              <td style="text-align: center;"><?php if ($category['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $category['category_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $category['category_id']; ?>" />
                <?php } ?></td>
              <?php if ($ecats2 == 1) { ?><td class="left" style="padding:0" id="cname-<?php echo $category['category_id']; ?>"><span style="float:left; padding:10px 7px"><span <?php echo ($category['status']==1?"style='color:#060;font-size:14px;'":"style='color:#900;font-size:14px;'"); ?> ><?php echo $category['name']; ?></span> <?php if ($ecats == 1) { ?>(<?php echo $category['total_products_1'] . " / " . $category['total_products_all']; ?>)<?php } ?></span><span style="float:right; padding-top:7px;padding-right:7px;"><a class="tooltip catprodbox" title="View Products in this Category" href="<?php echo $category['href']; ?>"><?php echo $text_cviewprods; ?></a></span></td><?php } else { ?><td class="left"><?php echo $category['name']; ?></td><?php } ?>
              <td class="right"><?php echo $category['sort_order']; ?></td>

			<?php if ($ecats1 == 1) { ?>
			<td class="center"><?php echo $category['status2']; ?></td>
			<?php } ?>
			
              <td class="center"><?php foreach ($category['action'] as $action) { ?>
                <?php if ($this->user->hasPermission('modify', 'catalog/category')) { ?><a href="<?php echo $action['href']; ?>" class="cateditbox" title="<?php echo $category['name']; ?>"><span class="tooltip" title="Edit Category"><?php echo $action['text']; ?></span></a>&nbsp;&nbsp;<?php } ?><?php } ?>
        <?php
        $this->load->model('catalog/category');
        $category_store = $this->model_catalog_category->getCategoryStores($category['category_id']);
        ?>
        <?php if (in_array(0, $category_store)) { ?>
         <a class="tooltip" title="View Category in store" onClick="window.open('<?php echo $store . 'index.php?route=product/category&path=' . $category['category_id']; ?>');"><?php echo $text_eview; ?></a><br />
        <?php } ?>
        <?php foreach ($stores as $storel) { ?>
          <?php if (in_array($storel['id'], $category_store)) { ?>
         <a class="tooltip" title="View Category in store" onClick="window.open('<?php echo $storel['href'] . 'index.php?route=product/category&path=' . $category['category_id']; ?>');"><?php echo $text_eview; ?></a><br />
        <?php } ?>
                <?php } ?></td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" 
			<?php if ($ecats1 == 1) { ?>colspan="4"<?php } else { ?>colspan="3"<?php } ?>
			><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </form>
      <div class="pagination"><?php echo $pagination; ?></div>
    </div>
  </div>
</div>

<?php if ($emisc6 == 1) { ?>
<script type="text/javascript">
$(document).ready(function() {
	$('.tooltip').tooltipster({theme:'.tooltipster-noir',timer: 2500});
	$('.tooltip2').tooltipster({theme:'.tooltipster-noir',offsetY: 20,timer: 2500});
});
</script>
<?php } ?>
        
<?php echo $footer; ?>