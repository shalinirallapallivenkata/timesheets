$(document).ready(function() {
    console.log("Hi");
});

function handleCancelButtonClick(){
    history.back();
}

$(document).on('click', '.cancelbtn', handleCancelButtonClick);