function checkDelete() {
    if (window.confirm("削除してよろしいですか？")) {
        return true;
    } else {
        return false;
    }
}
// Sidebar
var sidebarToggle = document.getElementById("sidebar-toggle");
var wrapper = document.getElementById("app");
sidebarToggle.addEventListener("click", function (e) {
    e.preventDefault();
    wrapper.classList.toggle("toggled");
});

// Feather icons
feather.replace();

function checkboxToggle(e) {
    var input = e.getElementsByTagName("input")[0];
    var label = e.getElementsByTagName("label")[0];
    if (input.checked == true) {
        input.checked = false;
        label.classList.remove("bg-info");
        label.classList.add("bg-secondary");
    } else {
        input.checked = true;
        label.classList.remove("bg-secondary");
        label.classList.add("bg-info");
    }
}
// auto resize textarea
function autoGrow(e) {
    e.style.height = "auto";
    e.style.height = e.scrollHeight + 2 + "px";
}

// show fcard conntent
function showFcards(target) {
    $(target).collapse("show");
}
// hide fcard conntent
function hideFcards(target) {
    $(target).collapse("hide");
}
// studied
function studied(e) {
    let id = e.getAttribute('data-id');
    let eOld = e.innerHTML;
    e.innerHTML = '<div class="spinner-border spinner-border-sm"></div>';
    // axios
    let btn = e;
    axios
        .get("/studied", {
            params: {
                id: id,
            },
        })
        .then(function (response) {
            btn.innerHTML = eOld;
            if (response.data.status == 'studied') {
                console.log(id+':studied');
                btn.classList.remove('btn-light');
                btn.classList.add('btn-primary');
            }
            else if (response.data.status == 'studying') {
                console.log(id+':studying');
                btn.classList.add('btn-light');
                btn.classList.remove('btn-primary');
            }
            else if (response.data.status == 'error') {
                console.log(response.data.msg);
            }
        })
        .catch(function (error) {
            console.log(error.data);
        })
        .then(function () {
            // always executed
        });
}
