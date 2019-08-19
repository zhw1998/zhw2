<?php

/**
 * Class Model
 *
 * 模型类父类
 *
 * 提供所有模型公共操作
 */
class Model extends DB
{
    protected $fillable = [];

    protected $rules = [];

    protected $table = '';

    public function validate($data = [])
    {
        if(empty($data)){
            $data = $_POST;
        }

        $parameters = [];
        foreach($data as $key => $value){
            if(in_array($key, $this->fillable)){
                $parameters[$key] = $value;
            }
        }

        $this->check($parameters);

        if(error()){
            return back($parameters);
        }

        return true;
    }

    private function check($parameters)
    {
        foreach($this->rules as $field => $rule){
            if(is_array($rule)){
                foreach($rule as $method => $errormsg){
                    if($method === 'pattern'){
                        $patterns_arr = $errormsg;
                        if(is_array($patterns_arr)){
                            $value = isset($parameters[$field]) ? $parameters[$field] : '';
                            $msg = isset($patterns_arr['errormsg']) ? $patterns_arr['errormsg'] : '';
                            $this->$method($field, $value, $patterns_arr['reg'], $msg);
                        }else{
                            dd('模型字段正则验证设置错误');
                        }
                    }else{
                        $value = isset($parameters[$field]) ? $parameters[$field] : '';
                        $this->$method($field, $value, $errormsg);
                    }
                }
            }else{
                return dd('模型字段验证设置错误');
            }
        }
    }

    private function required($field, $value, $errormsg = '')
    {
        if(empty($value)){
            error($errormsg ? $errormsg : $field . ' can not be empty');
        }
    }

    private function unique($field, $value, $errormsg = '')
    {
        $query = 'select '.$field.' from `'.$this->table.'` where '.$field.' = ?';
        if($this->find(
            $query,
            [
                $value
            ]
        )){
            error($errormsg ? $errormsg : $field . ' already exists');
        }
    }

    private function datetime($field, $value, $errormsg = '')
    {
        $ret = strtotime($value);

        if($ret === FALSE || $ret == -1){
            error($errormsg ? $errormsg : $field . ' must be date format');
        }
    }

    private function pattern($field, $value, $pattern, $errormsg = '')
    {
        if(!empty($value)){
            if(!preg_match($pattern, $value)){
                error($errormsg ? $errormsg : $field . ' does not meet the given pattern');
            }
        }
    }

}