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

function view() {
    fetch("../../api/view-my.php", {
    method: "GET",
    credentials: 'include',
    headers: {
        "Content-Type": "application/json"
    }
    }).then(r => r.text())
    .then(r => {
        var events = JSON.parse(r);
        for(let event of events) {
            var container = document.querySelector(".main-lower");
            container.appendChild(createEventButton(event, "my"));
        }
    })
    .catch(e => {
        console.log(e);
        document.body.appendChild(createPopUp("Something went wrong. Please refresh the page and try again.", "", "pop-up"));
    })
}

view();