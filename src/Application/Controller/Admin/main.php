<?php

/**
 * This Software is the property of D³ Data Development
 * and is protected by copyright law - it is NOT Freeware.
 *
 * Any unauthorized use of this software without a valid license
 * key is a violation of the license agreement and will be
 * prosecuted by civil and criminal law.
 *
 * D3 Data Development
 * Inhaber: Thomas Dartsch
 * Alle Rechte vorbehalten
 *
 * @package "Bonuspunkte"
 * @author Thomas Dartsch <thomas.dartsch@shopmodule.com> / Markus Gärtner <markus.gaertner@shopmodule.com>
 * @copyright (C) 2011, D3 Data Development
 * @see http://www.shopmodule.com
 */

namespace D3\Points\Application\Controller\Admin;

use D3\ModCfg\Application\Controller\Admin\d3_cfg_mod_;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;

class main extends d3_cfg_mod_
{
    protected $_hasListItems = false;

    public function render()
    {
        $this->addTplParam('sListClass', 'd3pointslist');
        $this->addTplParam('sMainClass', 'd3pointssettings');
        return parent::render();
    }
}