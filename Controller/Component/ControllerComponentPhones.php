<?php

class ControllerComponentPhones
{    
    protected $typesOfPhone = [
        '0' => 'hPhone', //home Phone
        '1' => 'wPhone', //work Phone
        '2' => 'cPhone' //cell Phone
    ];
    
    public function choiceBestPhone($bestPhone, $hPhone, $wPhone, $cPhone)
    {
        $phones = $this->getPhones($hPhone, $wPhone, $cPhone);
        $bestph = '';
        if (!empty($bestPhone)) {
            $bestph = $bestPhone;
        } else {
            foreach ($phones as $key => $value) {
                if (!empty($value)) {
                    $bestph = $key;
                    break;
                }
            }
        }
        return $bestph;
    }

    public function getPhones($hPhone, $wPhone, $cPhone)
    {
        $phones = [];
        $phones['1'] = $hPhone; //home Phone
        $phones['2'] = $wPhone; //work Phone
        $phones['3'] = $cPhone; //cell Phone
        return $phones;
    }

    public function sortPhonesByType($selectedPhones)
    {
        $phones = [];
        foreach ($selectedPhones as $key => $value) {
            foreach ($this->typesOfPhone as $k => $val) {
                if ($key == $k) {
                    $phones[$val] = $value['phone'];
                }
            }
        }
        return $phones;
    }
}
