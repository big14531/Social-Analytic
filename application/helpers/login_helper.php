<?php
	function isLoggedin($session_data)
	{
		if(isset($session_data['login_user_id']) && isset($session_data['logged_in']) )
		{
			if($session_data['login_user_id'] > 0 && $session_data['logged_in'] === TRUE)
			{
				return TRUE;
			}
			else
			{
				redirect('/login', 'refresh');
				exit();
			}
		}
		else
		{
			redirect('/login', 'refresh');
			exit();
		}
	}

	function isEmptyProfile($session_data)
	{
		if(isset($session_data['login_user_id']) && isset($session_data['logged_in']) )
		{
			redirect('/manage', 'refresh');
			exit();
		}
		else
		{
			redirect('/login', 'refresh');
			exit();
		}
	}

	/**
	 * [checkLoginPage description]
	 *
	 *	Auto go to dashboard , if user used to login
	 * 
	 * @param  [type] $session_data [description]
	 * @return [type]               [description]
	 */
	function checkLoginPage($session_data)
	{
		if(isset($session_data['login_user_id']) && isset($session_data['logged_in']) )
		{
			if($session_data['login_user_id'] > 0 && $session_data['logged_in'] === TRUE)
			{
				redirect('/dashboard', 'refresh');
			}
		}
	}

	/**
	 * [checkAdminAutho description]
	 *
	 * 		Authorization Admin Site
	 * 
	 * @param  [type] $session_data [description]
	 * @return [type]               [description]
	 */
	function checkAdminAutho($session_data)
	{
		if(isset($session_data['permission_admin']))
		{
			if( !$session_data['permission_admin'] )
			{
				redirect('/dashboard?authofail=1', 'refresh');
			}
		}
	}	


	/**
	 * [checkManagerAutho description]
	 *
	 *	Authorization Manager Site
	 * 
	 * @param  [type] $session_data [description]
	 * @return [type]               [description]
	 */
	function checkManagerAutho($session_data)
	{
		if(isset($session_data['permission_manager']))
		{
			if( !$session_data['permission_manager'] )
			{
				redirect('/dashboard?authofail=1', 'refresh');
			}
		}
	}	
