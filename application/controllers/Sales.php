<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Sales extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = 'Sales Report';
        $this->load->model('model_sales');
    }

    /* 
    * It redirects to the report page
    * and based on the year, all the orders data are fetch from the database.
    */
    public function index()
    {
        if (!in_array('viewSales', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $this->render_template('sales/index', $this->data);
    }

    public function fetchSalesData()
    {
        $result = array('data' => array());

        $data = $this->model_sales->get_sales_query(); //get data sale query
        // echo '<pre>';
        // print_r($data);
        foreach ($data as $key => $value) {
            $result['data'][$key] = array(
                $value['name'],
                $value['month'],
                $value['year'],
                number_format($value['amount'])
            );
        } //end foreach
        echo json_encode($result);
    }

    public function everydaySales()
    {
        $result = array('data' => array());
        $data = $this->model_sales->get_sales_everyday();
        foreach ($data as $key => $value) {
            $result['data'][$key] = array(
                $value['name'],
                $value['Day'],
                $value['year'],
                number_format($value['amount'])
            );
        } //end foreach
        echo json_encode($result);
    }
}
