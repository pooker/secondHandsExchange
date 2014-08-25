<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * the home controller of the website
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('language');
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->model('goodsM');
	}

	function index()
	{
		
		$data['page'] = '0';
		$data['message'] = '';
		$data['title'] = '颖火城-首页';
		$data['slide'] = $this->goodsM->getforSlide();
		$data['downslide'] = $this->goodsM->getfordownslide();
		$this->load->view('index/header',$data);
		$this->load->view('index/index',$data);
		$this->load->view('index/footer');
	}

	function get_good($type)//根据类别来获取物品
	{
		//$this->session->set_userdata['type'] = $this->uri->segment(3);
		$this->session->set_userdata('type', $this->uri->segment(3));
		$type = $this->uri->segment(3);
		$this->page($type,0);
	}
	
	function detail()
	{
		$id = $this->uri->segment(3);
		$q = $this->goodsM->getby_id($id);
		$data['title'] = '物品详情';
		$data['good'] = $q;
		$data['message']='';
		$data['page'] = $this->session->userdata('type');
		$this->load->view('index/header',$data);
		$this->load->view('index/detail',$data);
		$this->load->view('index/footer');
		
	}

	function add_good()
	{
		if (!$this->ion_auth->logged_in())
		 {
			//redirect them to the login page
			redirect('home/index', 'refresh');
			}
		$this->data['title'] = "发布我的二手物品";

		$this->form_validation->set_rules('catagery', '请选择分类', 'required|xss_clean');
		$this->form_validation->set_rules('price', '请标明价格', 'required|xss_clean');
		//$this->form_validation->set_rules('picture', '请选择相片', 'xss_clean');
		$this->form_validation->set_rules('title', '请输入标题', 'required|xss_clean');
		$this->form_validation->set_rules('description', '请详细说明', 'required|xss_clean');
		$this->form_validation->set_rules('address', '地址为必填内容', 'required|xss_clean');
		$this->form_validation->set_rules('connector', '联系人为必填内容', 'required|xss_clean');
		$this->form_validation->set_rules('phone', '联系人电话为必填内容', 'required|xss_clean');

		if ($this->form_validation->run() == true)
		{
			$catagery = $this->input->post('catagery');
			$price = $this->input->post('price');
			$title = $this->input->post('title');
			$description = $this->input->post('description');
			$address = $this->input->post('address');
			$connector = $this->input->post('connector');
			$phone = $this->input->post('phone');
			$sellor = $this->session->userdata('user_id');//从会话中获取用户名
			/**

			//进行上传图片的处理
			$config['upload_path'] ='./application/upload/image/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$pre = date("ymdhis",now()).'_'.rand(0,100);
			$config['file_name'] = array($pre.'_1.jpg',$pre.'_2.jpg',$pre.'_3.jpg',$pre.'_4.jpg');
			$config['max_size'] = '5000';
			$config['max_width'] = '10000';
			$config['max_height'] = '10000';

			$this->load->library('upload', $config);

			if($this->upload->do_multi_upload('picture[]')){
			$image_data = $this->upload->get_multi_upload_data();
			$config['image_library'] = 'gd2';
			$config['source_image'] = $image_data[0]['file_name'];
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['quality'] = '100';
			$config['width'] = '480';
			$config['height'] = '640';
			$config['master_dim'] = 'width';

			$config['wm_text'] = 'FROM:'.$this->session->userdata('username').'';
			$config['wm_type'] = 'text';
			// $config['wm_font_path'] = './system/fonts/texb.ttf';
			$config['wm_font_size'] = '16';
			$config['wm_font_color'] = 'CCCCCC';
			$config['wm_vrt_alignment'] = 'top';
			$config['wm_hor_alignment'] = 'center';
			$config['wm_padding'] = '20';
			$config['wm_opacity'] = '100';
				
			//$config['new_image'] ='./application/upload/image/'.date("ymdhis",now()).'_'.rand(0,100).'.jpg';//最终图片存放位置
			$picture = './application/upload/image/'.$image_data['file_name'];
			$this->load->library('image_lib', $config);

			if ( ! $this->image_lib->resize())
			{
			echo $this->image_lib->display_errors();
			}
			elseif(!$this->image_lib->watermark())
			{
			echo $this->image_lib->display_errors();
			}
			else echo 'ok';
				
				
			$q = $this->goodsM->add($catagery,$price,$picture,$title,$description,$address,$connector,$phone,$sellor);
			}
			else echo $this->upload->display_errors();
			// end of picture manage
			**/
			$picture = "null";
			$q = $this->goodsM->add($catagery,$price,$picture,$title,$description,$address,$connector,$phone,$sellor);
			if($q)
			{
				$this->order();
			}
		}
		else
		{
			//display the create user form
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
			$this->data['catagery'] = array(
				'name'  => 'catagety',
				'id'    => 'catagery',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('catagery'),
			);
			$this->data['price'] = array(
				'name'  => 'price',
				'id'    => 'price',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('price'),
			);

			$this->data['title'] = array(
				'name'  => 'title',
				'id'    => 'title',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('title'),
			);
			
			$this->data['description'] = array(
				'name'  => 'description',
				'id'    => 'description',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('description'),
			);
			$this->data['address'] = array(
				'name'  => 'address',
				'id'    => 'address',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('address'),
			);
			$this->data['connector'] = array(
				'name'  => 'connector',
				'id'    => 'connector',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('connector'),
			);
			$this->data['phone'] = array(
				'name'  => 'phone',
				'id'    => 'phone',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('phone'),
			);
			$this->data['page'] = 0;
			$this->data['message'] ='';
			$this->data['title'] = '发布我的二手物品';
			$this->load->view('index/header',$this->data);
			$this->load->view('index/add_good', $this->data);
		}
	}

	function page($type)//底部分页
	{
		$this->load->library('pagination');
		$config['base_url']=site_url('home/page/'.$this->session->userdata('type').'/');
		$config['total_rows']=10000;//数据总条数
		$config['per_page']=50;//每页显示条数
		//$config['suffix'] = '/'.$this->session->userdata('type') ;
		$config['uri_segment']=4;//设置URI 的哪个部分包含页数
		$config['num_links']=2;//当前页码的前面和后面的“数字”链接的数量
		$config['use_page_numbers']=TRUE;//默认分页URL中是显示每页记录数,启用use_page_numbers后显示的是当前页码
		$config['full_tag_open'] = '<ul class="controls-buttons pagination">';//把打开的标签放在所有结果的左侧。
		$config['full_tag_close'] = '</ul>';//把关闭的标签放在所有结果的右侧。
		$config['first_link'] = '首页';//你希望在分页的左边显示“第一页”链接的名字。如果你不希望显示，可以把它的值设为 FALSE
		$config['first_tag_open'] = '<li>';//“第一页”链接的打开标签。
		$config['first_tag_close'] = '</li>';//“第一页”链接的关闭标签。
		$config['last_link'] = '末页';//你希望在分页的右边显示“最后一页”链接的名字。如果你不希望显示，可以把它的值设为 FALSE 。
		$config['last_tag_open'] = '<li>';//“最后一页”链接的打开标签。
		$config['last_tag_close'] = '</li>';//“最后一页”链接的关闭标签。
		$config['prev_link'] = '上一页';//你希望在分页中显示“上一页”链接的名字。如果你不希望显示，可以把它的值设为 FALSE 。
		$config['prev_tag_open'] = '<li>';//“上一页”链接的打开标签 。
		$config['prev_tag_close'] = '</li>';//“上一页”链接的关闭标签 。
		$config['next_link'] = '下一页';//你希望在分页中显示“下一页”链接的名字。如果你不希望显示，可以把它的值设为 FALSE 。
		$config['next_tag_open'] = '<li>';//“下一页”链接的打开标签 。
		$config['next_tag_close'] = '</li>';//“下一页”链接的关闭标签 。
		$config['num_tag_open'] = '<li>';//“数字”链接的打开标签。
		$config['num_tag_close'] = '</li>';//“数字”链接的关闭标签。
		$config['cur_tag_open'] = '<li class="active"><a ><b>';//“当前”链接的打开标签。
		$config['cur_tag_close'] = '</b></a></li>';//“当前”链接的关闭标签。
		$this->pagination->initialize($config);//以上参数被 $this->pagination->initialize 方法传递
		$data['pagination']=$this->pagination->create_links();//创建分页变量给$pagination
		 
		$arr['num']=$config['per_page'];
		$arr['offset']=$this->uri->segment(4)!==FALSE?$this->uri->segment(4):0;
		$this->load->model('goodsM');
		$type = $this->uri->segment(3);
		$data['accounts'] = $this->goodsM->getLimit($arr,$type);//获取数据
		$data['page'] = $type;
		$data['message'] = '';
		$data['title'] = '我正在乱逛';
		// Load data variables separately so all views being loaded receive them
		$this->load->vars($data);

		// Load template view
		$this->load->view('index/header',$data);
		$this->load->view('index/list',$data);
		$this->load->view('index/footer');
		
		$type = $type;
	}

	function order()//获取用户的订单发布的二手物品
	{
		if (!$this->ion_auth->logged_in())
		 {
			//redirect them to the login page
			redirect('home/index', 'refresh');
			}
		$id = $this->session->userdata('user_id');
		$data['order'] = $this->goodsM->getBy_sellor($id);
		$data['title'] = '我出售的物品';
		$data['message'] = '';
		$data['page'] = '0';
		$this->load->view('index/header',$data);
		$this->load->view('index/myOrder',$data);
		$this->load->view('index/footer');
	}
	function complete()
	{
		//根据view里面传进来的物品id来对物品进行交易确认
		if (!$this->ion_auth->logged_in())
		 {
			//redirect them to the login page
			redirect('home/index', 'refresh');
		}
		$id = $this->uri->segment(3);
		if ($this->goodsM->sold_out($id))
		{
			redirect('home/order','refresh');//重定向至原界面
		}
	}
	
	function admin_user()
	{
		 if (!$this->ion_auth->logged_in())
		 {
			//redirect them to the login page
			redirect('home/index', 'refresh');
			}
			elseif (!$this->ion_auth->is_admin()) //remove this elseif if you want to enable this for non-admins
			{
			//redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
			}
			else
			{
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			//list the users
			$this->data['users'] = $this->ion_auth->users()->result();
			foreach ($this->data['users'] as $k => $user)
			{
			$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}

			$this->load->view('admin/mana_user', $this->data);
			}
			
	}
	function delete()
	{
		if($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
		{
		$this->load->model('ion_auth_model');
		$id = $this->uri->segment(3);
		if( $this->ion_auth_model->delete_user($id) )
		{
			redirect('home/admin_user','refresh');
		}
		else '删除失败';
		}
		else echo 'get out !!!';
	}
	function admin_order()
	{
	if (!$this->ion_auth->logged_in())
		 {
			//redirect them to the login page
			redirect('home/index', 'refresh');
			}
			elseif (!$this->ion_auth->is_admin()) //remove this elseif if you want to enable this for non-admins
			{
			//redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
			}
			else
			{
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			//list the users
			$this->data['orders'] = $this->goodsM->getAll();
			
			$this->load->view('admin/mana_order', $this->data);
			}
	}
	
	function reg()
	{
		$data['page'] = '0';
		$data['title'] = '注册';
		$data['message'] = '';
		$this->load->view('index/header',$data);
		$this->load->view('index/reg',$data);
		$this->load->view('index/footer');
	}

}