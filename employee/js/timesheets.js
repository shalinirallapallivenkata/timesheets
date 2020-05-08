//Functions go here
function handleHoursEntry() {
    var $totalHoursElement = $('.totalhours');
    var $hoursEntryElements = $('.hoursentry');

    //$hoursEntryElements.each(function(value){});
    var totalHours = 0;
    $hoursEntryElements.each(function (key, hoursEntryElement) {
        if (hoursEntryElement.value !== "") {
            totalHours += parseFloat(hoursEntryElement.value);
        }
    });
    $totalHoursElement.val(totalHours);
}


function deleteRecord() {
    var confirmation = confirm("Do you want to delete the record?");
    if (confirmation) {
        var tr = $(this).closest('tr');
        var username = $('[name="username"]').val();
        // var paycode=$('[name="paycode"]')
        // var paycodevalue= paycode.val();
        var paycode = $(tr).find("span.paycodemain");
        var starttime = $(tr).find("span.starttimemain");
        var endtime = $(tr).find("span.endtimemain");
        var hours = $(tr).find("span.hoursmain");
        var totalhours = $(tr).find("span.totalhours");

        //wtf?????????????????????????????????/

        var recordid = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: 'deleterecord.php',
            data: {
                "recordid": recordid,
                "username": username
            },
            success: function (data) {
                paycode[0].textContent = " ";
                starttime[0].textContent = " ";
                endtime[0].textContent = " ";
                hours[0].textContent = " ";
                totalhours[0].textContent = " ";
            }
        });
    }
}
function updateHourslogged()
{
    var intime=$("#intime").val();
    var it=intime.split(/:/)[0] * 3600 + intime.split(/:/)[1]  * 60;
    var outtime=$("#outtime").val();
    var ot=outtime.split(/:/)[0] * 3600 + outtime.split(/:/)[1]  * 60;
    var diff= parseInt(ot) - parseInt(it);
    console.log(diff);
    if(isNaN(diff)){
        return;
    }
    var loogedhours = parseFloat(diff/3600);
    $("#hrs").val(loogedhours.toFixed(2));
}

    var modal = document.getElementById("myModal");

// Get the button that opens the modal
    var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
//     btn.onclick = function() {
//         modal.style.display = "block";
//     }

// When the user clicks on <span> (x), close the modal
//     span.onclick = function() {
//         modal.style.display = "none";
//     }

// When the user clicks anywhere outside of the modal, close it
//     window.onclick = function(event) {
//         if (event.target == modal) {
//             modal.style.display = "none";
//         }
//     }
//}
function openModal(event) {
    var $modal = $("#myModal");
    $modal.show(); // same as $modal.attr('style', 'display:block')
    // display => block (shows element) is the opp of display => none (hides element)

}
function openModal2(event){
    var $modal2 = $("#myModal2");
    $modal2.show();
}
function closeModal(event){
    var $modal = $("#myModal");
    $modal.hide();
}
function closeModal2(event){
    var $modal2 = $("#myModal2");
    $modal2.hide();
}
function closeModalOverlayClick(event) {
    if (event.target === $('#myModal')[0]) {
        closeModal(event);
    }
}
function closeModalOverlayClick2(event) {
    if (event.target === $('#myModal2')[0]) {
        closeModal2(event);
    }
}


function datePicker()
{
        $("#datepicker1").datepicker({
            showOn:"both",
            inline:true,
            buttonImage: "calendar.png",
            buttonImageOnly: true,
            buttonText: "Select date"
        });
        $("#datepicker2").datepicker({
            showOn:"both",
            inline:true,
            buttonImage: "calendar.png",
            buttonImageOnly: true,
            buttonText: "Select date"
        });
}
// function excludeWeekends(){
//     $("excludechekbox").click()
//         $("#datepicker1").datepicker(
//             {
//                 beforeShowDay: $.datepicker.noWeekends
//             });
// }
// function dropdownSelection(){
//     $(".dropdown-menu li a").click(function() {
//         $(".btn:first-child").text($(this).text());
//         $(".btn:first-child").val($(this).text());
//     });
// }

function removeDeleteIcons()
{
    $('.deleterecord').each(function(){
        var tr = $(this).closest('tr');
        var paycode = tr.find('.paycodemain');
        if(paycode.text() === ""){
            $(this).remove();
        }
    });
}

function handleFormSubmit(e) {
    e.preventDefault();
    var $form = $(this);
    var url = $form.attr('action');
    var method = $form.attr('method');
    var formdata = $form.serializeArray();
    console.log(formdata);
    $.ajax({
        type:method,
            url:url,
        data:formdata,
        success:function (response) {
            var result = JSON.parse(response);
            if (!result['status']) {
                var errorMessage = result['errors'].join("\n");
                alert(errorMessage);
            }else {
                window.location.reload();
            }
        }
    });

}

//Todo: Learn JQuery Events
function init() {

//Event handlers go here
    $(document).on('keyup', '.hoursentry', handleHoursEntry);
    $(document).on('click', '#deleterecord', deleteRecord);
    $(document).on('click', '#myBtn', openModal)
    $(document).on('click', '.close-modal', closeModal);
    $(document).on('click', window, closeModalOverlayClick);
    $(document).ready(datePicker);
    $(document).on('change', '#outtime', updateHourslogged);
    $(document).on('change', '#intime', updateHourslogged);
    $(document).on('submit', '#mymodalform', handleFormSubmit);
    $(document).on('click','#approve', openModal2);
    $(document).on('click', '.close-modal2', closeModal2);
    $(document).on('click', window, closeModalOverlayClick2);



}

init();