'use strict';

const body = document.querySelector("body");
const modal = document.querySelector(".modal");
const textitem = document.querySelectorAll(".text-item");
const icon = document.querySelector(".icon");

icon.addEventListener("click", () => {
  modal.classList.toggle("active");
  icon.classList.toggle("active");
});

Array.from(textitem).forEach(text => {
  text.addEventListener("click", () => {
    modal.classList.toggle("active");
    icon.classList.toggle("active");
  });
});