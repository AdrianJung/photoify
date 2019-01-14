"use strict";

if (document.querySelector('.sign')){

  const signup = document.querySelector(".sign-up");
  const signin = document.querySelector(".sign-in");
  const signinafter = document.querySelector(".sign-in:after");
  const registerform = document.querySelector(".registerform");
  const loginform = document.querySelector(".loginform");
  const submitbutton = document.querySelector(".submitbutton");
  const registerbutton = document.querySelector(".registerbutton");
  const inputbox = document.querySelector(".input-box");
  
  signup.addEventListener("click", () => {
    signin.classList.add("faded");
    signup.classList.add("up-after");
    signin.classList.add("in-after");
    signup.classList.add("not-faded");
    loginform.classList.add("none");
    registerform.classList.add("block");
    submitbutton.classList.add("fade");
    setTimeout(function() {
      submitbutton.classList.remove("fade");
    }, 800);
  });
  signin.addEventListener("click", () => {
    signin.classList.remove("faded");
    signup.classList.remove("up-after");
    signin.classList.remove("in-after");
    signup.classList.remove("not-faded");
    loginform.classList.remove("none");
    loginform.classList.add("block");
    registerform.classList.remove("block");
    submitbutton.classList.toggle("fade");
    setTimeout(function() {
      submitbutton.classList.remove("fade");
    }, 800);
  });
}


const errordiv = document.querySelector('.error-div');

if (errordiv) 
{
  setTimeout(() => {
    window.location.pathname = '/login.php'
  }, 2500);
}