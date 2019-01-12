"use strict";

const buttons = [...document.querySelectorAll(".page-redirect")];

const redirect = e => {
  let pageId = e.target.dataset.id;
  window.location.replace(pageId);
  deleteCookie("imagecookie")
};

buttons.forEach(btn => {
  btn.addEventListener("click", redirect);
});
