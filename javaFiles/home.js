function hideSubMenu (){
    document.getElementById('subMenu').style.visibility = "hidden";
}

function subMenuSH (){
    var r = window.getComputedStyle(document.getElementById('subMenu'));
    if( r.visibility == "hidden") {
        document.getElementById('subMenu').style.visibility = "visible";
    }
   else if(r.visibility  == "visible") {
        document.getElementById('subMenu').style.visibility = "hidden";
    }

}