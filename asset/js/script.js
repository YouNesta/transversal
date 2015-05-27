/**
 * Created by Younes on 19/05/15.
 */
    function OpenTab(anchor){
    if($('.wrapperLeft').attr('is-open') >= 'false' ){
        $('.wrapperLeft').attr('is-open', 'true')
        $('.wrapperLeft').animate({
            width:"00vw"
        }, 1000);
        $( "#contentWL" ).fadeTo( 1200 , 0, function() {
            $(this).animate({
                opacity:"100"
            }, 1000);
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
        if(id == 'userAdd' || id == 'profil'){
            OpenTab('profil');
        }else if(id == 'userLogin'){
            OpenTab('profil');
            changebackgroundOn('#'+'userLogout');
            changebackgroundOn('#'+id);
        }else if(id == 'userLogout'){
            changebackgroundOn('#'+'userLogin');
            OpenTab('catalog');
        }else{
            OpenTab('catalog');
        }
    }else{
        sessionStorage.setItem('currentPage','catalog');
        changebackgroundOn('#catalog');
        OpenTab('catalog');
    }
    $('.nav ul li>a').click(function (){
        var id =  $(this).attr('id');
        if(id != 'logo'){
            var lastPage = '#'+sessionStorage.getItem('currentPage');
            changebackgroundOff(lastPage);
            changebackgroundOn($(this));
            sessionStorage.setItem('currentPage',id);
            OpenTab(id);
        }

    })
});


$(document).ready(function()
{
    $('#add-form').submit(function(event)
    {
        // immediately disable the submit button to prevent double submits

        var fName = $('#first-name').val();
        var lName = $('#last-name').val();
        var email = $('#email').val();
        var passwordCheck = $('#passwordCheck').val();
        var password = $('#password').val();
        var adress = $('#adress').val();
        var city = $('#city').val();
        var postalCode = $('#postalCode').val();
        var errorLog = [];


        // First and last name fields: make sure they're not blank

        if (lName === "") {
            $('#last-name').css({backgroundColor: "red"});
            errorLog.push("Vous n'avez pas entrer de Nom de Famille");
        }
        if (fName === "") {
            $('#first-name').css({backgroundColor: "red"});
            errorLog.push("Vous n'avez pas entrer de Prénom");
        }

        // Validate the email address:
        var emailFilter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (email === "") {
            $('#email').css({backgroundColor: "red"});
            errorLog.push("Vous n'avez pas entrer d'email");
        } else if (!emailFilter.test(email)) {
            errorLog.push("Votre email n'est pas valide");
            $('#email').css({backgroundColor: "red"});
        }
        if (adress === "") {
            $('#adress').css({backgroundColor: "red"});
            errorLog.push("Vous n'avez pas entrer d'adresse");

        }
        if (city === "") {
            $('#city').css({backgroundColor: "red"});
            errorLog.push("Vous n'avez pas entrer de ville");

        }
        if (postalCode === "") {
            $('#postalCode').css({backgroundColor: "red"});
            errorLog.push("Vous n'avez pas entrer de code Postal");

        }
        if (password === "") {
            $('#password').css({backgroundColor: "red"});
            errorLog.push("Vous n'avez pas entrer de Mots de passe");

        }
        if (passwordCheck === "") {
            $('#password').css({backgroundColor: "red"});

        }else if (password != passwordCheck ) {
            errorLog.push("Vos mots de passes n'ont pas pu etre verifié");
            $('#password').css({backgroundColor: "red"});
            $('#passwordCheck').css({backgroundColor: "red"});
        }

        for (error in errorLog){
            $("#errorLog").append('<br>'+errorLog[error]);
        }
        if(errorLog.length === 0){
            return true;
        }else{
            return false;
        }
// Prevent the default submit action on the form

    });



})
