<?php

namespace App\Models;

use App\Models\MetadataModel;

class MetadataList
{
    private $list;
    private $count;
    
    public function __construct()
    {
        $this->list = array();
        $this->count = 0;
    }

    public function size()
    {
        return $this->count;
    }

    public function add($item)
    {
        $MdModel = new MetadataModel();
        $MdModel->setTitle($item->{'title'});
        $MdModel->setCreator($item->{'creator'});
        $MdModel->setDescription($item->{'description'});
        $MdModel->setDate($item->{'date'});
        $MdModel->setType($item->{'type'});
        $MdModel->setFormat($item->{'format'});
        $MdModel->setIdentifier($item->{'identifier'});
        $MdModel->setSource($item->{'source'});
        $MdModel->setLanguage($item->{'language'});
        $MdModel->setPublisher($item->{'publisher'});
        $MdModel->setSubject($item->{'subject'});

        $this->list[] = $MdModel;
        $this->count++;
    }

    public function get($int)
    {
        return $this->list[$int];
    }

    public function getList() 
    {
        return $this->list;
    }
}

?>