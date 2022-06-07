 'use strict'
 const btnShowModal=document.querySelectorAll('.show-modal');
 const signupModal=document.querySelector('.modal__sign-up');
 const loginModal=document.querySelector('.modal__login');
 const modalOverlay=document.querySelector('.overlay');
 const btnCloseModal=document.querySelector('.modal__sign-up--btn-close');
 const btnCloseLoginModal=document.querySelector('.modal__login--btn-close');
 const btnShowLoginModal=document.querySelector('.show__login--modal');


 function showModal(ev){
    ev.preventDefault();
    loginModal.classList.add('hidden');
    signupModal.classList.remove('hidden');
    modalOverlay.classList.remove('hidden');
 }
 function hideModal(){
    signupModal.classList.add('hidden');
    loginModal.classList.add('hidden');
    modalOverlay.classList.add('hidden');
}
function showLoginModal(ev){
   ev.preventDefault();
   modalOverlay.classList.remove('hidden');
   loginModal.classList.remove('hidden');
   signupModal.classList.add('hidden');
}

document. addEventListener('keydown', function(event){
    if(event. key === "Escape")
        hideModal();
});
 btnCloseModal.addEventListener('click',hideModal);
 btnShowModal.forEach(function(ele){
    ele.addEventListener('click',showModal,false);
 });
 btnCloseModal.addEventListener('click',hideModal);
 btnShowLoginModal.addEventListener('click',showLoginModal,false);
 btnCloseLoginModal.addEventListener('click',hideModal);