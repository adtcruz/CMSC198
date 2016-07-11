$('document').ready(
	function()
    {
	    $("#homeButton").addClass("black");
        // these lines controls the slider present in the home page of the client
        // this line sets some properties of slider. transition and interval is in milliseconds
        $('.slider').slider({full_width: false, height: 100, transition: 300, interval: 4000});
        // this makes use of jQuery's hover function. on mouse in (1st argument), the slider will pause. on mouse out (2nd argument), the slider will resume.
        $('.slider').hover (
            function ()
            {
                // this function is a built-in function of materialize.js for sliders
                $('.slider').slider ('pause');
            },
            function ()
            {
                // another built-in function of materialize.js for sliders
                $('.slider').slider ('start');
            }
        );
    }
);
