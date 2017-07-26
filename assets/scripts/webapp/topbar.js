$(document).ready(function(){


//when account shortcut is selected
$('#account_shortcut').change(function(){

    var account_id = $("#account_shortcut").val();
    var link = $("#account_shortcut_link").val();
    var button = $("#account_shortcut_action");

    if(account_id != null){
        button.attr("href" , link + account_id);
    }else{
        button.attr("href" , "#");
    }

});


});