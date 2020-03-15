<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminCategoriesController extends MY_Controller {
    /**
     * AdminCategoriesController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->logged_in){
            redirect(base_url('index.php/login'));
            exit;
        }

        $this->load->model('ProductsModel');
        $this->load->model('CategoriesModel');

    }

    /**
     * Display the list of resource.
     */
	public function index()
	{
       $data['records'] = $this->CategoriesModel->order_by('created_at','desc')->get_all();

       $this->load->templateAdmin('admin/categories/list',$data);
	}

    /**
     * Create New Resource
     */
	public function create()
    {
        $data = array();

        $data['categories'] = $this->CategoriesModel->getCategoriesDropdown();
        //If POST method Create New Record
        if($this->input->server('REQUEST_METHOD')=='POST')
        {
            $inputs = $this->input->post();
            //print_r($inputs);
            $this->form_validation->set_rules('name','Name','trim|required|max_length[128]');


            if ($this->form_validation->run())
            {

                //Form validation success. Insert Record into database

				$upload_data = $this->uploadFile('cover_image',$this->getUploadConfig());

				$inputs['cover_image'] = $upload_data['file_name'];
                $last_id = $this->CategoriesModel->insert($inputs);


                $this->session->set_flashdata('success', 'Category Created successfully');

                redirect(base_url('index.php/admin/categories'));
                exit;
            }
        }


        $this->load->templateAdmin('admin/categories/create',$data);
    }

    /**
     * Show form for editing the resource Resource as well as update the database if HTTP verb is POST.
     *
     * @param $id
     */
    public function edit($id)
    {


        if($this->input->server('REQUEST_METHOD')=='POST')
        {
            $this->form_validation->set_rules('name','Name','trim|required|max_length[128]');

            if ($this->form_validation->run())
            {
                //Form validation success. Update Record
                $inputs = $this->input->post();
                $this->CategoriesModel->update($id, $inputs);
                $this->session->set_flashdata('success', 'Product Updated successfully');

                redirect(base_url('index.php/admin/categories'));
                exit;
            }
        }
        $record = $this->CategoriesModel->get($id);

        $data['record'] = $record;
        $data['categories'] = $this->CategoriesModel->getCategoriesDropdown($id);


        $this->load->templateAdmin('admin/categories/edit',$data);
    }

    public function delete($id)
    {
        if($this->input->server('REQUEST_METHOD')=='POST')
        {
            $status = $this->CategoriesModel->delete($id);
            if($status){
                $this->session->set_flashdata('info', 'Category deleted successfully.');
            }
            else{
                $this->session->set_flashdata('error', 'Failed to delete Category.');
            }

            redirect(redirect($_SERVER['HTTP_REFERER']));
        }

    }

    public function getUploadConfig(){
		$config = array();
		$config['upload_path'] = 'images/categories';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = 10000000;

		return $config;
	}
}
