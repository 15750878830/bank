<?php
class dbs{
    var $companyNum = '91234';//商店编号  前5位固定数字
    var $randNum = '';//随机编码 8位数字
    var $checkNum = '';//检查玛 逻辑产生
    var $needPayMoney = '';//需要付的钱
    public function getRandNum()
    {
        return mt_rand(00000000,99999999);
    }
    public function companyNumJoinRandNum()
    {
        return $this->companyNum.$this->getRandNum();
    }
    public function strToArray($str = '')
    {       
        if($str == ''){
            $str = $this->companyNumJoinRandNum();
        }
        $list = str_split($str);
        return $list;
    }
    public function toSum($str)
    {   
        $sum = 0;
        $array = $this->strToArray($str);
        $newList = [9,8,7,6,5,4,3,2,1,2,3,4,5];
        for ($x=0; $x<count($array); $x++) {
                $sum += $array[$x]*$newList[$x];
        }
        return $sum;
    }    
    public function moneyTosum($money = '')
    {
        $sumLength = 11;
        $str = '';
        $num  = $sumLength - strlen($money);
        for($i=0;$i< $num;$i++){
            $str .= 0;
        }
        $str = $str.$money;
        $numList = [9,8,7,6,5,4,3,2,1,2,3];
        $array = $this->strToArray($str);
        $sum = 0;
        for ($x=0; $x<count($array); $x++) {
                $sum += $array[$x]*$numList[$x];
        }
        return $sum;
    }

    public function getCheckNum($money = '',$str = '')
    {
        $sum = $this->toSum($str) + $this->moneyTosum($money);
        $res = $sum/10;
        $checkNum  = (ceil($res) - $res)*10;
        return  $checkNum;
    }
    public function getDbsAccount($money,$str = '')
    {
       return $this->companyNumJoinRandNum().$this->getCheckNum($money,$str ='');
    }

}
$dbs = new dbs();
$res = $dbs->getDbsAccount($needPayMoney = '18000');
// $list = str_split($res);
// print_r($res);
// echo $res;

?>