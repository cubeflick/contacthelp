<?php
namespace Category\Model;
use Doctrine\ORM\Mapping as ORM;

class Category
{
    protected $id;
    protected $name;
    protected $parentId;
    protected $description;
    
}

