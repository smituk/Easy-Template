<?php
    class Home extends Std
    {
        public function _routing()
        {
            Http::_()->get('/', array($this, 'home_page'));
            Http::_()->get('/home', array($this, 'home_page'));
        }

        public function home_page()
        {
            return Tpl::_()->render('home', array(
                'title' => 'Home page'
            ));
        }
    }
?>
