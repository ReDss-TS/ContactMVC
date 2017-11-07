<?php

abstract class ViewErrorPageMain
{

    protected function render()
    {
        $html = '';
        $html .= '<p><font size="40" color="red" face="Arial" align="center">' . $this->msg . '</font>';
        return $html;
    }

}
