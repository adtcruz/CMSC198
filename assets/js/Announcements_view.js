var ann_ID="";

$('document').ready(
    function()
    {
        $('#annButton').addClass("black");
        $('ul.tabs').tabs();

        $('#titleCount').text('128 characters left');
        var maxTitle = 128;
        $('#title').keyup(
            function()
            {
                var lenTitle = $(this).val().length;
                if (lenTitle >= maxTitle)
                {
                    $('#contentCount').text(' you have reached the limit');
                }
                else
                {
                    var charTitle = maxTitle - lenTitle;
                    $('#titleCount').text(charTitle + ' characters left');
                }
            }
        );

        $('#contentCount').text('1024 characters left');
        var maxContent = 1024;
        $('#content').keyup(
            function()
            {
                var lenContent = $(this).val().length;
                if (lenContent >= maxContent)
                {
                    $('#contentCount').text(' you have reached the limit');
                }
                else
                {
                    var charContent = maxContent - lenContent;
                    $('#contentCount').text(charContent + ' characters left');
                }
            }
        );
    }
);

function confirmDelete(annID)
{
    ann_ID = annID;

    $('#deleteModal').openModal(
        {dismissible: false}
    );
}

function deleteAnnouncement(url)
{
    //jquery post (path_to_api, values sent in JSON format, callback function)
    $.post(
        url+"delete_announcement",
        {
            announcementID:ann_ID
        },
        function(data)
        {
            if (data === 'Announcement Deleted')
            {
                $('#deleteModal').closeModal();
                window.location.href = url+"announcements";
            }
        }
    );
}
