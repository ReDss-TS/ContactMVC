<?php

class ViewContactIndex extends CoreView
{
    //what render (form or table or both)
    protected $thatRender = ['table'];
    //table column names
    protected $columnNames = [
        'firstName' => 'First Name',
        'lastName'  => 'Last Name',
        'email'     => 'Email',
        'phone'     => 'Best phone'
    ];

    protected $additionalСolumns = [
        //name   => executable file
        'edit'   => 'update',
        'delete' => 'delete'
    ];
    
    public function renderData($data)
    {
        $renderedData = '';
        if (!empty($data['contacts'])) {
            foreach ($data['contacts'] as $key => $value) {
                $renderedData .= "
                    <tr id = " . $value['id'] . ">
                        <td>" . $value['firstName'] . " </td>
                        <td>" . $value['lastName'] . " </td>
                        <td>" . $value['email'] . " </td>
                        <td>" . $value['phone'] . " </td>
                        <td><a href = '/contact/edit/" . $value['id'] . "' class='button'>edit</a></td>
                        <td><a href = '/contact/delete/" . $value['id'] . "' class='button'>delete</a></td>
                    </tr> ";
            }
        }
        return $renderedData;
    }
}
