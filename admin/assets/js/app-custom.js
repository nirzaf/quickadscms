/*
Document: app-custom.js
Author: Bylancer
Description: Write your custom code here
*/

// Below is an example of function and its initialization
var AppCustom = function() {
	var showAppName = function() {
		//console.log( 'Quickad Classified - Admin & Frontend template' );
	};

	return {
		init: function() {
			showAppName();
		}
	}
}();

// Initialize AppCustom when page loads
jQuery( function() {
	AppCustom.init();
});
