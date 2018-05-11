<?php

namespace App\Admin\Extensions;



class CustomActions extends \Encore\Admin\Grid\Displayers\Actions
{

    protected $allowShow = true;

    protected function showAction()
    {
        return <<<EOT
<a href="{$this->getResource()}/{$this->getKey()}" class="btn btn-xs btn-primary " style="margin-right: 5px">
    <i class="fa fa-eye"></i> Show
</a>
EOT;
    }

    protected function editAction()
    {
        return <<<EOT
<a href="{$this->getResource()}/{$this->getKey()}/edit" class="btn btn-xs btn-default" style="margin-right: 5px">
    <i class="fa fa-edit"></i> Edit
</a>
EOT;
    }

    protected function deleteAction()
    {
        parent::deleteAction();

        return <<<EOT
<a href="javascript:void(0);" data-id="{$this->getKey()}" class="grid-row-delete btn btn-xs btn-danger" style="margin-right: 5px">
    <i class="fa fa-trash"></i> Remove
</a>
EOT;
    }

    public function display($callback = null)
    {
        if ($callback instanceof \Closure) {
            $callback->call($this, $this);
        }

        $actions = $this->prepends;
        if ($this->allowShow) {
            array_push($actions, $this->showAction());
        }

        if ($this->allowEdit) {
            array_push($actions, $this->editAction());
        }

        if ($this->allowDelete) {
            array_push($actions, $this->deleteAction());
        }


        $actions = array_merge($actions, $this->appends);

        return implode('', $actions);
    }
}

