const logOutBtn = document.getElementById('logout-btn');

logOutBtn.addEventListener('click', () => {
    fetch("../../api/logout.php", {
        method: "GET",
        credentials: 'include'
    }).then(r => {
        if(r.status === 200) {
            document.body.appendChild(createPopUp("Logout successful. You will be redirected to home page.", "../home/index.php", "pop-up"));
        }
    }).catch(e => {
        document.body.appendChild(createPopUp("Something went wrong. Please refresh the page.", "", "pop-up"));
        console.log(e);
    })
})