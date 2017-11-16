<?php

class ModelBehaviourSorting
{
    protected $sortBy = [
        'firstName',
        'lastName',
        'email',
        'phone'
    ];

    public function getSortBy($param)
    {
        if (!isset($param[1])) {
            $sort = 'ASC';
        } else {
            if ($param[1] == 'ASC' || $param[1] == 'DESC') {
                $sort = $param[1];
            } else {
                $sort = 'ASC';
            }
        }
        return $sort;
    }

    public function changeSortBy()
    {
        $sort = $this->getSortBy();
        if (isset($sort) && $sort == "ASC") {
            $sort = "DESC";
        } else {
            $sort = "ASC";
        }
        return $sort;
    }
    public function getOrder($param)
    {
        if (!isset($param[0])) {
            $order = 'firstName';
        } else {
            foreach ($this->sortBy as $key => $value) {
                if ($param[0] == $value) {
                    $order = $param[0];
                    break;
                } else {
                    $order = 'firstName';
                }
            }
        }
        return $order;
    }

    public function getOrderBy($param)
    {  
        $order = $this->getOrder($param);
        if (!isset($param[0])) {
            //value by default
            $tablePlusOrder = "contact_list.firstName";
        } else {
            if ($order == 'phone') {
                //for contact_phones table
                $tablePlusOrder = "contact_phones.". $order;
            } else {
                //for contact_list table
                $tablePlusOrder = "contact_list.". $order;
            }
        }
        return $tablePlusOrder;
    }
    
}
