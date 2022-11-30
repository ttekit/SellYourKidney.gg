<?php

namespace App;

class Pagination
{
    public static function printElem($value)
    {
        echo "<div class='blog-page-prew col-sm-6 col-md-4 col-lg-3 blog-container' name='blog-container'> <div class='box'><h6><?= $value[dateOfPublication] ?></h6>" .
            "<div class='img-box'>" .
            "<img class='blog-img-box' src='" . $value["imgSrc"] ."'".
            "alt='" . $value["altSrc"] . "'>" .
            "</div>" .
            "<button class='blog-read-button'>" .
            "<a href='/blog/post?id=" . $value["Id"] . "'>Go Read</a>" .
            "</button>" .
            " <div class='blog-detail-box'>" .
            "<h4>" . $value["categoryName"] . "</h4>" .
            "<h5>" . $value["title"] . "</h5>" .
            "<h6>" . $value["slogan"] . "</h6>" .
            "</div>" .
            "</div>" .
            "</div>";
    }

    public static function printControlPanel($data, $countPosts, $href)
    {
        if (str_contains($href, "&")) {
            $tmpHref = "";
            $href = explode("&", $href);
            for ($i = 0; $i < count($href); $i++) {
                if (!str_contains($href[$i], "page=")) {
                    $tmpHref .= $href[$i];
                }
            }
            $href = $tmpHref;
        }
        if(str_contains($href, "?")){
            $href = explode("?", $href)[0];
        }
        echo "<div class='blog-page-count-container'>";

        echo "<button class = 'swipe-page-button'><a href = '/blog?page=0'><<</a></button>";
        echo "<button onclick = 'goPrew()' class = 'prew swipe-page-button'>←</button>";
        for ($i = $data["page"] - 2; $i < $countPosts / (int)$data["postsCount"] && $i < $data["page"] + (int)$data["postsCount"]; $i++) {
            if ($i >= 0) {
                echo "<button class = 'swipe-page-button'>";
                echo "<a href = '" . $href . "?page=" . ($i) . "'>" . ($i + 1) . "</a>";
                echo "</button>";
            }
        }
        echo "<button onclick = 'goNext($countPosts)' class = 'next swipe-page-button'>→</button>";
        echo "<a href = '/blog?page=" . (round($countPosts / (int)$data["postsCount"] - 1)) . "'><button class = 'swipe-page-button'>>></button></a>";
        echo "</div>";

    }

    public static function printTagsPanel($data, $href)
    {
        if (str_contains($href, "&")) {
            $tmpHref = "";
            $href = explode("&", $href);
            for ($i = 0; $i < count($href); $i++) {
                if (!str_contains($href[$i], "filter=")) {
                    $tmpHref .= $href[$i];
                }
            }
            $href = $tmpHref;
        }
        for ($i = 0; $i < count($data); $i++) {
            //<button class='filterBtn'><h6>" . $value->category . ".</h6></button>
            echo "<a href='" . $href . "&filter=" . $data[$i]["tag"] . "'><button class='filterBtn'><h6>" . $data[$i]["tag"] . ".</h6></button></a>";
        }
    }
}

?>
<script>
    let goPrew = function () {
        let pageCount = window.location.href.split("page=");
        console.log(pageCount);

        if (pageCount[1] > 0) {
            window.location.href = "http://bootstrapshop.gg/blog?page=" + (pageCount[1] - 1);
        }
    }
    let goNext = function (leng) {
        let pageCount = window.location.href.split("page=");
        console.log(pageCount);
        if(pageCount[1] === undefined){
            pageCount[1] = 1;
        }
        if (pageCount[1] < leng) {
            window.location.href = "http://bootstrapshop.gg/blog?page=" + (parseInt(pageCount[1]) + 1);
        }
    }
</script>