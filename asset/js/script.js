/**
 * Created by Younes on 19/05/15.
 */
    function OpenTab(anchor){
    if($('.wrapperLeft').attr('is-open') >= 'false' ){
        $('.wrapperLeft').attr('is-open', 'true')
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
            width:"18vw"
        }, 1000);
    }else{
        $("#contentWL>img").attr('src','asset/images/contentWL/'+anchor+'.png')
        $('.wrapperLeft').attr('is-open', 'true')
        $.ajax({
            type: "GET",
            url: "src/Website/View/contentWL/"+anchor+".html",
            success: function(data){
                $("#navWL").html(data);
            }
        });
        $('.wrapperLeft').animate({
            width:"18vw"
        }, 1000);
        $( "#contentWL").animate({
            opacity:"100"
        }, 1000);
    }
};
    function changebackgroundOn(object){
        var id = $(object).attr('id');
            $(object).fadeOut('slow', function () {
                $(object).css({ 'background-image': 'url("asset/images/headerOn/'+id+'.png")' });
                $(object).fadeIn('slow');
            });
        }
function changebackgroundOff(object){
    var id = $(object).attr('id');
    $(object).fadeOut('slow', function () {
        $(object).css({ 'background-image': 'url("asset/images/header/'+id+'.png")' });
        $(object).fadeIn('slow');
    });
}
$(function() {
    if(sessionStorage.getItem('currentPage') != null){
        var id = sessionStorage.getItem('currentPage');
        changebackgroundOn('#'+id);
        if(id == 'userAdd' || id == 'profil' || id == 'userLogin'){
            OpenTab('profil');
        }else{
            OpenTab('catalog');
        }
    }else{
        changebackgroundOn('#catalog');
        OpenTab('catalog');
    }
    $('.nav ul li>a').click(function (){
        var id =  $(this).attr('id');
        var lastPage = '#'+sessionStorage.getItem('currentPage');
        changebackgroundOff(lastPage);
        changebackgroundOn($(this));
        sessionStorage.setItem('currentPage',id);
        OpenTab(id);
    })
});
