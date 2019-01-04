"use strict";
const posts = JSON.parse(getCookie("posts"));
console.log(posts);
const postbox = document.querySelector(".post-box");
posts.forEach(post => {
  postbox.innerHTML += `
  <div class="post-header">
      <img src="${post.image}" class="post-user-image" alt="">
      <h6>Username</h6>
  </div>
  <img class="post-image" src="${post.image}" alt="">
  <div class="post-description">
      <h5>Title</h5>
          <h6>Likes:</h6>
      <p> ${post.description}
      </p>
  </div>
  `;
});
