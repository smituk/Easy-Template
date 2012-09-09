<?php
    /**
     * Class Std, for extending models & conrollers,
     *  have singleton-factory initalizer
     * */
    abstract class Std
    {
        private static $instances = array();
        
        public static function _($data = null)
        {
            $class = get_called_class();
            if(empty(self::$instances[$class]))
            {
                self::$instances[$class] = new $class($data);
            }
            return self::$instances[$class];
        }
    }
?>
