// $(document).ready(function(){
//     // dialog("Notify","Page Loaded");

//     $.get('/api/demo/modal',function(data,textStatus,xhr){
//         $('main').html(data);
//     })
// });

$('#liveToastBtn').click(function(){
    var el = $('#liveToast').get(0); // Get the native DOM element
    var toast = new bootstrap.Toast(el, { delay: 3000 }); // Set delay to 3 seconds
    toast.show(); // Show the toast
});