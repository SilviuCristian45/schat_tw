/* Script pt. care */
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
    $.post("../server/senddm.php",//exact ca metoda de mai sus dar cu jquery
        {
            message: $("textarea").val(),//punem mesajul scris in textarea 
            //incarcam data si ora la care a fost trimis 
            timestampp: new Date().toISOString().slice(0, 19).replace('T', ' '),
            new_user: userto
        }
    ,function (data) {
        //$("#mesaj").text(data);//punem in pagina raspunsul de la server
        $("textarea").val("");//golim textarea-ul

        document.querySelector("#sendbtn").disabled = true;//disable la buton pt 2 secunde ca sa nu se faca spam
        setTimeout( () => {
             document.querySelector("#sendbtn").disabled = false;//peste 2 sec. dam enable la buton
        }, 2000);
    });
});