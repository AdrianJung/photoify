let url = 'http://localhost:8888/app/posts/full_api.php'

const container = document.querySelector(".posts-container")
const profilecontainer = document.querySelector('.profile-image-container')

const createPost = (json) => {
    const postsMarkup = json.map(post => {
        const comments = post.comments.map(comment => {
            return `
            <p><b class="comment-username">${comment.author} : </b> ${comment.content}</p>
            `    
        }).join('')
        return `
        <div class="post-box">
        <div class="post-header">
        <img src="${post.avatar}" style ="background-image: url()"class="post-user-image" alt="">
        <h3 class="comment-username">${post.username}</h3>
        <form class="deletePost-form" target="hiddenFrame" action="../app/posts/update.php" method="post">
        <button name="deletePost" data-id="${post.user_id}" data-postid="${post.post_id}" class="post-button delete-post" type="submit">Delete</button>
        </form>
        <form class="deletePost-form" target="hiddenFrame" action="../app/posts/update.php" method="post">
        <button name="updatePost" data-id="${post.user_id}" data-postid="${post.post_id}" class="post-button edit-post" type="submit">Edit</button>
        </form>
        </div>
        <div class="post-image-container">
        <img class="post-image" data-id="${post.post_id}" src="${post.image}" alt="">
        </div>
        <div class="post-description">
        <p class="post-description-text"> <b>${post.description}</b>
        <form action="../app/posts/likes.php" class="likeform" target="hiddenFrame" method="post">
        <button class="likeBtn like far fa-thumbs-up" id="#likeBtn" data-id="${post.post_id}" name="like" type="submit" value="">
        </button>
        <button class="likeBtn dislike fas fa-thumbs-up hidden" id="#likeBtn" data-id="${post.post_id}" name="dislike" type="submit" value="">
        </button>
        <p class="likes" data-id="${post.post_id}"> ${post.no_likes}</p>
        </form>
        </div>
        </p>
        <div data-id="${post.post_id}" class="commentscontainer">
        <div class="comments-section" data-id="${post.post_id}">
        ${comments}
        </div>
        </div>
        <form class="comments-form" target="hiddenFrame" action="../app/posts/comments.php" method="post">
        <input class="comment-input" type="text" name="comment" placeholder="" required>
        <button type="submit" data-id="${post.post_id}" class="commentBtn">Comment</button>
        </form>
        </div>      
        `
    }).join('')
    container.innerHTML = postsMarkup;
}

const createPostProfile = (json) => {
    const profileposts = json.map(post => {
        return `
        <div class="profile-image-box">
        <img src="${post.image}" data-id="${post.post_id} "class="profile-grid-image" alt="">
        </div>
        `
    }).join('')
    profilecontainer.innerHTML = profileposts
}

const getCookieVal = (name) => {
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
    setTimeout(() => {
        getData(url)
        .then(data => {
            const commentsSection = [...document.querySelectorAll('.comments-section')]
            const commentsInputs = [...document.querySelectorAll('.comment-input')]
            const filterfunc = elts => elts.filter(el => el.dataset.id === postId)
            const dbfilter = data => data.filter(comments => comments.post_id === postId)
            dbfilter(data).forEach(comment => {
                filterfunc(commentsSection).forEach(commentSection => {
                    const postComments = comment.comments.map(postComment => {
                        return `
                        <p><b class="comment-username">${postComment.author}</b> : ${postComment.content}</p>
                        `
                    }).join('')
                    commentSection.innerHTML = postComments
                    commentsInputs.forEach(commentInput => {
                        commentInput.value = '';
                        
                    })
                })
            })
        })
    }, 100)
}

const hideButtons = (json, elts) => json.map(post => {
    const likeButtons = elts.filter(el => el.dataset.id === post.post_id)
    if (post.has_liked) {
        likeButtons.map(button => {
            button.classList.toggle('hidden')
        })
    }
})

const handleClickDelete = (event) => {
    let postId = event.target.dataset.postid
    document.cookie = "delete=" + postId
    window.location.reload()
}

const displayButtonsHandler = (elts) => {
    elts.map(el => {
        if (getCookieVal('userid') !== el.dataset.id) {
            el.classList.add('hidden')
        }
    })
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
            filterfunc(likes)[0].innerHTML = dbfilter(data)[0].no_likes
            const likeButtons = [...document.querySelectorAll('.likeBtn')]
            let currentbuttons = filterfunc(likeButtons)
            currentbuttons.map(button => {
                button.classList.toggle('hidden')
            })
        })
    }, 40)
}

const deleteCookie = (name) => {
    document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

let imagecookie = document.cookie.match(/^(.*;)?\s*imagecookie\s*=\s*[^;]+(.*)?$/)

getData(url)
.then(data => {
    if (window.location.pathname === '/profile.php') {
        if (!imagecookie) {
            let currentUser = getCookieVal('userid')
            const userfilter = data => data.filter(user => user.user_id === currentUser)
            data = userfilter(data)
            createPostProfile(data)
            const images = [...document.querySelectorAll('.profile-grid-image')]
            images.forEach(image => {
                // (image.clientHeight > image.clientWidth) ? image.classList.add('portrait') : image.classList.add('landscape')
                image.addEventListener('click', (event) => {
                    document.cookie = "imagecookie=" + event.target.dataset.id
                    window.location.reload()
                })
            })
        }
        if (imagecookie) {
            const profileInfo = document.querySelector('.profile-image-name')
            profileInfo.classList.add('hidden')

            const cookieid = getCookieVal("imagecookie")
            const postsfilter = data => data.filter(post => post.post_id === cookieid)
            data = postsfilter(data)
            createPost(data)
            const buttons = [...document.querySelectorAll('.likeBtn')]
            const deleteButtons = [...document.querySelectorAll('.delete-post')]
            const editButtons = [...document.querySelectorAll('.edit-post')]
            const commentbuttons = [...document.querySelectorAll('.commentBtn')]
            initEventListeners(buttons, handleClickLikes)
            initEventListeners(commentbuttons, handleClickComment)
            initEventListeners(deleteButtons, handleClickDelete)
            hideButtons(data, buttons)
            displayButtonsHandler(deleteButtons)
            displayButtonsHandler(editButtons)
        } 
        
    } else {
        createPost(data)
     
        const buttons = [...document.querySelectorAll('.likeBtn')]
        const deleteButtons = [...document.querySelectorAll('.delete-post')]
        const editButtons = [...document.querySelectorAll('.edit-post')]
        const commentbuttons = [...document.querySelectorAll('.commentBtn')]
        initEventListeners(buttons, handleClickLikes)
        initEventListeners(commentbuttons, handleClickComment)
        initEventListeners(deleteButtons, handleClickDelete)
        hideButtons(data, buttons)
        displayButtonsHandler(deleteButtons)
        displayButtonsHandler(editButtons)
    }
    deleteCookie("imagecookie")
})
