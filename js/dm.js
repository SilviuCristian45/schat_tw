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
}, 5000);