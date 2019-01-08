"use strict"

const postscontainer = document.querySelector(".posts-container")

const getUser = (name) => {
  var value = "; " + document.cookie;
  var parts = value.split("; " + name + "=")
  if (parts.length == 2) return parts.pop().split(";").shift();
}

const createPost = json => {
  json.forEach(post => {
    postscontainer.innerHTML += `
    <div class="post-box">
    <div class="post-header">
    <img src="${post.avatar}" class="post-user-image" alt="">
    <h2>${post.username}</h2>
    </div>
    <img class="post-image" src="${post.image}" alt="">
    <div class="post-description">
    <h5>Title</h5>
    <p class="likes" data-id="${post.post_id}"> Likes: ${post.no_likes}
    <form action="../app/posts/likes.php" target="hiddenFrame" method="post">
    </p>
    <p> ${post.description}
    </p>
    <button class="likeBtn like" name="like" type="submit" value="">
    <i class="fas fa-thumbs-up" data-id="${post.post_id}"></i>
    </button>
    <button class="likeBtn dislike" name="dislike" type="submit" value="">
    <i class="fas fa-thumbs-down" data-id="${post.post_id}"></i>
    </button>
    </form>
    </div>
    </div>
    <div data-id="${post.post_id}" class="commentscontainer">
    <div class="comment-section">
    </div>
    <form class="comments-form" target="hiddenFrame" action="../app/posts/comments.php" method="post">
    <input type="text" name="comment" placeholder="" required>
    <button type="submit" data-id="${post.post_id}" class="commentBtn">comment</button>
    </form>
    </div>
    `
  })
}

const initEventListeners = (elts, callBack) => {
  elts.forEach(el => {
    el.addEventListener("click", callBack)
  })
}
const handleClickComment = (event) => {
  let postId = event.target.dataset.id
  document.cookie = "postId=" + postId
}
const createComment = (elts, data) => {
  console.log(elts)
  console.log(data)
}

const handleClick = (event) => {
  let postId = event.target.dataset.id
  document.cookie = "like=" + postId

  fetch("http://localhost:8888/app/posts/comments_api.php")
  .then((resp) => resp.json())
  .then((data) => {
  })
  setTimeout(() => {
    fetch("http://localhost:8888/app/posts/api.php")
    .then((resp) => resp.json())
    .then((data) => {
      const likes = [...document.querySelectorAll('.likes')]
      const filterfunc = data => data.filter(item => item.dataset.id === event.target.dataset.id)
      const dbfilter = data => data.filter(item => item.post_id === filterfunc(likes)[0].dataset.id)
      filterfunc(likes)[0].innerHTML = "Likes: " + dbfilter(data)[0].no_likes
    })
  }, 50)
}
fetch("http://localhost:8888/app/posts/api.php")
.then((resp) => resp.json())
.then((data) => {
  if (window.location.pathname === '/profile.php') {
    let currentUser = getUser('userid')
    const userfilter = data => data.filter(user => user.user_id === currentUser)
    data = userfilter(data)
  }
  createPost(data)
  const buttons = document.querySelectorAll('.likeBtn')
  const commentscontainer = [...document.querySelectorAll('.comments-container')]
  const commentbuttons = [...document.querySelectorAll('.commentBtn')]
  initEventListeners(buttons, handleClick)
  initEventListeners(commentbuttons, handleClickComment)
})
