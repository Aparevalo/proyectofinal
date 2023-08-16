$(document).ready(function(){
    $("#send-btn").on("click", function(){
        $value = $("#data").val();
        $msg = '<div id="user" class="user response"><span>'+ $value +'</span></div>';
        $(".messages").append($msg);
        $("#data").val('');
        
        $.ajax({
            url: 'message.php',
            type: 'POST',
            data: 'text='+$value,
            success: function(result){
               
                $replay = '<div id="bot" class="bot response"><span>'+ result +'</span></div>'
                $(".messages").append($replay);
                $(".messages").scrollTop($(".messages")[0].scrollHeight);
            }
        });
    });
});