<?php

namespace AtCms\Controller;

use AtCms\Grid;
use AtAdmin\Controller\AbstractDataGridController;

/**
 * Class Admin_PageController
 * @package AtCms\Controller
 */
class Admin_PageController extends AbstractDataGridController
{
    /**
     * @return array|mixed|object
     */
    public function getGridManager()
    {
        return $this->getServiceLocator()->get('atcms_page_grid_manager');
    }
}
