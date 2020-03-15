<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ShopController extends CI_Controller {
    /**
     * ShopController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model('ProductsModel');
        $this->load->model('ProductImagesModel');
        $this->load->model('CategoriesModel');
        $this->load->library('pagination');
    }

    /**
     * Get Configuration for pagination.
     *
     * @param $category_id required to find total records from model.
     * @param $inputs required to find total records from model.
     * @return mixed
     */
    public function getPaginationConfig($category_id,$inputs)
    {
        $config['base_url'] = base_url('index.php/shop/'.$this->uri->segment(2));
        $config['total_rows'] = $this->ProductsModel->getTotalRecordsForPagination($category_id,$inputs);
        $config['per_page'] = 9;
        $config['page_query_string'] = true;

        $config['reuse_query_string'] = true;
        $config['full_tag_open'] = '<div class="pagination flex-m flex-w p-t-26">';
        $config['full_tag_close'] = '</div>';
        $config['cur_tag_open'] = '<a class="item-pagination flex-c-m trans-0-4 active-pagination">';
        $config['cur_tag_close'] = '</a>';
        $config['attributes'] = array('class' => 'item-pagination flex-c-m trans-0-4');
        return $config;
    }

    /**
     * Display List of Products for shopping using Category ID.
     *
     * @param null $category_id
     */
	public function index($category_id = null)
	{
        //Get Query string Inputs.
        $inputs = $this->input->get();

        $pagination_config = $this->getPaginationConfig($category_id,$inputs);

        $this->pagination->initialize($pagination_config);

        $current_per_page = $this->input->get('per_page') OR 0;

        $limit = $pagination_config['per_page'];
        $offset = $current_per_page;

        //Get Categories
        $data['categories'] = $this->CategoriesModel->get_all();
        //

        $data['total_rows'] = $pagination_config['total_rows'];
		$products = $this->ProductsModel->getProductsForShop($category_id,$inputs,$limit,$offset);

		//Get Product Images :
		//$this->ProductImagesModel->getImageLookupProducts($products);


		$data['products'] = $products;

       $this->load->template('shop/list',$data);
	}
}
