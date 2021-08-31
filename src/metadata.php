<?php

use OxidEsales\Eshop\Application\Controller as OxidController;
use OxidEsales\Eshop\Application\Model as OxidModel;
use OxidEsales\Eshop\Core as OxidCore;

/**
 * Metadata version
 */
$sMetadataVersion = '2.1';

$sD3Logo = '<img src="https://logos.oxidmodule.com/d3logo.svg" alt="(D3)" style="height:1em;width:1em"> ';

/**
 * Module information
 */
$aModule = [
    'id'          => 'd3points',
    'title'       => $sD3Logo . ' Bonuspunkte',
    'description' => [
    'de' => 'Bieten Sie Ihren Kunden ein umfassendes Bonussystem an.',
    'en' => ''
    ],
    'lang'        => 'de',
    'thumbnail'   => 'picture.png',
    'version'     => '5.0.3.1',
    'author'      => 'D&sup3; Data Development',
    'url'         => 'http://www.shopmodule.com',
    'email'       => 'support@shopmodule.com',
    'extend'      => [
        OxidController\AccountController::class        => \D3\Points\Modules\Application\Controller\d3_account_points::class,
        OxidController\ArticleDetailsController::class => \D3\Points\Modules\Application\Controller\d3_details_points::class,
        OxidController\ReviewController::class         => \D3\Points\Modules\Application\Controller\d3_review_points::class,
        OxidController\Admin\OrderMain::class          => \D3\Points\Modules\Application\Controller\Admin\d3_ordermain_d3points::class,
        OxidModel\Order::class                         => \D3\Points\Modules\Application\Model\d3_oxorder_d3points::class,
        OxidModel\User::class                          => \D3\Points\Modules\Application\Model\d3_oxuser_points::class,
        OxidModel\Voucher::class                       => \D3\Points\Modules\Application\Model\d3_oxvoucher_points::class,
        OxidCore\ViewConfig::class                     => \D3\Points\Modules\Core\d3_oxviewconfig_points::class,
        OxidCore\Email::class                          => \D3\Points\Modules\Core\d3_oxemail_points::class,
    ],

    'controllers'       => [
        'd3points'                  => \D3\Points\Application\Model\d3points::class,
        'd3rating'                  => \D3\Points\Application\Model\d3rating::class,
        'utils_points'              => \D3\Points\Application\Model\utils_points::class,
        'd3prerunchecks'            => \D3\Points\Application\Model\d3prerunchecks::class,
        'd3conditions'                => \D3\Points\Application\Model\d3conditions::class,

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
    ],

    'templates'   => [
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
        'd3_account_points_azure.tpl'                          => 'd3/points/Application/views/azure/tpl/account/account_points.tpl',
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
        'd3_account_points_flow.tpl'                          => 'd3/points/Application/views/flow/tpl/account/account_points.tpl',
        'd3points_list_type_flow_oxorder.tpl'                 => 'd3/points/Application/views/flow/tpl/account/inc/oxorder.tpl',
        'd3points_list_type_flow_oxorder_storno.tpl'          => 'd3/points/Application/views/flow/tpl/account/inc/oxorder_storno.tpl',
        'd3points_list_type_flow_oxrating.tpl'                => 'd3/points/Application/views/flow/tpl/account/inc/oxrating.tpl',
        'd3points_list_type_flow_oxreview.tpl'                => 'd3/points/Application/views/flow/tpl/account/inc/oxreview.tpl',
        'd3points_list_type_flow_oxvoucher.tpl'               => 'd3/points/Application/views/flow/tpl/account/inc/oxvoucher.tpl',
        'd3points_list_type_flow_oxvoucher_storno.tpl'        => 'd3/points/Application/views/flow/tpl/account/inc/oxvoucher_storno.tpl',
        'd3points_list_type_flow_oxvoucher_storno_rebook.tpl' => 'd3/points/Application/views/flow/tpl/account/inc/oxvoucher_storno_rebook.tpl',

        //wave
        'd3points_mail_option_wave.tpl'                       => 'd3/points/Application/views/wave/tpl/account/inc/mail_option.tpl',
        'd3_account_points_wave.tpl'                          => 'd3/points/Application/views/wave/tpl/account/account_points.tpl',
        'd3points_list_type_wave_other.tpl'                   => 'd3/points/Application/views/wave/tpl/account/inc/other.tpl',
        'd3points_list_type_wave_oxorder.tpl'                 => 'd3/points/Application/views/wave/tpl/account/inc/oxorder.tpl',
        'd3points_list_type_wave_oxorder_storno.tpl'          => 'd3/points/Application/views/wave/tpl/account/inc/oxorder_storno.tpl',
        'd3points_list_type_wave_oxrating.tpl'                => 'd3/points/Application/views/wave/tpl/account/inc/oxrating.tpl',
        'd3points_list_type_wave_oxreview.tpl'                => 'd3/points/Application/views/wave/tpl/account/inc/oxreview.tpl',
        'd3points_list_type_wave_oxvoucher.tpl'               => 'd3/points/Application/views/wave/tpl/account/inc/oxvoucher.tpl',
        'd3points_list_type_wave_oxvoucher_storno.tpl'        => 'd3/points/Application/views/wave/tpl/account/inc/oxvoucher_storno.tpl',
        'd3points_list_type_wave_oxvoucher_storno_rebook.tpl' => 'd3/points/Application/views/wave/tpl/account/inc/oxvoucher_storno_rebook.tpl',
    ],


    'events'      => [
        'onActivate'    => '\D3\Points\Setup\Events::onActivate',
    ],

    'blocks'      => [
        [
            'template' => 'page/account/inc/account_menu.tpl',
            'block'    => 'account_menu',
            'file'     => 'Application/views/blocks/page/account/inc/account_menu.tpl',
            'position'  => 1,
        ],
        [
            'template' => 'page/account/dashboard.tpl',
            'block'    => 'account_dashboard_col1',
            'file'     => 'Application/views/blocks/page/account/dashbord.tpl',
            'position'  => 1,
        ],
        [
            'template' => 'widget/header/servicebox.tpl',
            'block'    => 'widget_header_servicebox_items',
            'file'     => 'Application/views/blocks/widget/header/servicebox.tpl',
            'position'  => 1,
        ],

        [
            'template' => 'widget/header/servicemenu.tpl',
            'block'    => 'dd_layout_page_header_icon_menu_account_button',
            'file'     => 'Application/views/blocks/widget/header/dd_layout_page_header_icon_menu_account_button.tpl',
            'position'  => 1,
        ],

        [
            'template' => 'widget/footer/services.tpl',
            'block'    => 'footer_services_items',
            'file'     => 'Application/views/blocks/widget/footer/services.tpl',
            'position'  => 1,
        ],

        [
            'template' => 'order_main.tpl',
            'block'    => 'admin_order_main_form',
            'file'     => 'Application/views/admin/blocks/order_main_form.tpl',
            'position'  => 1,
        ],

        [
            'template' => 'layout/base.tpl',
            'block'    => 'base_style',
            'file'     => 'Application/views/blocks/layout/base_style.tpl',
            'position'  => 1,
        ],
    ],
];
