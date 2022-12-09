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
    public function getPost($offset, $limit, $category, $tag)
    {
        $query = "SELECT blogposts.id, blogposts.title, blogposts.slogan, blogposts.dateOfPublication, 
                    blogposts.imgSrc, blogposts.altSrc, blogposts.content, blogposts.state, blogposts.author, 
                    categories.category, tags.tag
                    FROM blogposts 
                    LEFT JOIN blogcategories
                    ON blogposts.id = blogcategories.post_id
                    LEFT JOIN categories
                    ON categories.id = blogcategories.category_id
                    LEFT JOIN posttags
                    ON posttags.post_id = blogposts.id
                    LEFT JOIN tags
                    ON tags.id = posttags.tag_id
                    WHERE blogposts.state = 'published'";
        if($category != ""){
            $query .= "AND categories.category = '".$category."'";
        }
        if($tag != ""){
            $query .= "AND tags.tag = '".$tag."'";
        }
        $query .= "LIMIT ".$limit." OFFSET ". $offset;
        return $this->executeQuery($query);
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
    public function getAllPostsCount()
    {
        return $this->executeQuery("SELECT COUNT(*) FROM blogposts");
    }

    public function getPostByAuthorId($id){
        return $this->executeQuery("SELECT blogposts.id, blogposts.title, blogposts.slogan, blogposts.dateOfPublication, blogposts.imgSrc, blogposts.altSrc, blogposts.content, (SELECT GROUP_CONCAT(DISTINCT categories.category SEPARATOR ', ') AS categories FROM blogcategories
	LEFT JOIN categories ON blogcategories.category_id = categories.id
	LEFT JOIN blogposts ON blogcategories.post_id = blogposts.id
	WHERE blogposts.author =" . $id . ") AS tags,
	(SELECT GROUP_CONCAT(DISTINCT tags.tag SEPARATOR ', ') AS tags FROM posttags
	LEFT JOIN tags ON posttags.tag_id = tags.id
	LEFT JOIN blogposts ON blogposts.id = posttags.post_id
	WHERE blogposts.slug = " . $id . ") AS categories
 FROM blogposts
WHERE author = " . $id
        );
    }

    public function UpdateImagePathOfProdById($id, $path)
    {
        return parent::updateRow($id, [
            "imgSrc" => $path
        ]);
    }
}
