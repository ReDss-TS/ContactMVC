<?php

class ControllerComponentPhones
{    
    protected $phonesKey = [
        '1' => 'hPhone',
        '2' => 'wPhone',
        '3' => 'cPhone',
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

    // public function getPhones($data)
    // {
    //     $phones = [];
    //     foreach ($data as $k => $val) {
    //         foreach ($this->phonesKey as $key => $value) {
    //             if ($k == 'user_' . $value) {
    //                 $phones[$key] = $val;
    //             }
    //     }
    //     return $phones;
    // }
}
