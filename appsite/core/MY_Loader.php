<?php
class MY_Loader extends CI_Loader{
	public function model($model, $name = '', $db_conn = FALSE){

		if (is_array($model))
		{
			foreach ($model as $babe)
			{
				$this->model($babe);
			}
			return;
		}

		if ($model == '')
		{
			return;
		}

		$path = '';

		// Is the model in a sub-folder? If so, parse out the filename and path.
		if (($last_slash = strrpos($model, '/')) !== FALSE)
		{
			// The path is in front of the last slash
			$path = substr($model, 0, $last_slash + 1);

			// And the model name behind it
			$model = substr($model, $last_slash + 1);
		}

		if ($name == '')
		{
			$name = $model;
		}

		if (in_array($name, $this->_ci_models, TRUE))
		{
			return;
		}

		$CI =& get_instance();
		if (isset($CI->$name))
		{
			show_error('The model name you are loading is the name of a resource that is already being used: '.$name);
		}

		$model = strtolower($model);
		foreach ($this->_ci_model_paths as $mod_path)
		{
			if ( ! file_exists($mod_path.'models/'.$path.$model.'.php'))
			{
				continue;
			}

			if ($db_conn !== FALSE AND ! class_exists('CI_DB'))
			{
				if ($db_conn === TRUE)
				{
					$db_conn = '';
				}

				$CI->load->database($db_conn, FALSE, TRUE);
			}

			if ( ! class_exists('CI_Model'))
			{
				load_class('Model', 'core');
			}

			require_once($mod_path.'models/'.$path.$model.'.php');

			$model = ucfirst($model);

			$CI->$name = new $model();

			$this->_ci_models[] = $name;
			return;
		}
		/*--------------------------lxc-----------------------------*/
		$table=$model;
		$model='db_model';
		if ( ! class_exists('CI_Model'))
		{
			load_class('Model', 'core');
		}
		require_once($mod_path.'models/'.$path.$model.'.php');
		$CI->$name = new $model();
		//echo $CI->$name->_tablepre;
		$CI->$name->setTable($table);
		$this->_ci_models[] = $name;
		return;
		/*--------end--------------------lxc--------------------------------*/
		// couldn't find the model
		show_error('Unable to locate the model you have specified: '.$model);
	}
}
?>