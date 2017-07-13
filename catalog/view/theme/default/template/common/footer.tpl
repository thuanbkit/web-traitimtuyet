</div>
<div class="clear"></div>

<div id="footer">
    <div class="container">
        <?php if ($informations) { ?>
        <div class="column">
            <h3 class="name_store_footer"><?php echo $text_information; ?></h3>
            <ul>
                <?php foreach ($informations as $information) { ?>
                <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
        <?php } ?>
        <div class="column">
            <h3 class="name_store_footer"><?php echo $text_service; ?></h3>
            <ul>
                <li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
                <li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
                <li><a href="<?php echo $sitemap; ?>"><?php echo $text_sitemap; ?></a></li>
            </ul>
        </div>
        <div class="column">
            <h3 class="name_store_footer"><?php echo $text_extra; ?></h3>
            <ul>
                <li><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li>
                <li><a href="<?php echo $voucher; ?>"><?php echo $text_voucher; ?></a></li>
                <li><a href="<?php echo $special; ?>"><?php echo $text_special; ?></a></li>
            </ul>
        </div>
        <div class="column">
            <h3 class="name_store_footer"><?php echo $text_name_store; ?></h3>
            <div><?php echo $text_address; ?> <?php echo $config_address; ?></div>
            <div><?php echo $text_telephone; ?> <?php echo $config_telephone; ?></div>
            <div><?php echo $text_email; ?> <?php echo $config_email; ?></div>
            <div><?php echo $text_website; ?> <?php echo $config_website; ?></div>
        </div>
    </div>
</div>
</div>
<div id="powered">
    <div class="container">
        <div class="copyright"><?php echo $powered; ?></div>
        <div class="createby"><?php echo $createby; ?></div>
    </div>
</div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&appId=1411450375798466&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
</body></html>