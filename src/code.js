let menuButton;

const listenToButtonMenuButton = () => {
  menuButton.addEventListener('click', function(){
    let menu = document.querySelector('.js-user-menu');
    if(menuButton.dataset.hidden == "false"){
      menuButton.setAttribute('data-hidden', "true");
      menu.style.visibility = "visible";
    } else {
      menuButton.setAttribute('data-hidden', "false");
      menu.style.visibility = "hidden";
    }
  })
} // Still doesnt work

const init = function(){
  console.log('loaded');
  menuButton = document.querySelector('.js-user-menu-button');
  listenToButtonMenuButton();
};

document.addEventListener('DOMContentLoaded', init);