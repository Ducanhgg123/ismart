$(document).ready(function(){
    $("#check-order").click(function(){
        var id = $(this).attr('data-id');
        $.ajax({
            url: "?mod=order&controller=index&action=update",
            method : "POST",
            data: {id: id},
            dataType: 'text',
            success: function(data){
                alert(data);
            }
        });
    });
});