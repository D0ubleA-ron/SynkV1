function passwordmatch(){
    const password = document.getElementById("password").value
    const passwordmatch = document.getElementById("passwordretest").value
    if(password.match(passwordmatch)){
        return true;
    }
    else{
        return false;
    }
}
function ValidateEmail(inputText){
    const mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if(!inputText.match(mailformat)){
        document.getElementById("usernameError").style.display = "block";
        return false;
    }
    else if(!passwordmatch()){
        document.getElementById("usernameError").style.display = "none";
        document.getElementById("passwordError").style.display = "block";
        return false;
    }
    else if(document.getElementById("file").value === ""){
        document.getElementById("usernameError").style.display = "none";
        document.getElementById("passwordError").style.display = "none";
        document.getElementById("photoError").style.display = "block";
        return false;
    }
    else
    {
        document.getElementById("usernameError").style.display = "none";
        document.getElementById("passwordError").style.display = "none";
        return true;
    }


}
