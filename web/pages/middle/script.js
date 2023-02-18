const logOutBtn = document.getElementById('logout-btn');
const viewBtn = document.getElementById('view-btn');
const createBtn = document.getElementById('create-btn');
const adminUiBtn = document.getElementById('adminui-btn');

viewBtn.addEventListener('click', () => {
    window.location = "../view-middle/index.php";
});
  
createBtn.addEventListener('click', () => {
    window.location = "../create/index.php";
});


if(adminUiBtn !== null) {
    adminUiBtn.addEventListener('click', () => {
        window.location = "../adminui-middle/index.php";
    });
}

logOutBtn.addEventListener('click', () => {
    fetch("../../api/logout.php", {
        method: "GET",
        credentials: 'include'
    }).then(r => {
        if(r.status === 200) {
            document.body.appendChild(createPopUp("Logout successful. You will be redirected to home page.", "../home/index.php", "pop-up"));
        }
    }).catch(e => {
        console.log(e);
        document.body.appendChild(createPopUp("Something went wrong. Please refresh the page.", "", "pop-up"));
    })
})