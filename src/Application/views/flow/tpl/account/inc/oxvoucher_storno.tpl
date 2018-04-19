[{* Gutschein storniert *}]
[{block name="d3accountpoints_list_with_points_oxvoucher_storno"}]

[{assign var="oVoucher" value=$oPoint->d3GetVoucher()}]
<li>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-4">
                    <strong>[{oxmultilang ident="D3_ACCOUNT_POINTS_VOUCHER" suffix="COLON"}]</strong>
                    <span>[{oxmultilang ident="D3_ACCOUNT_POINTS_VOUCHERNR"}] [{$oVoucher->oxvouchers__oxvouchernr->value}]</span>
                </div>
                <div class="col-xs-4">
                    <strong>[{oxmultilang ident="D3_ACCOUNT_POINTS_AMOUNT" suffix="COLON"}]</strong>
                    <span>[{if $oPoint->d3points__d3points->value > 0}]+[{/if}][{$oPoint->d3points__d3points->value}]</span>
                    <div>
                        <strong>[{oxmultilang ident="D3_ACCOUNT_POINTS_POINTS_STORNO2"}]</strong>
                        [{*$oVoucher->oxvouchers__oxreserved->rawValue|date_format:"%d.%m.%Y"}][{/if*}]
                    </div>
                </div>
                <div class="col-xs-4">
                    <strong>[{oxmultilang ident="D3_ACCOUNT_POINTS_DATE" suffix="COLON"}]</strong>
                    <span class="note">[{$oPoint->d3points__oxtime->rawValue|date_format:"%d.%m.%Y"}]</span>
                </div>
            </div>
        </div>
        [{if $oPoint->d3points__oxtext->value}]
            <div class="panel-body">
                <strong>[{oxmultilang ident="D3_ACCOUNT_POINTS_COMMENT" suffix="COLON"}]</strong>
                <span>[{oxmultilang ident="D3_ACCOUNT_POINTS_VOUCHERTYPE"}] [{ $oVoucher->oxvouchers__oxvouchernr->value}]</span>
            </div>
        [{/if}]
    </div>
</li>
[{/block}]