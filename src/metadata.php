<?php

use D3\Points\Setup as ModuleSetup;
use OxidEsales\Eshop\Application\Controller as OxidController;
use OxidEsales\Eshop\Application\Model as OxidModel;
use OxidEsales\Eshop\Core as OxidCore;

/**
 * Metadata version
 */
$sMetadataVersion = '2.0';

$sD3Logo = (class_exists(d3\modcfg\Application\Model\d3utils::class) ? d3\modcfg\Application\Model\d3utils::getInstance()->getD3Logo() : 'D&sup3;');

/**
 * Module information
 */
$aModule = array(
    'id'          => 'd3points',
    'title'       => $sD3Logo . ' Bonuspunkte',
    'description' => array(
    'de' => 'Bieten Sie Ihren Kunden ein umfassendes Bonussystem an.',
    'en' => ''
    ),
    'lang'        => 'de',
    'thumbnail'   => 'picture.png',
    'version'     => '5.0.0.2',
    'author'      => 'D&sup3; Data Development',
    'url'         => 'http://www.shopmodule.com',
    'email'       => 'support@shopmodule.com',
    'extend'      => array(
        OxidController\AccountController::class        => \D3\Points\Modules\Application\Controller\d3_account_points::class,
        OxidController\ArticleDetailsController::class => \D3\Points\Modules\Application\Controller\d3_details_points::class,
        OxidController\ReviewController::class         => \D3\Points\Modules\Application\Controller\d3_review_points::class,
        OxidController\Admin\OrderMain::class          => \D3\Points\Modules\Application\Controller\Admin\d3_ordermain_d3points::class,
        OxidModel\Order::class                         => \D3\Points\Modules\Application\Model\d3_oxorder_d3points::class,
        OxidModel\User::class                          => \D3\Points\Modules\Application\Model\d3_oxuser_points::class,
        OxidModel\Voucher::class                       => \D3\Points\Modules\Application\Model\d3_oxvoucher_points::class,
        OxidCore\ViewConfig::class                     => \D3\Points\Modules\Core\d3_oxviewconfig_points::class,
        OxidCore\Email::class                          => \D3\Points\Modules\Core\d3_oxemail_points::class,
    ),

    'controllers'       => array(
        'd3_d3points_demo'          => \D3\Points\Application\Controller\Admin\demo::class,
        'd3_d3points_licence'       => \D3\Points\Application\Controller\Admin\licence::class,
        'd3_d3points_list'          => \D3\Points\Application\Controller\Admin\pointslist::class,
        'd3_d3points_settings'      => \D3\Points\Application\Controller\Admin\settings::class,
        'd3_d3points_main'          => \D3\Points\Application\Controller\Admin\main::class,
        'd3_d3points_maintenance'   => \D3\Points\Application\Controller\Admin\maintenance::class,
        'd3_d3points_userpoints'    => \D3\Points\Application\Controller\Admin\userpoints::class,
        'd3_d3points_log'           => \D3\Points\Application\Controller\Admin\pointslog::class,
        'd3_d3points_loglist'       => \D3\Points\Application\Controller\Admin\pointsloglist::class,
        'd3_d3points_accountpoints' => \D3\Points\Application\Controller\accountpoints::class,
    ),

    'templates'   => array(
        // Admin
        'd3points_demo.tpl'                    => 'd3/points/Application/views/admin/tpl/d3points_demo.tpl',
        'd3points_maintenance.tpl'             => 'd3/points/Application/views/admin/tpl/d3points_maintenance.tpl',
        'd3points_settings.tpl'                => 'd3/points/Application/views/admin/tpl/d3points_settings.tpl',
        'd3points_userpoints.tpl'              => 'd3/points/Application/views/admin/tpl/d3points_userpoints.tpl',

        'd3points_userpoints_other.tpl'                   => 'd3/points/Application/views/admin/tpl/inc/other.tpl',
        'd3points_userpoints_oxorder.tpl'                 => 'd3/points/Application/views/admin/tpl/inc/oxorder.tpl',
        'd3points_userpoints_oxorder_storno.tpl'          => 'd3/points/Application/views/admin/tpl/inc/oxorder_storno.tpl',
        'd3points_userpoints_oxrating.tpl'                => 'd3/points/Application/views/admin/tpl/inc/oxrating.tpl',
        'd3points_userpoints_oxreview.tpl'                => 'd3/points/Application/views/admin/tpl/inc/oxreview.tpl',
        'd3points_userpoints_oxvoucher.tpl'               => 'd3/points/Application/views/admin/tpl/inc/oxvoucher.tpl',
        'd3points_userpoints_oxvoucher_storno.tpl'        => 'd3/points/Application/views/admin/tpl/inc/oxvoucher_storno.tpl',
        'd3points_userpoints_oxvoucher_storno_rebook.tpl' => 'd3/points/Application/views/admin/tpl/inc/oxvoucher_storno_rebook.tpl',


        ## Mail for manuel points from admin
        'd3_email_manuelpoints_html.tpl'       => 'd3/points/Application/views/tpl/email/d3_email_manuelpoints_html.tpl',
        'd3_email_manuelpoints_plain.tpl'      => 'd3/points/Application/views/tpl/email/d3_email_manuelpoints_plain.tpl',
        'd3_email_manuelpoints_subj.tpl'       => 'd3/points/Application/views/tpl/email/d3_email_manuelpoints_subj.tpl',

        // Frontend
        'd3_account_points.tpl'                => 'd3/points/Application/views/tpl/d3_account_points.tpl',
        'd3_email_orderpoints_html.tpl'        => 'd3/points/Application/views/tpl/email/d3_email_orderpoints_html.tpl',
        'd3_email_orderpoints_plain.tpl'       => 'd3/points/Application/views/tpl/email/d3_email_orderpoints_plain.tpl',
        'd3_email_orderpoints_subj.tpl'        => 'd3/points/Application/views/tpl/email/d3_email_orderpoints_subj.tpl',
        'd3_email_pointsautovoucher_html.tpl'  => 'd3/points/Application/views/tpl/email/d3_email_pointsautovoucher_html.tpl',
        'd3_email_pointsautovoucher_plain.tpl' => 'd3/points/Application/views/tpl/email/d3_email_pointsautovoucher_plain.tpl',
        'd3_email_pointsautovoucher_subj.tpl'  => 'd3/points/Application/views/tpl/email/d3_email_pointsautovoucher_subj.tpl',
        'd3_email_pointsvoucher_html.tpl'      => 'd3/points/Application/views/tpl/email/d3_email_pointsvoucher_html.tpl',
        'd3_email_pointsvoucher_plain.tpl'     => 'd3/points/Application/views/tpl/email/d3_email_pointsvoucher_plain.tpl',
        'd3_email_pointsvoucher_subj.tpl'      => 'd3/points/Application/views/tpl/email/d3_email_pointsvoucher_subj.tpl',
        'd3_email_remindpoints_html.tpl'       => 'd3/points/Application/views/tpl/email/d3_email_remindpoints_html.tpl',
        'd3_email_remindpoints_plain.tpl'      => 'd3/points/Application/views/tpl/email/d3_email_remindpoints_plain.tpl',
        'd3_email_remindpoints_subj.tpl'       => 'd3/points/Application/views/tpl/email/d3_email_remindpoints_subj.tpl',
        'd3_email_reviewpoints_html.tpl'       => 'd3/points/Application/views/tpl/email/d3_email_reviewpoints_html.tpl',
        'd3_email_reviewpoints_plain.tpl'      => 'd3/points/Application/views/tpl/email/d3_email_reviewpoints_plain.tpl',
        'd3_email_reviewpoints_subj.tpl'       => 'd3/points/Application/views/tpl/email/d3_email_reviewpoints_subj.tpl',
        'd3_email_stornopoints_html.tpl'       => 'd3/points/Application/views/tpl/email/d3_email_stornopoints_html.tpl',
        'd3_email_stornopoints_plain.tpl'      => 'd3/points/Application/views/tpl/email/d3_email_stornopoints_plain.tpl',
        'd3_email_stornopoints_subj.tpl'       => 'd3/points/Application/views/tpl/email/d3_email_stornopoints_subj.tpl',

        //azure
        'd3points_mail_option_azure.tpl'                       => 'd3/points/Application/views/azure/tpl/account/inc/mail_option.tpl',
        'd3points_list_type_azure_other.tpl'                   => 'd3/points/Application/views/azure/tpl/account/inc/other.tpl',
        'd3points_list_type_azure_oxorder.tpl'                 => 'd3/points/Application/views/azure/tpl/account/inc/oxorder.tpl',
        'd3points_list_type_azure_oxorder_storno.tpl'          => 'd3/points/Application/views/azure/tpl/account/inc/oxorder_storno.tpl',
        'd3points_list_type_azure_oxrating.tpl'                => 'd3/points/Application/views/azure/tpl/account/inc/oxrating.tpl',
        'd3points_list_type_azure_oxreview.tpl'                => 'd3/points/Application/views/azure/tpl/account/inc/oxreview.tpl',
        'd3points_list_type_azure_oxvoucher.tpl'               => 'd3/points/Application/views/azure/tpl/account/inc/oxvoucher.tpl',
        'd3points_list_type_azure_oxvoucher_storno.tpl'        => 'd3/points/Application/views/azure/tpl/account/inc/oxvoucher_storno.tpl',
        'd3points_list_type_azure_oxvoucher_storno_rebook.tpl' => 'd3/points/Application/views/azure/tpl/account/inc/oxvoucher_storno_rebook.tpl',

        //flow
        'd3points_mail_option_flow.tpl'                       => 'd3/points/Application/views/flow/tpl/account/inc/mail_option.tpl',
        'd3points_list_type_flow_other.tpl'                   => 'd3/points/Application/views/flow/tpl/account/inc/other.tpl',
        'd3points_list_type_flow_oxorder.tpl'                 => 'd3/points/Application/views/flow/tpl/account/inc/oxorder.tpl',
        'd3points_list_type_flow_oxorder_storno.tpl'          => 'd3/points/Application/views/flow/tpl/account/inc/oxorder_storno.tpl',
        'd3points_list_type_flow_oxrating.tpl'                => 'd3/points/Application/views/flow/tpl/account/inc/oxrating.tpl',
        'd3points_list_type_flow_oxreview.tpl'                => 'd3/points/Application/views/flow/tpl/account/inc/oxreview.tpl',
        'd3points_list_type_flow_oxvoucher.tpl'               => 'd3/points/Application/views/flow/tpl/account/inc/oxvoucher.tpl',
        'd3points_list_type_flow_oxvoucher_storno.tpl'        => 'd3/points/Application/views/flow/tpl/account/inc/oxvoucher_storno.tpl',
        'd3points_list_type_flow_oxvoucher_storno_rebook.tpl' => 'd3/points/Application/views/flow/tpl/account/inc/oxvoucher_storno_rebook.tpl',
    ),

    'events'      => array(
        //'onActivate' => \d3\modcfg\Application\Model\Install\d3install::class . '::checkUpdateStart',
        'onActivate' => '\D3\Points\Setup\Events::onActivate',
    ),

    'blocks'      => array(
        array(
            'template' => 'page/account/inc/account_menu.tpl',
            'block'    => 'account_menu',
            'file'     => 'Application/views/blocks/page/account/inc/account_menu.tpl',
            'position'  => 1,
        ),
        array(
            'template' => 'page/account/dashboard.tpl',
            'block'    => 'account_dashboard_col1',
            'file'     => 'Application/views/blocks/page/account/dashbord.tpl',
            'position'  => 1,
        ),
        array(
            'template' => 'widget/header/servicebox.tpl',
            'block'    => 'widget_header_servicebox_items',
            'file'     => 'Application/views/blocks/widget/header/servicebox.tpl',
            'position'  => 1,
        ),

        array(
            'template' => 'widget/footer/services.tpl',
            'block'    => 'footer_services_items',
            'file'     => 'Application/views/blocks/widget/footer/services.tpl',
            'position'  => 1,
        ),

        array(
            'template' => 'order_main.tpl',
            'block'    => 'admin_order_main_form',
            'file'     => 'Application/views/admin/blocks/order_main_form.tpl',
            'position'  => 1,
        ),

        array(
            'template' => 'layout/base.tpl',
            'block'    => 'base_style',
            'file'     => 'Application/views/blocks/layout/base_style.tpl',
            'position'  => 1,
        ),
    ),
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
    ),
    'd3SetupClasses' => array(
        ModuleSetup\d3_points_update::class,
    ),
);
