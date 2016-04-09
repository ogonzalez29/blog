/*
This JS handles the menu. It actually hides submenus and adds cool arrow to the menu items with children.
*/
function toggleByClass(className) {
    jQuery("."+className).toggle();
}
jQuery(document).click(function() {
	jQuery('.sub-menu').hide();
});
jQuery( document ).ready(function() {
	jQuery(".menu-item-has-children>a:first-of-type").attr('href', function( index ) {
		return "javascript:toggleByClass('hidder-" + index + "');";} );
	jQuery(".menu-item-has-children>a:first-of-type").prepend("&#8675;&nbsp;");
	jQuery( ".menu-item-has-children .sub-menu" ).addClass(function( index ) {
	  return "hidder-" + index;}); 
});