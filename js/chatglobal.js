let chatbox = document.getElementById("chatsection"); 

//repetam acest request la fiecare 5 secunde si luam asincron din baza de date mesajele 
setInterval( () => {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {//la terminarea request-ului asignam functia aceasta
        if (this.readyState == 4 && this.status == 200) {//daca avem ok-ul de la server ca s-a primit request-ul
            chatbox.innerHTML = this.response;//punem raspunsul (lista de mesaje) in chatbox
        }
    };
    xhttp.open("GET", "server/messages.php", true);//deschidem request-ul 
    xhttp.send();//trimitem request-ul la server
} , 5000)

//request la click pe butonul send prin care inseram mesajul in baza de date 
$("button").click(function(){
    let dataToSend = new FormData();
    let imageData = $("#imagefile").prop('files')[0];

    //completez formularul "imaginar"
    dataToSend.append('message', $("textarea").val() );
    dataToSend.append('timestampp', new Date().toISOString().slice(0, 19).replace('T', ' '));
    dataToSend.append('fileToUpload', imageData);

    //trimitem request-ul 
    $.ajax({
        url: 'server/sendmessage.php', // point to server-side PHP script 
        cache: false,
        contentType: false,
        processData: false,
        data: dataToSend,                         
        type: 'post'
     });

}); 

