$('document').ready(
    function(){
        $("#notifButton").addClass("black");
    }
);

function markAsRead(url,notifID,userID,userType){
  $.post(
    url+'notifications/mark_as_read/',
    {
      notifID:notifID,
      userID:userID,
      userType:userType
    },
    function(data){
      if(data==="Marked as read"){
        window.location.href = url+"notifications";
      }
    }
  );
}
