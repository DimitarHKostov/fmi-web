const btn = document.getElementById('login-btn');

const inputObjectTemplate = {
  username: "username",
  password: "password"
};

btn.addEventListener('click', () => {
  const username = document.getElementById(inputObjectTemplate.username);
  const password = document.getElementById(inputObjectTemplate.password);

  const user = {
      username: username.value,
      password: password.value
  };

  fetch("../../api/login.php", {
  method: "POST",
  credentials: 'include',
  headers: {
    "Content-Type": "application/json"
  },
  body: JSON.stringify(user)
    }).then(r => {
        return r.text();
    })
    .then(r => {
        if (r === "Success.") {
            document.body.appendChild(createPopUp(r, "../middle/index.php", "pop-up"));
        } else {
            document.body.appendChild(createPopUp(r, "", "pop-up"));
        }
    })
    .catch(e => {
        console.log(e);
        document.body.appendChild(createPopUp("Something went wrong. Please refresh the page.", "", "pop-up"));
    })
})