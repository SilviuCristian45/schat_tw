console.log("chat global");
let chatbox = document.getElementById("chatsection"); 

setInterval( () => {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        // Typical action to be performed when the document is ready:
        chatbox.innerHTML = this.response;
    }
    };
    xhttp.open("GET", "server/messages.php", true);
    xhttp.send();
} , 5000)


