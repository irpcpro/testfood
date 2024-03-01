<?php

if(!function_exists('APIResponse')){
    /**
     * @param mixed ...$data [message, error_code, success]
     * */
    function APIResponse(...$data){
        return app('APIResponse', $data);
    }
}

