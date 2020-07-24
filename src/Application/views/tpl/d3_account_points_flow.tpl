<h1 class="page-header">[{oxmultilang ident="D3_INC_ACCOUNT_HEADER_POINTS"}]</h1>

[{*<h3 class="d3points">[{oxmultilang ident="D3_INC_ACCOUNT_HEADER_POINTS_ACCOUNT"}]</h3>*}]
[{block name="d3accountpoints_created_voucher_message"}]
    [{assign var=oNewVoucher value=$oView->getCreatedVoucher()}]
    [{if $oNewVoucher}]
        <div class="account d3points voucher created message">
            <div class="alert alert-danger">[{oxmultilang ident="D3_ACCOUNT_POINTS_NEWVOUCHERTEXT1"}] <b>
                    [{$oNewVoucher->oxvouchers__oxvouchernr->value}]</b>
                [{oxmultilang ident="D3_ACCOUNT_POINTS_NEWVOUCHERTEXT2"}] <b>[{$oNewVoucher->fVoucherdiscount}]
                    [{$currency->sign}]</b> [{oxmultilang ident="D3_ACCOUNT_POINTS_NEWVOUCHERTEXT3"}]
                <br>
                [{if !$oView->d3GetSelectedOption(3)}]
                    [{oxmultilang ident="D3_ACCOUNT_POINTS_NEWVOUCHERTEXT4"}]
                [{/if}]
            </div>
        </div>
    [{/if}]
[{/block}]

[{block name="d3accountpoints_created_voucher"}]
    <form action="[{$oViewConf->getSelfActionLink()}]" name="d3points" method="post">
        <div class="account d3points create voucher">
            <div class="hidden">
                [{$oViewConf->getHiddenSid()}]
                [{$oViewConf->getNavFormParams()}]
                <input type="hidden" name="fnc" value="d3CreateVoucherFromPoints">
                <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    [{oxmultilang ident="D3_ACCOUNT_POINTS_CREATE_VOUCHER"}] & [{oxmultilang ident="D3_ACCOUNT_POINTS_TOTALSUM"}]
                </div>
                <div class="panel-body">

                    [{assign var="dTotalSum" value=$oView->d3GetPointsTotalSum()}]
                    <div class="form-group">
                        <div class="col-lg-9 col-xs-12">
                            [{oxmultilang ident="D3_ACCOUNT_POINTS_TOTALSUM_TEXT" suffix="COLON"}] <b>[{if $dTotalSum > 0}]+[{/if}][{$dTotalSum}]</b> [{oxmultilang ident="D3_ACCOUNT_POINTS_AMOUNT"}].
                        </div>
                    </div>
                    <hr>

                    [{if $oView->d3getAllowCreateVoucher()}]
                        <div class="form-group">
                            <div class="col-lg-9 col-xs-12">
                                [{oxmultilang ident="D3_ACCOUNT_POINTS_CHANGETEXT1"}] [{$oView->d3getVoucherAmount()}]
                                [{$currency->sign}] [{oxmultilang ident="D3_ACCOUNT_POINTS_CHANGETEXT2"}]
                            </div>
                            <div class="col-lg-3 col-xs-12">
                                <button id="d3GenerateVoucher" type="submit" name="save" class="btn btn-primary">[{oxmultilang ident="D3_ACCOUNT_POINTS_CREATE"}]</button>
                            </div>
                        </div>
                    [{else}]
                        <div class="form-group">
                            <div class="col-lg-9 col-xs-12">
                                [{oxmultilang ident="D3_ACCOUNT_POINTS_POSSIBLETEXT1"}] <b>[{$oView->d3getVoucherAvailable()}]
                                    [{oxmultilang ident="D3_ACCOUNT_POINTS_POSSIBLEPOINTS"}]</b> [{oxmultilang ident="D3_ACCOUNT_POINTS_POSSIBLETEXT2"}]
                            </div>
                        </div>
                    [{/if}]
                </div>
            </div>
        </div>
    </form>
[{/block}]

[{block name="d3accountpoints_list_with_points"}]
    <div class="panel panel-default">
        <div class="panel-heading">
            [{oxmultilang ident="D3_ACCOUNT_POINTS_HEADER"}]
        </div>
        <div class="panel-body">
            <ol class="list-unstyled">
                [{assign var=oPointList value=$oView->d3GetAllPoints('flow')}]
                [{foreach from=$oPointList item="oPoint"}]
                    [{include file=$oPoint->d3points__d3template->value oPoint=$oPoint RowStyle=$RowStyle}]
                    [{foreachelse}]
                    [{oxmultilang ident="D3_ACCOUNT_POINTS_NO_POINTS"}]
                [{/foreach}]
            </ol>
        </div>
    </div>
[{/block}]
[{include file='d3points_mail_option_flow.tpl'}]