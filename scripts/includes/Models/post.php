<?php

namespace Models;
class post extends \App\DBEngine
{
    public function __construct()
    {
        parent::__construct("blogposts");
    }

    public function getPostById($id)
    {
        return $this->executeQuery("SELECT blogposts.id, blogposts.title, blogposts.slogan, blogposts.dateOfPublication, blogposts.imgSrc, blogposts.altSrc, blogposts.content, (SELECT GROUP_CONCAT(DISTINCT categories.category SEPARATOR ', ') AS categories FROM blogcategories
	LEFT JOIN categories ON blogcategories.category_id = categories.id
	LEFT JOIN blogposts ON blogcategories.post_id = blogposts.id
	WHERE blogposts.slug =" . $id . ") AS tags,
	(SELECT GROUP_CONCAT(DISTINCT tags.tag SEPARATOR ', ') AS tags FROM posttags
	LEFT JOIN tags ON posttags.tag_id = tags.id
	LEFT JOIN blogposts ON blogposts.id = posttags.post_id
	WHERE blogposts.slug = " . $id . ") AS categories
 FROM blogposts
WHERE id = " . $id
        )[0];
    }

    public function getAllPosts()
    {
        return $this->executeQuery("SELECT
    pst.Id,
    pst.title,
    pst.imgSrc,
    pst.altSrc,
    pst.slug,
    pst.slogan,
    pst.dateOfPublication,
    (SELECT categories.category FROM categories WHERE categories.Id =
        (SELECT blogcategories.category_id FROM blogcategories WHERE blogcategories.post_id = pst.Id LIMIT 1) ) AS categoryName,
   (SELECT tags.tag FROM tags WHERE tags.Id =
        (SELECT posttags.tag_id FROM posttags WHERE posttags.post_id = pst.Id LIMIT 1)) AS tagName
             FROM blogposts AS pst WHERE pst.state = 'published'	
				 ");
    }

    public function removeOnePost($id)
    {
        $this->executeQuery("DELETE FROM blogcategories WHERE blogcategories.post_id = " . $id);
        $this->executeQuery("DELETE FROM posttags WHERE posttags.post_id = " . $id);
        $this->executeQuery("DELETE FROM comments WHERE post_id=" . $id . ";");
        $this->removeRow($id);
        return true;

    }

    public function getById($id)
    {
        return $this->getOneRow(["id" => $id]);
    }

    public function UpdateImagePathOfProdById($id, $path)
    {
        return parent::updateRow($id, [
            "imgSrc" => $path
        ]);
    }
}
