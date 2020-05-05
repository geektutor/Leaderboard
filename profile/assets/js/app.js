var hamBurger = document.getElementById("hamB");
var navPane = document.getElementById("navPane");

hamBurger.addEventListener("click", function(){
 if(navPane.classList.contains("closed")){
  navPane.classList.remove("closed");
  hamBurger.classList.remove("closed")
  navPane.classList.add("open")
  hamBurger.classList.add("open")
 }
 else if(navPane.classList.contains("open")){
  navPane.classList.remove("open");
  hamBurger.classList.remove("open");
  navPane.classList.add("closed");
  hamBurger.classList.add("closed");
 }
})
navPane.addEventListener("click", function(e){
 if(e.target.tagName == "LI") {
  window.location.href = e.target.children[1].href
 }
})
function resizeEvent () {
document.getElementById("mainWrp").style.height = navPane.offsetHeight + "px"
}
Array.from(document.getElementsByClassName("dismiss")).forEach(function(elm){
 elm.addEventListener("click", function(e){
  e.target.parentElement.remove()
 })
})
window.onresize = resizeEvent;
resizeEvent()
