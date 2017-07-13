<?php 	$this->document->addScript('catalog/view/javascript/piecemaker/swfobject.js'); ?>
<?php 
$pieces=array(9,12,15,18,21);
$easing=array('linear','easeInSine','easeOutSine','easeOutSine','easeOutInSine','easeInQuad','easeOutQuad','easeInOutQuad','easeInOutQuad','easeInBounce','easeInOutQuart','easeInOutQuart','easeInQuint','easeInQuint','easeInOutQuint','easeOutInQuint','easeInExpo','easeOutExpo','easeInOutExpo','easeInCirc','easeInOutBack');
$xml='<?xml version="1.0" encoding="utf-8"?>
<Piecemaker>
  <Contents>';
foreach ($sliders as $slide) 
{
$xml.='<Image Source="'.$slide['image'].'" Title="'.$slide['title'].'">
<Hyperlink URL="'.$slide['link'].'" Target="_blank" />
</Image>';
}
$xml.='</Contents>
  <Settings ImageWidth="'.$width.'" ImageHeight="'.($height).'" LoaderColor="0x333333" InnerSideColor="0x222222" SideShadowAlpha="0.8" DropShadowAlpha="0.7" DropShadowDistance="25" DropShadowScale="0.95" DropShadowBlurX="40" DropShadowBlurY="4" MenuDistanceX="20" MenuDistanceY="50" MenuColor1="0x999999" MenuColor2="0x333333" MenuColor3="0xFFFFFF" ControlSize="50" ControlDistance="20" ControlColor1="0x222222" ControlColor2="0xFFFFFF" ControlAlpha="0.8" ControlAlphaOver="0.95" ControlsX="450" ControlsY="280&#xD;&#xA;" ControlsAlign="center" TooltipHeight="30" TooltipColor="0x222222" TooltipTextY="5" TooltipTextStyle="P-Italic" TooltipTextColor="0xFFFFFF" TooltipMarginLeft="5" TooltipMarginRight="7" TooltipTextSharpness="50" TooltipTextThickness="-100" InfoWidth="400" InfoBackground="0xFFFFFF" InfoBackgroundAlpha="0.95" InfoMargin="15" InfoSharpness="0" InfoThickness="0" Autoplay="'.($duration/1000).'" FieldOfView="45"></Settings> <Transitions>';
  foreach ($sliders as $slide) 
{
$xml.='<Transition Pieces="'.$pieces[array_rand($pieces)].'" Time="'.(1+$velocity/1000).'" Transition="'.$easing[array_rand($easing)].'" Delay="'.($velocity/1000).'" DepthOffset="300" CubeDistance="30"></Transition>';
}
$xml.='</Transitions></Piecemaker>';
$xmlFile = 'catalog/view/javascript/piecemaker/piecemaker'.$module.'.xml';
$xmlOpen = fopen($xmlFile, 'w') or die("can't open file");
fwrite($xmlOpen, $xml);
fclose($xmlOpen);
?>
<div class="slideshow">
    <div id="piecemaker<?php echo $module; ?>">
      <p></p>
    </div>
</div>
<script type="text/javascript"><!--
      var flashvars = {};
      flashvars.cssSource = "catalog/view/javascript/piecemaker/piecemaker.css";
      flashvars.xmlSource = "catalog/view/javascript/piecemaker/piecemaker<?php echo $module; ?>.xml";
		
      var params = {};
      params.play = "true";
      params.menu = "true";
      params.scale = "showall";
      params.wmode = "transparent";
      params.allowfullscreen = "true";
      params.allowscriptaccess = "always";
      params.allownetworking = "all";
	  
      swfobject.embedSWF('catalog/view/javascript/piecemaker/piecemaker.swf', 'piecemaker<?php echo $module; ?>', '<?php echo ($width+50);?>', '<?php echo ($height+90);?>', '10', null, flashvars,    
      params, null);
	  
--></script>