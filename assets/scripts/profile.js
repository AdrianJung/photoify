'use strict';

const errordiv = document.querySelector('.error-div')

if (errordiv) 
{
  const profilecontainer = document.querySelector('.profile-container')
  profilecontainer.setAttribute("style", "display: flex; justify-content: center;");
  setTimeout(() => {
    window.location.pathname = '/profile.php'
  }, 2000);
}
