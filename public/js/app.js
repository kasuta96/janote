function checkDelete() {
    if (window.confirm('削除してよろしいですか？')) {
        return true;
    } else {
        return false;
    }
}
// Sidebar
var sidebarToggle = document.getElementById('sidebar-toggle');
var wrapper = document.getElementById('app');
sidebarToggle.addEventListener('click', function(e) {
    e.preventDefault();
    wrapper.classList.toggle('toggled');
});

// Feather icons
feather.replace();

function checkboxToggle(e) {
    var input = e.getElementsByTagName('input')[0];
    var label = e.getElementsByTagName('label')[0];
    if (input.checked == true) {
        input.checked = false;
        label.classList.remove('bg-info');
        label.classList.add('bg-secondary');
    } else {
        input.checked = true;
        label.classList.remove('bg-secondary');
        label.classList.add('bg-info');
    }
}