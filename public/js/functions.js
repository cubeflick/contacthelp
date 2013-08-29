$(function() {
	$('#navigation ul li:last').addClass('last')
	

	 var availableTags = [ "ActionScript", "AppleScript", "Asp", "BASIC", "C",
		"C++", "Clojure", "COBOL", "ColdFusion", "Erlang", "Fortran",
		"Groovy", "Haskell", "Java", "JavaScript", "Lisp", "Perl", "PHP",
		"Python", "Ruby", "Scala", "Scheme" ];
	
	$("#company").autocomplete({
		source: "/application/index/searchlisting",
		 select: function( event, ui ) {
		 console.log( ui.item ?
		 "Selected: " + ui.item.value + " aka " + ui.item.id :
		 "Nothing selected, input was " + this.value );
		 }
	});
	
	
	
});

$(window).load(function() {
	$('.flexslider').flexslider({
		animation: "slide",
		controlsContainer: ".slider",
		slideshowSpeed: 5000,
		directionNav: false,
		controlNav: true,
		animationDuration: 900
	});
});