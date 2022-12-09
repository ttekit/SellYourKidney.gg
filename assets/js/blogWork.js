window.addEventListener("load", function () {

    //получение контейнеров
    let tagContainer = $(".tag-sort-content");
    let catsContainer = $(".categories-sort-content");
    let postContainer = $(".blog-container");

    //получение данных по сорту
    let currentCategory = "";
    let currentTag = "";
    let currentPage = 1;
    let postsCount = 3;

    let appendTags = () => {
        $.ajax({
            url: "/ajax/getAllTags",
            method: "get",
            async: true,
            success: (data) => {
                data = JSON.parse(data);

                for (let i = 0; i < data.length; i++) {
                    let $button = $(`<div>
                    <a>
                        <button class="filterBtn">
                            <h6>${data[i].tag}</h6>
                        </button>
                    </a>
                </div>`);
                    $button.find(".filterBtn").on("click", function (e){
                        currentTag = e.target.innerHTML;
                        refreshPostContainer();
                    })

                    tagContainer.append($button);
                }
            }
        })
    }

    let appendCats = () => {
        $.ajax({
            url: "/ajax/getAllCategories",
            method: "get",
            async: true,
            success: (data) => {
                data = JSON.parse(data);
                for (let i = 0; i < data.length; i++) {
                    let $button = $(`<div>
                    <a>
                        <button class="filterBtn">
                            <h6>${data[i].category}</h6>
                        </button>
                    </a>
                </div>`)
                    $button.find(".filterBtn").on("click", function (e){
                        currentCategory = e.target.innerHTML;
                        refreshPostContainer();
                    })
                    catsContainer.append($button);
                }
            }
        })
    }

    let appendPosts = () => {
        $.ajax({
            url: "/ajax/getLimitCountOfPosts",
            method: "get",
            async: true,
            data: {
                "postsCount": postsCount,
                "startPos": (currentPage - 1) * postsCount,
                "category": currentCategory,
                "tag": currentTag,
            },
            success: (data) => {
                data = JSON.parse(data);

                for (let i = 0; i < data.length; i++) {
                    let value = data[i];
                    postContainer.append(    `<div class='blog-page-prew col-sm-6 col-md-4 col-lg-3 blog-container' name='blog-container'> <div class='box'><h6>${value.dateOfPublication}</h6>
                                            <div class='img-box'>
                                            <img class='blog-img-box' src='${value.imgSrc}' alt='$value["altSrc"]'>
                                            </div>
                                            <button class='blog-read-button'>
                                            <a href='/blog/post?id=${value.Id}'>Go Read</a>
                                            </button>
                                            <div class='blog-detail-box'>
                                            <h5> ${value.title}</h5>
                                            <h6>${value.slogan}</h6>
                                            </div>
                                            </div>
                                            </div>`);
                }
            }
        })
    }

    let refreshPostContainer = () => {
        postContainer.empty();
        appendPosts();
    }

    appendTags();
    appendCats();
    appendPosts();
})

