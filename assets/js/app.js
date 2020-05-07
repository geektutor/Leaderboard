var hamBurger = document.getElementById("hamburger");
var navPane = document.getElementById("navPane");

hamBurger.addEventListener("click", function(){
 navPane.classList.toggle("open") 
})

navPane.addEventListener("click", function(e){ 
 if(e.target.tagName == "LI") {
  window.location.href = e.target.children[1].href
 }
})

Array.from(document.getElementsByClassName("dismiss")).forEach(function(elm){
 elm.addEventListener("click", function(e){
  e.target.parentElement.remove()
 })
})
// window.onresize = resizeEvent;
// resizeEvent()