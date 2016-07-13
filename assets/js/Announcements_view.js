$('document').ready(
    function ()
    {
        $('#annButton').addClass("black");
        $('ul.tabs').tabs();
        $('#charCount').text('1024 characters left');
        $('#text').keyup(
            function ()
            {
                var max = 1024;
                var len = $(this).val().length;
                if (len >= max)
                {
                    $('#charCount').text(' you have reached the limit');
                }
                else
                {
                    var char = max - len;
                    $('#charCount').text(char + ' characters left');
                }
            }
        );
    }
);
