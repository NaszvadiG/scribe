<?php

class Scribe extends Controller {

	function __construct() {
		parent::Controller();
		$this->load->library('pagination');
	}
	
	/* Kinda rough around the edges. Needs to be more ordered */
	function index() {
		
		$this->db->order_by("date", "desc");
		$data['posts'] = $this->db->get('posts',5);
		
		$config['base_url'] = base_url() . '/post/p';
		$config['total_rows'] = $this->db->get('posts')->num_rows();
		$config['per_page'] = '5';
		$this->pagination->initialize($config);
		$data['paginate_posts'] = $this->pagination->create_links();
		
		$this->load->view('index', $data);
		
	}
	
	/* The posts subpage. Probably here because we also need a pages. Plus, I totally forget why I used post/p. :P
	*/
	function post() {
		if(!$this->uri->segment(2)) {
			redirect('/');
		} else {
			if($this->uri->segment(2) == 'p') {
				
				$config['base_url'] = base_url() . '/post/p';
				$config['total_rows'] = $this->db->get('posts')->num_rows();
				$config['per_page'] = '5';
				$this->pagination->initialize($config);
				$data['paginate'] = $this->pagination->create_links();
				
				$this->db->order_by("date", "desc");
				$data['posts'] = $this->db->get('posts',5, $this->uri->segment(3));
				
				$this->load->view('list', $data);
				
			} else {
				
				$id = $this->uri->segment(2);
				
				$data['posts'] = $this->db->get_where('posts', array('id' => $id));
				$data['comments'] = $this->db->get_where('comments', array('post_id'=>$id));
				
				$this->load->view('single', $data);
					
			}
		}
	}
	
}