$(document).ready(function () {
    $('#contacts-equip_ren[input[type=checkbox]]').change(function(){
        $(this).parent().siblings().children().filter(':checked').not(this).removeAttr('checked');
    });
});
