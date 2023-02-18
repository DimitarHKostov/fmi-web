const logOutBtn = document.getElementById('logout-btn');

logOutBtn.addEventListener('click', () => {
    fetch("../../api/logout.php", {
        method: "GET",
        credentials: 'include'
    }).then(r => {
        return r.text();
    })
    .then(r => {
        document.body.appendChild(createPopUp(r, "", "pop-up"));
    })
    .catch(e => {
        document.body.appendChild(createPopUp("Something went wrong. Please refresh the page.", ""));
        console.log(e);
    })
})