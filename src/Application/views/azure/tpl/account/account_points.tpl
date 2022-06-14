<h1 class="pageHead">[{oxmultilang ident="D3_INC_ACCOUNT_HEADER_POINTS"}]</h1>

<h3 class="d3points">[{oxmultilang ident="D3_INC_ACCOUNT_HEADER_POINTS_ACCOUNT"}]</h3>
[{block name="d3accountpoints_main_form_points"}]
    <form action="[{$oViewConf->getSelfActionLink()}]" name="d3points" method="post">
        <div class="account d3points">
            [{$oViewConf->getHiddenSid()}]
            [{$oViewConf->getNavFormParams()}]
            <input type="hidden" name="fnc" value="d3CreateVoucherFromPoints">
            <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
            [{assign var=oNewVoucher value=$oView->getCreatedVoucher()}]
            [{if $oNewVoucher}]
                <div>[{oxmultilang ident="D3_ACCOUNT_POINTS_NEWVOUCHERTEXT1"}] <b>
                        [{$oNewVoucher->oxvouchers__oxvouchernr->value}]</b>
                    [{oxmultilang ident="D3_ACCOUNT_POINTS_NEWVOUCHERTEXT2"}] <b>[{$oNewVoucher->fVoucherdiscount}]
                        [{$currency->sign}]</b> [{oxmultilang ident="D3_ACCOUNT_POINTS_NEWVOUCHERTEXT3"}]
                    <br>
                    [{if !$oView->d3GetSelectedOption(3)}]
                        [{oxmultilang ident="D3_ACCOUNT_POINTS_NEWVOUCHERTEXT4"}]
                    [{/if}]
                </div>
                <br>
                <div class="dot_sep"></div>
            [{/if}]

            <table class="pointslist">
                <colgroup>
                    <col class="column first">
                    <col class="column second">
                    <col class="column third">
                    <col class="column fourth">
                </colgroup>
                <tr class="head">
                    <td class="column first"><label>&nbsp;</label></td>
                    <td class="column second">
                        <label>&nbsp;&nbsp;[{oxmultilang ident="D3_ACCOUNT_POINTS_DATE"}]</label>
                    </td>
                    <td class="column third">
                        <label>&nbsp;&nbsp;[{oxmultilang ident="D3_ACCOUNT_POINTS_AMOUNT"}]</label>
                    </td>
                    <td class="column fourth">
                        <label>&nbsp;&nbsp;[{oxmultilang ident="D3_ACCOUNT_POINTS_COMMENT"}]</label>
                    </td>
                </tr>
                [{assign var=oPointList value=$oView->d3GetAllPoints()}]

                [{assign var="cntRow" value=0}]

                [{assign var=oPointList value=$oView->d3GetAllPoints('azure')}]
                [{foreach from=$oPointList item="oPoint"}]

                    [{if $cntRow ==0}]
                        [{assign var="cntRow" value=1}]
                        [{*assign var="RowStyle" value="#F0F0F0"*}]
                        [{assign var="RowStyle" value=" first_row"}]
                    [{else}]
                        [{assign var="cntRow" value=0}]
                        [{*assign var="RowStyle" value="#fff"*}]
                        [{assign var="RowStyle" value=" second_row"}]
                    [{/if}]

                    [{include file=$oPoint->d3points__d3template->value oPoint=$oPoint RowStyle=$RowStyle}]

                    [{if $cntRow ==1}]
                        [{assign var="cntRow" value=1}]
                    [{else}]
                        [{assign var="cntRow" value=0}]
                    [{/if}]

                    [{foreachelse}]
                    [{oxmultilang ident="D3_ACCOUNT_POINTS_NO_POINTS"}]
                [{/foreach}]

                [{assign var="dTotalSum" value=$oView->d3GetPointsTotalSum()}]
                <tr>
                    <td class="column first"><label><b>[{oxmultilang ident="D3_ACCOUNT_POINTS_TOTALSUM"}]</b></label></td>
                    <td class="column second"><label>&nbsp;</label></td>
                    <td class="column third"><label>&nbsp;&nbsp;<b>
                                [{if $dTotalSum > 0}]+[{/if}][{$dTotalSum}]</b></label></td>
                    <td class="column fourth"><label>&nbsp;&nbsp;&nbsp;</label></td>
                </tr>
            </table>

            <div class="dot_sep"></div>
            <br>
            [{if $oView->d3getAllowCreateVoucher()}]
                <div class="right"><br>
                    [{oxmultilang ident="D3_ACCOUNT_POINTS_CHANGETEXT1"}] [{$oView->d3getVoucherAmount()}]
                    [{$currency->sign}] [{oxmultilang ident="D3_ACCOUNT_POINTS_CHANGETEXT2"}]
                    <ul>
                        <li class="formSubmit">
                            <button id="d3GenerateVoucher"
                                    type="submit"
                                    value="[{oxmultilang ident=" D3_ACCOUNT_POINTS_CREATE"}]"
                                    class="submitButton">[{oxmultilang ident="D3_ACCOUNT_POINTS_CREATE"}]
                            </button>
                        </li>
                    </ul>
                </div>
            [{else}]
                <div class="right">
                    [{oxmultilang ident="D3_ACCOUNT_POINTS_POSSIBLETEXT1"}] <b>[{$oView->d3getVoucherAvailable()}]
                        [{oxmultilang ident="D3_ACCOUNT_POINTS_POSSIBLEPOINTS"}]</b> [{oxmultilang ident="D3_ACCOUNT_POINTS_POSSIBLETEXT2"}]
                </div>
            [{/if}]
            <br>
            <br>
        </div>
    </form>
[{/block}]

[{include file='d3points_mail_option_azure.tpl'}]
