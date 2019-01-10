'use strict';

let url = 'http://localhost:8888/app/posts/full_api.php'

const body = document.querySelector("body");
const modal = document.querySelector(".modal");
const textitem = document.querySelectorAll(".text-item");
const icon = document.querySelector(".icon");
const profilecontainer = document.querySelector('.profile-image-container');

icon.addEventListener("click", () => {
  modal.classList.toggle("active");
  body.classList.toggle("menuopen");
  icon.classList.toggle("active");
});
Array.from(textitem).forEach(text => {
  text.addEventListener("click", () => {
    modal.classList.toggle("active");
    icon.classList.toggle("active");
    body.classList.toggle("menuopen");
  });
});

const createPostProfile = (json) => {
  const profileposts = json.map(post => {
      return `
      <div class="profile-image-box">
      <img src="${post.image}" class="profile-grid-image" alt="">
      </div>
      `
  }).join('')
  profilecontainer.innerHTML = profileposts;
}

const getData = url => {
  return fetch(url)
  .then((resp) => resp.json())
}

const getUser = (name) => {
var value = "; " + document.cookie
var parts = value.split("; " + name + "=")
if (parts.length == 2) return parts.pop().split(";").shift()
}

getData(url)
.then(data => {
    let currentUser = getUser('userid')
    const userfilter = data => data.filter(user => user.user_id === currentUser)
    data = userfilter(data)
    createPostProfile(data)

})
