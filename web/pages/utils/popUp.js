function createPopUp(message, location, id) {
    var parentDiv = createParentDiv(id);
    parentDiv.appendChild(createChildDivUp(location, id));
    parentDiv.appendChild(createChildDivDown(message));

    return parentDiv;
}

function createParentDiv(id) {
    var parentDiv = document.createElement("div");
    parentDiv.style.background = "linear-gradient(to right, blue, green)";
    parentDiv.style.position = "absolute";
    parentDiv.style.border = "2px solid black";
    parentDiv.style.width = "550px";
    parentDiv.style.height = "350px";
    parentDiv.style.marginLeft = "25%";
    parentDiv.style.marginTop = "10%";
    parentDiv.style.display = "flex";
    parentDiv.style.flexDirection = "column";
    parentDiv.style.alignItems = "center";
    parentDiv.style.justifyContent = "center";
    parentDiv.id = id;
    return parentDiv;
}

function createChildDivUp(location, id) {
    var div = document.createElement("div");
    div.style.width = "100%";
    div.style.height = "15%";
    div.style.display = "flex";
    div.style.flexDirection = "column";
    div.style.justifyContent = "center";
    div.style.alignItems = "flex-end";
    div.appendChild(createCloseButton(location, id));
    return div;
}

function createCloseButton(location, id) {
    var button = document.createElement("button");
    button.style.width = "30%";
    button.style.height = "100%";
    button.innerHTML = "Close";
    button.style.background = "linear-gradient(to right, green, blue)";
    button.style.fontSize = "20px";
    button.style.color = "white";
    button.style.borderRadius = "5%";
    button.onclick = function() {
        var element = document.getElementById(id);
        element.parentNode.removeChild(element);
        if(location !== "") {
            window.location = location;
        }
    };
    return button;
}

function createChildDivDown(message) {
    var div = document.createElement("div");
    div.style.width = "100%";
    div.style.height = "80%";
    div.style.display = "flex";
    div.style.alignItems = "center";
    div.style.justifyContent = "center";
    div.style.flexDirection = "column";
    div.style.fontSize = "25px";
    div.style.color = "white";
    div.innerHTML = message;
    div.id = "down";
    return div;
}