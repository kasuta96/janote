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
// auto resize textarea
function autoGrow(e) {
    e.style.height = 'auto';
    e.style.height = (e.scrollHeight+2) + "px";
}

// show fcard conntent
function showFcards(target) {
    $(target).collapse('show');
}
// hide fcard conntent
function hideFcards(target) {
    $(target).collapse('hide');
}
// remembered
function remembered(id) {
    console.log(id);
}

// // axios
// axios.get('/user', {
//     params: {
//       ID: 12345
//     }
//   })
//   .then(function (response) {
//     console.log(response);
//   })
//   .catch(function (error) {
//     console.log(error);
//   })
//   .then(function () {
//     // always executed
//   });  