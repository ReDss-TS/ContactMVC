<?php

abstract class CoreView
{
	public function render($data) //TODO I think it is not right
	{
		$content = '';
		foreach ($this->thatRender as $key => $value) {
			if ($value == 'form') {
				$content .= $this->renderForm($data);
			} elseif ($value == 'table') {
				$content .= $this->renderTable($data);
			}
		}
		return $content;
	}

    public function renderForm($data)
    {
    	$renderForms = new ViewHelpersForms($data);
    	$form = $renderForms->render($this->structure, $this->elements);
    	return $form;
    }


    public function renderTable($data)
    {
    	$dataForTable = $this->renderData($data);

        $renderTables = new ViewHelpersTable($data);
    	$table = $renderTables->render($this->columnNames, $this->additionalСolumns, $dataForTable);
    	return $table;
    }
}
