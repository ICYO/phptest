<?php
require_once("interface/Person_basic.php");


class User implements Person_basic {

    protected $manager = 3;
	public static $a = 'asd';
	public $name = FALSE;
	public $email = FALSE;
    protected $password = FALSE;
	public $age = FALSE;
	public $captcha = FALSE;

	public $db_path = 'DataBase.json';
	public $error = NULL;

	public function __construct()
	{
	    if(! isset($_SESSION))
			session_start();
		
		if(isset($_SESSION['user'])):
			header("Location:main.php");
		    exit(0);
		endif;

		$this->db = new mysqlIO($this->db_path);
	}

// regest:
    public function regest()
	{
//	check empty and space:
		if (! $this->check_info(
			[$this->email,
			 $this->password,
			 $this->name,
			 $this->age]
			))
			return false;
//	check captcha:
		if (! $this->check_captcha())
			return FALSE;

//	check multiple registed:
		$reg_data = ['email' => $this->email];
		$check = $this->db->select_once(
			['id'], 'users', $reg_data
			);
		if ($check != []) {
		    $this->error = '重复注册';
			return FALSE;
		}
//	end of check;
		
		return $this->save();
	}

// login:
    public function login()
	{
		if (! $this->check_info([$this->email, $this->password]))
			return false;
		if (! $this->check_captcha())
			return false;

		$login_data = [
			'email' => $this->email,
			'password' => $this->password
			];
		$check = $this->db->select_once(['name', 'email', 'age', 'manager'], 'users', $login_data); // jsonIO: select();
		if ($check != [])
			return $this->load($check); // jsonIO: $check[0]

		$this->error = '账号或密码错误';
		return FALSE;
	}

    public function update_msg()
	{
		return true;
	}

//	load user data from database:
	private function load($user)
	{
		$_SESSION['user'] = [
			'name' => $user['name'],
			'email' => $user['email'],
			'age' => $user['age'],
			'manager' => $user['manager']
			];
		return true;
	}

    protected function save()
	{
	    $user = [
			'name' => $this->name,
			'email' => $this->email,
			'password' => $this->password,
			'age' => $this->age,
			'manager' => $this->manager
			];
		if ($this->db->insert('users', $user))
			return true;
		die("save user error in " . __FILE__ . " line " . __LINE__);
	}

    protected function check_info(array $info)
	{
		$key = array(" ","　","\t","\n","\r");
		foreach ($info as $once) {
			if (str_replace($key, '', $once) == '') {
				$this->error = "请提交完整的表单";
				return false;
			}
		}
	    return true;
	}

    private function check_captcha()
	{
		if (! $this->captcha):
			$this->error = '请填写验证码';
		    return FALSE;
		endif;

		if ($this->captcha != $_SESSION['captcha']):
			$this->error = '验证码错误';
		    return FALSE;
		endif;

		return TRUE;
	}

	public function setpasswd(string $pwd)
	{
		$this->password = sha1($pwd);
	}
}
?>