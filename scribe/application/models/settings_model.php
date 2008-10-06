<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings_model extends Model {
	
	function __construct() {
		parent::Model();
	}
	
	// Get a particular settings_
	function getSettings( $setting = '' ) {
		if($setting == '') {
			return "We need something to go by.";
		}
		
		$this->db->select('settings_value');
		$query = $this->db->get_where('settings', array('settings_name'=>$setting));
		
		return $query->result();
	}
	
	// Checks whether a setting is set or not. Basically, returns FALSE if settings_value for a particular setting is NULL.
	function getSet( $setting = '') {
		if($setting == '') {
			return "We need something to go by.";
		}
		
		$this->db->select('settings_value');
		$query = $this->db->get_where('settings', array('settings_name'=>$setting));
		
		if(!$query->result()) {
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
}