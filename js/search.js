
$(document).ready(function(){
    $("#search").keyup(function(){

        var input = $(this).val();

        if(input !=""){
            $.ajax({

                url:"../includs/livesearch.php",
                method:"POST",
                data:{input:input},

                success:function(data){
                    $("#main").html(data);
                }
            });
        }else{
            $("#main").css("display", "none");
        }
    });
});