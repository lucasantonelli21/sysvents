$('page-register',function (){
    var $page = $(this);
    var $passwordConfirmation = $page.find('.password-confirmation');
    var $password = $page.find('.password');
    var $imgCheck = $page.find('.img-check');
    $passwordConfirmation.keyup(function(){
        console.log('oi');
        if($password.val() == $(this).val()){
            $imgCheck.css('visibility', 'visible');
        }else{
            $imgCheck.css('visibility', 'hidden');
        }

    });

});


