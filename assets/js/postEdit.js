window.addEventListener("load", function () {

    let globalData = {  };

    let addNewCategory = function (categoryName) {
        return $(`<option class="new-category-option">${categoryName}</option>`);
    }

    let addNewCategoryButton = function (categoryName) {
        let $btn = $(`<button class="category-elem">${categoryName}</button>`);
        $btn.on("click", function () {

            for (let i = 0; i < globalData.category.length; i++) {
                if (globalData.category[i] === categoryName) {
                    globalData.category.splice(i);
                    e.target.remove();
                    break;
                }
            }
            console.log(globalData);
        })
        return $btn;
    }

    let addNewTag = function (categoryName) {
        return $(`<option class="new-tag-option">${categoryName}</option>`);
    }

    let addNewTagButton = function (tagName) {
        let $btn = $(`<button class="tag-elem">${tagName}</button>`);
        $btn.on("click", function (e) {

            for (let i = 0; i < globalData.tag.length; i++) {
                console.log(globalData.tag[i]);
                if (globalData.tag[i] === tagName) {

                    globalData.tag.splice(i);
                    e.target.remove();
                    break;
                }
            }

        })
        return $btn;
    }

    let $addCategoryBtn = $(".addNewCategoryBtn");
    let $categoryBlock = $addCategoryBtn.parent();

    let $addTagBtn = $(".addNewTagBtn");
    let $tagBlock = $addTagBtn.parent();

    $tagBlock.addClass("hidden");
    $categoryBlock.addClass("hidden");

    let $postId = $categoryBlock.find(".postId").text();
    $(".category-elem").on("click", function (e) {
        for (let i = 0; i < globalData.category.length; i++) {
            if (globalData.category[i] === e.target.innerHTML) {
                globalData.category.splice(i);
                e.target.remove();
                break;
            }
        }
    });

    $(".tag-elem").on("click", function (e) {
        for (let i = 0; i < globalData.tag.length; i++) {
            if (globalData.tag[i] === e.target.innerHTML) {
                globalData.tag.splice(i);
                e.target.remove();
                break;
            }
        }
    });

    $.ajax({
        url: "/ajax/getCategory",
        method: "GET",
        data: {
            "postId": $postId
        },
        beforeSend: function() {
            $('#preloader').fadeIn(500);
        },
        complete: function() {
            $('#preloader').fadeOut(500);
        },
        success: (data) => {
            globalData.category = [];
            let tmp = JSON.parse(data);
            for(let i = 0; i < tmp.length; i++){
                globalData.category.push(tmp[i].category);
            }
            $categoryBlock.removeClass("hidden");
        },
        error: (msg) => {
            alert(msg);
        }
    })

    $.ajax({
        url: "/ajax/getTags",
        method: "GET",
        data: {
            "postId": $postId
        },
        success: (data) => {
            globalData.tag = [];
            let tmp = JSON.parse(data);
            for(let i = 0; i < tmp.length; i++){
                globalData.tag.push(tmp[i].tag);
            }
            $tagBlock.removeClass("hidden");
        },
        beforeSend: function() {
            $('#preloader').fadeIn(500);
        },
        complete: function() {
            $('#preloader').fadeOut(500);
        },
        error: (msg) => {
            alert(msg);
        }
    })


    $addCategoryBtn.on("click", function () {
        let $select = $(".categories-select");
        $select.removeClass("hidden");
        for (let i = 0; i < globalData.category.length; i++) {
            $select.append(addNewCategory(globalData.category[i]));
        }
        $select.on("change", function () {
            let selectedOption = $('option:selected');
            globalData.category.push(selectedOption.val());
            $select.addClass("hidden")
            $select.empty();
            let newOption = addNewCategoryButton(selectedOption.val());
            $(".categories-active-categories").append(newOption);
        });
    })

    $addTagBtn.on("click", function () {
        let $select = $(".tags-select");
        $select.removeClass("hidden");
        for (let i = 0; i < globalData.tag.length; i++) {
            $select.append(addNewTag(globalData.tag[i]));
        }
        $select.on("change", function () {
            let selectedOption = $('option:selected');
            globalData.tag.push(selectedOption.val());
            $select.addClass("hidden")
            $select.empty();
            let newOption = addNewTagButton(selectedOption.val());
            $(".tags-active-tags").append(newOption);
        });
    })
})