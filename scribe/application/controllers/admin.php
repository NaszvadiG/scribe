<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Controller {

	function __construct() {
		parent::Controller();
		$this->load->library('validation');
		if($this->uri->segment('2') != "login") {
			if(!$this->erkanaauth->try_session_login()) {
				redirect('admin/login');
			}
		}
	}
	
	/*
	The login session currently uses cookies.
	It is basically the Erkana authentication library made by Michael Wales (http://michaelwales.com/).
	We definitely need something better, and much more robust. But till then, this will do.
	*/
	
	function index() {
		$this->load->view('admin/index_view');
	}
	
	// Logging in page. site.com/admin/login.
	function login() {
		if (!$this->erkanaauth->try_session_login()) {
			$rules['username'] = "required|trim|callback__check_login";
			$rules['password'] = "required";
			$this->validation->set_rules($rules);
			$fields['username'] = "username";
			$fields['password'] = "password";
			$this->validation->set_fields($fields);
			if ($this->validation->run()) {
				$this->load->helper('security');
				$username = $this->input->post('username');
				$password = dohash($this->input->post('password'));
				$data = array(
					'username'	=>	$username,
					'password'	=>	$password
				);
				if ($this->erkanaauth->try_login($data)) {
					redirect('admin/index');
				} else {
					$this->load->view('admin/login_view');
				}
			} else {
				$this->load->view('admin/login_view');
			}
		} else {
			redirect('admin/index');
		}
	
	}
	
	function _check_login($username) {
		$this->load->helper('security');
		$password = dohash($this->input->post('password'));
		$data = array(
				'username'	=>	$username,
				'password'	=>	$password
			);
		if ($this->erkanaauth->try_login($data)) {
			return TRUE;
		} else {
 			$this->validation->set_message('_check_login', 'Incorrect login info.');
    		return FALSE;
		}
	}
	
	function logout() {
		$this->erkanaauth->logout();
		redirect('');
	}
	
	/*
	Creating a post.
	Currently this is how it works.
	admin/post => shows all the currently available posts.
	admin/post/new => creates a new post.
	admin/post/edit => 'No post mentioned. Please do not be naughty.'
	admin/post/edit/:postid => edits that particular post.
	*/
	function post($type = '') {
		if(!$type) {
			$this->db->order_by("date", "desc");
			$data['query'] = $this->db->get('posts');
			$data['page_title'] = "List of available posts";
			$this->load->view('admin/post/list', $data);
		} else {
			if($type=='new') {
				$rules['title'] = "trim";
				$rules['post_body'] = "required|trim";
				$this->validation->set_rules($rules);
				$fields['title'] = "title";
				$fields['post_body'] = "body";
				$this->validation->set_fields($fields);
				
				if($this->validation->run()) {
					$title = $this->input->post('title');
					$body = $this->input->post('post_body');
					$date = date('Y-m-d H:i:s');
					$author = getField('username');
					$data = array(
						'title'	=>	$title,
						'body'	=>	$body,
						'date'	=>	$date,
						'author'=>	$author
					);
					
					if($this->db->insert('posts',$data))
						$this->load->view('admin/post/success');
					else
						$this->load->view('admin/post/fail');
				} else {
					$this->load->view('admin/post/new');
				}
			} elseif($type=='edit') {
				if(!$this->uri->segment(4)) {
					die('No post mentioned. Please do not be naughty.');
				}
				$id = $this->uri->segment(4);
				$rules['title'] = "trim";
				$rules['post_body'] = "required|trim";
				$this->validation->set_rules($rules);
				$fields['title'] = "title";
				$fields['post_body'] = "body";
				$this->validation->set_fields($fields);
				
				if($this->validation->run()) {
					$title = $this->input->post('title');
					$body = $this->input->post('post_body');
					$data = array(
						'title' => $title,
						'body' => $body
						);
					$this->db->where('id', $id);
					if($this->db->update('posts', $data))
						$this->load->view('admin/post/success');
					else
						$this->load->view('admin/post/fail');
						
				} else {
					$data['query'] = $this->db->get_where('posts',array('id'=>$id),1);
					$this->load->view('admin/post/edit', $data);
				}
			} elseif($type=='delete') {
				if(!$this->uri->segment(4))
					die('No post mentioned. Please do not be naughty.');
				$id = $this->uri->segment(4);
				if($this->db->delete('posts', array('id' => $id))) {
					$this->load->view('admin/post/success');
				} else {
					$this->load->view('admin/post/fail');
				}
			}
		}
	}
	
	/*
	The thing here is that the admin file contains the new comment code, which it should NOT.
	Other than that, it also has admin/comments for displaying all comments, and admin/comments/edit/:commentid for editing commentid.
	*/
	
	function comments($type = '') {
		if($type=='new') {
			
			$rules['cname'] = "required|trim";
			$rules['email'] = "required|valid_email|trim";
			$rules['website'] = "trim";
			$rules['comment'] = "required|trim";
			$this->validation->set_rules($rules);
			$fields['cname'] = "name";
			$fields['email'] = "email";
			$fields['website'] = "website";
			$fields['comment'] = "comment";
			$this->validation->set_fields($fields);
			
			if($this->validation->run()) {
				$name = $this->input->post('cname');
				$email = $this->input->post('email');
				$url = $this->input->post('website');
				$comment = $this->input->post('comment');
				$postid = $this->input->post('post_id');
				$date = date('Y-m-d H:i:s');
				
				$data = array(
					'name' => $name,
					'email' => $email,
					'url' => $url,
					'body' => $comment,
					'post_id' => $postid,
					'date' => $date
					);
				if($this->db->insert('comments',$data))
					redirect('post/'.$postid);
				else
					die('Something went horribly wrong!');
			} else {
				die($this->validation->error_string);
			}
			
		} else {
			if(!$type) {
				$data['page_title'] = "List of all comments"; 
				$this->db->order_by("date", "desc");
				$data['query'] = $this->db->get('comments');
				$this->load->view('admin/comments/list', $data);
			} else {
				if(!$this->uri->segment(4))
					die('Please load a proper comment. Do not be naughty.');
				if($type=='edit') {
					$id = $this->uri->segment(4);
					$rules['cname'] = "required|trim";
					$rules['email'] = "required|valid_email|trim";
					$rules['website'] = "trim";
					$rules['comment'] = "required|trim";
					$this->validation->set_rules($rules);
					$fields['cname'] = "name";
					$fields['email'] = "email";
					$fields['website'] = "website";
					$fields['comment'] = "comment";
					$this->validation->set_fields($fields);
					
					if($this->validation->run()) {
						$name = $this->input->post('cname');
						$email = $this->input->post('email');
						$url = $this->input->post('website');
						$comment = $this->input->post('comment');
						
						$data = array(
							'name' => $name,
							'email' => $email,
							'url' => $url,
							'body' => $comment
							);
						if($this->db->update('comments',$data,array('id'=>$id)))
							$this->load->view('admin/comments/success');
						else
							$this->load->view('admin/comments/fail');
						
					} else {
						$data['query'] = $this->db->get_where('comments',array('id'=>$id),1);
						$this->load->view('admin/comments/edit', $data);
					}
					
				} elseif($type=='delete') {
					$id = $this->uri->segment(4);
					if($this->db->delete('comments',array('id'=>$id)))
						$this->load->view('admin/comments/success');
					else
						$this->load->view('admin/comments/fail');
				}
				
			}
		}
	}
	
	/*
	Probably not *the* biggest issue right now, but a theme panel should have basic functionalities.
	*/
	function theme() {
		
	}
	
	/*
	Followed by *the* biggest issue right now.
	*/
	function settings() {
		$rules['blog_title'] = "trim|required";
		$rules['blog_description'] = "trim";
		
	}
	
	/*
	Needs much work.
	*/
	function user($name) {
		if($name == '') {
		// If admin, view and edit all users, if writer, just view. mmkay?	
			$data['users'] = $this->db->get('users');
			
			
			
		} else {
		// Particular user
			if(getField('role') == 'administrator' || getField('username') == $name) {
				
				
				$rules['username'] = "trim";
				$rules['old_pass'] = "trim|required|callback__pass_check";
				$rules['password'] = "trim|matches[passconf]";
				$rules['passconf'] = "trim";
				$rules['email'] = "trim|valid_email";
				$this->validation->set_rules($rules);
				$fields['username'] = "username";
				$fields['old_pass'] = "old password";
				$fields['password'] = "new password";
				$fields['passconf'] = "password confirmation";
				$fields['email'] = "email";
				$this->validation->set_fields($fields);
				
				if($this->validation->run()) {
					$id = getField('id');
					$username = $this->input->post('username');
					$password = $this->input->post('password');
					
					if($username && $username!=getField('username')) {
						$this->db->where('id',$id);
						$this->db->update('users',array('username'=>$username));
					}
					if($password) {
						$passw = dohash($password);
						$this->db->where('id', $id);
						$this->db->update('users',array('password'=>$passw));
					}
					
					if(!$username && !$password) {
						$msg['message'] = "No information changed.";
					} elseif($password && $username) {
						$msg['message'] = "Password and username changed";
					} elseif($password) {
						$msg['message'] = "Password changed";
					} elseif($username) {
						$msg['message'] = "Username changed";
					}
					
					$this->load->view('admin/user_edit', $msg);
					
				} else {
					$msg['message'] = "";
					$this->load->view('admin/user_edit', $msg);
				}
				
				
			} else {
				die('no can do, sir.');
			}
		}
	}
	
	function _pass_check($password) {
		$this->load->helper('security');
		$pass = dohash($password);
		$id = getField('id');
		$this->db->where('id', $id);
		$query = $this->db->get('users');
		$row = $query->row_array();
		if($pass==$row['password']) {
			return TRUE;
		} else {
			$this->validation->set_message('pass_check', 'Password incorrect');
			return FALSE;
		}
	}
	
}