'use strict';

let url = 'http://localhost:8888/app/posts/full_api.php'

const container = document.querySelector(".posts-container")

const createPost = (json) => {
    
    
    const postsMarkup = json.map(post => {
        
        const comments = post.comments.map(comment => {
            return `<p>${comment.content}</p>`
        }).join('')
        
        return `
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
        ${comments}
        </div>
        <form class="comments-form" target="hiddenFrame" action="../app/posts/comments.php" method="post">
        <input type="text" name="comment" placeholder="" required>
        <button type="submit" data-id="${post.post_id}" class="commentBtn">comment</button>
        </form>
        </div>
        `
    }).join('')
    
    container.innerHTML = postsMarkup;
}


const getUser = (name) => {
    var value = "; " + document.cookie
	var parts = value.split("; " + name + "=")
	if (parts.length == 2) return parts.pop().split(";").shift()
}

const getData = url => {
    return fetch(url)
    .then((resp) => resp.json())
}

const initEventListeners = (elts, callback) => {
    elts.forEach(el => {
        el.addEventListener('click', callback)
	})
}

const handleClick = (event) => {
    let postId = event.target.dataset.id
    document.cookie = "like=" + postId
    
}

const handleClickComment = (event) => {
    let postId = event.target.dataset.id
    document.cookie = "postId=" + postId
}

const handleClickLikes = (event) => {
	let postId = event.target.dataset.id
	document.cookie = "like=" + postId
	setTimeout(() => {
		getData(url)
			.then(data => {
				const likes = [...document.querySelectorAll('.likes')]
				const filterfunc = data => data.filter(item => item.dataset.id === event.target.dataset.id)
				const dbfilter = data => data.filter(item => item.post_id === filterfunc(likes)[0].dataset.id)
				filterfunc(likes)[0].innerHTML = "Likes: " + dbfilter(data)[0].no_likes
			})
	}, 40)
}

getData(url)
.then(data => {
        if (window.location.pathname === '/profile.php') {
            let currentUser = getUser('userid')
            const userfilter = data => data.filter(user => user.user_id === currentUser)
            data = userfilter(data)
        }
        createPost(data)

        const buttons = document.querySelectorAll('.likeBtn')
        const commentscontainer = [...document.querySelectorAll('.comments-container')]
        const commentbuttons = [...document.querySelectorAll('.commentBtn')]
        
        initEventListeners(buttons, handleClickLikes)
        
        initEventListeners(commentbuttons, handleClickComment)
})

