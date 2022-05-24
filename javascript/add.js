var searchbtn = document.getElementById("add_btn_klass");
var joinbtn = document.getElementById("join_btn_klass");
const isEmpty = str => !str.trim().length;

document.getElementById("gruppid").addEventListener("input", function() {if(isEmpty(this.value)){
    joinbtn.disabled=true;
} else {
    joinbtn.disabled=false;
}
});

document.getElementById("gruppnamn").addEventListener("input", function() {
if(isEmpty(this.value)){
    searchbtn.disabled=true;
} else {
    searchbtn.disabled=false;
}
});




