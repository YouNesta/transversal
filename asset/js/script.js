/**
 * Created by Younes on 19/05/15.
 */
    function OpenTab(anchor){
    if($('.wrapperLeft').width() > '1' ){
        $('.wrapperLeft').animate({
            width:"00vw"
        }, 2000);
        $( "#contentWL" ).fadeTo( 2400 , 0, function() {
            $(this).animate({
                opacity:"100"
            }, 2000);
            $("#contentWL>img").attr('src','asset/images/contentWL/'+anchor+'.png')
            $.ajax({
                type: "GET",
                url: "src/Website/View/contentWL/"+anchor+".html",
                success: function(data){
                    $("#navWL").html(data)
                }
            });
        });
        $('.wrapperLeft').animate({
            width:"20vw"
        }, 1000);
    }else{
        $("#contentWL>img").attr('src','asset/images/contentWL/'+anchor+'.png')
        $.ajax({
            type: "GET",
            url: "src/Website/View/contentWL/"+anchor+".html",
            success: function(data){
                $("#navWL").html(data)
            }
        });
        $('.wrapperLeft').animate({
            width:"20vw"
        }, 1000);
        $( "#contentWL").animate({
            opacity:"100"
        }, 1000);
    }
};
$(function() {
    $('.nav ul li>a').click(function (){
        OpenTab($(this).attr('id'));
    })
});
