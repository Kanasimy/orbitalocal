(function() {
    'use strict';
var pageNav = document.getElementById(pageNav);
pageNav.onclick = function changeCount(e) {
    console.log(e);
    document.location = this.options[this.selectedIndex].value;
}
})();