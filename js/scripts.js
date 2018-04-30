// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

// $(document).ready(function(){
//     var maxLength = 300;
//     $(".show-read-more").each(function(){
//         var myStr = $(this).text();
//         if($.trim(myStr).length > maxLength){
//             var newStr = myStr.substring(0, maxLength);
//             var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
//             $(this).empty().html(newStr);
//             $(this).append(' <a href="javascript:void(0);" class="read-more">read more...</a>');
//             $(this).append('<span class="more-text">' + removedStr + '</span>');
//         }
//     });
//     $(".read-more").click(function(){
//         $(this).siblings(".more-text").contents().unwrap();
//         $(this).remove();
//     });
// });