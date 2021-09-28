// C-pannel JavaScript Code Starts From Here
//******************************************/
//*********************************************
// Site Header JavaScript Code Starts From Here
//*********************************************
// Profile Details Show Here 
let profileTag = document.getElementById("profileDet");
let detailsModal = document.getElementById("profileModal");
profileTag.addEventListener("click", function(){
    detailsModal.style.display = "block";
});

// Profile Details Hide 
let crossModal = document.getElementById("crossModal");

crossModal.addEventListener("click", function(){
    detailsModal.style.display = "none";
});

// Header Content Toggle Show And Hide Using Menu Bar

// Header Content Show Here 
let menuBar = document.getElementById("menu-bars");
let headerContent = document.getElementById("headerContent");

// Header Content Hide Here 
let contetntHideBtn = document.getElementById("menu-barsCross");

// Header Content Show Code Here
menuBar.addEventListener("click", function(){
    headerContent.style.display = "block";
    menuBar.style.display = "none";
    contetntHideBtn.setAttribute("id", "menu-barsCross2");
    contetntHideBtn.style.display = "block";
    // Main content width return in initial
    let mainContent = document.getElementsByClassName("main");
    mainContent.removeAttribute("id", "main");
});

// Header Content hide Code Here 
contetntHideBtn.addEventListener("click", function(){
    headerContent.style.display = "none";
    contetntHideBtn.style.display = "none";
    menuBar.style.display = 'block';
    // Main content width make 100% 
    let mainContent = document.getElementsByClassName("main");
    mainContent.setAttribute("id", "main");
});

//*********************************************
// Site Header JavaScript Code Ends To Here
//*********************************************