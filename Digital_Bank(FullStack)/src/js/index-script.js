 'use strict'
 const btnShowModal=document.querySelectorAll('.show-modal');
 const signupModal=document.querySelector('.modal__sign-up');
 const modalOverlay=document.querySelector('.overlay');
 const btnCloseModal=document.querySelector('.modal__sign-up--btn-close');


 btnShowModal.forEach(function(ele){
    ele.addEventListener('click',function(ev){
        signupModal.classList.remove('hidden');
        modalOverlay.classList.remove('hidden');

    });
 });
 btnCloseModal.addEventListener('click',function(e){
    signupModal.classList.add('hidden');
        modalOverlay.classList.add('hidden');
 });
