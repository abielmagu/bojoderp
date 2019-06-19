(function(){
  /* JQuery *******************************************************************/

  // Hide message status
  $('#message').delay(5000).fadeOut();
	
  /* Bootstrap ****************************************************************/

  // Tooltip
  $('[data-toggle="tooltip"]').tooltip();
   
  // Collapse
  //$('.collapse').collapse('hide');
	
	
	/* Morris ****************************************************************/
	
	$('#bars-types-works-print').resize(function () { bar.redraw(); });
	
	$('#donut-intermediaries-print').resize(function () { bar.redraw(); });
})()

// $('.collapse').collapse();