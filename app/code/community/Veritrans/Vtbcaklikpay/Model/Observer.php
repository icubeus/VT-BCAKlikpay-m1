<?php
class Veritrans_Vtbcaklikpay_Model_Observer {

    public function filterByIp($event) {
        $method = $event->getMethodInstance();
        $result = $event->getResult();
        $filteredMethods = array('vtbcaklikpay');
        if(in_array($method->getCode(),$filteredMethods)){
            $userIpAddress = $_SERVER['REMOTE_ADDR'];
            $ipAddress = Mage::getStoreConfig('payment/vtbcaklikpay/ipdev'); //'128.199.213.16'
            Mage::log('$userIpAddress:'.$userIpAddress,null,'vtbcaklikpay_ip.log',true);
            Mage::log('config $ipAddress:'.$ipAddress,null,'vtbcaklikpay_ip.log',true);
            if(empty($ipAddress)) {
                return;
            } else {
                $ipAddress = explode(',',$ipAddress);
                if(!in_array($userIpAddress,$ipAddress)) {
                    $result->isAvailable = false;
                }
            }
        } else {
            return;
        }
    }
}
?>