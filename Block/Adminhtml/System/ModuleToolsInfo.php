<?php
namespace GDW\RmProductsBySkuPath\Block\Adminhtml\System;

class ModuleToolsInfo extends \GDW\Core\Block\Adminhtml\System\Core\ModuleToolsInfo
{
    const GDW_MODULE_COMMAND = 'gdw:rmproductsbysku';

    public function getDescFull()
    {
        $html = 
<<<HTML
    <p>Remove all products where value %like% in sku.</p>
    <p>Examples:</p>
    <p>php bin/magento gdw:rmproductsbysku --path="WJ03-XS"</p>
HTML;
        return $html;
    }
}