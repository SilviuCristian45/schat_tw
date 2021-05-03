/* In acest script ma ocup de trimiterea unui dm si update-ul casutei de dm corespunzatoare unui user*/

let userto = document.getElementById("ss").innerText;
console.log(userto);

setInterval(() => {
    console.log(userto);
    $.get("../server/dm.php",{
            userto:userto
        },
        function(data) {
            $("#chatsection").html(data);
        }
    ); 
    //document.getElementById("chatsection").scrollTop = document.getElementById("chatsection").scrollHeight;
}, 5000);

$("#sendbtn").click(function () { 
    console.log("click click");

    let dataToSend = new FormData();
    let imageData = $("#imagefile").prop('files')[0];

    //completez formularul "imaginar"
    dataToSend.append('message', $("textarea").val() );
    dataToSend.append('timestampp', new Date().toISOString().slice(0, 19).replace('T', ' '));
    dataToSend.append('fileToUpload', imageData);
    dataToSend.append('new_user', userto);

    //trimitem request-ul 
    $.ajax({
        url: '../server/senddm.php', // point to server-side PHP script 
        cache: false,
        contentType: false,
        processData: false,
        data: dataToSend,                         
        type: 'post',
        succes: function(){
            $("textarea").val("");//golim textarea-ul
            document.querySelector("#sendbtn").disabled = true;//disable la buton pt 2 secunde ca sa nu se faca spam
            setTimeout( () => {
                document.querySelector("#sendbtn").disabled = false;//peste 2 sec. dam enable la buton
            }, 2000);
        }
     });

});