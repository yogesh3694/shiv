<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CheckoutController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProductsModel');
        $this->load->model('ProductImagesModel');
        if(!$this->session->userdata('logged_in'))
        {
            $this->session->set_userdata('redirect_to',base_url('index.php/'.uri_string()));
            redirect(base_url('index.php/login'));
        }
        include_once APPPATH."third_party/stripe/init.php";
        
    }
    /**
     * Display the list of resource.
     */
    public function index()
    {
        //if cart is empty,
        if(count($this->cart->contents()) == 0){
            $this->session->set_flashdata('error', 'Please add items  to cart first');
            redirect(base_url('index.php/shop'));
            exit();
        }
        $data['cart'] = $this->cart->contents();

        $this->load->template('checkout/checkout',$data);
    }

    /**
     * Place order
     */
    public function placeOrder()
    {


        $this->load->model('OrdersModel');
        $this->load->model('OrderProductModel');

        $cart_contents = $this->cart->contents();

        $total_amt = $this->cart->total(); //Temperory set to cart total


        $order_data = array(
            'user_id' => $this->session->userdata('user')->id,//Logged in user id
            'delivery_address' => $this->input->post('delivery_address'),
            'pincode'=>$this->input->post('pincode'),
            'order_status' => '1',
            'total_amt'=> $total_amt
        );
        $order_id = $this->OrdersModel->insert($order_data);

        /*payment*/
        // \Stripe\Stripe::setApiKey("sk_test_b3lLzyTbVwjJyaBLOe3s0rRS");
        
        //  $cents =  (int) ( ( (string) ( $this->input->post('amount') * 100 ) ) );

         
        // try {
        //     $charge = \Stripe\Charge::create(array(
        //         "amount" => $cents, 
        //         "currency" => "usd",
        //         "customer" => $customerID)
        //      );
        //     $success = 1;

        //     //echo $charge->id; exit;
            
        // } catch(Stripe_CardError $e) {  
        //   $error1 = $e->getMessage();
        // } catch (Stripe_InvalidRequestError $e) {  
        //   $error1 = $e->getMessage();
        // } catch (Stripe_AuthenticationError $e) {  
        //   $error1 = $e->getMessage();
        // } catch (Stripe_ApiConnectionError $e) {  
        //   $error1 = $e->getMessage();
        // } catch (Stripe_Error $e) {  
        //   $error1 = $e->getMessage();
        // } catch (Exception $e) {  
        //   $error1 = $e->getMessage();
        // }
        // if ($success!=1)
        // {
        //     $this->session->set_flashdata('paymentfail',$error1);
        //     redirect(base_url().'discussion-details/'.$did);
        // }

        // if($charge->id!=''){
        //     $databid = array('payment_status'=>'1');
        //     $condbid = array('dscussion_ID'=>$did,'user_ID'=>$this->session->userdata('userid'));
            
        //     $updatebid = $this->MainModel->updaterecords('trader_bid',$condbid,$databid);
        //     for($d=2;0<$d;--$d){
        //         if($d==2){
        //             $discussion_id=0;   
        //         }else{
        //             $discussion_id=$did;
        //         }
        //     $data = array(
        //         'user_ID'=>$this->session->userdata('userid'),
        //         'transaction_number'=>$charge->id,
        //         'disussion_ID'=>$discussion_id,
        //         'debit_credit'=>$d,
        //         'amount'=>$this->input->post("amount"),
        //         'description'=>'Payment as Attendee for bid',
        //         "createdDate" => date("Y-m-d H:i:s"),
        //         "updatedDate" => date("Y-m-d H:i:s")
        //    );
        //    $insert = $this->MainModel->insertdata('trader_transaction',$data);
        /*end payment*/

        foreach ($cart_contents as $product){
            $order_product_data = array(
                'product_id' => $product['id'],
                'order_id'=>$order_id,
                'qty'=>$product['qty'],
            );
            $this->OrderProductModel->insert($order_product_data);
        }
        if($order_id){
            $this->cart->destroy();
            $this->session->set_flashdata('success', 'Order placed successfully');
            redirect(base_url('index.php/shop'));
            exit;
        }
        else{
            $this->session->set_flashdata('error', 'Oops! Something went wrong.');
            redirect(base_url('index.php/shop'));
            exit;
        }



    }
}
