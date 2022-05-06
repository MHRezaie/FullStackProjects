 'use strict'
const navLinks=document.querySelectorAll('.nav-link a');



navLinks.forEach(function(ele){
    console.log(ele.getAttribute('href  '));
});