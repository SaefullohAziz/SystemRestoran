<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
    {
    	$data['title'] = 'Restoran';

    	$data['meja'] = $this->db->get('meja')->result_array();

        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/login');
        $this->load->view('templates/auth_footer');
    }

    public function login()
    {
        if ($this->input->post('no_meja')) {
            $no_meja = $this->input->post('no_meja');
            $id_order = $this->db->count_all('order') + 1;
            $data = [
                'id_order' => $id_order,
                'no_meja'  => $no_meja,
                'id_user'  => $no_meja,
                'keterangan' => '-',
                'status_order' => 1
            ];
            $this->db->set('tanggal', 'NOW()', FALSE);
            $this->db->insert('order', $data);

            $this->db->set('status', 1);
            $this->db->where('no_meja', $no_meja);
            $this->db->update('meja');

            $session = [
                'no_meja' => $no_meja,
                'id_order' => $id_order
            ];
            $this->session->set_userdata($session);

            redirect('user/');
        } else 
        {
            redirect('user/');
        }

    }

    public function logout()
    {
        $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Terimakasih telah mengunjungi lesehan sheila. Silahkan lakukan pembayaran di kasir dengan id_order = <b>' . $this->session->userdata['id_order'] . '</b>.</div>');

        $no_meja = $this->session->userdata('no_meja');

        $this->db->set('status', 0);
        $this->db->where('no_meja', $no_meja);
        $this->db->update('meja');

        $this->session->unset_userdata('no_meja');
        $this->session->unset_userdata('id_order');

            redirect('auth');
    }

}