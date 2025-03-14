$(".page-form-users", function(){

    var $page = $(this);

    var $checkboxButton = $page.find('.render-password');
    var $passwordConfirmation = $page.find('.password-confirmation');
    var $passwordBox = $page.find('.password-box');
    var $newPassword = $page.find('.new-password');
    var $password = $page.find('.password');
    var $imgCheck = $page.find('.img-check2');

    $checkboxButton.on('change', function (){
        $passwordBox.toggleClass('d-none');
        console.log($checkboxButton.val());
        if($checkboxButton.is(":checked")){
            $passwordConfirmation.attr('required',true);
            $newPassword.attr('required',true);
            $password.attr('required',true);

        }else{
            $passwordConfirmation.removeAttr('required');
            $newPassword.removeAttr('required');
            $password.removeAttr('required');
        }
    });

    $passwordConfirmation.keyup(function(){

        if($newPassword.val() == $(this).val()){
            $imgCheck.css('visibility', 'visible');
        }else{
            $imgCheck.css('visibility', 'hidden');
        }

    });

});
