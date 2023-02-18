const logOutBtn = document.getElementById('logout-btn');
const createBtn = document.getElementById('create-btn');
const failMessage = "Creation not successful. <br> Please check the documentation. </br>";

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

const inputObjectTemplate = {
    name: "name",
    beneficier: "beneficier",
    iban: "iban",
    description: "description"
};

createBtn.addEventListener('click', () => {
    const name = document.getElementById(inputObjectTemplate.name);
    const beneficier = document.getElementById(inputObjectTemplate.beneficier);
    const iban = document.getElementById(inputObjectTemplate.iban);
    const description = document.getElementById(inputObjectTemplate.description);

    const data = {
        name: name.value,
        beneficier: beneficier.value,
        iban: iban.value,
        description: description.value
    };

    fetch("../../api/create.php", {
        method: "POST",
        credentials: 'include',
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    }).then(r => r.text())
    .then(r => {
        document.body.appendChild(createPopUp(r, "", "pop-up"));
    })
    .catch(e => {
        document.body.appendChild(createPopUp("Something went wrong. Please refresh the page.", "", "pop-up"));
    })
})