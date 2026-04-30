var previousCardElement = "";
var currentRecipe;
    
function toggleFlip(element) {
    if (previousCardElement !='') previousCardElement.classList.remove("is-flipped");
    if (previousCardElement != element){ 
        element.classList.toggle('is-flipped');
        previousCardElement = element
    }else{
        previousCardElement = ""
    }
    }


function handleButtonClick(event) {
    alert('k')
    event.stopPropagation();
}

function viewRecipeDetails(event,id){
    event.stopPropagation();
window.location.href = window.location.href = "recipe.php?id="+id;
}

function deleteRecipe(event,id){
    event.stopPropagation();
    if (confirm("Are you sure to delete this recipe?")){
        window.location.href = "deleteRecipe.php?id="+id;
    };
}


function removeSavedRecipe(event,userid,recipeid){
    event.stopPropagation();
    if (confirm("Are you sure to remove this recipe?")){
        window.location.href = "removeSavedRecipe.php?userid="+userid+"&recipeid="+recipeid;
    }
}


function openModal(){
    document.getElementById('backdrop').style.display="block"
    document.getElementById('newRecipeModal').classList.toggle("hideModal")
}


function closeModal(){
    document.getElementById('backdrop').style.display="none"
    document.getElementById('newRecipeModal').classList.toggle("hideModal")
}


function openModifyModal(event,id){
    event.stopPropagation();
    
    document.getElementById('recipeId').value=id
    document.getElementById('backdrop').style.display="block"
    document.getElementById('modifyModal').classList.toggle("hideModal")

    document.getElementById('recipeCurrentTitle').value = document.getElementById('r'+id).getAttribute("title")
    document.getElementById('recipeCurrentDifficulty').value = document.getElementById('r'+id).getAttribute("difficulty")
    document.getElementById('recipeCurrentDescription').value = document.getElementById('r'+id).getAttribute("description")
    document.getElementById('recipeCurrentSteps').value = document.getElementById('r'+id).getAttribute("steps")
    document.getElementById('recipeCurrentTime').value = document.getElementById('r'+id).getAttribute("time")
    if (document.getElementById('r'+id).getAttribute("isPublic") == "1"){
        document.getElementById('pubCheck').checked = true
    }else{
        document.getElementById('publicCheck').checked = true
    }
}

function closeModifyModal(){
    document.getElementById('backdrop').style.display="none"
    document.getElementById('modifyModal').classList.toggle('hideModal')
}

function updateRecipe(){
    console.log("update Recipe")
}


function addSavedRecipe(event,userid,recipeid){
    event.stopPropagation();
    if (confirm("Are you sure to save this recipe?")){
        window.location.href = "addSavedRecipe.php?userid="+userid+"&recipeid="+recipeid;
    }
}


function check(){
    if (document.getElementById('title').value ==""){
        alert("Invalid recipe title");
        return false
    }
    if (document.getElementById('description').value ==""){
        alert("Invalid recipe description");
        return false
    }
    if (document.getElementById('steps').value ==""){
        alert("Invalid recipe steps");
        return false
    }
    if (document.getElementById('time').value =="" || document.getElementById('time').value<1){
        alert("Invalid recipe time");
        return false
    }
}


function check2(){
    if (document.getElementById('recipeCurrentTitle').value ==""){
        alert("Invalid recipe title");
        return false
    }
    if (document.getElementById('recipeCurrentDescription').value ==""){
        alert("Invalid recipe description");
        return false
    }
    if (document.getElementById('recipeCurrentSteps').value ==""){
        alert("Invalid recipe steps");
        return false
    }
    if (document.getElementById('recipeCurrentTime').value =="" || document.getElementById('recipeCurrentTime').value<1){
        alert("Invalid recipe time");
        return false
    }
}