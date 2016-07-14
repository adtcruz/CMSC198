$('document').ready(
	function()
    {
        $("#mngeApButton").addClass("black");
        $('#genRepButton').removeClass("grey");
        $('#genRepButton').removeClass("darken-4");
        $('#genRepButton').addClass('black');
        $('#menuBody').addClass('active');
        $('.collapsible').collapsible(
            {
                accordion: false
            }
        );
	}
);
