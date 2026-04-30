function register(){
    if (document.getElementById('email').value == ""){
        alert("Enter email address")
        return false
    }
    if (document.getElementById('password') == ''){
        alert("Invalid Password")
        return false
    }
    if (document.getElementById("password").value != document.getElementById('cpassword').value ){
        alert("Password mismatch")
        return false
    }
}


function login(){
    if (document.getElementById('email').value == ""){
        alert("Enter email address")
        return false
    }
    if (document.getElementById('password') == ''){
        alert("Invalid Password")
        return false
    }
}

function logout(){
    window.location.href = "index.php";
}

function openModal(){
    document.getElementById('backdrop').style.display="block"
    document.getElementById('displayNameModal').classList.toggle("hideModal")
    document.getElementById('displayName').value = document.getElementById('dn').getAttribute('displayName')
}


function closeModal(){
    document.getElementById('backdrop').style.display="none"
    document.getElementById('displayNameModal').classList.toggle("hideModal")
}


currentUser = "";
function openAdminModal(id){
    document.getElementById('backdrop').style.display="block"
    document.getElementById('displayNameModal').classList.toggle("hideModal")
    document.getElementById('displayName').value = document.getElementById('l'+id).getAttribute('displayName')
    currentUser = id
}

function updateUser(){
    if (document.getElementById('displayName').value == ""){
        alert("Enter a displayName")
        return false
    }
    if (currentUser != ""){
        window.location.href = "updateDisplayNameByAdmin.php?userID="+currentUser+"&displayName="+document.getElementById('displayName').value;
    }
    
}

function deleteUser(id){
    if (confirm("Are you sure to delete this user?")){
        window.location.href = "deleteUser.php?id="+id;
    };
}