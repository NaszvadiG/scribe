<?php

class Halfpant extends Controller {

	function __construct() {
		parent::Controller();
		$this->load->library('pagination');
	}
	
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
	
	function post() {
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
			
			if(!$this->uri->segment(2)) {
				redirect('/');
			}
			
			$id = $this->uri->segment(2);
			
			$data['posts'] = $this->db->get_where('posts', array('id' => $id));
			$data['comments'] = $this->db->get_where('comments', array('post_id'=>$id));
			
			$this->load->view('single', $data);
			
		}
	}
	
}