"use strict";
//
// const profile = document.querySelector(".footer-4");
//
// profile.addEventListener("click", () => {
//   window.location.href = "/profile.php";
// });

const buttons = [...document.querySelectorAll(".page-redirect")];

const redirect = e => {
  let pageId = e.target.dataset.id;
  window.location.replace(pageId);
};

buttons.forEach(btn => {
  btn.addEventListener("click", redirect);
});
