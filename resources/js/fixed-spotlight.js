$(document).ready(function() {
    window.onscroll = function() {myFunction()};

    var header = document.getElementById("spotlight");
    var filter = document.getElementById("filter");
    var sticky = header.offsetTop;

    function myFunction() {
        if (window.pageYOffset > sticky) {
            header.classList.add("sticky");
            filter.classList.add("sticky");
        } else {
            header.classList.remove("sticky");
            filter.classList.remove("sticky");
        }
    }
});