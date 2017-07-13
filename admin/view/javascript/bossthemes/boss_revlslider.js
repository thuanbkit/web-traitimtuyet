(function($){
	function changeColorPicker(i){
		$('#bg_color').ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).val(hex);
				$(el).css({backgroundColor:"#" + hex});
				$(el).ColorPickerHide();
			},
			onChange: function (hsb, hex, rgb) {
				$("#bg_color").css('background', '#' + hex);
				$("#bg_color").val(hex);
			},
			onBeforeShow: function () {
				$(this).ColorPickerSetColor(this.value);
			}
			
		});
	};	
	var initLayout = function() {
			changeColorPicker();
	};	
	EYE.register(initLayout, 'init');
})(jQuery)

$(document).ready(function() {
	$('#revlslide_setting').dcAccordion({
		menuClose: false,
		autoClose: true,
		saveState: false,
		disableLink: false,	
		autoExpand: true
	});
});
$(document).ready(function() {
	$('#revlslide_slider').dcAccordion({
		menuClose: false,
		autoClose: true,
		saveState: false,
		disableLink: false,	
		classExpand : 'bt-expand',
		autoExpand: true
	});
});
$(document).ready(function() {
	$('#revlslide_slides').dcAccordion({
		menuClose: false,
		autoClose: true,
		saveState: false,
		disableLink: false,	
		classExpand : 'bt-expand',
		autoExpand: true
	});
});

$(function() {
	$( "#revlslide_setting" ).sortable();
});
$(function() {
	$( "#slider_caption" ).sortable();
});
$(document).ready(function() {
	$("#bg_radio_transparent").prop("checked",true);
			
	//set radio boxes:
	$("#bg_radio_image").click(function(){
		$("#bg_color").hide();
		$("#bg_image").show();
	});

	$("#bg_radio_color").click(function(){
		$("#bg_image").hide();
		$("#bg_color").show();
	});
	
	$("#bg_radio_transparent").click(function(){
		$("#bg_image").hide();
		$("#bg_color").hide();
	});
});