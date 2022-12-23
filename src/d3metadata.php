<?php

/**
 * This Software is the property of Data Development and is protected
 * by copyright law - it is NOT Freeware.
 *
 * Any unauthorized use of this software without a valid license
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 *
 * http://www.shopmodule.com
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author    D3 Data Development - Daniel Seifert <support@shopmodule.com>
 * @link      http://www.oxidmodule.com
 */

use D3\Points\Setup as ModuleSetup;

/**
 * Module information
 */
$aModule = array(
    'd3FileRegister'    => array(
        'd3/points/IntelliSenseHelper.php',
        'd3/points/metadata.php',

        'd3/points/Application/Controller/accountpoints.php',
        'd3/points/Application/Controller/Admin/d3_cfg_d3pointslog.php',
        'd3/points/Application/Controller/Admin/d3_cfg_d3pointslog_list.php',
        'd3/points/Application/Controller/Admin/demo.php',
        'd3/points/Application/Controller/Admin/licence.php',
        'd3/points/Application/Controller/Admin/list.php',
        'd3/points/Application/Controller/Admin/main.php',
        'd3/points/Application/Controller/Admin/maintenance.php',
        'd3/points/Application/Controller/Admin/settings.php',
        'd3/points/Application/Controller/Admin/userpoints.php',

        //'d3/points/Application/Model/conditions.php',
        'd3/points/Application/Model/d3points.php',
        'd3/points/Application/Model/rating.php',
        'd3/points/Application/Model/utils_points.php',

        'd3/points/Application/translations/de/d3_points_lang.php',

        'd3/points/Application/public/d3_cron_points.php',
        'd3/points/Application/public/d3_cron_points.sh',

        'd3/points/Application/Modules/Application/Controller/d3_account_points.php',
        'd3/points/Application/Modules/Application/Controller/d3_details_points.php',
        'd3/points/Application/Modules/Application/Controller/d3_review_points.php',
        'd3/points/Application/Modules/Application/Controller/Admin/d3_ordermain_d3points.php',
        'd3/points/Application/Modules/Core/d3_oxemail_points.php',
        'd3/points/Application/Modules/Core/d3_oxviewconfig_points.php',
        'd3/points/Application/Modules/Application/Models/d3_oxorder_d3points.php',
        'd3/points/Application/Modules/Application/Models/d3_oxorder_d3points.php',
        'd3/points/Application/Modules/Application/Models/d3_oxuser_points.php',
        'd3/points/Application/Modules/Application/Models/d3_oxvoucher_points.php',

        'd3/points/Setup/d3_points_update.php',
        'd3/points/Setup/Events.php',
    ),
    'd3SetupClasses' => array(
        ModuleSetup\d3_points_update::class,
    ),
);
