<?php

class ViewHelpersForms
{
    //array with input data and results of validation and radioButtons;
    protected $data = [];
    //array with keys to be contained in $data;
    protected $dataKeys = [
        'data',
        'validate',
        'radio'
    ];

    function __construct($formData) {
        $this->data = $formData;       
    }

    public function startForm($elements)
    {
        $form = "
            <div class = 'editBlock' id = 'editBlock'>
                <form method = 'post' action=''>
                <div class = 'editBlockHead' id = 'editBlockHead'>
                    <h2>
                        " . $elements['header'] . "
                    </h2>
                </div>";
        return $form;
    }

    public function endForm()
    {
        $form = "
            </form>
            </div>";
        return $form;
    }

    public function renderInput($name, $label, $typeOfInput)
    {
        foreach ($this->dataKeys as $value) {
            $parameters[$value] = (isset($this->data[$value][$name])) ? $this->data[$value][$name] : '';
            if ($value == 'radio') {
                $parameters[$value] = (isset($this->data[$value])) ? $this->data[$value] : '';
            }
        }

        $radioBtn = (method_exists(get_class($this), 'renderRadioBtn')) ? $this->renderRadioBtn($name, $parameters['radio']) : '';//TODO

        $input = "<div class = \"field\">
                    <label for ='$name'>$label:</label>
                    $radioBtn
                    <input class = \"text\" id = '$name' name = '$name' type = '$typeOfInput' value=\"" . $parameters['data'] . "\" />
                    <br/>
                    " . $parameters['validate'] . "
                    </div>";
        return $input;
    }

    public function submitBtn($elements)
    {
        $submitBtn = $elements['submitBtn'];
        $backLink = $elements['backBtn'];
        $backBtn = explode('/', $backLink);
        $btns = "<br/>
                <input class = 'button' type = 'submit' name = '" . $submitBtn . "Btn' value = '$submitBtn'/>
                <a href = '/$backLink' class='button'>$backBtn[1]</a>";
        return $btns;
    }

    public function render($structure, $elements)
    {
        $html = '';
        $html .= $this->startForm($elements);
        foreach($structure as $field){
            $html .= $this->renderInput($field['name'], $field['label'], $field['type']);
        }
        $html .= $this->submitBtn($elements);
        $html .= $this->endForm();
        return $html;
    }
}
