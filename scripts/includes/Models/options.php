<?php
namespace Models;
class options extends \App\DBEngine
{
    public function __construct()
    {
        parent::__construct("options");
    }

    public function get($nameOption)
    {
        $result = $this->getManyRows(["name" => $nameOption]);
        if (count($result) > 0) {
            return $result[0];
        }
        return null;
    }

    public function execQuery($query)
    {
        return parent::executeQuery($query);
    }

    public function add($name, $value, $group = null)
    {
        return parent::addRow([
            'name' => $name,
            'value' => $value,
            'group' => $group
        ]);
    }

    public function updateById($id, $nameCol, $newValue)
    {
        return parent::updateRow($id, [
            "name" => $nameCol,
            "value" => $newValue
        ]);
    }

    public function changeByOldValue($oldValue, $nameCol, $newValue)
    {
        $id = parent::getId([
            "value" => $oldValue
        ]);
        return parent::updateRow($id, [
            "name" => $nameCol,
            "value" => $newValue
        ]);
    }
}
