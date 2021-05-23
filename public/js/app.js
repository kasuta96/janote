function checkDelete() {
    if (window.confirm('削除してよろしいですか？')) {
        return true;
    } else {
        return false;
    }
}

var sidebarToggle = document.getElementById('sidebar-toggle');
var wrapper = document.getElementById('app');
sidebarToggle.addEventListener('click', function(e) {
    e.preventDefault();
    wrapper.classList.toggle('toggled');
});