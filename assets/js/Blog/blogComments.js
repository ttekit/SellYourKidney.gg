window.addEventListener("load", async function () {
    "use strict"

    let userData = [];

    $.ajax({
        url: "/ajax/getUserData",
        method: "GET",
        success: (data) => {
            userData = JSON.parse(data);
        },
        beforeSend: function () {
            $('#preloader').fadeIn(500);
        },
        complete: function () {
            $('#preloader').fadeOut(500);
        },
    })


    let getAnswerFrom = function ($parent, oldData) {
        let $data;
        $data = $(`<form action="saveComment" method="post" id="comment-form" class="form-horizontal form-wizzard">
                            <h3 class="h3">Answer a comment</h3>
                            <div class="row">
                                <div class="col-lg-6 col-md-4 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <input name="login" class="form-control" placeholder="Enter your name ..." value="${userData.FullName}" disabled/>
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
                        </form>`);


        $data.submit(dataSubmitFunc)

        function dataSubmitFunc(e) {

            e.preventDefault();

            let $nameInput = $data.find("input[name*='login']");
            let $emailInput = $data.find("input[name*='email']");
            let $messageInput = $data.find("textarea[name*='message']");

            let userMessage = {
                postId: postId,
                login: $nameInput.val(),
                email: $emailInput.val(),
                message: $messageInput.val(),
                messageId: oldData.id
            }

            $.ajax({
                url: "/ajax/saveComment",
                method: "POST",
                data: userMessage,
                beforeSend: function () {
                    $('#preloader').fadeIn(500);
                },
                complete: function () {
                    location.reload();
                },
                error: (msg) => {
                    alert(msg);
                }
            })

            $data.remove();
            $parent.find(".comment-answer-btn").removeClass("hidden");

        }

        return $data;
    }

    let getSubComments = function (parent_id, $block) {
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
                    $block.append(getOneChildBlock(comments[i]));
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

    let getOneCommentBlock = function (comment) {
        let $block = $(`<li class="media">
                                <div class="comment-id">${comment.id}</div>
                                
                                <div class="media-left">
                                    <img class="comment-ava" src="/assets/images/blog/mike.jpg" alt="">
                                </div>
                                <div class="media-body">
                                <div class = "comment-header">
                                    <img class="img-fluid rounded-circle" style="height: 50px; width: 50px" src="${comment.avatar}"/>
                                    <h4 class="media-heading">${comment.login}</h4>
                                    <button class = "comment-btn">+</button>
                                    <button class="comment-answer-btn">answ</button>
                                </div>

                                    <div class="media-date">${comment.comment_date}</div>
                                    <div class="media-content">
                                        <p>${comment.comment}</p>
                                    </div>
                                </div>
                 </li>`);

        $block.find(".comment-btn").on("click", function (e) {
            $(e.target).remove();
            getSubComments(comment.id, $block)
        });

        $block.find(".comment-answer-btn").on("click", function (e) {
            $(e.target).addClass("hidden");
            $block.append(getAnswerFrom($block, comment));
        })

        return $block;
    }

    let getOneChildBlock = function (data) {
        let $block = $(`<li class="media child">
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

        $block.find(".comment-btn").on("click", function (e) {
            $(e.target).remove();
            getSubComments(data.id, $block)
        });
        $block.find(".comment-answer-btn").on("click", function (e) {
            $(e.target).addClass("hidden");
            $block.append(getAnswerFrom($block, data));
        })

        return $block;
    }

    let postId = parseInt($("#post-id").text());

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
                        $commContainer.append(getOneCommentBlock(item))
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

    let $messageForm = $("#comment-form");

    $messageForm.submit(function (e) {
        e.preventDefault();
        let $nameInput = $messageForm.find("input[name*='login']");
        let $emailInput = $messageForm.find("input[name*='email']");
        let $messageInput = $messageForm.find("textarea[name*='message']");

        let userMessage = {
            postId: postId,
            login: $nameInput.val(),
            email: $emailInput.val(),
            message: $messageInput.val(),
            messageId: null
        };

        if (userMessage.message.length > 10 && userMessage.message.length < 150) {
            $.ajax({
                url: "/ajax/saveComment",
                method: "POST",
                data: userMessage,
                success: (data) => {
                    console.log(data);
                    switch (data) {
                        case "1 row affected": {
                            $(".comments-form").trigger("reset");
                            Swal.fire({
                                title: "Comment is successfully send",
                                icon: "success",
                            })
                            break;
                        }
                        case "0 row affected": {
                            Swal.fire({
                                title: "Some data in comment is unavailable, refill form",
                                icon: "error",
                            })
                            break;
                        }
                    }

                },
                error: (msg) => {
                    alert(msg);
                }
            })
        } else {
            Swal.fire({
                title: "Comment must to be from 10 to 150 symbols",
                icon: "error"
            })
        }

    })

})