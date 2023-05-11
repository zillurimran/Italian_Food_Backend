(function ($) {
    "use strict"

	/* Document on Ready functions */
	$(function(){
	
		/* Select2 Scroll Problem Solve function */
		$('.members-assign-select').on('select2:open', function (e) {
			const evt = "scroll.select2";
			$(e.target).parents().off(evt);
			$(window).off(evt);
		});
	
		/* Choose Color Input function */
		// $(document).on("change", ".jscolor", function(){
		// 	$(this).attr("data-backgroundcolor", $(this).css("background-color"));
		// 	$(this).attr("data-color", $(this).css("color"));
		// });
	
		/* Textarea auto fit height function */
		// $('.card-details__heading__edit-title').each(function () {
		// 	this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px; overflow-y:hidden; overflow-wrap: break-word;');
		// }).on('input', function () {
		// 	this.style.height = 'auto';
		// 	this.style.height = (this.scrollHeight) + 'px';
		// });
	})

})(jQuery);