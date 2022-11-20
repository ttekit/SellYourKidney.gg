<?php

namespace Models;
class Navigate extends \App\DBEngine
{
    public function __construct()
    {
        parent::__construct("navpanel");
    }

    public function getNavigateData()
    {
        return $this->getManyRows([], "ASC", "order_id");
    }

    public function getParentElements()
    {
        return $this->getManyRows(["parent_id" => null], "ASC", "order_id");
    }

    public function getChildElement($id)
    {
        return $this->getManyRows(["parent_id" => $id], "ASC", "order_id");
    }
}
