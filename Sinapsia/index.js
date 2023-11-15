const informacion = document.querySelector('.informacion');
const interrogationbtn = document.querySelector('.textbox');
const closeTab = document.querySelector('.icon-close');


interrogationbtn.addEventListener('click', () =>{
    informacion.classList.add('active-popup')
});

closeTab.addEventListener('click', () =>{
    informacion.classList.remove('active-popup')
});