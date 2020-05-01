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


function readyFunction() {
    $("#deleterecord").on("click", function(){
        confirm("Do you want to delete the record?");
    });

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
}
function openModal(event) {
    var $modal = $("#myModal");
    $modal.show(); // same as $modal.attr('style', 'display:block')
    // display => block (shows element) is the opp of display => none (hides element)
}
function closeModal(event){
    var $modal = $("#myModal");
    $modal.hide();
}
function closeModalOverlayClick(event) {
    if (event.target === $('#myModal')[0]) {
        closeModal(event);
    }
}

function datePicker()
{
    $("#datepicker1").datepicker({
        showOn: "both",
        //buttonImage: "http://jqueryui.com/resources/demos/datepicker/images/calendar.gif",
        buttonImage: "calendar.png",
        buttonImageOnly: true,
        buttonText: "Select date"
    });
    $("#datepicker2").datepicker({
        showOn: "both",
        //buttonImage: "http://jqueryui.com/resources/demos/datepicker/images/calendar.gif",
        buttonImage: "calendar.png",
        buttonImageOnly: true,
        buttonText: "Select date"
    });
}
//Todo: Learn JQuery Events

function init() {

//Event handlers go here
    $(document).on('keyup', '.hoursentry', handleHoursEntry);
    $(document).ready(readyFunction);
    $(document).on('click', '#myBtn', openModal)
    $(document).on('click', 'span.close', closeModal);
    $(document).on('click', window, closeModalOverlayClick);
    $(document).ready(datePicker);

}

init();
