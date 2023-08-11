
function ValidateEmail(inputText){
    const mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if(!inputText.match(mailformat)){
        document.getElementById("usernameError").style.display = "block";
        return false;
    }
    else{
        document.getElementById("usernameError").style.display = "none";
        return true;
    }

}