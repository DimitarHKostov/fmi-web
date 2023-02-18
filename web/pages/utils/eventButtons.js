function createEventButton(event, status) {
    var button = document.createElement("button");
    button.innerHTML = event.name;
    button = applyStyling(button);
    button.onclick = function() {
        let div = createPopUp(formatEventInfo(event), "", "pop-up");
        div = adjust(div);
        
        if(status === "my") {
            div.appendChild(produceAddParticipantField(event));
            div.appendChild(produceRemoveParticipantField(event));
        }

        div.appendChild(produceViewParticipantsButton(event));
        document.body.appendChild(div);
    };

    return button;
}

function produceAddParticipantField(event) {
    let div = document.createElement("div");

    div.style.display = "flex";
    div.style.flexDirection = "row";
    div.style.alignItems = "center";
    div.style.justifyContent = "space-around";
    div.style.width = "100%";
    div.style.height = "50%";

    div.appendChild(produceInput());
    div.appendChild(produceButton(event));
    return div;
}

function produceRemoveParticipantField(event) {
    let div = document.createElement("div");

    div.style.display = "flex";
    div.style.flexDirection = "row";
    div.style.alignItems = "center";
    div.style.justifyContent = "space-around";
    div.style.width = "100%";
    div.style.height = "50%";

    div.appendChild(produceRemoveInput());
    div.appendChild(produceRemoveButton(event));
    return div;
}

function produceRemoveInput() {
    let input = document.createElement("input");
    input.type = "text";
    input.id = "input-remove";
    input.style.width = "50%";
    input.style.height = "30%";
    input.placeholder = "participant to remove(email)"

    return input;
}

function produceRemoveButton(event) {
    let button = document.createElement("button");
    button.style.width = "20%";
    button.style.height = "30%";
    button.style.background = "linear-gradient(to right, green, blue)";
    button.style.font = "100%";
    button.style.color = "white";
    button.style.borderRadius = "2px solid black";
    button.onclick = function() {
        let email = document.getElementById("input-remove");

        const object = {
            email: email.value,
            eventId: event.id
        };

        fetch("../../api/participant.php", {
            method: "DELETE",
            credentials: 'include',
            headers: {
              "Content-Type": "application/json"
            },
            body: JSON.stringify(object)
              }).then(r => {
                let input = document.getElementById("input-remove");
                input.value = "";
                if (r.status === 200) {
                    document.body.appendChild(createPopUp("Success.", "", "pop-up-info"));
                } else if(r.status === 401) {
                    document.body.appendChild(createPopUp("Unauthorized", "", "pop-up-info"));
                } else if(r.status === 500) {
                    document.body.appendChild(createPopUp("Internal server error. Please refresh the page and try again.", "", "pop-up-info"));
                } else if(r.status === 422) {
                    document.body.appendChild(createPopUp("Please check the documentation about this field.", "", "pop-up-info"));
                }
              }).catch(e => {
                  console.log(e);
                  document.body.appendChild(createPopUp("Something went wrong. Please refresh the page.", "", "pop-up-info"));
              })
    }

    button.innerHTML = "Remove";

    return button;
}

function produceInput() {
    let input = document.createElement("input");
    input.type = "text";
    input.id = "input";
    input.style.width = "50%";
    input.style.height = "30%";
    input.placeholder = "participant to add(email)"

    return input;
}

function produceButton(event) {
    let button = document.createElement("button");
    button.style.width = "20%";
    button.style.height = "30%";
    button.style.background = "linear-gradient(to right, green, blue)";
    button.style.font = "100%";
    button.style.color = "white";
    button.style.borderRadius = "2px solid black";
    button.onclick = function() {
        let email = document.getElementById("input");

        const object = {
            email: email.value,
            eventId: event.id
        };

        fetch("../../api/participant.php", {
            method: "POST",
            credentials: 'include',
            headers: {
              "Content-Type": "application/json"
            },
            body: JSON.stringify(object)
              }).then(r => {
                let input = document.getElementById("input");
                input.value = "";
                if (r.status === 200) {
                    document.body.appendChild(createPopUp("Success.", "", "pop-up-info"));
                } else if(r.status === 401) {
                    document.body.appendChild(createPopUp("Unauthorized", "", "pop-up-info"));
                } else if(r.status === 500) {
                    document.body.appendChild(createPopUp("Internal server error. Please refresh the page and try again.", "", "pop-up-info"));
                } else if(r.status === 422) {
                    document.body.appendChild(createPopUp("Please check the documentation about this field.", "", "pop-up-info"));
                }
              }).catch(e => {
                  console.log(e);
                  document.body.appendChild(createPopUp("Something went wrong. Please refresh the page.", "", "pop-up-info"));
              })
    }

    button.innerHTML = "Add";

    return button;
}

function produceViewParticipantsButton(event) {
    var viewParticipantButton = document.createElement("button");
    viewParticipantButton.innerHTML = "Click to view participants";
    viewParticipantButton.classList.add("view-participants-button");

    viewParticipantButton.onclick = function() {
        getParticipants(event);
    }

    return viewParticipantButton;
}

function getParticipants(event) {
    fetch(`../../api/participant.php?eventId=${event.id}`, {
        method: "GET",
        credentials: 'include',
        headers: {
          "Content-Type": "application/json"
        }
          }).then(r => r.text())
          .then(r => {
            document.body.appendChild(createPopUp(formatParticipants(r), "", "pop-up-info"));
          })
          .catch(e => {
              console.log(e);
              document.body.appendChild(createPopUp("Something went wrong. Please refresh the page.", "", "pop-up-info"));
          })
}

function formatParticipants(participantsArrayStr) {
    let arr = JSON.parse(participantsArrayStr);
    let result = "";

    for(let i = 0; i < arr.length; i++) {
        result += "<br>"
        result += arr[i]['userEmail'];
        if(i != arr.length - 1) {
            result += '\n';
        }
        result += "</br>"
    }

    return result;
}

function produceAddParticipantButton(event) {
    var addParticipantButton = document.createElement("button");
    addParticipantButton.innerHTML = "Click to add participant";
    addParticipantButton.classList.add("add-participant-button");

    addParticipantButton.onclick = function() {
        let div = createPopUp("add", "", "pop-up-child-add");
        div.style.marginLeft = "30%";
        div.style.marginTop = "20%";
        document.body.appendChild(div);
    }

    return addParticipantButton;
}

function formatEventInfo(event) {
    let name = event.name;
    let iban = event.iban;
    let description = event.description;
    let beneficier = event.beneficier;

    return `<br> name: ${name} </br>` + `<br> IBAN: ${iban} </br>` + `<br> Description: ${description} </br>` + `<br> Beneficier: ${beneficier} </br>`;
}

function adjust(div) {
    div = adjustSize(div);

    return div;
}

function adjustSize(div) {
    div.style.height = "70%";
    div.style.width = "50%";
    div.style.display = "flex";
    div.style.flexDirection = "column";
    div.style.alignItems = "center";
    div.style.justifyContent = "space-around";

    return div;
}

function applyStyling(button) {
    button.style.width = "50%";
    button.style.height = "7%";
    button.style.borderRadius = "10%";
    button.style.fontSize = "100%";
    button.style.color = "white";
    button.style.background = "linear-gradient(to right, green, blue)";
    button.style.border = "2px solid black";

    return button;
}

