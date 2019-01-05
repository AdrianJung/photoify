"use strict";

const postbox = document.querySelector(".post-box");

const createPost = json => {
  json.forEach(post => {
    postbox.innerHTML += `
    <div class="post-header">
    <img src="${post.avatar}" class="post-user-image" alt="">
    <h6>${post.username}</h6>
    </div>
    <img class="post-image" src="${post.image}" alt="">
    <div class="post-description">
    <h5>Title</h5>
    <p class="likes" data-id="${post.post_id}"> Likes: ${post.no_likes}
    <form action="../app/posts/likes.php" target="hiddenFrame" method="post">
</p>
    <p> ${post.description}
    </p>
    <button class="likeBtn" name="like" type="submit" value="" data-id="${post.post_id}">Like</button>
    </div>
    `
    ;
  });
};


const initEventListeners = elts => {
  elts.forEach(el => {
    el.addEventListener("click", handleClick);
  });
};
const handleClick = (event) => {
let postId = event.target.dataset.id
document.cookie = "like="+postId
setTimeout(() => {
fetch("http://localhost:8888/app/posts/api.php")
  .then((resp) => resp.json())
  .then((data) => {
			const likes = [...document.querySelectorAll('.likes')]
			const filterfunc = data => data.filter(item => item.dataset.id === event.target.dataset.id)
			const dbfilter = data => data.filter(item => item.post_id === filterfunc(likes)[0].dataset.id)

			console.log(filterfunc(likes)[0].innerHTML)
			console.log(filterfunc(likes)[0].dataset.id)
			console.log(dbfilter(data)[0].no_likes)
filterfunc(likes)[0].innerHTML = "Likes: " + dbfilter(data)[0].no_likes
  })
},50 );
}

fetch("http://localhost:8888/app/posts/api.php")
  .then(resp => resp.json())
  .then(data => {
    console.table(data);
    createPost(data);
    const buttons = document.querySelectorAll(".likeBtn");
    initEventListeners(buttons);
  });
