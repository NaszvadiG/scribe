<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends Model {
	
	function __construct() {
		parent::Model();
	}
	
	function getNumberOfPosts() {
		$query = $this->db->get('posts');
		
		return $query->num_rows();
	}
	
	function getNumberOfTags() {
		$query = $this->db->get('tags');
		
		return $query->num_rows();
	}
	
	function getNumberOfComments() {
		$query = $this->db->get('comments');
		
		return $query->num_rows();
	}
	
}