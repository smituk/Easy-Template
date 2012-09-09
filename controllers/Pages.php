<?php
    class Pages extends Std
    {
        public function _routing()
        {
            Http::_()->notfound(array($this, 'find_template'));
        }

        public function find_template($method, $path)
        {
            if(Tpl::_()->exists($path))
            {
                return Tpl::_()->render($path, array(
                    'title' => 'Some page',
                    'path' => $path
                ));
            }
            else
            {
                return Tpl::_()->render('notfound', array(
                    'title' => 'Notfound',
                    'path' => $path
                ));
            }
        }
    }
?>
