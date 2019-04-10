<?php 


function get_order()
{
	$ci = get_instance();
	
	return $order = $ci->db->query("SELECT count(*) AS j FROM `order`")->row_array()['j'] + 1;
}

function is_logged_in()
{
	$ci = get_instance();
	if (!$ci->session->userdata('no_meja')) {
		redirect('auth');
		die;
	}
}