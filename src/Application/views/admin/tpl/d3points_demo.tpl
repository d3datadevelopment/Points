[{include file="headitem.tpl" title="D3_CFG_MOD"|oxmultilangassign}]

<style type="text/css">
    <!--
    fieldset{
        border: 1px inset black;
        background-color: #F0F0F0;
        width: 47%;
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
    table.bordered{
        border: 1px solid #aaa;
    }
    table.bordered th, table.bordered td {
        border: 1px solid gray;
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
    <input type="hidden" name="actshop" value="[{ $oViewConf->getActiveShopId()}]">
    <input type="hidden" name="editlanguage" value="[{ $editlanguage }]">
</form>

[{*assign var="sRate4Points" value=$oView->d3GetRate4Points()}]
[{assign var="aRate4Points" value=$oView->d3GetRateArray4Points()}]
[{assign var="sRate4Voucher" value=$oView->d3GetRate4Voucher()*}]

[{block name="d3points_demo"}]
    [{block name="d3points_demo_calculate_points"}]
    <fieldset>
        <legend>[{oxmultilang ident="D3_CFG_MOD_d3points_DEMO_CALCULATE_POINTS"}]</legend>
        <form name="myedit" id="myedit" action="[{ $oViewConf->getSelfLink() }]" method="post">
            [{ $oViewConf->getHiddenSid() }]
            <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
            <input type="hidden" name="fnc" value="calculatePoints">
            <input type="hidden" name="oxid" value="[{ $oxid }]">
            <input type="hidden" name="editval[d3_cfg_mod__oxid]" value="[{ $oxid }]">

            [{block name="d3points_demo_calculate_points_table"}]
            <table width="100%">
                [{block name="d3points_demo_calculate_points_table_items"}]
                <tr>
                    <td><label for="DEMOSYSTEM[PRICE2POINTS]">[{oxmultilang ident="D3_CFG_MOD_d3points_DEMO_CALCULATE_POINTS_PRICE_AMOUNT"}]</label></td>
                    <td><input type="text" name="DEMOSYSTEM[PRICE2POINTS]" id="DEMOSYSTEM[PRICE2POINTS]" value="[{$PRICE2POINTS|default:"0"}]" size="6" maxlength="10"> [{ $oActCur->sign }]</td>
                </tr>

                [{if $sRate4Points !=''}]
                    <tr>
                        <td>[{oxmultilang ident="D3_CFG_MOD_d3points_DEMO_CALCULATE_POINTS_RATE"}]</td>
                        <td>[{$sRate4Points}]</td>
                    </tr>
                    <tr>
                        <td>[{oxmultilang ident="D3_CFG_MOD_d3points_DEMO_CALCULATE_METHODE"}]</td>
                        <td>[{$PRICE2POINTS|default:"0"}] / [{$sRate4Points}]  =</td>
                    </tr>
                [{/if}]
                [{if $aRate4Points}]
                    <tr>
                        <td style="vertical-align:top;">[{oxmultilang ident="D3_CFG_MOD_d3points_DEMO_CALCULATE_POINTS_SCALAR"}]</td>
                        <td>
                            <table width="100%" class="bordered">
                                <thead>
                                <tr>
                                    <th>[{oxmultilang ident="D3_CFG_MOD_d3points_DEMO_CALCULATE_POINTS_SCALAR_POINTS"}]</th>
                                    <th>[{oxmultilang ident="D3_CFG_MOD_d3points_DEMO_CALCULATE_POINTS_SCALAR_MIN"}]</th>
                                    <th>[{oxmultilang ident="D3_CFG_MOD_d3points_DEMO_CALCULATE_POINTS_SCALAR_MAX"}]</th>
                                </tr>
                                </thead>
                                [{foreach from=$aRate4Points item=scalar}]
                                    <tr>
                                        <td align="right">[{$scalar.points}]</td>
                                        <td align="right">[{$scalar.min}]</td>
                                        <td align="right">[{$scalar.max}]</td>

                                    </tr>
                                [{/foreach}]
                            </table>
                        </td>
                    </tr>
                [{/if}]
                <tr>
                    <td>[{oxmultilang ident="D3_CFG_MOD_d3points_DEMO_CALCULATE_POINTS_SUM"}]</td>
                    <td><span>[{$CALCULATEDPOINTS|default:"0"}]</span> [{oxmultilang ident="D3_CFG_MOD_d3points_LABEL_POINTS"}]</td>
                </tr>
                [{/block}]
                [{block name="d3points_demo_calculate_points_table_submit"}]
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <span class="d3modcfg_btn icon d3color-green">
                                <button type="submit" name="save">
                                    <i class="fa fa-check-circle fa-inverse"></i>[{oxmultilang ident="D3_CFG_MOD_d3points_DEMO_CALCULATE_SUBMIT"}]
                                </button>
                            </span>
                        </td>
                    </tr>
                [{/block}]
            </table>
            [{/block}]
        </form>
    </fieldset>
    [{/block}]

    [{block name="d3points_demo_calculate_voucher"}]
    <fieldset>
        <legend>[{oxmultilang ident="D3_CFG_MOD_d3points_DEMO_CALCULATE_VOUCHER"}]</legend>
        <form name="myedit" id="myedit" action="[{ $oViewConf->getSelfLink() }]" method="post">
            <div>
                [{ $oViewConf->getHiddenSid() }]
                <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
                <input type="hidden" name="fnc" value="calculateVoucher">
                <input type="hidden" name="oxid" value="[{ $oxid }]">
                <input type="hidden" name="editval[d3_cfg_mod__oxid]" value="[{ $oxid }]">
            </div>
            [{block name="d3points_demo_calculate_voucher_table"}]
            <table width="100%">
                [{block name="d3points_demo_calculate_voucher_table_items"}]
                <tr>
                    <td>
                        <label for="DEMOSYSTEM[POINTS2VOUCHER]">[{oxmultilang ident="D3_CFG_MOD_d3points_DEMO_CALCULATE_VOUCHER_POINTS_SUM"}]</label>
                    </td>
                    <td>
                        <input type="text" name="DEMOSYSTEM[POINTS2VOUCHER]" ID="DEMOSYSTEM[POINTS2VOUCHER]" value="[{$POINTS2VOUCHER|default:"0"}]" size="6" maxlength="10">
                        [{oxmultilang ident="D3_CFG_MOD_d3points_LABEL_POINTS"}]
                    </td>
                </tr>
                <tr>
                    <td>[{oxmultilang ident="D3_CFG_MOD_d3points_DEMO_CALCULATE_POINTS_RATE"}]</td>
                    <td>[{$sRate4Voucher}]</td>
                </tr>
                <tr>
                    <td>[{oxmultilang ident="D3_CFG_MOD_d3points_DEMO_CALCULATE_METHODE"}]</td>
                    <td>[{$POINTS2VOUCHER|default:"0"}] * [{$sRate4Voucher}]  =</td>
                </tr>
                <tr>
                    <td>[{oxmultilang ident="D3_CFG_MOD_d3points_DEMO_CALCULATE_VOUCHER_AMOUNT"}]</td>
                    <td><span>[{$CALCULATEDVOUCHER|default:"0"}]</span> [{ $oActCur->sign }]</td>
                </tr>
                [{/block}]

                [{block name="d3points_demo_calculate_voucher_table_submit"}]
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <span class="d3modcfg_btn icon d3color-green">
                                <button type="submit" name="save">
                                    <i class="fa fa-check-circle fa-inverse"></i>[{oxmultilang ident="D3_CFG_MOD_d3points_DEMO_CALCULATE_SUBMIT"}]
                                </button>
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
[{include file="d3_cfg_mod_inc.tpl"}]
