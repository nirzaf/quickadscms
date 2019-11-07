/*
Document: base_pages_dashboard.js
Author: Zeunix
Description: Custom JS code used in Dashboard Page (index.html)
 */

var BasePagesDashboard = function() {
	// Chart.js Chart: http://www.chartjs.org/docs
	var initDashChartJS = function() {

		// Get Chart Containers
		var $dashChartBarsCnt3 = jQuery( '.js-chartjs-bars3' )[0].getContext( '2d'),
			$dashChartLinesCnt4 = jQuery( '.js-chartjs-lines4' )[0].getContext( '2d' )

		// Set global chart options
		var $globalOptions = {
			showScale: false,
			tooltipCornerRadius: 2,
			maintainAspectRatio: false,
			responsive: true,
			animation: false,
			pointDotStrokeWidth: 2
		};


		// Init Lines Chart Bars
		$dashChartBars3 = new Chart( $dashChartBarsCnt3 ).Bar( $dashChartLinesData3, {
			scaleBeginAtZero: true,
			scaleShowVerticalLines: false,
			barShowStroke: false,
			scaleFontFamily: "'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif",
			scaleFontColor: App.colors.text_muted,
			tooltipTitleFontFamily: "'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif",
			tooltipCornerRadius: 2,
			maintainAspectRatio: false,
			responsive: true,
			animation: false
		});

		// Init Lines Chart 4
		$dashChartLines4 = new Chart( $dashChartLinesCnt4 ).Line( $dashChartLinesData4, {
            scaleBeginAtZero: true,
			scaleShowHorizontalLines: false,
			bezierCurve: false,
			datasetFill: false,
			pointDotStrokeWidth: 2,
			scaleFontFamily: "'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif",
			scaleFontColor: App.colors.text_muted,
			scaleFontStyle: '500',
			tooltipTitleFontFamily: "'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif",
			tooltipCornerRadius: 2,
			maintainAspectRatio: false,
			responsive: true,
			animation: false
		});
	};

	return {
		init: function () {
			// Init ChartJS chart
			initDashChartJS();
		}
	};
}();

// Initialize when page loads
jQuery( function() {
	BasePagesDashboard.init();
});
