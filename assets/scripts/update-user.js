'use strict';

const errordiv = document.querySelector('.error-div');

if (errordiv) 
{
  setTimeout(() => {
    window.location.pathname = '/../update-user.php'
  }, 2500);
}