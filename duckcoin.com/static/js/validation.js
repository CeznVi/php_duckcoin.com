
const validateEmail = (email) => {
    return email.match(
        /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    );
};

const validate = () => {
    const $result = $('#resultEmail');
    const email = $('#email').val();
    $result.text('');

    if(email.length > 4) {
        if(validateEmail(email)){
            //$result.text(email + ' Пошта вказана вірно');
            $result.css('color', 'green');
            $('#submitButton').removeClass("disabled");
        } else{
            $result.text(email + ' це не пошта!');
            $result.css('color', 'red');
            $('#submitButton').addClass("disabled");
        }
        return false;
    }
}

$('#email').on('input', validate);


