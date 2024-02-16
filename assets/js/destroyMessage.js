function destroyMessage(element) {
    message = [...document.getElementsByClassName("message")];
    if(message.length > 0) {
        message.forEach(element => element.style.display = `none`);
    }
}

function fadeOutMessage() {
    message = [...document.getElementsByClassName("message")];
    if(message.length > 0) {
        message.forEach(element => {
            element.classList.add('fadeout');
            setTimeout(destroyMessage, 900);
        });
    }
}
setTimeout(fadeOutMessage, 3000);
