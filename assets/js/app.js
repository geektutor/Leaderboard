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

//remove WYSIWYG inline styling
var notice = Array.from(document.getElementsByClassName("notice"))
if (notice.length > 0) {
 notice.forEach(function(a){
    Array.from(a.children).forEach(function (e) {
      e.removeAttribute("style");
      if (e.firstElementChild) {
        Array.from(e.children).forEach(function (c) {
          c.removeAttribute("style");
          if (c.firstElementChild) {
            Array.from(c.children).forEach(function (d) {
              d.removeAttribute("style");
            });
          }
        });
      }
    });
})  
}
/* window.onresize = resizeEvent;
 resizeEvent() */
