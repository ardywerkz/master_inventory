<?php

class Dashboard extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Dashboard';

		$this->load->model('model_products');
		$this->load->model('model_orders');
		$this->load->model('model_users');
		$this->load->model('model_stores');
	}

	/* 
	* It only redirects to the manage category page
	* It passes the total product, total paid orders, total users, and total stores information
	into the frontend.
	*/
	public function index()
	{
		$today = $this->session->userdata('date_today');
		$this->data['total_products'] = $this->model_products->countTotalProducts();
		$this->data['total_sale_today'] = $this->model_products->getSales_today($today);
		$this->data['total_sale_monthly'] = $this->model_products->get_saleMonthly();
		$this->data['total_sale_yearly'] = $this->model_products->get_saleYearly();
		// echo '<pre>';
		// print_r($this->data['total_sale_yearly']);

		$user_id = $this->session->userdata('id');
		$is_admin = ($user_id == 1) ? true : false;

		$this->data['is_admin'] = $is_admin;
		$this->render_template('dashboard', $this->data);
	}
}
