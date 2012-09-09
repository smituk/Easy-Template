<?php
	class Tpl extends Std
	{
        private $globals = array('empty' => '');

        public function register($key, $value)
        {
            $this->globals[$key] = $value;
        }

		public function exists($tpl = '')
		{
			if(file_exists(DIR_VIEWS . $tpl . TEMPLATE_EXT))
			{
				return true;
            }
            return false;
        }

		public function render($tpl = '', $data = array(' ' => ' '))
		{
			if(!file_exists(DIR_VIEWS . $tpl . TEMPLATE_EXT))
			{
				return '{{error:template was not found:}}';
			}
			$tpl = file_get_contents(DIR_VIEWS . $tpl . TEMPLATE_EXT);
			
            //include other templates {{include:header}} with the same $data
			if(preg_match_all('/.*?\{\{include\:(.*)\}\}.*?/i', $tpl, $params))
			{
				foreach($params[1] as $inc)
				{
					$tpl = str_replace('{{include:' . $inc . '}}',
						$this->render($inc, $data), $tpl);
				}
			}
            
            //replace vars {{var}}
            $data = array_merge($this->globals, $data);
            foreach($data as $key => $val)
            {
                $tpl = str_replace('{{' . $key . '}}', $val, $tpl);
            }
			
            //{{if {{A}}={{B}} }}some{{else}}other{{fi}}
            if(preg_match_all('/^.+(\{\{if\s(.*?)(\=|\!\=)(.*?)\}\}(.+)\{\{else\}\}(.+)\{\{fi\}\}).+$/ims', $tpl, $params))
			{
				foreach($params[3] as $num => $cond)
				{
                    switch($cond)
                    {
                        case '=':
                            if($params[2][$num] == $params[4][$num])
                            {
                                $tpl = str_replace($params[1][$num], $params[5][$num], $tpl);
                            }
                            else
                            {
                                $tpl = str_replace($params[1][$num], $params[6][$num], $tpl);
                            }
                        break;
                        case '!=':
                            if($params[2][$num] != $params[4][$num])
                            {
                                $tpl = str_replace($params[1][$num], $params[5][$num], $tpl);
                            }
                            else
                            {
                                $tpl = str_replace($params[1][$num], $params[6][$num], $tpl);
                            }
                        break;
                    }
				}
			}

            //hide all undefined tpl vars
            if(preg_match_all('/.*?\{\{(.*)\}\}.*?/i', $tpl, $op))
			{
				foreach($op[1] as $var)
				{
					$tpl = str_replace('{{' . $var . '}}', '', $tpl);
				}
			}

            return $tpl;
		}
	}
?>
