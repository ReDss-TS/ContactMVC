<?php

class ViewHelpersTable
{
    protected $sortingTag = '&#8593;';

    //array with data that will be at table;
    protected $data = [];

    //abstract protected function renderData($data);

    function __construct($tableData) {
        $this->data = $tableData;       
    }

    public function tableHeaders($columnNames, $additionalСolumns)//TODO
    {   
        $tableHeader = '';
        // $orderObj = new Order;
        // $sortObj = new Sort;
        // $order = $orderObj->getOrder();
        // $sort = $sortObj->changeSortBy();
        $sort = 'ASC';
        foreach ($columnNames as $key => $value) {
            //$this->sortingTag = ($key == $order && $sort == 'ASC') ? '&#8593;' : (($key == $order && $sort == 'DESC') ? '&#8595;' : '');
            $uri = $this->data['uri'];
            $tableHeader .= "<th><a class=\"columnNames\" href=\"/$uri/column:$key/by:$sort\">$value $this->sortingTag</a></th>";
        }
        if (isset($additionalСolumns)){
            foreach ($additionalСolumns as $key => $value) {
                $tableHeader .= "<th>$key</th>";
            }
        }

        return $tableHeader;
    }

    public function createBtn($typeBtn, $idLine)
    {
        $btn = "<form method = \"post\" action = ''>
            <input type= \"hidden\" name = \"idLine\" value = " . $idLine . " />
            <input class = " . $typeBtn . " Btn type=\"submit\" name = " . $typeBtn . " Btn value = " . $typeBtn . " />
            </form>";
        return $btn;
    }

}