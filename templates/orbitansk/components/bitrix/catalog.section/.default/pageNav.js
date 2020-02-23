(function() {
    'use strict';
    document.addEventListener("DOMContentLoaded", ready);
    function ready() {
        console.log('готов');
        var pageNav = document.getElementById('pageNav');
        pageNav.onchange = function(e) {
            console.log(e);
            document.location = this.options[this.selectedIndex].value;
        }
}
})();