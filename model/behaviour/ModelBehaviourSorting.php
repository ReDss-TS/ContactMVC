<?php

class ModelBehaviourSorting
{
    protected $columns = [
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
        if ($sort == "ASC") {
            $sort = "DESC";
        } else {
            $sort = "ASC";
        }
        return $sort;
    }
    public function getColumn($param, $columns)
    {
        if (!isset($param[0])) {
            $column = $columns[0];
        } else {
            foreach ($columns as $key => $value) {
                if ($param[0] == $value) {
                    $column = $param[0];
                    break;
                } else {
                    $column = $columns[0];
                }
            }
        }
        return $column;
    }   
}
