window.addEventListener("load", () => {

    let categories = "";
    let tags = [];

    $(".addNewCategoryBtn").on("click", (e) => {
        let $button = $(e.target);
        if ($button.hasClass("pressed")) {
            categories = "";
            $button.attr("class", "addNewCategoryBtn");
            console.log(categories);
        } else {
            if (categories === "") {
                categories = $button.text();
                $button.addClass("pressed");
            }
            console.log(categories);
        }
    });

    $(".addNewTagBtn").on("click", (e) => {
        let $button = $(e.target);
        if ($button.hasClass("pressed")) {
            tags.splice(tags.indexOf($button.text()), 1);
            $button.attr("class", "addNewTagBtn");
        } else {
            tags.push($button.text());
            $button.addClass("pressed");
        }
    });

});