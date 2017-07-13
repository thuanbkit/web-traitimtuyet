<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8" />
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<link rel="stylesheet" type="text/css" href="view/stylesheet/stylesheet.css" />

<!-- Admin Enhanced -->
<?php if ($emisc1 == 1) { ?>
<style type="text/css">
#menu > ul #dashboard a.top {
	padding-left: 35px;
	background: url('view/image/home.png') 9px 7px no-repeat;
}
#menu > ul #catalog a.top {
	padding-left: 35px;
	background: url('../eadmin/image/menu/category.png') 9px 7px no-repeat;
}
#menu > ul #extension a.top {
	padding-left: 35px;
	background: url('../eadmin/image/menu/module.png') 9px 7px no-repeat;
}
#menu > ul #sale a.top {
	padding-left: 35px;
	background: url('../eadmin/image/menu/order.png') 9px 7px no-repeat;
}
#menu > ul #system a.top {
	padding-left: 35px;
	background: url('../eadmin/image/menu/setting.png') 9px 7px no-repeat;
}
#menu > ul #reports a.top {
	padding-left: 35px;
	background: url('../eadmin/image/menu/report.png') 9px 7px no-repeat;
}
#menu > ul #localisation a.top {
	padding-left: 35px;
	background: url('../eadmin/image/menu/language.png') 9px 7px no-repeat;
}
#menu > ul #help a.top {
	padding-left: 35px;
	background: url('../eadmin/image/menu/help.png') 9px 7px no-repeat;
}
#menu > ul #store a.top {
	padding-left: 35px;
	background: url('../eadmin/image/menu/preview.png') 9px 7px no-repeat;
}
#menu > ul #logged a.top {
	padding-left: 35px;
	background: url('../eadmin/image/menu/lockscreen.png') 9px 7px no-repeat;
}
#menu > ul #dashboard:hover, #menu > ul #catalog:hover, #menu > ul #extension:hover, #menu > ul #sale:hover, #menu > ul #system:hover, #menu > ul #reports:hover, #menu > ul #localisation:hover, #menu > ul #help:hover, #menu > ul #store:hover, #menu > ul #logged:hover {
	background: url('../eadmin/image/menu/top-hover.png') repeat-x;
}
#menu > ul .selected {
	background: url('../eadmin/image/menu/selected.png') repeat-x!important;
	color: #FFFFFF;
}
#menu > ul .selected:hover, #menu > ul .sfhover {
	background: url('../eadmin/image/menu/selected.png') repeat-x!important;
}
</style>
<?php } ?>


<?php foreach ($styles as $style) { ?>
<link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>

	<!-- Admin Enhanced -->
	<?php if ($emisc4 == 1) { ?>
	<link rel="stylesheet" type="text/css" href="view/stylesheet/highlight-css.css" />
	<?php } ?>
	<!-- Admin Enhanced -->
			
<script type="text/javascript" src="view/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link type="text/css" href="view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script type="text/javascript" src="view/javascript/jquery/tabs.js"></script>
<script type="text/javascript" src="view/javascript/jquery/superfish/js/superfish.js"></script>
<script type="text/javascript" src="view/javascript/common.js"></script>
<!-- Admin Enhanced --><?php if ($egana == 1) { ?><script type="text/javascript" src='view/javascript/oocharts/oocharts.js'></script><?php } ?><!-- Admin Enhanced -->
<?php foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>
<script type="text/javascript">
//-----------------------------------------
// Confirm Actions (delete, uninstall)
//-----------------------------------------
$(document).ready(function(){
    // Confirm Delete
    $('#form').submit(function(){
        if ($(this).attr('action').indexOf('delete',1) != -1) {
            if (!confirm('<?php echo $text_confirm; ?>')) {
                return false;
            }
        }
    });
    // Confirm Uninstall
    $('a').click(function(){
        if ($(this).attr('href') != null && $(this).attr('href').indexOf('uninstall', 1) != -1) {
            if (!confirm('<?php echo $text_confirm; ?>')) {
                return false;
            }
        }
    });
        });
    </script>

<!-- Admin Enhanced -->
<link rel="stylesheet" type="text/css" href="view/javascript/jquery/colorbox/colorbox.css?v=1.0" media="screen" />
<script type="text/javascript" src="view/javascript/jquery/colorbox/jquery.colorbox-min.js"></script>
<link rel="stylesheet" type="text/css" href="../eadmin/css/eadmin.css" />
<?php if ($emisc6 == 1) { ?>
<link rel="stylesheet" type="text/css" href="view/javascript/jquery/tooltipster/css/tooltipster.css" />
<link rel="stylesheet" type="text/css" href="view/javascript/jquery/tooltipster/css/themes/tooltipster-noir.css" />
<script type="text/javascript" src="view/javascript/jquery/tooltipster/js/jquery.tooltipster.min.js"></script>
<?php } ?>
<?php if ($edate == 1) { ?>
<script language="JavaScript" type="text/javascript">
function clock() {
var d = new Date();
var month = d.getMonth()
var day = d.getDate();
var hours = d.getHours();
var minutes = d.getMinutes();
var seconds = d.getSeconds();
if (month == 0) month = "<?php echo $text_january; ?>"
 else if (month == 1) month = "<?php echo $text_february; ?>"
 else if (month == 2) month = "<?php echo $text_march; ?>"
 else if (month == 3) month = "<?php echo $text_april; ?>"
 else if (month == 4) month = "<?php echo $text_may; ?>"
 else if (month == 5) month = "<?php echo $text_june; ?>"
 else if (month == 6) month = "<?php echo $text_july; ?>"
 else if (month == 7) month = "<?php echo $text_august; ?>"
 else if (month == 8) month = "<?php echo $text_september; ?>"
 else if (month == 9) month = "<?php echo $text_october; ?>"
 else if (month == 10) month = "<?php echo $text_november; ?>"
 else if (month == 11) month = "<?php echo $text_december; ?>";
if (day <= 9) day = "0" + day;
if (hours <= 9) hours = "0" + hours;
if (minutes <= 9) minutes = "0" + minutes;
if (seconds <= 9) seconds = "0" + seconds;
date_time =+ day + " " + month + " " + d.getFullYear() +
"<?php echo $text_year; ?><br />"+ hours + ":" + minutes + ":" + seconds;
if (document.layers) {
 document.layers.doc_time.document.write(date_time);
 document.layers.doc_time.document.close();}
else document.getElementById("doc_time").innerHTML = date_time;
 setTimeout("clock()", 1000);
}
</script>
<?php } ?>
<?php if ($eprod7 == 1 || $ecats4 == 1) { ?>
<script language="JavaScript" type="text/javascript">
$(document).scroll(function () {
    var y = $(this).scrollTop();
    if (y > 276) {
        $('.heading2').fadeIn('slow');
    } else {
        $('.heading2').fadeOut('fast');
    }
});
</script>
<style>
.box > .heading2 {
	width:100%;
	padding-left: 7px;
	padding-right: 7px;
	border-bottom: 2px solid #DBDBDB;
	background: #fff url('view/image/box.png') repeat-x;
	-webkit-border-radius: 0px;
	-moz-border-radius: 0px;
	-khtml-border-radius: 0px;
	border-radius: 0px;
	display:none;
	position: fixed;
	top: 0px;
	right: 0px;
	box-shadow: 0 3px 6px #999;	
}
.box > .heading2 h1 {
	margin: 0 0 0 45px;
	padding: 11px 0px 0px 0px;
	color: #003A88;
	font-size: 16px;
	float: left;
}
.box > .heading2 h1 img {
	float: left;
	margin-top: -1px;
	margin-left: 3px;
	margin-right: 8px;
}
.box > .heading2 .buttons2 {
	float: right;
	padding-top: 7px;
	-webkit-border-radius: 0px;
	-moz-border-radius: 0px;
	-khtml-border-radius: 0px;
	border-radius: 0px;
	margin: -1px 30px 0 0!important;
	padding: 6px;
}
.box > .heading2 .buttons2 .button {
	margin-left: 5px;
}
</style>
<?php } ?>
<style>
span.success2 {
	margin: 13px 0 0 25px;
	padding: 0 0 0 20px;
	color: #060;
	font-weight:bold;
	font-size: 13px;
	background: url('view/image/success.png') no-repeat 0 0;
	height:16px;
	float:left;
}
span.warning2 {
	margin: 13px 0 0 25px;
	padding: 0 0 0 20px;
	color: #900;
	font-weight:bold;
	font-size: 13px;
	background: url('view/image/warning.png') no-repeat 0 0;
	height:16px;
	float:left;
}
#toTop {
	display:none;
	text-decoration:none;
	position:fixed;
	bottom:10px;
	right:10px;
	overflow:hidden;
	width:25px;
	height:25px;
	border:none;
	text-indent:100%;
	background:url(view/image/ui.totop.png) no-repeat left top;
}
#toTopHover {
	background:url(view/image/ui.totop.png) no-repeat left -25px;
	width:25px;
	height:25px;
	display:block;
	overflow:hidden;
	float:left;
	opacity: 0;
	-moz-opacity: 0;
	filter:alpha(opacity=0);
}
#toTop:active, #toTop:focus {
	outline:none;
}
</style>
<!-- Admin Enhanced -->
          	
      		
</head>
<body>
<div id="container">
    <div id="header">
  <div class="div1">
    <div class="div2"><img src="view/image/logo.png" title="<?php echo $heading_title; ?>" onclick="location = '<?php echo $home; ?>'" /></div>

			<?php if ($edate == 1) { ?><div id="doc_time" style="float:left;position:relative;top:13px;left:20px;color:white"><script language="JavaScript" type="text/javascript">clock();</script></div><?php } ?>
			
    <?php if ($logged) { ?>
    <div class="div3"><img src="view/image/lock.png" alt="" style="position: relative; top: 3px;" />&nbsp;<?php echo $logged; ?></div>
    <?php } ?>
  </div>
  <?php if ($logged) { ?>
  <div id="menu">
    <ul class="left" style="display: none;">
      <li id="dashboard"><a href="<?php echo $home; ?>" class="top"><?php echo $text_dashboard; ?></a></li>
      <li id="catalog"><a class="top"><?php echo $text_catalog; ?></a>
        <ul>
          <li><a href="<?php echo $category; ?>"><?php echo $text_category; ?></a></li>
          <li><a href="<?php echo $product; ?>"><?php echo $text_product; ?></a></li>
          <li><a href="<?php echo $filter; ?>"><?php echo $text_filter; ?></a></li>
          <li><a href="<?php echo $profile; ?>"><?php echo $text_profile; ?></a></li>
          <li><a class="parent"><?php echo $text_attribute; ?></a>
            <ul>
              <li><a href="<?php echo $attribute; ?>"><?php echo $text_attribute; ?></a></li>
              <li><a href="<?php echo $attribute_group; ?>"><?php echo $text_attribute_group; ?></a></li>
            </ul>
          </li>
          <li><a href="<?php echo $option; ?>"><?php echo $text_option; ?></a></li>
          <li><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li>
          <li><a href="<?php echo $download; ?>"><?php echo $text_download; ?></a></li>
          <li><a href="<?php echo $review; ?>"><?php echo $text_review; ?></a></li>
          <li><a href="<?php echo $information; ?>"><?php echo $text_information; ?></a></li>
<li><a class="parent"><?php echo $text_news; ?></a>
            <ul>
              <li><a href="<?php echo $news; ?>"><?php echo $text_news; ?></a></li>
              <li><a href="<?php echo $news_category; ?>"><?php echo $text_news_category; ?></a></li>
              <li><a href="<?php echo $news_comment; ?>"><?php echo $text_news_comment; ?></a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li id="extension"><a class="top"><?php echo $text_extension; ?></a>
        <ul>
          <li><a href="<?php echo $module; ?>"><?php echo $text_module; ?></a></li>
          <li><a href="<?php echo $shipping; ?>"><?php echo $text_shipping; ?></a></li>
          <li><a href="<?php echo $payment; ?>"><?php echo $text_payment; ?></a></li>
          <li><a href="<?php echo $total; ?>"><?php echo $text_total; ?></a></li>
          <li><a href="<?php echo $feed; ?>"><?php echo $text_feed; ?></a></li>
          <li><a href="<?php echo $vqmod_manager; ?>"><?php echo $text_vqmod_manager; ?></a></li>
          <?php if ($openbay_show_menu == 1) { ?>
            <li><a class="parent"><?php echo $text_openbay_extension; ?></a>
                <ul>
                    <li><a href="<?php echo $openbay_link_extension; ?>"><?php echo $text_openbay_dashboard; ?></a></li>
                    <li><a href="<?php echo $openbay_link_orders; ?>"><?php echo $text_openbay_orders; ?></a></li>
                    <li><a href="<?php echo $openbay_link_items; ?>"><?php echo $text_openbay_items; ?></a></li>

                    <?php if($openbay_markets['ebay'] == 1){ ?>
                    <li><a class="parent" href="<?php echo $openbay_link_ebay; ?>"><?php echo $text_openbay_ebay; ?></a>
                        <ul>
                            <li><a href="<?php echo $openbay_link_ebay_settings; ?>"><?php echo $text_openbay_settings; ?></a></li>
                            <li><a href="<?php echo $openbay_link_ebay_links; ?>"><?php echo $text_openbay_links; ?></a></li>
                            <li><a href="<?php echo $openbay_link_ebay_orderimport; ?>"><?php echo $text_openbay_order_import; ?></a></li>
                       </ul>
                    </li>
                    <?php } ?>

                    <?php if($openbay_markets['amazon'] == 1){ ?>
                    <li><a class="parent" href="<?php echo $openbay_link_amazon; ?>"><?php echo $text_openbay_amazon; ?></a>
                        <ul>
                            <li><a href="<?php echo $openbay_link_amazon_settings; ?>"><?php echo $text_openbay_settings; ?></a></li>
                            <li><a href="<?php echo $openbay_link_amazon_links; ?>"><?php echo $text_openbay_links; ?></a></li>
                        </ul>
                    </li>
                    <?php } ?>

                    <?php if($openbay_markets['amazonus'] == 1){ ?>
                    <li><a class="parent" href="<?php echo $openbay_link_amazonus; ?>"><?php echo $text_openbay_amazonus; ?></a>
                        <ul>
                            <li><a href="<?php echo $openbay_link_amazonus_settings; ?>"><?php echo $text_openbay_settings; ?></a></li>
                            <li><a href="<?php echo $openbay_link_amazonus_links; ?>"><?php echo $text_openbay_links; ?></a></li>
                        </ul>
                    </li>
                    <?php } ?>
                </ul>
            </li>
          <?php } ?>
        </ul>
      </li>
      <li id="sale"><a class="top"><?php echo $text_sale; ?></a>
        <ul>
          <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
          <li><a href="<?php echo $recurring_profile; ?>"><?php echo $text_recurring_profile; ?></a></li>
          <li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
          <li><a class="parent"><?php echo $text_customer; ?></a>
            <ul>
              <li><a href="<?php echo $customer; ?>"><?php echo $text_customer; ?></a></li>
              <li><a href="<?php echo $customer_group; ?>"><?php echo $text_customer_group; ?></a></li>
              <li><a href="<?php echo $customer_ban_ip; ?>"><?php echo $text_customer_ban_ip; ?></a></li>
            </ul>
          </li>
          <li><a href="<?php echo $affiliate; ?>"><?php echo $text_affiliate; ?></a></li>
          <li><a href="<?php echo $coupon; ?>"><?php echo $text_coupon; ?></a></li>
          <li><a class="parent"><?php echo $text_voucher; ?></a>
            <ul>
              <li><a href="<?php echo $voucher; ?>"><?php echo $text_voucher; ?></a></li>
              <li><a href="<?php echo $voucher_theme; ?>"><?php echo $text_voucher_theme; ?></a></li>
            </ul>
          </li>
          <!-- PAYPAL MANAGE NAVIGATION LINK -->
          <?php if ($pp_express_status) { ?>
           <li><a class="parent" href="<?php echo $paypal_express; ?>"><?php echo $text_paypal_express; ?></a>
             <ul>
               <li><a href="<?php echo $paypal_express_search; ?>"><?php echo $text_paypal_express_search; ?></a></li>
             </ul>
           </li>
          <?php } ?>
          <!-- PAYPAL MANAGE NAVIGATION LINK END -->
          <li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
        </ul>
      </li>
      <li id="system"><a class="top"><?php echo $text_system; ?></a>
        <ul>
          <li><a href="<?php echo $setting; ?>"><?php echo $text_setting; ?></a></li>
          <li><a class="parent"><?php echo $text_design; ?></a>
            <ul>
              <li><a href="<?php echo $layout; ?>"><?php echo $text_layout; ?></a></li>
              <li><a href="<?php echo $banner; ?>"><?php echo $text_banner; ?></a></li>
              <li><a href="<?php echo $slider; ?>"><?php echo $text_slider; ?></a></li>
            </ul>
          </li>
          <li><a class="parent"><?php echo $text_users; ?></a>
            <ul>
              <li><a href="<?php echo $user; ?>"><?php echo $text_user; ?></a></li>
              <li><a href="<?php echo $user_group; ?>"><?php echo $text_user_group; ?></a></li>
            </ul>
          </li>
          <li><a class="parent"><?php echo $text_localisation; ?></a>
            <ul>
              <li><a href="<?php echo $language; ?>"><?php echo $text_language; ?></a></li>
              <li><a href="<?php echo $currency; ?>"><?php echo $text_currency; ?></a></li>
              <li><a href="<?php echo $stock_status; ?>"><?php echo $text_stock_status; ?></a></li>
              <li><a href="<?php echo $order_status; ?>"><?php echo $text_order_status; ?></a></li>
              <li><a class="parent"><?php echo $text_return; ?></a>
                <ul>
                  <li><a href="<?php echo $return_status; ?>"><?php echo $text_return_status; ?></a></li>
                  <li><a href="<?php echo $return_action; ?>"><?php echo $text_return_action; ?></a></li>
                  <li><a href="<?php echo $return_reason; ?>"><?php echo $text_return_reason; ?></a></li>
                </ul>
              </li>
              <li><a href="<?php echo $country; ?>"><?php echo $text_country; ?></a></li>
              <li><a href="<?php echo $zone; ?>"><?php echo $text_zone; ?></a></li>
              <li><a href="<?php echo $geo_zone; ?>"><?php echo $text_geo_zone; ?></a></li>
              <li><a class="parent"><?php echo $text_tax; ?></a>
                <ul>
                  <li><a href="<?php echo $tax_class; ?>"><?php echo $text_tax_class; ?></a></li>
                  <li><a href="<?php echo $tax_rate; ?>"><?php echo $text_tax_rate; ?></a></li>
                </ul>
              </li>
              <li><a href="<?php echo $length_class; ?>"><?php echo $text_length_class; ?></a></li>
              <li><a href="<?php echo $weight_class; ?>"><?php echo $text_weight_class; ?></a></li>
            </ul>
          </li>
          <li><a href="<?php echo $error_log; ?>"><?php echo $text_error_log; ?></a></li>
          <li><a href="<?php echo $backup; ?>"><?php echo $text_backup; ?></a></li>
        </ul>
      </li>
      <li id="reports"><a class="top"><?php echo $text_reports; ?></a>
        <ul>
          <li><a class="parent"><?php echo $text_sale; ?></a>
            <ul>
              <li><a href="<?php echo $report_sale_order; ?>"><?php echo $text_report_sale_order; ?></a></li>
              <li><a href="<?php echo $report_sale_tax; ?>"><?php echo $text_report_sale_tax; ?></a></li>
              <li><a href="<?php echo $report_sale_shipping; ?>"><?php echo $text_report_sale_shipping; ?></a></li>
              <li><a href="<?php echo $report_sale_return; ?>"><?php echo $text_report_sale_return; ?></a></li>
              <li><a href="<?php echo $report_sale_coupon; ?>"><?php echo $text_report_sale_coupon; ?></a></li>
            </ul>
          </li>
          <li><a class="parent"><?php echo $text_product; ?></a>
            <ul>
              <li><a href="<?php echo $report_product_viewed; ?>"><?php echo $text_report_product_viewed; ?></a></li>
              <li><a href="<?php echo $report_product_purchased; ?>"><?php echo $text_report_product_purchased; ?></a></li>
            </ul>
          </li>
          <li><a class="parent"><?php echo $text_customer; ?></a>
            <ul>
              <li><a href="<?php echo $report_customer_online; ?>"><?php echo $text_report_customer_online; ?></a></li>
              <li><a href="<?php echo $report_customer_order; ?>"><?php echo $text_report_customer_order; ?></a></li>
              <li><a href="<?php echo $report_customer_reward; ?>"><?php echo $text_report_customer_reward; ?></a></li>
              <li><a href="<?php echo $report_customer_credit; ?>"><?php echo $text_report_customer_credit; ?></a></li>
            </ul>
          </li>
          <li><a class="parent"><?php echo $text_affiliate; ?></a>
            <ul>
              <li><a href="<?php echo $report_affiliate_commission; ?>"><?php echo $text_report_affiliate_commission; ?></a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li id="help"><a class="top"><?php echo $text_help; ?></a>
        <ul>
          <li><a href="http://www.opencart.com" target="_blank"><?php echo $text_opencart; ?></a></li>
          <li><a href="http://www.opencart.com/index.php?route=documentation/introduction" target="_blank"><?php echo $text_documentation; ?></a></li>
          <li><a href="http://forum.opencart.com" target="_blank"><?php echo $text_support; ?></a></li>
        </ul>
      </li>
    </ul>
    <ul class="right" style="display: none;">
      <li id="store"><a href="<?php echo $store; ?>" target="_blank" class="top"><?php echo $text_front; ?></a>
        <ul>
          <?php foreach ($stores as $stores) { ?>
          <li><a href="<?php echo $stores['href']; ?>" target="_blank"><?php echo $stores['name']; ?></a></li>
          <?php } ?>
        </ul>
      </li>
      
      <!-- Admin Enhanced -->
	  <li id="logged"><a class="top" href="<?php echo $logout; ?>">
	  <!-- Admin Enhanced -->
          	
      		<?php echo $text_logout; ?></a></li>
    </ul>
  </div>
  <?php } ?>
</div>
