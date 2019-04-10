<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    // AUTOLOAD DI SEMUA METHOD (DISEBUT KONSTRAKTOR)
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

	public function index()
    {
    	$data['title'] = 'Menu masakan';
    	$data['meja'] = $this->session->userdata('no_meja');
    	$data['masakan'] = $this->db->get_where('masakan', ['status_makanan' => 1])->result_array();


        $this->load->view('templates/auth_header', $data);
        $this->load->view('user/menu', $data);
        $this->load->view('templates/auth_footer');
    }

    public function beli()
    {
    	$id_masakan = $this->input->post('id_makanan');
    	$jumlah = htmlspecialchars($this->input->post('jumlah'));
    	$keterangan = htmlspecialchars($this->input->post('ket'));
    	$id_order = $this->session->userdata('id_order');

    	$data = [
    		'id_detail_order' => '',
    		'id_order' => $id_order,
    		'id_masakan' => $id_masakan,
    		'jumlah' => $jumlah,
    		'keterangan' => $keterangan,
    		'status_detail_order' => 1
    	];
    	$this->db->insert('detail_order', $data);

    	$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Pesanan telah di konfirmasi, Silahkan pilih masakan lagi, atau tekan tombol selesai jika tidak ada lagi pesanan! Terimakasih - Lesehan sheila.</div>');
        redirect('user');
    }

    public function finish($total = 0)
    {
    	$id_user = $this->session->userdata('no_meja');
    	$id_order = $this->session->userdata('id_order');

        $pesanan = $this->db->query("SELECT count(*) AS j FROM `detail_order` WHERE `id_order` = $id_order")->row_array()['j'];

        if ($pesanan) {
            $q = "  SELECT SUM(`detail_order`.`jumlah` * `masakan`.`harga`)
                AS total
                FROM `detail_order` JOIN `masakan`
                ON `detail_order`.`id_masakan` = `masakan`.`id_masakan`
                WHERE `detail_order`.`status_detail_order` = 1
                AND `detail_order`.`id_order` = $id_order
                ";
            $total = $this->db->query($q)->result_array()[0]['total'];
        } else {
            $total = 0;
        }

    	

    	$data = [
    		'id_transaksi' => '',
    		'id_user'	   => $id_user,
    		'id_order'	   => $id_order,
    		'total_bayar'  => $total
    	];
        $this->db->set('tanggal', 'NOW()', FALSE);
        $this->db->insert('transaksi', $data);

        redirect('auth/logout');

    }

}