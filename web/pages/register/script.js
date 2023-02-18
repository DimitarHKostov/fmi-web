const btn = document.getElementById('register-btn');
const registrationFailMessage = "Registration not successful. <br> Please check the documentation. </br>";

const inputObjectTemplate = {
  username: "username",
  password: "password",
  firstName: "firstName",
  lastName: "lastName",
  email: "email"
};

btn.addEventListener('click', () => {
  const username = document.getElementById(inputObjectTemplate.username);
  const password = document.getElementById(inputObjectTemplate.password);
  const firstName = document.getElementById(inputObjectTemplate.firstName);
  const lastName = document.getElementById(inputObjectTemplate.lastName);
  const email = document.getElementById(inputObjectTemplate.email);

  const user = {
      username: username.value,
      password: password.value,
      firstName: firstName.value,
      lastName: lastName.value,
      email: email.value
  }

  fetch("../../api/register.php", {
  method: "POST",
  headers: {
    "Content-Type": "application/json"
  },
  body: JSON.stringify(user)
  }).then(r => r.text())
  .then(r => {
    document.body.appendChild(createPopUp(r, "", "pop-up"));
  })
  .catch(e => {
    console.log(e);
    document.body.appendChild(createPopUp("Something went wrong. Please refresh the page and try again.", "", "pop-up"));
  })
})
  