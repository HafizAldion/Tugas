<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Overview extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		$this->load->model("produk_model");
	}

	public function index()
	{
		$data["produk"] = $this->produk_model->getAll(); // ambil data dari model
        $this->load->view("overview", $data); // load view 
	}
}