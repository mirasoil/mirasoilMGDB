
function openModal() {
    document.getElementById("myModal").style.display = "block";
  }
  
  function closeModal() {
    document.getElementById("myModal").style.display = "none";
  }
  
  var slideIndex = 1;
  showSlides(slideIndex);
  
  function plusSlides(n) {
    showSlides(slideIndex += n);
  }
  
  function currentSlide(n) {
    showSlides(slideIndex = n);
  }
  
  function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("demo");
    var captionText = document.getElementById("caption");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
    captionText.innerHTML = dots[slideIndex-1].alt;
  }
  
  /*Animatie titlu*/
  // anime.timeline({loop: true})
  //   .add({
  //     targets: '.ml5 .line',
  //     opacity: [0.5,1],
  //     scaleX: [0, 1],
  //     easing: "easeInOutExpo",
  //     duration: 700
  //   }).add({
  //     targets: '.ml5 .line',
  //     duration: 600,
  //     easing: "easeOutExpo",
  //     translateY: (el, i) => (-0.625 + 0.625*2*i) + "em"
  //   }).add({
  //     targets: '.ml5 .ampersand',
  //     opacity: [0,1],
  //     scaleY: [0.5, 1],
  //     easing: "easeOutExpo",
  //     duration: 600,
  //     offset: '-=600'
  //   }).add({
  //     targets: '.ml5 .letters-left',
  //     opacity: [0,1],
  //     translateX: ["0.5em", 0],
  //     easing: "easeOutExpo",
  //     duration: 600,
  //     offset: '-=300'
  //   }).add({
  //     targets: '.ml5 .letters-right',
  //     opacity: [0,1],
  //     translateX: ["-0.5em", 0],
  //     easing: "easeOutExpo",
  //     duration: 600,
  //     offset: '-=600'
  //   }).add({
  //     targets: '.ml5',
  //     opacity: 0,
  //     duration: 1000,
  //     easing: "easeOutExpo",
  //     delay: 1000
  //   });