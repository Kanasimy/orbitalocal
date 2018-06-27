(function() {
    'use strict';
    document.addEventListener("DOMContentLoaded", ready);
    function ready() {
        var pageNav = document.getElementById('pageNav');
        pageNav.onchange = function(e) {
            document.location = this.options[this.selectedIndex].value;
        }
}
})();