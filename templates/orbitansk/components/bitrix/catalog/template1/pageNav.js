(function() {
    'use strict';
var pageNav = document.getElementById('pageNav');
pageNav.onchange = function(e) {
    console.log(e);
    document.location = this.options[this.selectedIndex].value;
}
})();