<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post_model extends Model {
	
	function __construct() {
		parent::Model();
	}
	
	
	
	function getPosts( $num = 0, $offset = 0, $sortby = 'desc' ) {
		
		$this->db->order_by("date", $sortby);
		
		if($num == 0 && $offset == 0) {
			$query = $this->db->get('posts');
		} else {
			if($num == 0) {
				$query = $this->db->get('posts',0,$offset);
			}
			if($offset == 0) {
				$query = $this->db->get('posts',$num);
			}
			if($num != 0 && $offset != 0) {
				$query = $this->db->get('posts', $num, $offset);
			}
		}
		
		return $query->result();
		
	}
	
	
	
	function getPostById( $id ) {
		$query = $this->db->get_where('posts', array('id' => $id));
		
		return $query->result();
	}
	
	
	
	function getPostBySlug( $name ) {
		$query = $this->db->get_where('posts', array('slug' => $slug));
		
		return $query->result();
	}
	
	
	
	function getPostsByTag( $tag ) {
		
		/* Join post2tag and posts database. Then select all the post fields where tag is tagid. */
		
	}
	
	
	
	/* Multiple posts can have the same name. So, to work around it, here's a simple thingy.
		When inserting a new post, we check to see if a post in the db has the same slug or not.
		If there is one, we prepend the post id to the slug.
	*/
	
	// below, $post is an array containing all the relevant data.
	function insertPost( $post ) {
		$postSlug = url_title($post['title'], 'underscore');
		$query = $this->etPostBySlug( $postSlug );
		if($query->num_rows() > 0) {
			$postSlug .= '_' . $post['id'];
		}
		
		$data = array(
					'id' => $post['id'],
					'title' => $post['title'],
					'body' => $post['body'],
					'published' => $post['published'],
					'date' => $post['date'],
					'slug' => $postSlug,
					'author' => $post['author']
				);
		return $this->db->insert('posts', $data);
					
	}
	
	
	
	function deletePost( $id ) {
		$this->db->where('id', $id);
		return $this->db->delete('posts');
	}
	
}