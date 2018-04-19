[{include file="headitem.tpl" title="D3_CFG_MOD"|oxmultilangassign}]

<script type="text/javascript">
    <!--
    [{if $updatelist == 1}]
    UpdateList('[{$oxid}]');
    [{/if}]

    function UpdateList( sID)
    {
        var oSearch = parent.list.document.getElementById("search");
        oSearch.oxid.value=sID;
        oSearch.fnc.value='';
        oSearch.submit();
    }

    function EditThis( sID)
    {
        var oTransfer = document.getElementById("transfer");
        oTransfer.oxid.value=sID;
        oTransfer.cl.value='';
        oTransfer.submit();

        var oSearch = parent.list.document.getElementById("search");
        oSearch.actedit.value = 0;
        oSearch.oxid.value=sID;
        oSearch.submit();
    }

    function _groupExp(el) {
        var _cur = el.parentNode;

        if (_cur.className == "exp") _cur.className = "";
        else _cur.className = "exp";
    }

    function d3ChangeOption(active, inactive) {
        var elname = "d3_cfg_mod__d3points_POINTS_SYSTEM_";
        var elact = document.getElementById(elname+active.toUpperCase());
        var elina = document.getElementById(elname+inactive.toUpperCase());
        if(elact && elina)
        {
            elact.disabled = false;
            elina.disabled = true;
        }
    }
    -->
</script>


<style type="text/css">
    <!--
    .helptextbox{
        background-color: white;
        color: black;
        border: 1px solid black;
        position: absolute;
        overflow: hidden;
        padding: 5px;
        margin-top: 15px;
        width: 300px;
        z-index: 99;
    }
    fieldset{
        border: 1px inset black;
    }
    legend{
        font-weight: bold;
    }
    .groupExp dl dt{
        font-weight: normal;
        width: 35%;
        padding-left: 10px;
    }
    div.highlight.left {
        float:left;
    }

    .groupExp.highlighted {
        background-color: #CD0210;
    }
    .groupExp.highlighted a.rc b {
        color: white;
    }
    .groupExp.highlighted .exp a.rc b {
        color: black;
    }
    .groupExp.highlighted .exp {
        background-color: #F0F0F0;
    }
    .groupExp .exp dl.highlighted {
        background-color:#CD0210;

    }
    .groupExp {
        border: 1px solid lightgray;
    }
    .ext_edittext {
        padding: 2px;
    }
    td.edittext {
        white-space: normal;
    }

    td.edittext.listitem{
        padding-left: 0;
    }
    .confinput {
        width: 300px;
        height: 60px;
    }
    span.field {
        border: 1px inset black;
        padding: 1px 6px;
        width:138px;
        display: block;
    }
    [{*
    a.d3cronjoblink {
        background: url("[{$oViewConf->getModuleUrl('d3modcfg_lib', 'out/admin/src/bg/d3modcfg_icons.png')}]") no-repeat scroll 0 -150px transparent;
        display: inline-block;
        height: 20px;
        width: 20px;
    }
    *}]
    a.d3cronjoblink:hover {
        text-decoration:none;
    }
    -->
</style>

[{if $readonly}]
    [{assign var="readonly" value="readonly disabled"}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]

<form name="transfer" id="transfer" action="[{$oViewConf->getSelfLink()}]" method="post">
    [{$oViewConf->getHiddenSid()}]
    <input type="hidden" name="oxid" value="[{$oxid}]">
    <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
    <input type="hidden" name="actshop" value="[{$shop->id}]">
    <input type="hidden" name="editlanguage" value="[{$editlanguage}]">
</form>

<form name="myedit" id="myedit" action="[{$oViewConf->getSelfLink()}]" method="post">
    [{$oViewConf->getHiddenSid()}]
    <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
    <input type="hidden" name="fnc" value="save">
    <input type="hidden" name="oxid" value="[{$oxid}]">
    <input type="hidden" name="editval[d3_cfg_mod__oxid]" value="[{$oxid}]">

    [{include file="d3_cfg_mod_active.tpl"}]
    <hr>
    [{if $oView->getValueStatus() == 'error'}]
        <table>
            <tr>
                <td>
                    <b>[{oxmultilang ident="D3_CFG_MOD_GENERAL_NOCONFIG_DESC"}]</b><br>
                    <div class="d3modcfg_btn fixed icon status_danger">
                        <input type="submit" value="[{oxmultilang ident="D3_CFG_MOD_GENERAL_NOCONFIG_BTN"}]">
                        <div></div>
                    </div>
                </td>
            </tr>
        </table>
    [{else}]
        <fieldset>
            <legend>[{oxmultilang ident="D3_CFG_MOD_d3points_CRONJOBS_OWERVIEW"}]</legend>
            [{block name="d3points_settings_cronjob_actions_table"}]
            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
                    <td class="edittext listitem" rowspan="2">[{oxmultilang ident="D3_CFG_MOD_d3points_CRONJOB_GENERALL"}]</td>
                    <td class="edittext listitem" rowspan="2">
                        <input type="hidden" name="value[d3_cfg_mod__bld3points_CRONJOB_ACTIVE]" value="0">
                        <input class="edittext ext_edittext" type="checkbox" name="value[d3_cfg_mod__bld3points_CRONJOB_ACTIVE]" value='1' [{if $edit->getValue('bld3points_CRONJOB_ACTIVE') == 1}]checked[{/if}]>
                        [{oxinputhelp ident="D3_CFG_MOD_d3points_CRONJOBS_ACTIVE_HELP"}]
                    </td>
                    <td class="edittext listitem">[{oxmultilang ident="D3_CFG_MOD_d3points_LAST_STARTS_CRONJOBS"}]</td>
                    <td class="edittext listitem"><span class="field">[{$edit->getValue('d3points_CronJob_NEWPOINTS_LastStart')}]&nbsp;</span></td>
                </tr>
                <tr>
                    <td class="edittext listitem">[{oxmultilang ident="D3_CFG_MOD_d3points_CRONJOBS_LINK"}]</td>
                    <td class="edittext listitem" style="white-space: nowrap;">
                        <a href="[{$oViewConf->getModuleUrl('d3points', 'public/d3_cron_points.php')}]?key=[{$edit->getValue('d3points_ACCESSKEY')}][{$oView->d3GetShopId()}]" target="_new" class="d3modcfg_btn icon d3color-blue" style="margin-right: 3px; padding-right: 0; background-image: none; width: 25px;">
                            <i class="fa fa-mouse-pointer fa-inverse" style="padding: 5px 9px;"></i>
                        </a>
                        [{$oViewConf->getModuleUrl('d3points', 'public/d3_cron_points.php')}]?key=[{$edit->getValue('d3points_ACCESSKEY')}][{$oView->d3GetShopId()}]

                        &nbsp;[{oxinputhelp ident="D3_CFG_MOD_d3points_CRONJOBS_LINK_HELP"}]
                    </td>
                </tr>
                <tr>
                    <td class="edittext">[{oxmultilang ident="D3_CFG_MOD_d3points_CRONJOB_NEWPOINTS"}]</td>
                    <td class="edittext">
                        <input type="hidden" name="value[d3_cfg_mod__bld3points_FNC_NEWPOINTS_ACTIVE]" value="0">
                        <input class="edittext ext_edittext" type="checkbox" name="value[d3_cfg_mod__bld3points_FNC_NEWPOINTS_ACTIVE]" value='1' [{if $edit->getValue('bld3points_FNC_NEWPOINTS_ACTIVE') == 1}]checked[{/if}]>
                        [{oxinputhelp ident="D3_CFG_MOD_d3points_CRONJOB_NEWPOINTS_HELP"}]
                    </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td class="edittext listitem">[{oxmultilang ident="D3_CFG_MOD_d3points_VOUCHER_4_MAX_POINTS"}]</td>
                    <td class="edittext listitem">
                        <input type="hidden" name="value[d3_cfg_mod__bld3points_FNC_VOUCHER_4_MAX_POINTS]" value="0">
                        <input class="edittext ext_edittext" type="checkbox" name="value[d3_cfg_mod__bld3points_FNC_VOUCHER_4_MAX_POINTS]" value='1' [{if $edit->getValue('bld3points_FNC_VOUCHER_4_MAX_POINTS') == 1}]checked[{/if}]>
                        [{oxinputhelp ident="D3_CFG_MOD_d3points_VOUCHER_4_MAX_POINTS_HELP"}]
                    </td>
                    <td class="listitem">&nbsp;</td>
                    <td class="listitem">&nbsp;</td>
                </tr>
                <tr>
                    <td class="edittext ext_edittext">[{oxmultilang ident="D3_CFG_MOD_d3points_SEND_FIRST_MAIL"}]</td>
                    <td class="edittext ext_edittext">
                        <input type="hidden" name="value[d3_cfg_mod__bld3points_FNC_SEND_FIRST_MAIL]" value="0">
                        <input class="edittext ext_edittext" type="checkbox" name="value[d3_cfg_mod__bld3points_FNC_SEND_FIRST_MAIL]" value='1' [{if $edit->getValue('bld3points_FNC_SEND_FIRST_MAIL') == 1}]checked[{/if}]>
                        [{oxinputhelp ident="D3_CFG_MOD_d3points_SEND_FIRST_MAIL_HELP"}]
                    </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td class="edittext listitem">[{oxmultilang ident="D3_CFG_MOD_d3points_SEND_REMINDER_MAIL"}]</td>
                    <td class="edittext listitem">
                        <input type="hidden" name="value[d3_cfg_mod__bld3points_FNC_SEND_REMINDER_MAIL]" value="0">
                        <input class="edittext ext_edittext" type="checkbox" name="value[d3_cfg_mod__bld3points_FNC_SEND_REMINDER_MAIL]" value='1' [{if $edit->getValue('bld3points_FNC_SEND_REMINDER_MAIL') == 1}]checked[{/if}]>
                        [{oxinputhelp ident="D3_CFG_MOD_d3points_SEND_REMINDER_MAIL_HELP"}]
                    </td>
                    <td class="listitem">&nbsp;</td>
                    <td class="listitem">&nbsp;</td>
                </tr>

                <tr>
                    <td class="edittext ">[{oxmultilang ident="D3_CFG_MOD_d3points_ACCESSKEY"}]</td>
                    <td class="edittext " colspan="2">
                        <input type="text" class="editinput" size="10" maxlength="100" name="value[d3_cfg_mod__d3points_ACCESSKEY]" value="[{$edit->getValue('d3points_ACCESSKEY')|default:$oView->d3GetRandomCode()}]">[{oxinputhelp ident="D3_CFG_MOD_d3points_ACCESSKEY_HELP"}]
                    </td>
                    <td class="">&nbsp;</td>
                </tr>

                [{block name="d3points_settings_cronjob_actions_table_last_row"}]
                <tr>
                    <td class="edittext ">[{oxmultilang ident="D3_CFG_MOD_d3points_FNC_CRONJOB_PRINT_STATUS"}]</td>
                    <td class="edittext " colspan="2">
                        <input type="hidden" name="value[d3_cfg_mod__bld3points_FNC_CRONJOB_PRINT_STATUS]" value="0">
                        <input class="edittext ext_edittext" type="checkbox" name="value[d3_cfg_mod__bld3points_FNC_CRONJOB_PRINT_STATUS]" value='1' [{if $edit->getValue('bld3points_FNC_CRONJOB_PRINT_STATUS') == 1}]checked[{/if}]>
                        [{oxinputhelp ident="D3_CFG_MOD_d3points_FNC_CRONJOB_PRINT_STATUS_HELP"}]
                    </td>
                    <td class="">&nbsp;</td>
                </tr>
                [{/block}]
            </table>
            [{/block}]
        </fieldset>
        <hr>
        [{block name="d3points_settings_settings"}]
        <fieldset>
            <legend>[{oxmultilang ident="D3_CFG_MOD_d3points_SETTINGS"}]</legend>
            [{* Berechnung *}]
            [{block name="d3points_settings_settings_calculation"}]
            <div class="groupExp [{*if $edit->getValue('meinPaket_HOST == ''}]highlighted[{/if*}]">
                <div class="">
                    <a class="rc" onclick="_groupExp(this); return false;" href="#">
                        <b>
                            [{oxmultilang ident="D3_CFG_MOD_d3points_CALCULATION"}]
                        </b>
                    </a>
                    [{oxinputhelp ident="D3_CFG_MOD_d3points_CALCULATION_HELP"}]
                    [{block name="d3points_settings_settings_calculation_options_list"}]
                    <dl>
                        <dt>
                        [{oxmultilang ident="D3_CFG_MOD_d3points_POINTS_SYSTEM"}]
                        </dt>
                        <dd>
                            <div style="width:64%;float:right;">
                                <table border="0" width="100%">
                                    <tr>
                                        <td>
                                            [{* lineare Punktevergabe *}]
                                            <input  onclick="d3ChangeOption('linear','scalar');" type="radio" name="value[d3_cfg_mod__d3points_POINTS_SYSTEM]" value="linear" [{if $edit->getValue('d3points_POINTS_SYSTEM') =="linear" || !$edit->getValue('d3points_POINTS_SYSTEM')}]checked[{/if}]>[{oxmultilang ident="D3_CFG_MOD_d3points_POINTS_SYSTEM_LINEAR"}][{oxinputhelp ident="D3_CFG_MOD_d3points_POINTS_SYSTEM_LINEAR_HELP"}]
                                        </td>
                                        <td>
                                            [{oxmultilang ident="D3_CFG_MOD_d3points_POINTS_SYSTEM_LINEAR_SET"}]
                                            [{oxinputhelp ident="D3_CFG_MOD_d3points_POINTS_SYSTEM_LINEAR_SET_HELP"}]<br>
                                            <input type="text" name="value[d3_cfg_mod__d3points_POINTS_SYSTEM_LINEAR]" id="d3_cfg_mod__d3points_POINTS_SYSTEM_LINEAR" value="[{$edit->getValue('d3points_POINTS_SYSTEM_LINEAR')|default:"0.5"}]" size="4" maxlength="10" [{if $edit->getValue('d3points_POINTS_SYSTEM') == "scale"}] disabled="disabled"[{/if}]>
                                            [{oxmultilang ident="D3_CFG_MOD_d3points_LABEL_POINTS"}]&nbsp;
                                        </td>
                                    </tr>
                                    <tr><td colspan="2">&nbsp;<hr></td></tr>
                                    <tr>
                                        <td>
                                            [{*skalare Punktevergabe*}]
                                            <input onclick="d3ChangeOption('scalar','linear');" type="radio" name="value[d3_cfg_mod__d3points_POINTS_SYSTEM]" value="scale" [{if $edit->getValue('d3points_POINTS_SYSTEM') =="scale"}]checked[{/if}]>[{oxmultilang ident="D3_CFG_MOD_d3points_POINTS_SYSTEM_SCALE"}][{oxinputhelp ident="D3_CFG_MOD_d3points_POINTS_SYSTEM_SCALE_HELP"}]
                                        </td>
                                        <td>
                                            [{oxmultilang ident="D3_CFG_MOD_d3points_POINTS_SYSTEM_SCALAR_SET"}]
                                            [{oxinputhelp ident="D3_CFG_MOD_d3points_POINTS_SYSTEM_SCALAR_SET_HELP"}]<br>
                                            [{assign var='SCALAR_FALLBACK' value='5 => 0__@@49.99
10 => 50__@@99.99
20 => 100__@@149.99
30 => 150__@@999999'}]
                                            <textarea cols="50" rows="3" class="confinput" name="valuearr[d3_cfg_mod__ad3points_POINTS_SYSTEM_SCALAR]" id="d3_cfg_mod__d3points_POINTS_SYSTEM_SCALAR" [{if $edit->getEditValue('d3points_POINTS_SYSTEM') != "scale"}] disabled="disabled"[{/if}]>[{$edit->getEditValue('ad3points_POINTS_SYSTEM_SCALAR')|default:$SCALAR_FALLBACK}]</textarea>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="spacer"></div>
                        </dd>
                    </dl>
                    <dl>
                        <dt>
                        [{oxmultilang ident="D3_CFG_MOD_d3points_POINTS_SYSTEM_REVIEW_RATING_SET"}]
                        </dt>
                        <dd>
                            <input type="text" name="value[d3_cfg_mod__d3points_POINTS_SYSTEM_REVIEW_RATING]" value="[{$edit->getValue('d3points_POINTS_SYSTEM_REVIEW_RATING')|default:"0"}]" size="4" maxlength="10">
                            [{oxmultilang ident="D3_CFG_MOD_d3points_LABEL_POINTS"}]&nbsp;
                            [{oxinputhelp ident="D3_CFG_MOD_d3points_POINTS_SYSTEM_REVIEW_RATING_SET_HELP"}]
                            <div class="spacer"></div>
                        </dd>
                    </dl>
                    <dl>
                        <dt>
                        [{oxmultilang ident="D3_CFG_MOD_d3points_POINTS_SYSTEM_REVIEW_TEXT_SET"}]
                        </dt>
                        <dd>
                            <input type="text" name="value[d3_cfg_mod__d3points_POINTS_SYSTEM_REVIEW_TEXT]" value="[{$edit->getValue('d3points_POINTS_SYSTEM_REVIEW_TEXT')|default:"0"}]" size="4" maxlength="10">
                            [{oxmultilang ident="D3_CFG_MOD_d3points_LABEL_POINTS"}]&nbsp;
                            [{oxinputhelp ident="D3_CFG_MOD_d3points_POINTS_SYSTEM_REVIEW_TEXT_SET_HELP"}]
                            <div class="spacer"></div>
                        </dd>
                    </dl>
                    <dl>
                        <dt>
                        [{oxmultilang ident="D3_CFG_MOD_d3points_POINTS_SYSTEM_REVIEW_TEXT_MULTIPLE_REVIEWS"}]
                        </dt>
                        <dd>
                            <input type="hidden" name="value[d3_cfg_mod__d3points_POINTS_SYSTEM_REVIEW_TEXT_MULTIPLE_REVIEWS]" value="0">
                            <input class="edittext ext_edittext" type="checkbox" name="value[d3_cfg_mod__d3points_POINTS_SYSTEM_REVIEW_TEXT_MULTIPLE_REVIEWS]" value='1' [{if $edit->getValue('d3points_POINTS_SYSTEM_REVIEW_TEXT_MULTIPLE_REVIEWS') == 1}]checked[{/if}]>
                            [{oxinputhelp ident="D3_CFG_MOD_d3points_POINTS_SYSTEM_REVIEW_TEXT_MULTIPLE_REVIEWS_HELP"}]
                            <div class="spacer"></div>
                        </dd>
                    </dl>
                    [{* EE-Mall-Modus *}]
                    <dl>
                        <dt>
                        [{oxmultilang ident="D3_CFG_MOD_d3points_POINTS_SYSTEM_EE_MALL_ACCOUNT"}]
                        </dt>
                        <dd>
                            <input type="hidden" name="value[d3_cfg_mod__bld3points_POINTS_SYSTEM_EE_MALL_ACCOUNT]" value="0">
                            <input class="edittext ext_edittext" type="checkbox" name="value[d3_cfg_mod__bld3points_POINTS_SYSTEM_EE_MALL_ACCOUNT]" value='1' [{if $edit->getValue('bld3points_POINTS_SYSTEM_EE_MALL_ACCOUNT') == 1}]checked[{/if}]>
                            [{oxinputhelp ident="D3_CFG_MOD_d3points_POINTS_SYSTEM_EE_MALL_ACCOUNT_HELP"}]
                            <div class="spacer"></div>
                        </dd>
                    </dl>
                    [{/block}]
                </div>
            </div>
            [{/block}]

            [{* Auswahl Bestellungen *}]
            [{block name="d3points_settings_settings_select_orders"}]
            <div class="groupExp">
                <div class="">
                    <a class="rc" onclick="_groupExp(this); return false;" href="#">
                        <b>
                            [{oxmultilang ident="D3_CFG_MOD_d3points_SELECT_ORDERS"}]
                        </b>
                    </a>
                    [{oxinputhelp ident="D3_CFG_MOD_d3points_SELECT_ORDERS_HELP"}]
                    [{block name="d3points_settings_settings_select_orders_options_list"}]
                    [{* Datumsbegrenzung in Monaten zurück *}]
                    <dl>
                        <dt>
                        [{oxmultilang ident="D3_CFG_MOD_d3points_SELECTION_DATE_LIMIT"}]
                        </dt>
                        <dd>
                            <input type="text" name="value[d3_cfg_mod__d3points_SELECTION_DATE_LIMIT]" value="[{$edit->getValue('d3points_SELECTION_DATE_LIMIT')|default:"6"}]" size="3" maxlength="10">
                            <select name="value[d3_cfg_mod__d3points_SELECTION_DATE_LIMIT_RANGE]">
                                <option value="months"[{if $edit->getValue('d3points_SELECTION_DATE_LIMIT_RANGE') == 'months'}] selected
                                    [{elseif $edit->getValue('d3points_SELECTION_DATE_LIMIT_RANGE') == ''}] selected
                                    [{/if}]>
                                    [{oxmultilang ident="D3_CFG_MOD_d3points_LABEL_MONTHS"}]</option>
                                <option value="days"[{if $edit->getValue('d3points_SELECTION_DATE_LIMIT_RANGE') == 'days'}] selected[{/if}]>[{oxmultilang ident="D3_CFG_MOD_d3points_LABEL_DAYS"}]</option>
                            </select>

                            [{*oxmultilang ident="D3_CFG_MOD_d3points_LABEL_DAYS"*}]&nbsp;
                            [{oxinputhelp ident="D3_CFG_MOD_d3points_SELECTION_DATE_LIMIT_HELP"}]
                            <div class="spacer"></div>
                        </dd>
                    </dl>
                    [{* Erstellung der Punkte nach x Tagen *}]
                    <dl>
                        <dt>
                        [{oxmultilang ident="D3_CFG_MOD_d3points_SELECTION_DATE_RANGE"}]
                        </dt>
                        <dd>
                            <input type="text" name="value[d3_cfg_mod__d3points_SELECTION_DATE_RANGE]" value="[{$edit->getValue('d3points_SELECTION_DATE_RANGE')|default:"0"}]" size="3" maxlength="10">
                            [{oxmultilang ident="D3_CFG_MOD_d3points_LABEL_DAYS"}]&nbsp;
                            [{oxinputhelp ident="D3_CFG_MOD_d3points_SELECTION_DATE_RANGE_HELP"}]
                            <div class="spacer"></div>
                        </dd>
                    </dl>
                    [{* Preislimit *}]
                    <dl>
                        <dt>
                        [{oxmultilang ident="D3_CFG_MOD_d3points_SELECTION_PRICE_LIMIT"}]
                        </dt>
                        <dd>
                            <input type="text" name="value[d3_cfg_mod__d3points_SELECTION_PRICE_LIMIT]" value="[{$edit->getValue('d3points_SELECTION_PRICE_LIMIT')|default:"19,99"}]" size="5" maxlength="10">
                            [{* $oActCur->sign *}]
                            [{oxinputhelp ident="D3_CFG_MOD_d3points_SELECTION_PRICE_LIMIT_HELP"}]
                            <div class="spacer"></div>
                        </dd>
                    </dl>

                    [{* Kunden ohne Kundenkonto *}]
                    <dl>
                        <dt>
                        [{oxmultilang ident="D3_CFG_MOD_d3points_DO_POINTS_FOR_USER_WITHOUT_ACCOUNT"}]
                        </dt>
                        <dd>
                            <input type="hidden" name="value[d3_cfg_mod__d3points_DO_POINTS_FOR_USER_WITHOUT_ACCOUNT]" value='0'>
                            <input class="edittext ext_edittext" type="checkbox" name="value[d3_cfg_mod__d3points_DO_POINTS_FOR_USER_WITHOUT_ACCOUNT]" value='1' [{if $edit->getValue('d3points_DO_POINTS_FOR_USER_WITHOUT_ACCOUNT') == 1}]checked[{/if}]>
                            [{oxinputhelp ident="D3_CFG_MOD_d3points_DO_POINTS_FOR_USER_WITHOUT_ACCOUNT_HELP"}]
                            <div class="spacer"></div>
                        </dd>
                    </dl>

                    [{* Kundengruppen freigeben *}]
                    <dl>
                        <dt>
                        [{oxmultilang ident="D3_CFG_MOD_d3points_SELECTION_GROUPS_4_POINTS"}]
                        [{oxinputhelp ident="D3_CFG_MOD_d3points_SELECTION_GROUPS_4_POINTS_HELP"}]
                        </dt>
                        <dd>
                            <div style="width:64%;float:right;">
                                <input class="edittext ext_edittext" type="hidden" name="SELECTIONGROUPS[SELECTION_GROUPS_4_POINTS]" value='0' >
                                [{strip}]
                                    <table>
                                        <tr>
                                            [{assign var=oGroups4Points value=$oView->d3_PrepareGroups4Points()}]
                                            [{foreach from=$oGroups4Points item=Groups name="group4points"}]
                                                <td>
                                                    [{*<input class="edittext ext_edittext" type="hidden" name="SELECTIONGROUPS[SELECTION_GROUPS_4_POINTS][]" value='0' >*}]
                                                    <input class="edittext ext_edittext" type="checkbox" name="SELECTIONGROUPS[SELECTION_GROUPS_4_POINTS][]"
                                                           value='[{$Groups->oxgroups__oxid->value}]' [{if $Groups->select == 1}]checked[{/if}]>
                                                    [{if !$Groups->oxgroups__oxactive->value}]<span style="font-style:italic;">[{else}]<span>[{/if}][{$Groups->oxgroups__oxtitle->value}]</span>
                                                    [{if !$Groups->oxgroups__oxactive->value}]<span style="font-style:italic;">([{oxmultilang ident="D3_CFG_MOD_d3points_INACTIVE"}])</span>[{/if}]
                                            </td>
                                            [{if $smarty.foreach.group4points.last && $smarty.foreach.group4points.iteration % 2 != 0}]
                                                <td></td>
                                            [{/if}]
                                            [{if $smarty.foreach.group4points.iteration % 2 == 0}]
                                            </tr>
                                            [{if !$smarty.foreach.group4points.last}]
                                                <tr>
                                                [{/if}]
                                            [{/if}]
                                        [{/foreach}]
                                </table>
                            [{/strip}]
                            </div>
                            <div class="spacer"></div>
                        </dd>
                    </dl>
                    [{*Kundengruppen ausschlieï¿½en*}]
                    <dl>
                        <dt>
                        [{oxmultilang ident="D3_CFG_MOD_d3points_SELECTION_GROUPS_4_NO_POINTS"}]
                        [{oxinputhelp ident="D3_CFG_MOD_d3points_SELECTION_GROUPS_4_NO_POINTS_HELP"}]
                        </dt>
                        <dd>
                            <div style="width:64%;float:right;">
                                <input class="edittext ext_edittext" type="hidden" name="SELECTIONGROUPS[SELECTION_GROUPS_4_NO_POINTS]" value='0'>
                                [{strip}]
                                    <table>
                                        <tr>
                                            [{assign var=oGroups4NoPoints value=$oView->d3_PrepareGroups4NoPoints()}]
                                            [{foreach from=$oGroups4NoPoints item=Groups name="groupnopoints"}]
                                                <td>

                                                    <input class="edittext ext_edittext" type="checkbox" name="SELECTIONGROUPS[SELECTION_GROUPS_4_NO_POINTS][]"
                                                           value='[{$Groups->oxgroups__oxid->value}]' [{if $Groups->select == 1}]checked[{/if}]>
                                                    [{if !$Groups->oxgroups__oxactive->value}]<span style="font-style:italic;">[{else}]<span>[{/if}][{$Groups->oxgroups__oxtitle->value}]</span>
                                                    [{if !$Groups->oxgroups__oxactive->value}]<span style="font-style:italic;">([{oxmultilang ident="D3_CFG_MOD_d3points_INACTIVE"}])</span>[{/if}]
                                            </td>
                                            [{if $smarty.foreach.groupnopoints.last && $smarty.foreach.groupnopoints.iteration % 2 != 0}]
                                                <td></td>
                                            [{/if}]
                                            [{if $smarty.foreach.groupnopoints.iteration % 2 == 0}]
                                            </tr>
                                            [{if !$smarty.foreach.groupnopoints.last}]
                                                <tr>
                                                [{/if}]
                                            [{/if}]
                                        [{/foreach}]
                                    </table>
                                [{/strip}]
                                </div>
                                <div class="spacer"></div>
                            </dd>
                        </dl>
                        [{* Keine Punkte bei folgenden Zahlarten *}]
                        <dl>
                            <dt>
                            [{oxmultilang ident="D3_CFG_MOD_d3points_SELECTION_PAYMENT_4_NO_POINTS"}]
                            [{oxinputhelp ident="D3_CFG_MOD_d3points_SELECTION_PAYMENT_4_NO_POINTS_HELP"}]
                            </dt>
                            <dd>
                                <div style="width:64%;float:right;">
                                    <input class="edittext ext_edittext" type="hidden" name="SELECTIONGROUPS[SELECTION_PAYMENTS_4_NO_POINTS]" value='0'>
                                    [{assign var=oPayments4NoPoints value=$oView->d3_PreparePayments4NoPoints()}]
                                    [{foreach from=$oPayments4NoPoints item=Payments}]
                                        <input class="edittext ext_edittext" type="checkbox" name="SELECTIONGROUPS[SELECTION_PAYMENTS_4_NO_POINTS][]"
                                               value='[{$Payments->oxpayments__oxid->value}]' [{if $Payments->select == 1}]checked[{/if}]>
                                        [{if !$Payments->oxpayments__oxactive->value}]<span style="font-style:italic;">[{else}]<span>[{/if}][{$Payments->oxpayments__oxdesc->value}]</span>
                                        [{if !$Payments->oxpayments__oxactive->value}]<span style="font-style:italic;">([{oxmultilang ident="D3_CFG_MOD_d3points_INACTIVE"}])</span>[{/if}]
                                        Oxid: [{$Payments->oxpayments__oxid->value}]
                                    <br>
                                [{/foreach}]

                            </div>
                            <div class="spacer"></div>
                        </dd>
                    </dl>
                    [{* Gesetztes "bezahlt am"-Datum *}]
                    <dl>
                        <dt>
                        [{oxmultilang ident="D3_CFG_MOD_d3points_SELECTION_PAYMENT_DATE_PAYED_POINTS"}]
                        [{oxinputhelp ident="D3_CFG_MOD_d3points_SELECTION_PAYMENT_DATE_PAYED_POINTS_HELP"}]
                        </dt>
                        <dd>
                            <div style="width:64%;float:right;">
                                <input class="edittext ext_edittext" type="hidden" name="SELECTIONGROUPS[SELECTION_PAYMENTS_PAID_4_POINTS]" value='0'>
                                [{assign var=oPaymentsPaid4Points value=$oView->d3_PreparePaymentsPaid4Points()}]
                                [{foreach from=$oPaymentsPaid4Points item=Payments}]
                                    <input class="edittext ext_edittext" type="checkbox" name="SELECTIONGROUPS[SELECTION_PAYMENTS_PAID_4_POINTS][]"
                                           value='[{$Payments->oxpayments__oxid->value}]' [{if $Payments->select == 1}]checked[{/if}]>
                                    [{if !$Payments->oxpayments__oxactive->value}]<span style="font-style:italic;">[{else}]<span>[{/if}][{$Payments->oxpayments__oxdesc->value}]</span>
                                    [{if !$Payments->oxpayments__oxactive->value}]<span style="font-style:italic;">([{oxmultilang ident="D3_CFG_MOD_d3points_INACTIVE"}])</span>[{/if}]
                                <br>
                            [{/foreach}]

                        </div>
                        <div class="spacer"></div>
                    </dd>
                </dl>
                [{* Versandtdatum bei folgenden Bezahlarten pruefen *}]
                <dl>
                    <dt>
                    [{oxmultilang ident="D3_CFG_MOD_d3points_SELECTION_DELIVERYDATE_4_NO_POINTS"}]
                    [{oxinputhelp ident="D3_CFG_MOD_d3points_SELECTION_DELIVERYDATE_4_NO_POINTS_HELP"}]
                    </dt>
                    <dd>
                        <div style="width:64%;float:right;">
                            <br>
                            <br>
                            [{foreach from=$oView->d3_PrepareDeliveryDate4NoPoints() item=Payments}]
                                <input class="edittext ext_edittext" type="hidden" name="SELECTIONGROUPS[SELECTION_DELIVERYDATE_4_NO_POINTS][]" value='0'>
                                <input class="edittext ext_edittext" type="checkbox" name="SELECTIONGROUPS[SELECTION_DELIVERYDATE_4_NO_POINTS][]"
                                       value='[{$Payments->oxpayments__oxid->value}]' [{if $Payments->select == 1}]checked[{/if}]>
                                [{if !$Payments->oxpayments__oxactive->value}]<span style="font-style:italic;">[{else}]<span>[{/if}][{$Payments->oxpayments__oxdesc->value}]</span>
                                [{if !$Payments->oxpayments__oxactive->value}]<span style="font-style:italic;">([{oxmultilang ident="D3_CFG_MOD_d3points_INACTIVE"}])</span>[{/if}]
                            <br>
                        [{/foreach}]
                    </div>
                    <div class="spacer"></div>
                </dd>
            </dl>

            [{*oxfolder pruefen*}]
            [{*
            <dl>
                <dt>
                [{oxmultilang ident="D3_CFG_MOD_d3points_SELECTION_OXFOLDER_4_POINTS"}]
                [{oxinputhelp ident="D3_CFG_MOD_d3points_SELECTION_OXFOLDER_4_POINTS_HELP"}]
                </dt>
                <dd>
                    <div style="width:64%;float:right;">
                        [{foreach from=$oView->d3GetOxFolders4Points() item=aOxFolder}]
                            <input class="edittext ext_edittext" type="hidden" name="SELECTIONGROUPS[SELECTION_OXFOLDER_4_POINTS][]" value="0">
                            <input class="edittext ext_edittext" type="checkbox" name="SELECTIONGROUPS[SELECTION_OXFOLDER_4_POINTS][]"
                                   value="[{$aOxFolder->id}]" [{if $aOxFolder->select == 1}]checked[{/if}]>
                            [{oxmultilang ident=$aOxFolder->id}]
                            <br>
                        [{/foreach}]

                    </div>
                    <div class="spacer"></div>
                </dd>
            </dl>
            *}]

            [{*oxfolder pruefen*}]
            [{*
            <dl>
                <dt>
                [{oxmultilang ident="D3_CFG_MOD_d3points_SELECTION_OXFOLDER_4_NO_POINTS"}]
                [{oxinputhelp ident="D3_CFG_MOD_d3points_SELECTION_OXFOLDER_4_NO_POINTS_HELP"}]
                </dt>
                <dd>
                    <div style="width:64%;float:right;">
                        [{foreach from=$oView->d3GetOxFolders4NoPoints() item=aOxFolder}]
                            <input class="edittext ext_edittext" type="hidden" name="SELECTIONGROUPS[SELECTION_OXFOLDER_4_NO_POINTS][]" value="0">
                            <input class="edittext ext_edittext" type="checkbox" name="SELECTIONGROUPS[SELECTION_OXFOLDER_4_NO_POINTS][]"
                                   value="[{$aOxFolder->id}]" [{if $aOxFolder->select == 1}]checked[{/if}]>
                            [{oxmultilang ident=$aOxFolder->id}]
                            <br>
                        [{/foreach}]

                    </div>
                    <div class="spacer"></div>
                </dd>
            </dl>
            *}]
            [{/block}]
            </div>
        </div>
    [{/block}]

    [{block name="d3points_settings_settings_opt_settings"}]
    [{* Optionale Einstellungen *}]
    <div class="groupExp">
        <div class="">
            <a class="rc" onclick="_groupExp(this); return false;" href="#">
                <b>
                    [{oxmultilang ident="D3_CFG_MOD_d3points_OPT_SETTINGS"}]
                </b>
            </a>
            [{oxinputhelp ident="D3_CFG_MOD_d3points_OPT_SETTINGS_HELP"}]
            [{block name="d3points_settings_settings_opt_settings_options_list"}]
            [{* Wert muss im Feld oxip enthalten sein*}]
            <dl>
                <dt>
                [{oxmultilang ident="D3_CFG_MOD_d3points_SELECTION_OXIP_INCL"}]
                [{oxinputhelp ident="D3_CFG_MOD_d3points_SELECTION_OXIP_INCL_HELP"}]
                </dt>
                <dd>
                    <textarea cols="50" rows="3" class="confinput" name="valuearr[d3_cfg_mod__ad3points_POINTS_SELECTION_OXIP_INCL]">[{$edit->getEditValue('ad3points_POINTS_SELECTION_OXIP_INCL')}]</textarea>
                    <div class="spacer"></div>
                </dd>
            </dl>

            [{* Wert darf nicht im Feld oxip enthalten sein*}]
            <dl>
                <dt>
                [{oxmultilang ident="D3_CFG_MOD_d3points_SELECTION_OXIP_EXCL"}]
                [{oxinputhelp ident="D3_CFG_MOD_d3points_SELECTION_OXIP_EXCL_HELP"}]
                </dt>
                <dd>
                    <textarea cols="50" rows="3" class="confinput" name="valuearr[d3_cfg_mod__ad3points_POINTS_SELECTION_OXIP_EXCL]">[{$edit->getEditValue('ad3points_POINTS_SELECTION_OXIP_EXCL')}]</textarea>
                    <div class="spacer"></div>
                </dd>
            </dl>

            [{* Wert muss-werte im Feld OXTRANSSTATUS enthalten sein*}]
            <dl>
                <dt>
                [{oxmultilang ident="D3_CFG_MOD_d3points_SELECTION_OXTRANSSTATUS_INCL"}]
                [{oxinputhelp ident="D3_CFG_MOD_d3points_SELECTION_OXTRANSSTATUS_INCL_HELP"}]
                </dt>
                <dd>
                    <textarea cols="50" rows="3" class="confinput" name="valuearr[d3_cfg_mod__ad3points_POINTS_SELECTION_OXTRANSSTATUS_INCL]">[{$edit->getEditValue('ad3points_POINTS_SELECTION_OXTRANSSTATUS_INCL')}]</textarea>
                    <div class="spacer"></div>
                </dd>
            </dl>

            [{* Wert darf nicht im Feld OXTRANSSTATUS enthalten sein*}]
            <dl>
                <dt>
                [{oxmultilang ident="D3_CFG_MOD_d3points_SELECTION_OXTRANSSTATUS_EXCL"}]
                [{oxinputhelp ident="D3_CFG_MOD_d3points_SELECTION_OXTRANSSTATUS_EXCL_HELP"}]
                </dt>
                <dd>
                    <textarea cols="50" rows="3" class="confinput" name="valuearr[d3_cfg_mod__ad3points_POINTS_SELECTION_OXTRANSSTATUS_EXCL]">[{$edit->getEditValue('ad3points_POINTS_SELECTION_OXTRANSSTATUS_EXCL')}]</textarea>
                    <div class="spacer"></div>
                </dd>
            </dl>

            [{* Wert muss-werte in oxbillemails enthalten sein*}]
            <dl>
                <dt>
                [{oxmultilang ident="D3_CFG_MOD_d3points_SELECTION_OXBILLEMAIL_INCL"}]
                [{oxinputhelp ident="D3_CFG_MOD_d3points_SELECTION_OXBILLEMAIL_INCL_HELP"}]
                </dt>
                <dd>
                    <textarea cols="50" rows="3" class="confinput" name="valuearr[d3_cfg_mod__ad3points_POINTS_SELECTION_OXBILLEMAIL_INCL]">[{$edit->getEditValue('ad3points_POINTS_SELECTION_OXBILLEMAIL_INCL')}]</textarea>
                    <div class="spacer"></div>
                </dd>
            </dl>

            [{* Wert darf nicht im Feld oxbillemails enthalten sein*}]
            <dl>
                <dt>
                [{oxmultilang ident="D3_CFG_MOD_d3points_SELECTION_OXBILLEMAIL_EXCL"}]
                [{oxinputhelp ident="D3_CFG_MOD_d3points_SELECTION_OXBILLEMAIL_EXCL_HELP"}]
                </dt>
                <dd>
                    <textarea cols="50" rows="3" class="confinput" name="valuearr[d3_cfg_mod__ad3points_POINTS_SELECTION_OXBILLEMAIL_EXCL]">[{$edit->getEditValue('ad3points_POINTS_SELECTION_OXBILLEMAIL_EXCL')}]</textarea>
                    <div class="spacer"></div>
                </dd>
            </dl>
            [{/block}]
        </div>
    </div>
    [{/block}]

    [{block name="d3points_settings_settings_voucher"}]
    [{* Generierung Gutscheine *}]
    <div class="groupExp">
        <div class="">
            <a class="rc" onclick="_groupExp(this); return false;" href="#">
                <b>
                    [{oxmultilang ident="D3_CFG_MOD_d3points_VOUCHER"}]
                </b>
            </a>
            [{oxinputhelp ident="D3_CFG_MOD_d3points_VOUCHER_HELP"}]
            [{block name="d3points_settings_settings_voucher_options_list"}]
            <dl>
                <dt>
                [{oxmultilang ident="D3_CFG_MOD_d3points_VOUCHER_RATE_4_VOUCHER"}]
                </dt>
                <dd>
                    <input type="text" name="value[d3_cfg_mod__d3points_VOUCHER_RATE_4_VOUCHER]" value="[{$edit->getValue('d3points_VOUCHER_RATE_4_VOUCHER')|default:"0,01"}]" size="4" maxlength="10">
                    [{oxmultilang ident="D3_CFG_MOD_d3points_LABEL_EUR_POINTS"}]&nbsp;
                    [{oxinputhelp ident="D3_CFG_MOD_d3points_VOUCHER_RATE_4_VOUCHER_HELP"}]
                    <div class="spacer"></div>
                </dd>
            </dl>

            <dl>
                <dt>
                [{oxmultilang ident="D3_CFG_MOD_d3points_POINTS_VOUCHER_OUT_PAYMENT"}]
                </dt>
                <dd>
                    <input type="text" name="value[d3_cfg_mod__d3points_VOUCHER_OUT_PAYMENT]" value="[{$edit->getValue('d3points_VOUCHER_OUT_PAYMENT')|default:"100"}]" size="4" maxlength="10">
                    [{oxmultilang ident="D3_CFG_MOD_d3points_LABEL_POINTS"}]&nbsp;
                    [{oxinputhelp ident="D3_CFG_MOD_d3points_POINTS_VOUCHER_OUT_PAYMENT_HELP"}]
                    <div class="spacer"></div>
                </dd>
            </dl>

            <dl>
                <dt>
                [{oxmultilang ident="D3_CFG_MOD_d3points_POINTS_VOUCHER_AUTOMATIC_PAYOUT"}]
                </dt>
                <dd>
                    <input type="text" name="value[d3_cfg_mod__d3points_VOUCHER_AUTOMATIC_PAYOUT]" value="[{$edit->getValue('d3points_VOUCHER_AUTOMATIC_PAYOUT')|default:"1000"}]" size="4" maxlength="10">
                    [{oxmultilang ident="D3_CFG_MOD_d3points_LABEL_POINTS"}]&nbsp;
                    [{oxinputhelp ident="D3_CFG_MOD_d3points_POINTS_VOUCHER_AUTOMATIC_PAYOUT_HELP"}]
                    <div class="spacer"></div>
                </dd>
            </dl>

            <dl>
                <dt>
                [{oxmultilang ident="D3_CFG_MOD_d3points_POINTS_VOUCHER_NUMBER_OF_CHARAKTER"}]
                </dt>
                <dd>
                    <input type="text" name="value[d3_cfg_mod__d3points_VOUCHER_NUMBER_OF_CHARAKTER]" value="[{$edit->getValue('d3points_VOUCHER_NUMBER_OF_CHARAKTER')|default:"8"}]" size="4" maxlength="10">
                    [{oxmultilang ident="D3_CFG_MOD_d3points_LABEL_LETTER"}]&nbsp;
                    [{oxinputhelp ident="D3_CFG_MOD_d3points_POINTS_VOUCHER_NUMBER_OF_CHARAKTER_HELP"}]
                    <div class="spacer"></div>
                </dd>
            </dl>
            [{/block}]
        </div>
    </div>
    [{/block}]

    [{block name="d3points_settings_settings_emails"}]
    [{* Emailversandt *}]
    <div class="groupExp [{*if $edit->getValue('meinPaket_HOST == ''}]highlighted[{/if*}]">
        <div class="">
            <a class="rc" onclick="_groupExp(this); return false;" href="#">
                <b>
                    [{oxmultilang ident="D3_CFG_MOD_d3points_EMAILS"}]
                </b>
            </a>
            [{oxinputhelp ident="D3_CFG_MOD_d3points_EMAILS_HELP"}]
            [{block name="d3points_settings_settings_emails_options_list"}]
            <dl>
                <dt>
                [{oxmultilang ident="D3_CFG_MOD_d3points_EMAILS_TEST"}]
                </dt>
                <dd>
                    <input type="text" name="value[d3_cfg_mod__d3points_EMAILS_TEST]" value="[{$edit->getValue('d3points_EMAILS_TEST')}]" size="30" maxlength="50">
                    [{oxinputhelp ident="D3_CFG_MOD_d3points_EMAILS_TEST_HELP"}]
                    <div class="spacer"></div>
                </dd>
            </dl>

            <dl>
                <dt>
                [{oxmultilang ident="D3_CFG_MOD_d3points_EMAILS_BCC"}]
                </dt>
                <dd>
                    <input type="text" name="value[d3_cfg_mod__d3points_EMAILS_BCC]" value="[{$edit->getValue('d3points_EMAILS_BCC')}]" size="30" maxlength="50">
                    [{oxinputhelp ident="D3_CFG_MOD_d3points_EMAILS_BCC_HELP"}]
                    <div class="spacer"></div>
                </dd>
            </dl>

            <dl>
                <dt>
                [{oxmultilang ident="D3_CFG_MOD_d3points_SEND_FIRST_EMAIL"}]
                </dt>
                <dd>
                    <input type="text" name="value[d3_cfg_mod__d3points_SEND_FIRST_EMAIL]" value="[{$edit->getValue('d3points_SEND_FIRST_EMAIL')|default:"0"}]" size="4" maxlength="50">
                    [{oxmultilang ident="D3_CFG_MOD_d3points_LABEL_DAYS"}]&nbsp;
                    [{oxinputhelp ident="D3_CFG_MOD_d3points_SEND_FIRST_EMAIL_HELP"}]
                    <div class="spacer"></div>
                </dd>
            </dl>
            [{*<!--
            <dl>
            <dt>
            [{oxmultilang ident="D3_CFG_MOD_d3points_REMINDER_DAYS_WAIT_4_FIRST_MAIL"}]
            </dt>
            <dd>
            <input type="text" name="value[d3_cfg_mod__d3points_REMINDER_DAYS_WAIT_4_FIRST_MAIL]" value="[{$edit->getValue('d3points_REMINDER_DAYS_WAIT_4_FIRST_MAIL')|default:"3"}]" size="4" maxlength="10">
            [{oxmultilang ident="D3_CFG_MOD_d3points_LABEL_DAYS"}]&nbsp;
            [{oxinputhelp ident="D3_CFG_MOD_d3points_REMINDER_DAYS_WAIT_4_FIRST_MAIL_HELP"}]
            <div class="spacer"></div>
            </dd>
            </dl>
            -->*}]
            <dl>
                <dt>
                [{oxmultilang ident="D3_CFG_MOD_d3points_REMINDER_DAYS_WAIT_4_NEXT_MAILS"}]
                </dt>
                <dd>
                    <input type="text" name="value[d3_cfg_mod__d3points_REMINDER_DAYS_WAIT_4_NEXT_MAILS]" value="[{$edit->getValue('d3points_REMINDER_DAYS_WAIT_4_NEXT_MAILS')|default:"60"}]" size="4" maxlength="10">
                    [{oxmultilang ident="D3_CFG_MOD_d3points_LABEL_DAYS"}]&nbsp;
                    [{oxinputhelp ident="D3_CFG_MOD_d3points_REMINDER_DAYS_WAIT_4_NEXT_MAILS_HELP"}]
                    <div class="spacer"></div>
                </dd>
            </dl>

            <dl>
                <dt>
                [{oxmultilang ident="D3_CFG_MOD_d3points_REMINDER_AMOUNT_POINTS"}]
                </dt>
                <dd>
                    <input type="text" name="value[d3_cfg_mod__d3points_REMINDER_AMOUNT_POINTS]" value="[{$edit->getValue('d3points_REMINDER_AMOUNT_POINTS')|default:"250"}]" size="4" maxlength="10">
                    [{oxmultilang ident="D3_CFG_MOD_d3points_LABEL_POINTS"}]&nbsp;
                    [{oxinputhelp ident="D3_CFG_MOD_d3points_REMINDER_AMOUNT_POINTS_HELP"}]
                    <div class="spacer"></div>
                </dd>
            </dl>
            [{/block}]
        </div>
    </div>
    [{/block}]

        [{* Testmodus *}]
        [{*
        <div class="groupExp">
            <div class="">
                <a class="rc" onclick="_groupExp(this); return false;" href="#">
                    <b>
                        [{oxmultilang ident="D3_CFG_MOD_d3points_TESTMODUS_SETTING"}]
                    </b>
                </a>
                [{ oxinputhelp ident="D3_CFG_MOD_d3points_TESTMODUS_SETTING" }]
                <dl>
                    <dt>
                    [{oxmultilang ident="D3_CFG_MOD_d3points_TESTMODUS_FOR_REVIEWS"}]
                    </dt>
                    <dd>
                        <input type="hidden" name="value[d3_cfg_mod__d3points_TESTMODUS_FOR_REVIEWS]" value="0">
                        <input class="edittext ext_edittext" type="checkbox" name="value[d3_cfg_mod__d3points_TESTMODUS_FOR_REVIEWS]" value="1" [{if $value->d3_cfg_mod__d3points_TESTMODUS_FOR_REVIEWS == 1}]checked[{/if}]>
                        [{ oxinputhelp ident="D3_CFG_MOD_d3points_TESTMODUS_FOR_REVIEWS_HELP" }]
                        <div class="spacer"></div>
                    </dd>
                </dl>

                <dl>
                    <dt>
                    [{oxmultilang ident="D3_CFG_MOD_d3points_TESTMODUS_DISPLAY_ACCOUNT"}]
                    </dt>
                    <dd>
                        <input type="hidden" name="value[d3_cfg_mod__d3points_TESTMODUS_DISPLAY_ACCOUNT]" value="0">
                        <input class="edittext ext_edittext" type="checkbox" name="value[d3_cfg_mod__d3points_TESTMODUS_DISPLAY_ACCOUNT]" value="1" [{if $value->d3_cfg_mod__d3points_TESTMODUS_DISPLAY_ACCOUNT == 1}]checked[{/if}]>
                        [{ oxinputhelp ident="D3_CFG_MOD_d3points_TESTMODUS_DISPLAY_ACCOUNT_HELP" }]
                        <div class="spacer"></div>
                    </dd>
                </dl>

                <dl>
                    <dt>
                    [{oxmultilang ident="D3_CFG_MOD_d3points_TESTMODUS_CREATE_VOUCHERS"}]
                    </dt>
                    <dd>
                        <input type="hidden" name="value[d3_cfg_mod__d3points_TESTMODUS_CREATE_VOUCHERS]" value="0">
                        <input class="edittext ext_edittext" type="checkbox" name="value[d3_cfg_mod__d3points_TESTMODUS_CREATE_VOUCHERS]" value="1" [{if $value->d3_cfg_mod__d3points_TESTMODUS_CREATE_VOUCHERS == 1}]checked[{/if}]>
                        [{ oxinputhelp ident="D3_CFG_MOD_d3points_TESTMODUS_CREATE_VOUCHERS_HELP" }]
                        <div class="spacer"></div>
                    </dd>
                </dl>

                <dl>
                    <dt>
                    [{oxmultilang ident="D3_CFG_MOD_d3points_TESTMODUS_FOR_GROUPS"}]
                    [{ oxinputhelp ident="D3_CFG_MOD_d3points_TESTMODUS_FOR_GROUPS_HELP" }]
                    </dt>
                    <dd>
                        <div style="width:64%;float:right;">
                            <input class="edittext ext_edittext" type="hidden" name="SELECTIONGROUPS[TESTMODUS_FOR_GROUPS]" value="0">
                            [{strip}]
                                <table>
                                    <tr>
                                        [{foreach from=$oView->d3_PrepareGroups4TestModus() item=Groups name="groups4testmodus"}]
                                            <td>
                                                <input class="edittext ext_edittext" type="checkbox" name="SELECTIONGROUPS[TESTMODUS_FOR_GROUPS][]"
                                                       value="[{$Groups->oxgroups__oxid->value}]" [{if $Groups->select == 1}]checked[{/if}]>
                                            [{$Groups->oxgroups__oxtitle->value}] [{if !$Groups->oxgroups__oxactive->value}]<span class="filename_filepath_or_italic">([{oxmultilang ident="D3_CFG_MOD_d3points_INACTIVE"}])</span>[{/if}]
                                        </td>
                                        [{if $smarty.foreach.groups4testmodus.last && $smarty.foreach.groups4testmodus.iteration % 2 != 0}]
                                            <td></td>
                                        [{/if}]
                                        [{if $smarty.foreach.groups4testmodus.iteration % 2 == 0}]
                                        </tr>
                                        [{if !$smarty.foreach.groups4testmodus.last}]
                                            <tr>
                                            [{/if}]
                                        [{/if}]
                                    [{/foreach}]
                            </table>
                        [{/strip}]
                    </div>
                    <div class="spacer"></div>
                </dd>
            </dl>
        </div>
        </div>
        *}]
        [{/block}]
        [{block name="d3points_settings_save_button"}]
            <table style="width:100%">
                <tr>
                    <td class="edittext ext_edittext" align="left">
                        <br>
                        <div class="d3modcfg_btn">
                            <input type="submit" class="edittext ext_edittext" name="save" value="[{oxmultilang ident="D3_CFG_MOD_d3points_MAIN_SAVE"}]">
                        </div>
                        <br><br>
                    </td>
                </tr>
            </table>
        [{/block}]
    [{/if}]
</form>

[{include file="d3_cfg_mod_inc.tpl"}]

