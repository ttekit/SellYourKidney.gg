window.addEventListener("load", () => {
    let allIdsConts = $(".product-id");

    let allFavorites = JSON.parse(localStorage.getItem('favorites'));
    if (allFavorites == null) {
        allFavorites = [];
    }

    // because of using localstorage I cant set button in PHP
    for (let i = 0; i < allFavorites.length; i++) {
        for (let j = 0; j < allIdsConts.length; j++) {
            if (allFavorites[i] === parseInt(allIdsConts[j].innerHTML)) {

                let $cont = $(allIdsConts[j].parentElement);
                let $button = $cont.find(".addToFavorites");

                $button.removeClass("addToFavorites");
                $button.addClass("removeFromFavorites");
                $button.text("remove favorites");

                $button.off('click');
                $button.on("click", () => {
                    removeFromFavoritesHandler($button, allFavorites[i]);
                })
            }
        }
    }



    //add remove buttons handlers
    let addToFavoritesBtns = $(".addToFavorites");

    addToFavoritesBtns.on("click", (e) => {
        addToFavoritesHandler(e)
    })

    let addToFavoritesHandler = (e) => {
        let $button = $(e.target);
        let cont = $button.closest("div");
        let id = parseInt(cont.find(".product-id").text());

        allFavorites.push(id);
        localStorage.setItem("favorites", JSON.stringify(allFavorites));

        $button.removeClass("addToFavorites");
        $button.addClass("removeFromFavorites");
        $button.text("remove favorites");

        $button.off('click');
        $button.on("click", () => {
            removeFromFavoritesHandler($button, id);
        })
    }

    let removeFromFavoritesHandler = ($button, id) => {

        allFavorites.splice(allFavorites.indexOf(id), 1);
        localStorage.setItem("favorites", JSON.stringify(allFavorites));


        $button.removeClass("removeFromFavorites");
        $button.addClass("addToFavorites");
        $button.text("add to favorites");

        $button.off('click');
        $button.on("click", (e) => {
            addToFavoritesHandler(e);
        })
    }
})