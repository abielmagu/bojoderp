(function () {
  var $document  = $(document);
  var $body = $('body');

	// Toggle display the  zip-code table of details
	$body.on('change', '#selectZip', function (e) {
		var zipId = $('option:selected', this).val();
		var zipTables = $('#zips').children('table');
		$.each(zipTables, function(index, table){
			if($(table).attr('id') == zipId && $(table).hasClass('hidden'))
			{
				$(table).removeClass('hidden');
			}
			else
			{
				$(table).addClass('hidden');
			}
		});
	})
	
	// Show the past works pendings on works view
	$body.on('change', '#past-works', function () {
		var self = this;
    $('tr.warning').slideToggle(!self.checked).toggleClass('hidden');
	});
	
	// Load the form of work type selected
	$body.on('change', '#xjs-kindwork', function () {
    var thisValue  = $(this).val();
    var divLoad 	 = $('#xjs-kindwork-load');
    var divLoading = $('#xjs-kindwork-loading');

    $.ajax({
      beforeSend: function()
      {
        divLoading.toggleClass('hidden');
      },
      url: '?url=works/kind/' + thisValue,
      type: 'get'
      // dataType: JSON or other, data: serialize or values
    })
    .done(function( Settings ) {
      divLoad.html( Settings );
    })
    .fail(function() {
    })
    .always(function() {
      divLoading.toggleClass('hidden');
    });
  });
	
	
  // Show rvalues list by method
  $body.on('change', '#insulation-methods', function (e) {
    var $rvalues = $('#insulation-rvalues');
    var $optionSelected = $('option:selected', this).val();
    var $optgroupsLabels = $rvalues.find('optgroup');

    $rvalues.val('');
    $.each($optgroupsLabels, function(index, value) {
      var $optgroup = $(value);
      if( $optgroup.attr('label') == $optionSelected )
      {
        $optgroup.toggleClass('hidden');
      }
      else
      {
      	$optgroup.addClass('hidden');
      }
    });
  });

  // Calculate bags by sqfts or rvalues
  $body.on('change', '#insulation-rvalues', calculateBags);
  $body.on('keyup', '#insulation-sqfts', calculateBags);
})()


// FUNCTIONS

// Calculate bags of method insulation
function calculateBags() {
	var sqfts = $('#insulation-sqfts').val();
	var rvalue = $('#insulation-rvalues option:selected').data('score');

	floatBags = sqfts / parseInt(rvalue);
	intBags = !isNaN(floatBags) && isFinite(floatBags) ? Math.ceil(floatBags) : 0;
	$('#insulation-bags').val(intBags);
}