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
        <?php if ($icon) { ?>
        <link href="<?php echo $icon; ?>" rel="icon" />
        <?php } ?>
        <?php foreach ($links as $link) { ?>
        <link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
        <?php } ?>
        <link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/stylesheet.css" />
        <link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/font.css" />
        <?php foreach ($styles as $style) { ?>
        <link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
        <?php } ?>
        <script type="text/javascript" src="catalog/view/javascript/jquery/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
        <link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />
        <script type="text/javascript" src="catalog/view/javascript/common.js"></script>
        <script type="text/javascript" src="catalog/view/javascript/jquery.hoverex.js"></script>
        <?php foreach ($scripts as $script) { ?>
        <script type="text/javascript" src="<?php echo $script; ?>"></script>
        <?php } ?>
        <!--[if IE 7]> 
        <link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/ie7.css" />
        <![endif]-->
        <!--[if lt IE 7]>
        <link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/ie6.css" />
        <script type="text/javascript" src="catalog/view/javascript/DD_belatedPNG_0.0.8a-min.js"></script>
        <script type="text/javascript">
        DD_belatedPNG.fix('#logo img');
        </script>
        <![endif]-->
        
        <?php if ($stores) { ?>
        <script type="text/javascript"><!--
        $(document).ready(function () {
                < ?php foreach ($stores as $store) { ? >
                        $('body').prepend('<iframe src="<?php echo $store; ?>" style="display: none;"></iframe>');
                        < ?php } ? >
            });
        //--></script>
        <?php } ?>
        <?php echo $google_analytics; ?>
    </head>
    <body>

        <div class="container">
            <div id="header">
                <div id="content-header">
                    <?php if ($logo) { ?>
                    <div id="logo"><a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" /></a></div>
                    <?php } ?>

                    <?php echo $language; ?>
                    <div id="name_store"><?php //echo $text_name_store;?></div>
                    <div  id="name_sologan"><?php //echo $text_name_sologan;?></div>
                    <div id="search">
                        <div class="button-search"></div>
                        <input type="text" name="search" placeholder="<?php echo $text_search; ?>" value="<?php echo $search; ?>" />
                    </div>
                    <?php echo $cart; ?> 
                        <div class="facebook-header">
                            <div class="fb-like" data-href="https://www.facebook.com/itplusvn" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
                        </div>
                    </div>

            </div>
        </div>

        <div id="menu-width">
            <div id="container">
                <div id="header">
                    <ul class="menu-multi">
                        <?php echo $Multichidmenu;?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container">


                <?php if ($error) { ?>

                <div class="warning"><?php echo $error ?><img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>

                <?php } ?>
                <div id="notification"></div>

