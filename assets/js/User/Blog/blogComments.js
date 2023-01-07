window.addEventListener("load", async function () {
    "use strict"

    //getting login user data
    let $tpmUserDataCont = $(".currUserData");
    let userData = JSON.parse($tpmUserDataCont.text());
    $tpmUserDataCont.remove();


    let postId = parseInt($("#post-id").text());
    getAndFillComments(postId, userData)

    let $messageForm = $("#comment-form");
    $messageForm.submit(function (e) {
        e.preventDefault();
        let $messageInput = $messageForm.find("textarea[name*='message']");

        let userMessage = {
            "post_id": postId,
            "login": userData.login,
            "email": userData.email,
            "message": $messageInput.val(),
            "message_id": null,
            "avatar": userData.avatar,
        };
        if (userMessage.message.length > 10 && userMessage.message.length < 150) {
            sendDataToServer(userMessage);
        } else {
            Swal.fire({
                title: "Error",
                text: "Comment must to be from 10 to 150 symbols",
                icon: "error"
            })
        }

    })



})


let getAndFillComments = function (postId, userData) {
    if (!isNaN(postId)) {
        let $commContainer = $('.card-body');
        $.ajax({
            url: "/ajax/getComments",
            method: "POST",
            data: {
                "postId": postId
            },
            success: (data) => {
                let comments = JSON.parse(data);
                if (comments.length > 0) {
                    comments.forEach((item) => {
                        $commContainer.append(getOneCommentBlock(item, userData))
                    })
                }

            },
            error: (msg) => {
                alert(msg);
            },
            beforeSend: function () {
                $commContainer.addClass("d-none");
            },
            complete: function () {
                $commContainer.removeClass("d-none");
            },
        })
    }
}

let getOneCommentBlock = function (comment, userData) {
    let $block = getCommentBlockHTML(comment);

    $block.find(".comment-btn").on("click", function (e) {
        $(e.target).remove();
        getSubComments(comment.id, $block)
    });

    $block.find(".comment-answer-btn").on("click", function (e) {
        $(e.target).addClass("hidden");
        $block.append(getAnswerFrom($block, comment, userData));
    })

    return $block;
}

let getAnswerFrom = function ($parent, oldData, userData) {
    let $data;
    $data = getAnswerFormHTML(userData);

    $data.submit(dataSubmitFunc)

    function dataSubmitFunc(e) {

        e.preventDefault();

        let $messageInput = $data.find("textarea[name*='message']");
        let postId = parseInt($("#post-id").text());

        let userMessage = {
            "post_id": postId,
            "login": userData.login,
            "email": userData.email,
            "message": $messageInput.val(),
            "message_id": oldData.id,
            "avatar": userData.avatar
        }

        if (userMessage.message.length > 2 && userMessage.message.length < 150) {
            sendDataToServer(userMessage);
        } else {
            Swal.fire({
                title: "Error",
                message: "Comment must to be from 10 to 150 symbols",
                icon: "error"
            })
        }

        $data.remove();
        $parent.find(".comment-answer-btn").removeClass("hidden");

    }

    return $data;
}

let getSubComments = function (parent_id, $block, userData) {
    $.ajax({
        url: "/ajax/getSubComments",
        method: "POST",
        data: {
            "parentId": parent_id
        },
        success: (data) => {
            console.log(data);
            if (data == "[]") {
                Swal.fire("It hasn't answers");
            }
            let comments = JSON.parse(data);
            for (let i = 0; i < comments.length; i++) {
                $block.append(getOneChildBlock(comments[i], userData));
            }
        },
        error: (msg) => {
            alert(msg);
        },
        beforeSend: function () {
            $('#preloader').fadeIn(500);
        },
        complete: function () {
            $('#preloader').fadeOut(500);
        },
    })
}

let getOneChildBlock = function (data, userData) {
    let $block = getChildCommentHTML(data);

    $block.find(".comment-btn").on("click", function (e) {
        $(e.target).remove();
        getSubComments(data.id, $block)
    });
    $block.find(".comment-answer-btn").on("click", function (e) {
        $(e.target).addClass("hidden");
        $block.append(getAnswerFrom($block, data, userData));
    })

    return $block;
}


let getCommentBlockHTML = function (commentData) {
    return $(`<li class="media">
                                <div class="comment-id">${commentData.id}</div>
                                
                                <div class="media-left">
                                    <img class="comment-ava" src="/assets/images/blog/mike.jpg" alt="">
                                </div>
                                <div class="media-body">
                                <div class = "comment-header">
                                    <img class="img-fluid rounded-circle" style="height: 50px; width: 50px" src="${commentData.avatar}" alt="avatar"/>
                                    <h4 class="media-heading">${commentData.login}</h4>
                                    <button class = "comment-btn">+</button>
                                    <button class="comment-answer-btn">answ</button>
                                </div>

                                    <div class="media-date">${commentData.comment_date}</div>
                                    <div class="media-content">
                                        <p>${commentData.comment}</p>
                                    </div>
                                </div>
                 </li>`)
}

let getAnswerFormHTML = function (userData) {
    return $(`<form action="saveComment" method="post" id="comment-form" class="form-horizontal form-wizzard">
                            <h3 class="h3">Answer a comment</h3>
                            <div class="row">
                                <div class="col-lg-6 col-md-4 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <input name="login" class="form-control" placeholder="Enter your name ..." value="${userData.fullName}" disabled/>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-4 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <input name="email" type="email" class="form-control" placeholder="Enter your email ..." value="${userData.email}" disabled/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="message" rows="8" class="form-control" placeholder="Your comment ..."></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Answer comment" class="btn btn-default sumbit-btn"/>
                            </div>
                        </form>`)
}

let getChildCommentHTML = function (data) {
    return $(`<li class="media child">
                                <div class="comment-id">${data.id}</div>
                                <div class="media-left">
                                    <img class="comment-ava" src="/assets/images/blog/mike.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <div class = "comment-header">
                                        <h4 class="media-heading">${data.login}</h4>
                                        <button class = "comment-btn">+</button>
                                        <button class="comment-answer-btn">answ</button>
                                    </div>
                                    <div class="media-date">${data.dateOfComment}</div>
                                    <div class="media-content">
                                        <p>${data.comment}</p>
                                    </div>
                                </div>
                 </li>`);
}


let sendDataToServer = function (userData) {
    $.ajax({
        url: "/ajax/saveComment",
        method: "POST",
        data: userData,
        success: (data) => {
            if (data === "1 row affected") {
                $(".comments-form").trigger("reset");
                Swal.fire({
                    title: "Comment is successfully send",
                    icon: "success",
                })
            } else {
                Swal.fire({
                    title: "Some data in comment is unavailable, refill form",
                    icon: "error",
                })
            }
        },
        error: (msg) => {
            alert(msg);
        }
    })
}