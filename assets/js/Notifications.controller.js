$('document').ready(
    function(){
        $("#notifButton").addClass("black");
    }
);

function markAsRead(url,notifID,userID,userType){
  $.get(
    url+'notifications/mark_as_read/'+notifID+'/'+userID+'/'+userType+'/',
    function(data){
      if(data==="Marked as read"){
        Materialize.toast("Notification marked as read",3000);
      }
    }
  );
}
