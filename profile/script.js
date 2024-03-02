var inputs = document.getElementsByTagName('input')
var textareas = document.getElementsByTagName('textarea')

const editBtn = (btn1,btn2,btn3_state,bool) => {
    document.getElementById(btn1).style.display = "block";
    document.getElementById(btn2).style.display = "none";
    document.getElementById("addBtn").style.display = btn3_state;

    for(var i=0; i < inputs.length; i++) {
        inputs[i].disabled = bool;
    }
    for(var i=0; i < textareas.length; i++) {
        textareas[i].disabled = bool;
    }}

const addNew = (inputType, description) => {
    var newInput = document.createElement("input");
    newInput.type = inputType;
    newInput.value = description;
    document.getElementById("bio").appendChild(newInput)    
}



//opt.value == 1 ? opt.style.color = "blue" : opt.style.color = "red"