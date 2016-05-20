<?php if (!defined('BASEPATH'))
{
	exit('No direct script access allowed');
}

class Mailtest extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mta_site');
		$this->load->model('Mta_mail');
	}
	
	//发送测试邮件
	public function index()
	{
		$data = array
		(
			'to'    => $this->input->get('email'),
			'name'  => 'student_name',
			'title' => 'title',
			'body'  => 'body',
		);
		echo $this->Mta_mail->send($this->input->get('email'), 'hi', 'hi');

		
	}
	
	public function feedback()
	{
		echo 1;
		$this->load->model('Mta_feedback');
		
		print_r($this->Mta_feedback->admin_manage_feedback(array('id' => 2, 'manage' => false, 'content' => '222')));
		
		
	}
	
	public function aaa()
	{
		echo 1;
	}

	private function gettbs()
	{
		$url = 'http://tieba.baidu.com/dc/common/tbs';
		$result = json_decode(file_get_contents($url));
		return $result->tbs;
	}

	public function getlist()
	{
		$match = array(array());
		$list = array();
		$index = 1;
		do
		{
			foreach ($match[0] as $tieba)
			{
				$list[] = $tieba;
			}
			$url = 'http://tieba.baidu.com/f/like/mylike?pn='.$index;
			$options = array(
				'http' => array(
					'method'  => 'GET',
					'header'  => 'Cookie:TIEBA_USERTYPE=121622eedaaf0279aa2e3fd5; bdshare_firstime=1438240238954; rpln_guide=1; Hm_lvt_287705c8d9e2073d13275b18dbd746dc=1453522730,1455984699; BDUSS=UNmeGhjQU9NblY2VFNlMFBkNDZGYjJVektrQ3JmMm9mZ3NydXo0U0VPYkttelJYQVFBQUFBJCQAAAAAAAAAAAEAAAASyBw6zeO2ubzUsMkyODI1usUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMoODVfKDg1Xc; TIEBAUID=7a2a671aadf79cdde7f481f4; BAIDUID=74788FDBF3358432855BCD29C7AE3697:FG=1; PSTM=1463062664; BIDUPSID=60A32969EAC96C9A6EB2F43B5C31F92D; pgv_pvi=2397014016; cflag=15%3A3; IS_NEW_USER=e7d5aa4e5962ea81d6d4932c; BAIDU_WISE_UID=wapp_1463452418604_463; SEENKW=%E9%AD%94%E5%85%BD%E5%9C%B0%E5%9B%BE%E7%BC%96%E8%BE%91%E5%99%A8; wise_device=0; LONGID=974964754; H_PS_PSSID=1450_13701_19568_19559_19842_19860_17001_15886_11461',
					'timeout' => 15 * 60
				)
			);
			//echo $options['http']['header'];
			$context = stream_context_create($options);
			$result = file_get_contents($url, false, $context);
			$num = preg_match_all('/(?!\/f\?kw=)([\s\S]*?)(?=")/', $result, $match);
			$index++;
		}
		while ($num != 0);
		print_r($list);
	}

	public function send_post()
	{
		$this->getlist();
		$tbs = $this->gettbs();
		echo $tbs;

		$url = 'http://c.tieba.baidu.com/c/c/forum/sign';
		$post_data = array(
			'BDUSS' => 'UNmeGhjQU9NblY2VFNlMFBkNDZGYjJVektrQ3JmMm9mZ3NydXo0U0VPYkttelJYQVFBQUFBJCQAAAAAAAAAAAEAAAASyBw6zeO2ubzUsMkyODI1usUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMoODVfKDg1Xc',
			'fid'   => '179758',
			'kw'    => '西南位育',
			'tbs'   => $tbs,
		    'sign'  => ''
		);
		$sign = strtoupper(md5('BDUSS='.$post_data['BDUSS'].'fid='.$post_data['fid'].'kw='.$post_data['kw'].'tbs='.$post_data['tbs'].'tiebaclient!!!'));
		//echo $sign, '<br>';
		$post_data['sign'] = $sign;

		$postdata = http_build_query($post_data);
		$options = array(
			'http' => array(
				'method'  => 'POST',
				'header'  => 'Content-type:application/x-www-form-urlencoded',
				'content' => $postdata,
				'timeout' => 15 * 60
			)
		);
		$context = stream_context_create($options);
		//$result = file_get_contents($url, false, $context);

		//echo $result;
	}

	
}


