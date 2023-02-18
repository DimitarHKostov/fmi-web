const logOutBtn = document.getElementById('logout-btn');
const deleteUserBtn = document.getElementById('delete-btn');

logOutBtn.addEventListener('click', () => {
    fetch("../../api/logout.php", {
        method: "GET",
        credentials: 'include'
    }).then(r => {
        if(r.status === 200) {
            document.body.appendChild(createPopUp("Logout successful. You will be redirected to home page.", "../home/index.php"));
        }
    }).catch(e => {
        document.body.appendChild(createPopUp("Something went wrong. Please refresh the page.", ""));
        console.log(e);
    })
})

deleteUserBtn.addEventListener('click', () => {
    const email = document.getElementById("email");

    const object = {
        email: email.value
    };
  
    fetch("../../api/remove_user.php", {
    method: "DELETE",
    credentials: 'include',
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify(object)
      }).then(r => r.text())
      .then(r => {
        document.body.appendChild(createPopUp(r, "", "pop-up"));
      })
      .catch(e => {
          console.log(e);
          document.body.appendChild(createPopUp("Something went wrong. Please refresh the page.", "", "pop-up"));
      })
  })