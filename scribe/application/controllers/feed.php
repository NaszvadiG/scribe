<?php

class Feed extends Controller {
	
	function __construct() {
		parent::Controller();
		$this->load->helper('xml');
	}
	
	/*
	Currently, the index loads the RSS feed. It probably shouldn't, but I only used the RSS before.
	The index will redirect to the RSS or ATOM feed in the future, based on the Settings.
	Till such time, 
	*/
	function index() {
		$data['encoding'] = 'utf-8';
		$data['feed_name'] = 'Halfpant.net'; // Needs change
		$data['feed_url'] = 'http://halfpant.net'; // Needs change
		$data['page_description'] = 'well';
		$data['page_language'] = 'en-us';
        
		$this->db->orderby("date", "desc");
		$data['posts'] = $this->db->get('posts', 10);
		
        header("Content-Type: application/rss+xml");
        $this->load->view('feed/rss', $data);
	}
	
	function atom() {
		
	}
	
	function rss() {
		
	}
	
}