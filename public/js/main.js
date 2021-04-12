// NavBar Toggle Controls
(function () {
    $('#sidebarCollapse').on('click', function () {
      $('#sidebar').toggleClass('active');
      $(this).toggleClass('active');
    });
  });
(function () {
    $('#sidebarCollapseRight').on('click', function () {
      $('#sidebar-right').toggleClass('active');
      $(this).toggleClass('active');
    });
  });
  // Load Facebook SDK for JavaScript
  window.fbAsyncInit = function() {
    FB.init({
    xfbml            : true,
    version          : 'v7.0'
    });
  };
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

/* Set the width of the sidebar to 250px and the left margin of the page content to 250px */
  function openNav() {
    
    document.getElementById("mySidebar").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
  
  
  }
  
  /* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
  function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
  }
  
  function openNavRight() {
    
    document.getElementById("mySidebar1").style.width = "250px";
    document.getElementById("main1").style.marginRight = "250px";
  
  
  }
  
  /* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
  function closeNavRight() {
    document.getElementById("mySidebar1").style.width = "0";
    document.getElementById("main1").style.marginRight = "0";
  }
  
let show = () => {
  let homeSubmenu = document.getElementById('homeSubmenu');
  let collapse = homeSubmenu.previousElementSibling;
  if (collapse.getAttribute('aria-expanded') === 'true') {
    collapse.setAttribute('aria-expanded', 'false');
  } 
}
  show();

  // let homeSubmenu = document.getElementById('homeSubmenu');
  // let collapse = homeSubmenu.previousElementSibling;
  // collapse.addEventListener("click", function() {
  //   if (collapse.getAttribute('aria-expanded') === 'true') {
  //     collapse.setAttribute('aria-expanded', 'false');
  //   }
  //   // if(document.getElementById("#homeSubmenu").classList.contains("show")) {
  //   //   document.getElementById("#homeSubmenu").classList.remove('show');
  //   // }
  //   document.querySelector("#homeSubmenu").classList.toggle('show', false);
  //   this.removeEventListener('click', this);
  // })


  function myCollapseFunction() {
    var x = document.getElementById("homeSubmenuActivator").getAttribute("aria-expanded"); 
    if (x == "true") 
    {
    x = "false"
    } else {
    x = "true"
    }
    document.getElementById("homeSubmenuActivator").setAttribute("aria-expanded", x);
    document.getElementById("homeSubmenu").classList.remove('show');
    }
  /*
  // Get the modal
  var modal = document.getElementById("nav-bar");
  
  // Get the button that opens the modal
  var btn = document.getElementsByClassName("navbar-toggler");
  
  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];
  
  // When the user clicks on the button, open the modal
  btn.onclick = function() {
    modal.style.display = "block";
  }
  
  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  }
  
  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
  */
  

  