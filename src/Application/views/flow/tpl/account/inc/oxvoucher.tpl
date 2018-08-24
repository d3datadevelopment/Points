[{* Gutschein *}]
[{block name="d3accountpoints_list_with_points_oxvoucher"}]

[{assign var="oVoucher" value=$oPoint->d3GetVoucher()}]
<li>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-4">
                    <strong>[{oxmultilang ident="D3_ACCOUNT_POINTS_VOUCHER"}] [{oxmultilang ident="D3_ACCOUNT_POINTS_VOUCHERNR"}]</strong>
                    <span>[{*oxmultilang ident="D3_ACCOUNT_POINTS_VOUCHERNR"*}] [{$oVoucher->oxvouchers__oxvouchernr->value}]</span>
                </div>
                <div class="col-xs-4">

                    <strong>[{oxmultilang ident="D3_ACCOUNT_POINTS_AMOUNT" suffix="COLON"}]</strong>
                    <span>[{if $oPoint->d3points__d3points->value > 0}]+[{/if}][{$oPoint->d3points__d3points->value}]</span>

                </div>
                <div class="col-xs-4">
                    <strong>[{oxmultilang ident="D3_ACCOUNT_POINTS_DATE" suffix="COLON"}]</strong>
                    <span class="note">[{$oPoint->d3points__oxtime->rawValue|date_format:"%d.%m.%Y"}]</span>
                </div>
            </div>
        </div>
        [{*if $oPoint->d3points__oxtext->value
        || ($oVoucher->oxvouchers__oxdateused->rawValue =='0000-00-00' &&  $oVoucher->oxvouchers__oxreserved->rawValue > 0)
        || $oVoucher->oxvouchers__oxdateused->rawValue !='0000-00-00'*}]
            <div class="panel-body">
                <strong>[{oxmultilang ident="D3_ACCOUNT_POINTS_COMMENT" suffix="COLON"}]</strong>
                <span>[{$oPoint->d3points__oxtext->value}] [{* $oVoucher->oxvouchers__oxvouchernr->value *}]</span>

                [{if $oVoucher->discount}]
                    <strong>[{oxmultilang ident="D3_ACCOUNT_POINTS_VOUCHER_VALUE" suffix="COLON"}]</strong>
                    <span>[{$oVoucher->discount}] [{$currency->sign}]</span>
                [{/if}]

                [{if $oVoucher->oxvouchers__oxdateused->rawValue =='0000-00-00' &&  $oVoucher->oxvouchers__oxreserved->rawValue > 0}]
                    <span>[{oxmultilang ident="D3_ACCOUNT_POINTS_VOUCHER_RESERVED"}]</span>
                    [{$oVoucher->oxvouchers__oxreserved->rawValue|date_format:"%d.%m.%Y"}][{/if}]
                [{if $oVoucher->oxvouchers__oxdateused->rawValue !='0000-00-00'}]
                    <span>[{oxmultilang ident="D3_ACCOUNT_POINTS_VOUCHER_USED" }]</span>
                    [{$oVoucher->oxvouchers__oxdateused->rawValue|date_format:"%d.%m.%Y"}][{/if}]
            </div>
        [{*/if*}]
    </div>
</li>
[{/block}]