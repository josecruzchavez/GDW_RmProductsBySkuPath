<?php
namespace GDW\RmProductsBySkuPath\Block\Adminhtml\System;

use GDW\Core\Block\Adminhtml\System\Core\ModuleInfoFull as Fieldset;

class ModuleInfoFull extends Fieldset
{
    const GDW_MODULE_CODE = 'GDW_RmProductsBySkuPath';
    const GDW_MODULE_LINK = '';
    const GDW_MODULE_LINK_SECC = '';
    
    public function getDescFull()
    {
        $html =
<<<HTML
    <p>Permite eliminar Productos mediante una búsqueda y coincidencia de SKU.</p>
    <p>
    php bin/magento gdw:rmproductsbysku --path={valor}<br/>
    Confirmar eliminación de productos<br/>
    Listo !!
    </p>
HTML;
        return $html;
    }
}