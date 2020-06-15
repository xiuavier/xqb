<?php


namespace App\Http\MiniApi\Common;

/**
 * Class Error
 * @package App\Http\MiniApi\common
 */
class Error
{
    /**
     * @var int
     */
    protected $code = 0;
    /**
     * @var string
     */
    protected $msg = '';
    /**
     * @var string
     */
    protected $data = '';

    /**
     * Error constructor.
     * @param $data
     * @param string $msg
     * @param int $code
     */
    public function __construct($data, $msg = '', $code = 1)
    {
        $this->code = $code;
        $this->data = $data;
        $this->msg  = $msg;
    }

    /**
     * @param $result
     * @param string $data
     * @param string $msg
     * @return Error
     */
    public static function instance($result, $data = '', $msg = '')
    {
        return new Error($data, $msg, $result);
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed|string
     */
    public function getMsg()
    {
        if ($this->msg == "") {
            return $this->getMsgByCode();
        } else {
            return $this->msg;
        }
    }

    /**
     * @param $msg
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;
    }

    /**
     * @return mixed|string
     */
    private function getMsgByCode()
    {
        $errorArray = include "ErrorArray.php";
        if (isset($this->code, $errorArray)) {
            return $data['message'] = $errorArray[$this->code];
        } else {
            return $data['message'] = '';
        }
    }
}
