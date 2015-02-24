<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gamelogs extends MY_Controller {

	function __construct() {
		parent::__construct();
		if (!$this->session->userdata('loggedin')) {
			redirect('user/login', 'refresh');
		}
		$this->load->model('gamelogmodel');
		$this->load->model('adminmodel');
		$session_data = $this->session->userdata('loggedin');
		$data['username'] = $session_data['username'];
		
		$this->load->view('header', $data);
		$this->load->model('usermodel');
		$data['perm_list'] = $this->config->item('permissions');
		$data['check_perm'] = $this->usermodel->get_perms($session_data['group'],$data['perm_list']);
		$this->load->view('sidebar', $data);
		$this->load->library('form_validation');
	}
	
	public function atcmd() {
		$session_data = $this->session->userdata('loggedin');
		if ($this->adminmodel->check_perm($session_data['group'],'atcmdlog') == True) {
			$this->usermodel->update_user_active($session_data['id'],"gamelog/atcmd");
			$data['atcmd_log'] = $this->gamelogmodel->get_atcmd_log();
			$this->load->view('gamelogs/atcmd', $data);
		}
		else {
			$data['referpage'] = "noperm";
			$this->load->view('accessdenied', $data);
		}
		$this->load->view('footer-nocharts');
	}
	
	public function atcmdsearch() {
		if (empty($this->input->post('date_start')) == false) {
			$this->form_validation->set_rules('date_start', "Start Date", 'callback_check_datetime');
		}
		if (empty($this->input->post('date_end')) == false) {
			$this->form_validation->set_rules('date_end', "End Date", 'callback_check_datetime');
		}
		if ($this->form_validation->run() == FALSE) {
			$data['atcmd_log'] = $this->gamelogmodel->get_atcmd_log();
			$this->load->view('gamelogs/atcmd', $data);
		}
		else {
			$atcmdSearch = array(
				'char_name'		=> $this->input->post('char_name'),
				'atcmd'			=> $this->input->post('atcmd'),
				'date_start'	=> $this->input->post('date_start'),
				'date_end'		=> $this->input->post('date_end'),
				'map'				=> $this->input->post('map'),
			);
			$data['atcmd_log'] = $this->gamelogmodel->get_atcmd_search($atcmdSearch);
			$this->load->view('gamelogs/atcmd', $data);
		}
		$this->load->view('footer-nocharts');
	}
	
	function check_datetime($date) {
		if (date('Y-m-d H:i:s', strtotime($date)) == $date) {
			return true;
		}
		else {
			$this->form_validation->set_message('datetime_check', 'The datetime given is not in the proper format.');
			return false;
		}
	}
}