<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_install) { ?>
  <div class="warning"><?php echo $error_install; ?></div>
  <?php } ?>
  <?php if ($error_image) { ?>
  <div class="warning"><?php echo $error_image; ?></div>
  <?php } ?>
  <?php if ($error_image_cache) { ?>
  <div class="warning"><?php echo $error_image_cache; ?></div>
  <?php } ?>
  <?php if ($error_cache) { ?>
  <div class="warning"><?php echo $error_cache; ?></div>
  <?php } ?>
  <?php if ($error_download) { ?>
  <div class="warning"><?php echo $error_download; ?></div>
  <?php } ?>
  <?php if ($error_logs) { ?>
  <div class="warning"><?php echo $error_logs; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/home.png" alt="" /> <?php echo $heading_title; ?></h1>
    </div>
    <div class="content">

        	
         <!-- Admin Enhanced -->
		 <?php if ($eqick == 1) { include '../eadmin/shortcuts/eadmin.php'; } ?>
		 <!-- Admin Enhanced -->
          	
      		
      
      <!-- Admin Enhanced -->
	  <?php if ($estat == 1) { ?><div class="overview"><?php } else { ?><div class="overview" style="display:none;"><?php } ?>
	  <!-- Admin Enhanced -->
            
        <div class="dashboard-heading"><?php echo $text_overview; ?></div>
        <div class="dashboard-content">
          <table>
            <tr>
              <td><?php echo $text_total_sale; ?></td>
              <td><?php echo $total_sale; ?></td>
            </tr>
            <tr>
              <td><?php echo $text_total_sale_year; ?></td>
              <td><?php echo $total_sale_year; ?></td>
            </tr>
            <tr>
              <td><?php echo $text_total_order; ?></td>
              <td><?php echo $total_order; ?></td>
            </tr>
            <tr>
              <td><?php echo $text_total_customer; ?></td>
              <td><?php echo $total_customer; ?></td>
            </tr>
            <tr>
              <td><?php echo $text_total_customer_approval; ?></td>
              <td><?php echo $total_customer_approval; ?></td>
            </tr>
            <tr>
              <td><?php echo $text_total_review_approval; ?></td>
              <td><?php echo $total_review_approval; ?></td>
            </tr>
            <tr>
              <td><?php echo $text_total_affiliate; ?></td>
              <td><?php echo $total_affiliate; ?></td>
            </tr>
            <tr>
              <td><?php echo $text_total_affiliate_approval; ?></td>
              <td><?php echo $total_affiliate_approval; ?></td>
            </tr>
          </table>
        </div>
      </div>
      
      <!-- Admin Enhanced -->
	  <?php if ($estat == 1) { ?><div class="statistic"><?php } else { ?><div class="statistic" style="display:none;"><?php } ?>
	  <!-- Admin Enhanced -->
            
        <div class="range"><?php echo $entry_range; ?>
          <select id="range" onchange="getSalesChart(this.value)">
            <option value="day"><?php echo $text_day; ?></option>
            <option value="week"><?php echo $text_week; ?></option>
            <option value="month"><?php echo $text_month; ?></option>
            <option value="year"><?php echo $text_year; ?></option>
          </select>
        </div>
        <div class="dashboard-heading"><?php echo $text_statistics; ?></div>
        <div class="dashboard-content">
          <div id="report" style="width: 390px; height: 170px; margin: auto;"></div>
        </div>
      </div>
      
<!-- Admin Enhanced -->
<?php if ($etabs == 1) { ?>

<!-- Admin Enhanced -->
<?php if ( $egana == 1 && isset($config_eapi_key) && isset($config_eprofile_id) ) { ?>
<div class="egoogle">
        <div class="dashboard-heading"><?php echo $text_ga_summary; ?></div>
        <div class="dashboard-content">       
        
        <div id='chart_visits'></div>      
        <div id='chart_pageviews'></div>

        <table id='list_table' width="90%" cellpadding="10" align="center">
          <tr>
            <td width="45%"><div id='list_searches'></div></td>
            <td width="45%"><div id='list_referers'></div></td>
          </tr>
        </table>

        <div style="text-align:right;"><a href="http://www.google.com/analytics/" target="_blank">Google Analytics</a></div>
        
        <script type="text/javascript">
            window.onload = function(){                
                oo.setAPIKey("<?php echo $config_eapi_key; ?>");

                oo.load(function(){
                    // Set Parameters
                    var profile_id = "<?php echo $config_eprofile_id; ?>"
                      , date_days = "30d"
                      , max_result = 10      // 10 | 20 | ...
                      , table_display = true // true | false
                      ;
                    
                    // Visits & Vistors
                    var tl1 = new oo.Timeline(profile_id, date_days);
                    tl1.addMetric("ga:visits", "<?php echo $text_ga_visits; ?>");
                    tl1.addMetric("ga:visitors", "<?php echo $text_ga_visitors; ?>");
                    tl1.draw('chart_visits');
                    
                    // PageViews
                    var tl2 = new oo.Timeline(profile_id, date_days);
                    tl2.addMetric("ga:pageviews", "<?php echo $text_ga_pageviews; ?>"); 
                    tl2.draw('chart_pageviews');
                    
                    if ( table_display ) {                    
                      // Searches                    
                      var t1 = new oo.Table(profile_id, date_days);                    
                      t1.addDimension("ga:keyword", "TOP Searches");
                      t1.addMetric("ga:visits", "<?php echo $text_ga_visits; ?>");
                      t1.addMetric("ga:searchResultViews", "ResultViews");                    
                      //t1.query.setFilter("ga:searchResultViews>0");                     
                      t1.query.setSort('-ga:visits');
                      t1.query.setMaxResults(max_result);
                      t1.draw('list_searches');                    
                      
                      // Referers                    
                      var t2 = new oo.Table(profile_id, date_days);
                      t2.addDimension("ga:source", "TOP Referers");
                      t2.addMetric("ga:visits", "<?php echo $text_ga_visits; ?>");  // veskera navstevnost
                      t2.addMetric("ga:pageviews", "<?php echo $text_ga_pageviews; ?>");                   
                      t2.query.setFilter("ga:medium==referral"); // odkazujici stranky                    
                      t2.query.setSort('-ga:pageviews');
                      t2.query.setMaxResults(max_result);
                      t2.draw('list_referers');  
                    } else {
                      // document.getElementById("list_table").style.display = 'none';
                    }
                });
            };
        </script>
  </div>
</div>
<br />
<?php } ?>
<!-- Admin Enhanced -->      
      
  <div class="latest">
   <div class="dashboard-heading"><?php echo $text_latest; ?></div>
    <div class="dashboard-content">
        <div id="latest_tabs" class="htabs">
            <a href="#tab-latest_order"><?php echo $tab_order; ?></a>
            <?php if ($customers) { ?>
            <a href="#tab-latest_customer"><?php echo $tab_customer; ?></a>
            <?php } ?>
			<?php if ($returns) { ?>
            <a href="#tab-latest_return"><?php echo $tab_return; ?></a>
            <?php } ?>
            <?php if ($reviews) { ?>
            <a href="#tab-latest_review"><?php echo $tab_review; ?></a>
            <?php } ?>
        </div>       
       <div id="tab-latest_order" class="htabs-content">  
              <table class="list">
                <thead>
                  <tr>
                    <td class="right"><?php echo $column_order; ?></td>
                    <td class="left"><?php echo $column_customer; ?></td>
                    <td class="left"><?php echo $column_status; ?></td>
                    <td class="left"><?php echo $column_date_added; ?></td>
                    <td class="right"><?php echo $column_total; ?></td>
                    <td class="right"><?php echo $column_action; ?></td>
                  </tr>
                </thead>
                <tbody>
                  <?php if ($orders) { ?>
                  <?php foreach ($orders as $order) { ?>
                  <tr>
                    <td class="right"><?php echo $order['order_id']; ?></td>
                    <td class="left"><?php echo $order['customer']; ?></td>
                    <td class="left"><?php echo $order['status']; ?></td>
                    <td class="left"><?php echo $order['date_added']; ?></td>
                    <td class="right"><?php echo $order['total']; ?></td>
                    <td class="right"><?php foreach ($order['action'] as $action) { ?>
                      [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
                      <?php } ?></td>
                  </tr>
                  <?php } ?>
                  <?php } else { ?>
                  <tr>
                    <td class="center" colspan="6"><?php echo $text_no_results; ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
           </div>
       <?php if ($customers) { ?>
       <div id="tab-latest_customer" class="htabs-content">  
              <table class="list">
                <thead>
                  <tr>
                    <td class="left"><?php echo $column_customer; ?></td>
                    <td class="left"><?php echo $column_email; ?></td>
                    <td class="left"><?php echo $column_customer_group; ?></td>
                    <td class="left"><?php echo $column_status; ?></td>
                    <td class="right"><?php echo $column_date_added; ?></td>
                    <td class="right"><?php echo $column_action; ?></td>
                  </tr>
                </thead>
                <tbody>
                  <?php if ($customers) { ?>
                  <?php foreach ($customers as $customer) { ?>
                  <tr>
                    <td class="left"><?php echo $customer['name']; ?></td>
                    <td class="left"><?php echo $customer['email']; ?></td>
                    <td class="left"><?php echo $customer['customer_group']; ?></td>
                    <td class="left"><?php echo $customer['status']; ?></td>
                    <td class="right"><?php echo $customer['date_added']; ?></td>
                    <td class="right"><?php foreach ($customer['action'] as $action) { ?>
                      [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
                      <?php } ?></td>
                  </tr>
                  <?php } ?>

                  <?php } else { ?>
                  <tr>
                    <td class="center" colspan="6"><?php echo $text_no_results; ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
           </div>
           <?php } ?>
       <?php if ($returns) { ?>
       <div id="tab-latest_return" class="htabs-content">  
              <table class="list">
                <thead>
                  <tr>
                    <td class="right"><?php echo $column_return_id; ?></td>
                    <td class="right"><?php echo $column_order_id; ?></td>
                    <td class="left"><?php echo $column_customer; ?></td>
                    <td class="left"><?php echo $column_product; ?></td>
                    <td class="left"><?php echo $column_model; ?></td>
                    <td class="left"><?php echo $column_date_added; ?></td>
                    <td class="right"><?php echo $column_action; ?></td>
                  </tr>
                </thead>
                <tbody>
                  <?php if ($returns) { ?>
                  <?php foreach ($returns as $return) { ?>
                  <tr>
                    <td class="right"><?php echo $return['return_id']; ?></td>
                    <td class="right"><?php echo $return['order_id']; ?></td>
                    <td class="left"><?php echo $return['customer']; ?></td>
                    <td class="left"><?php echo $return['product']; ?></td>
                    <td class="left"><?php echo $return['status']; ?></td>
                    <td class="left"><?php echo $return['date_added']; ?></td>
                    <td class="right"><?php foreach ($return['action'] as $action) { ?>
                      [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
                      <?php } ?></td>
                  </tr>
                  <?php } ?>
                  <?php } else { ?>
                  <tr>
                    <td class="center" colspan="6"><?php echo $text_no_results; ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
           </div>
           <?php } ?>
       <?php if ($reviews) { ?>
       <div id="tab-latest_review" class="htabs-content">  
              <table class="list">
                <thead>
                  <tr>
                    <td class="left"><?php echo $column_product; ?></td>
                    <td class="left"><?php echo $column_author; ?></td>
                    <td class="right"><?php echo $column_rating; ?></td>
                    <td class="left"><?php echo $column_status; ?></td>
                    <td class="left"><?php echo $column_date_added; ?></td>
                    <td class="right"><?php echo $column_action; ?></td>
                  </tr>
                </thead>
                <tbody>
                  <?php if ($reviews) { ?>
                  <?php foreach ($reviews as $review) { ?>
                  <tr>
                    <td class="left"><?php echo $review['name']; ?></td>
                    <td class="left"><?php echo $review['author']; ?></td>
                    <td class="right"><?php echo $review['rating']; ?></td>
                    <td class="left"><?php echo $review['status']; ?></td>
                    <td class="left"><?php echo $review['date_added']; ?></td>
                    <td class="right"><?php foreach ($review['action'] as $action) { ?>
                      [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
                      <?php } ?></td>
                  </tr>
                  <?php } ?>
                  <?php } else { ?>
                  <tr>
                    <td class="center" colspan="6"><?php echo $text_no_results; ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
           </div>
           <?php } ?>
     </div>
   </div>
  </div>
<?php } else { ?>

<!-- Admin Enhanced -->
<?php if ( $egana == 1 && isset($config_eapi_key) && isset($config_eprofile_id) ) { ?>
<div class="egoogle">
        <div class="dashboard-heading"><?php echo $text_ga_summary; ?></div>
        <div class="dashboard-content">       
        
        <div id='chart_visits'></div>      
        <div id='chart_pageviews'></div>

        <table id='list_table' width="90%" cellpadding="10" align="center">
          <tr>
            <td width="45%"><div id='list_searches'></div></td>
            <td width="45%"><div id='list_referers'></div></td>
          </tr>
        </table>

        <div style="text-align:right;"><a href="http://www.google.com/analytics/" target="_blank">Google Analytics</a></div>
        
        <script type="text/javascript">
            window.onload = function(){                
                oo.setAPIKey("<?php echo $config_eapi_key; ?>");

                oo.load(function(){
                    // Set Parameters
                    var profile_id = "<?php echo $config_eprofile_id; ?>"
                      , date_days = "30d"
                      , max_result = 10      // 10 | 20 | ...
                      , table_display = true // true | false
                      ;
                    
                    // Visits & Vistors
                    var tl1 = new oo.Timeline(profile_id, date_days);
                    tl1.addMetric("ga:visits", "<?php echo $text_ga_visits; ?>");
                    tl1.addMetric("ga:visitors", "<?php echo $text_ga_visitors; ?>");
                    tl1.draw('chart_visits');
                    
                    // PageViews
                    var tl2 = new oo.Timeline(profile_id, date_days);
                    tl2.addMetric("ga:pageviews", "<?php echo $text_ga_pageviews; ?>"); 
                    tl2.draw('chart_pageviews');
                    
                    if ( table_display ) {                    
                      // Searches                    
                      var t1 = new oo.Table(profile_id, date_days);                    
                      t1.addDimension("ga:keyword", "TOP Searches");
                      t1.addMetric("ga:visits", "<?php echo $text_ga_visits; ?>");
                      t1.addMetric("ga:searchResultViews", "ResultViews");                    
                      //t1.query.setFilter("ga:searchResultViews>0");                     
                      t1.query.setSort('-ga:visits');
                      t1.query.setMaxResults(max_result);
                      t1.draw('list_searches');                    
                      
                      // Referers                    
                      var t2 = new oo.Table(profile_id, date_days);
                      t2.addDimension("ga:source", "TOP Referers");
                      t2.addMetric("ga:visits", "<?php echo $text_ga_visits; ?>");  // veskera navstevnost
                      t2.addMetric("ga:pageviews", "<?php echo $text_ga_pageviews; ?>");                   
                      t2.query.setFilter("ga:medium==referral"); // odkazujici stranky                    
                      t2.query.setSort('-ga:pageviews');
                      t2.query.setMaxResults(max_result);
                      t2.draw('list_referers');  
                    } else {
                      // document.getElementById("list_table").style.display = 'none';
                    }
                });
            };
        </script>
  </div>
</div>
<br />
<?php } ?>
<!-- Admin Enhanced -->      
      
	<div class="latest">
        <div class="dashboard-heading"><?php echo $text_latest_10_orders; ?></div>
        <div class="dashboard-content">
          <table class="list">
            <thead>
              <tr>
                <td class="right"><?php echo $column_order; ?></td>
                <td class="left"><?php echo $column_customer; ?></td>
                <td class="left"><?php echo $column_status; ?></td>
                <td class="left"><?php echo $column_date_added; ?></td>
                <td class="right"><?php echo $column_total; ?></td>
                <td class="right"><?php echo $column_action; ?></td>
              </tr>
            </thead>
            <tbody>
              <?php if ($orders) { ?>
              <?php foreach ($orders as $order) { ?>
              <tr>
                <td class="right"><?php echo $order['order_id']; ?></td>
                <td class="left"><?php echo $order['customer']; ?></td>
                <td class="left"><?php echo $order['status']; ?></td>
                <td class="left"><?php echo $order['date_added']; ?></td>
                <td class="right"><?php echo $order['total']; ?></td>
                <td class="right"><?php foreach ($order['action'] as $action) { ?>
                  [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
                  <?php } ?></td>
              </tr>
              <?php } ?>
              <?php } else { ?>
              <tr>
                <td class="center" colspan="6"><?php echo $text_no_results; ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
<?php } ?>
<!-- Admin Enhanced -->
      




































    </div>
  </div>
</div>
<!--[if IE]>
<script type="text/javascript" src="view/javascript/jquery/flot/excanvas.js"></script>
<![endif]--> 
<script type="text/javascript" src="view/javascript/jquery/flot/jquery.flot.js"></script> 
<script type="text/javascript"><!--
function getSalesChart(range) {
	$.ajax({
		type: 'get',
		url: 'index.php?route=common/home/chart&token=<?php echo $token; ?>&range=' + range,
		dataType: 'json',
		async: false,
		success: function(json) {
			var option = {	
				shadowSize: 0,
				lines: { 
					show: true,
					fill: true,
					lineWidth: 1
				},
				grid: {
					backgroundColor: '#FFFFFF'
				},	
				xaxis: {
            		ticks: json.xaxis
				}
			}

			$.plot($('#report'), [json.order, json.customer], option);
		}
	});
}

getSalesChart($('#range').val());
//--></script> 

<!-- Admin Enhanced -->
<?php if ($etabs == 1) { ?>
        <script type="text/javascript"><!--
        $('#latest_tabs a').tabs();
        //--></script>
<?php } ?>
        <style type="text/css">
        <!--
        	.htabs {
        	padding: 0px 0px 0px 10px;
        	height: 30px;
        	line-height: 16px;
        	border-bottom: 1px solid #547C96;
        	margin-bottom: 15px;
        }
        .htabs a {
        	border-top: 1px solid #547C96;
        	border-left: 1px solid #547C96;
        	border-right: 1px solid #547C96;
        	background: #547C96;
        	padding: 7px 15px 6px 15px;
        	float: left;
        	font-family: Arial, Helvetica, sans-serif;
        	font-size: 13px;
        	font-weight: 500;
        	text-align: center;
        	text-decoration: none;
        	color: #f7f7f7;
        	margin-right: 2px;
        	border-radius: 3px 3px 0px 0px;
        	display: none;
        }
        .htabs a.selected {
        	padding-bottom: 7px;
        	background: #FFFFFF;
        	color: #547C96;
        }
		.egoogle {
			clear: both;
		}
		.egoogle tbody td {
			background: #FFF;
		}
        -->
        </style>

<!-- Admin Enhanced -->
      
<?php echo $footer; ?>