<?php

class Feed extends Controller {
	
	function __construct() {
		parent::Controller();
		$this->load->helper('xml');
	}
	
	function index() {
		$data['encoding'] = 'utf-8';
		$data['feed_name'] = 'Halfpant.net';
		$data['feed_url'] = 'http://halfpant.net';
		$data['page_description'] = 'well';
		$data['page_language'] = 'en-us';
        
		$this->db->orderby("date", "desc");
		$data['posts'] = $this->db->get('posts', 10);
		
        header("Content-Type: application/rss+xml");
        $this->load->view('feed/rss', $data);
	}
	
}