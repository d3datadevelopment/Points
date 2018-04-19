[{include file="headitem.tpl" title="D3_CFG_MOD"|oxmultilangassign}]

<script type="text/javascript">
    <!--
    [{ if $updatelist == 1}]
        UpdateList('[{ $oxid }]');
    [{ /if}]

        function _groupExp(el) {
            var _cur = el.parentNode;

            if (_cur.className == "exp") _cur.className = "";
            else _cur.className = "exp";
        }

        -->
</script>

<style type="text/css">
    <!--
    .questbox{
        background-color: #07f;
        color: white;
        float: right;
        position: relative;
        display: block;
        padding: 1px 4px;
        font-weight: bold;
        z-index: 98;
        cursor: help;
        font-family: Verdana,Arial,Helvetica,sans-serif;
        font-size: 10px;
        line-height: 12px;
    }

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
        background-color: #F0F0F0;
        width: 98%;
        float:left;
    }

    legend{
        font-weight: bold;
    }

    .groupExp dl dt{
        font-weight: normal;
        width: 35%;
        padding-left: 10px;
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

    .ext_edittext {
        padding: 2px;
    }

    td.edittext {
        white-space: normal;
    }

    .confinput {
        width: 300px;
        height: 80px;
    }

    -->
</style>

[{if $readonly}]
    [{assign var="readonly" value="readonly disabled"}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]

<form name="transfer" id="transfer" action="[{ $oViewConf->getSelfLink() }]" method="post">
    [{ $oViewConf->getHiddenSid() }]
    <input type="hidden" name="oxid" value="[{ $oxid }]">
    <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
    <input type="hidden" name="editlanguage" value="[{ $editlanguage }]">
</form>

[{block name="d3points_maintenance"}]
[{block name="d3points_maintenance_reset_orders"}]
<fieldset>
    <legend>[{oxmultilang ident="D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDERS"}]&nbsp;[{oxinputhelp ident="D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDERS_HELP"}]</legend>
    <form name="myedit" id="myedit" action="[{ $oViewConf->getSelfLink() }]" method="post">
        [{ $oViewConf->getHiddenSid() }]
        <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
        <input type="hidden" name="fnc" value="d3SetOxorderd3IssetPoints">
        <input type="hidden" name="oxid" value="[{ $oxid }]">
        <input type="hidden" name="editval[d3_cfg_mod__oxid]" value="[{ $oxid }]">

        [{block name="d3points_maintenance_reset_orders_table"}]
        <table width="100%">
            [{block name="d3points_maintenance_reset_orders_table_items"}]
            <tr>
                <td style="vertical-align:top;">[{oxmultilang ident="D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDERS_TXT"}]</td>
                <td>

                    [{*<input type="checkbox" name="d3PointsOrderStatus" value="1">[{ oxinputhelp ident="D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDERS_TXT_HELP" }]*}]

                    <input type="hidden" name="d3PointsOrderStatus" value="-">
                    <input type="radio" name="d3PointsOrderStatus" value="0">[{oxmultilang ident="D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDERS_CONFIRM_UNSET"}][{ oxinputhelp ident="D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDERS_CONFIRM_UNSET_HELP" }]<br>
                    <input type="radio" name="d3PointsOrderStatus" value="1">[{oxmultilang ident="D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDERS_CONFIRM_SET"}][{ oxinputhelp ident="D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDERS_CONFIRM_SET_HELP" }]
                </td>
            </tr>
            <tr>
                <td>[{oxmultilang ident="D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDERS_CONFIRM"}]</td>
                <td><input type="checkbox" name="d3PointsOrderConfirm" value="1">[{ oxinputhelp ident="D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDERS_CONFIRM_HELP" }]</td>
            </tr>
            [{/block}]
            [{block name="d3points_maintenance_reset_orders_table_subdmit"}]
            <tr>
                <td>&nbsp;</td>
                <td>
                    <span class="d3modcfg_btn">
                        <input type="submit" class="edittext ext_edittext" name="save" value="[{oxmultilang ident="D3_CFG_MOD_d3points_MAINTAINCE_SAVE"}]">
                    </span>
                </td>
            </tr>
            [{/block}]
        </table>
        [{/block}]
    </form>
</fieldset>
[{/block}]

[{block name="d3points_maintenance_delete_order"}]
<fieldset>
    <legend>[{oxmultilang ident="D3_CFG_MOD_d3points_MAINTAINCE_DELETE_ORDER"}]&nbsp;[{oxinputhelp ident="D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDER_TXT_HELP"}]</legend>
    <form name="myedit" id="myedit" action="[{ $oViewConf->getSelfLink() }]" method="post">
        <div>
            [{ $oViewConf->getHiddenSid() }]
            <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
            <input type="hidden" name="fnc" value="d3DeleteOrderPoints">
            <input type="hidden" name="oxid" value="[{ $oxid }]">
            <input type="hidden" name="editval[d3_cfg_mod__oxid]" value="[{ $oxid }]">
        </div>
        [{block name="d3points_maintenance_delete_order_table"}]
        <table width="100%">
            [{block name="d3points_maintenance_delete_order_table_items"}]
            <tr>
                <td>[{oxmultilang ident="D3_CFG_MOD_d3points_MAINTAINCE_DELETE_ORDER_ORDERNR"}][{* oxinputhelp ident="D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDERS_TXT_HELP" *}]</td>
                <td><input type="text" name="d3PointsOrderNr" width="10"></td>
            </tr>
            <tr>
                <td style="vertical-align:top;">[{oxmultilang ident="D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDERS_TYP"}]</td>
                <td>
                    <input type="radio" name="d3PointsOrderType" value="delete">[{oxmultilang ident="D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDERS_TYP_DELETE"}][{ oxinputhelp ident="D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDERS_TYP_DELETE_HELP" }]<br>
                    <input type="radio" name="d3PointsOrderType" value="storno">[{oxmultilang ident="D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDERS_TYP_STORNO"}][{ oxinputhelp ident="D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDERS_TYP_STORNO_HELP" }]
                </td>
            </tr>

            <tr>
                <td style="vertical-align:top;">[{oxmultilang ident="D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDERS_SEND_MAIL"}]</td>
                <td><input type="checkbox" name="d3SendMail" value="1">[{ oxinputhelp ident="D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDERS_SEND_MAIL_HELP" }]</td>
            </tr>

            <tr>
                <td style="vertical-align:top;">[{oxmultilang ident="D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDERS_COMMET"}]</td>
                <td><textarea name="d3PointsOrderComment"  cols="45" rows="3"></textarea>[{ oxinputhelp ident="D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDERS_COMMET_HELP" }]</td>
            </tr>

            <tr>
                <td>[{oxmultilang ident="D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDERS_CONFIRM"}]</td>
                <td><input type="checkbox" name="d3PointsOrderConfirm" value="1">[{ oxinputhelp ident="D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDER_CONFIRM_HELP" }]</td>
            </tr>
            [{/block}]

            [{block name="d3points_maintenance_delete_order_table_submit"}]
            <tr>
                <td>&nbsp;</td>
                <td>
                    <span class="d3modcfg_btn">
                        <input type="submit" class="edittext ext_edittext" name="save" value="[{oxmultilang ident="D3_CFG_MOD_d3points_MAINTAINCE_SAVE"}]">
                    </span>
                </td>
            </tr>
            [{/block}]
        </table>
        [{/block}]
    </form>
</fieldset>
[{/block}]
[{/block}]

[{oxscript add='function _groupExp(el) {
    var _cur = el.parentNode;

    if (_cur.className == "exp") _cur.className = "";
    else _cur.className = "exp";
}'}]


[{include file="d3_cfg_mod_bottom.tpl"}]