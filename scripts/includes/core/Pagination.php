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
                if (!str_contains($href[$i], "pageCount=")) {
                    $tmpHref .= $href[$i];
                }
            }
            $href = $tmpHref;
        }
        echo "<div class='blog-page-count-container'>";

        echo "<button class = 'swipe-page-button'><a href = '/blog?pageCount=0'><<</a></button>";
        echo "<button onclick = 'goPrew()' class = 'prew swipe-page-button'>←</button>";
        for ($i = $data["currentPage"] - 2; $i < $countPosts / (int)$data["postsCount"] && $i < $data["currentPage"] + (int)$data["postsCount"]; $i++) {
            if ($i >= 0) {
                echo "<button class = 'swipe-page-button'>";
                echo "<a href = '" . $href . "&pageCount=" . ($i) . "'>" . ($i + 1) . "</a>";
                echo "</button>";
            }
        }
        echo "<button onclick = 'goNext($countPosts)' class = 'next swipe-page-button'>→</button>";
        echo "<button class = 'swipe-page-button'><a href = '/blog?pageCount=" . (round($countPosts / (int)$data["postsCount"] - 1)) . "'>>></a></button>";
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
    var goPrew = function () {
        var id = window.location.href.split("?pageCount=");
        if (id[1] > 0) {
            window.location.href = "http://bootstrapshop.co/blog?pageCount=" + (id[1] - 1);
        }
    }
    var goNext = function (leng) {
        var id = window.location.href.split("?pageCount=");
        if (id[1] < leng) {
            window.location.href = "http://bootstrapshop.co/blog?pageCount=" + (parseInt(id[1]) + 1);
        }
    }
</script>
