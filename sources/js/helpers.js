var $body = $('body');
	
// Clone element
$body.on( 'click', 'button[data-clone]', function (e) {
	var dataValue = $(this).data('clone');
	var containerClones = '#' + dataValue;
	var originalCloner = $(containerClones + ' #clone-original');
	var cloned = $(originalCloner).clone();

	$('input:text', cloned).val('');
	$("input[type='number']", cloned).val('0');
	cloned.find('[data-remove]').removeClass('hidden');
	cloned.removeAttr('id').addClass('cloned').appendTo(containerClones);
});

// Remove element class
$body.on( 'click', 'button[data-remove]', function (e) {
	var dataValue = $(this).data('remove');
	$(this).closest('.' + dataValue).remove();
});

// Slide works of casefile
$body.on('click', '.switcher-slide', function (e) {
	e.preventDefault();
	var switcher = this;
	$(switcher).nextAll('.element-slide').eq(0).slideToggle(400, function () {
		$('.rotator', switcher).toggleClass('rotate180');
	});
})

// ...
var toggleHandle = document.getElementsByClassName('toggle');
if ( toggleHandle.length > 0 )
{
	toggleHandle[0].addEventListener('click', toggleEnable);
}

function toggleEnable()
{
  var toggleData = this.getAttribute('data-toggle');
  var toggleElement = document.getElementById(toggleData);
  toggleElement.disabled = !toggleElement.disabled;
}