[{* Gutscheinwert zurück gebucht *}]
[{block name="d3accountpoints_list_with_points_oxvoucher_storno_rebook"}]

[{assign var="oVoucher" value=$oPoint->d3GetVoucher()}]
<li>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-4">
                    <strong>[{oxmultilang ident="D3_ACCOUNT_POINTS_VOUCHER_REBOOK" suffix="COLON"}]</strong>
                    <span>[{oxmultilang ident="D3_ACCOUNT_POINTS_VOUCHERNR"}] [{$oVoucher->oxvouchers__oxvouchernr->value}]</span>
                </div>
                <div class="col-4">
                    <strong>[{oxmultilang ident="D3_ACCOUNT_POINTS_AMOUNT" suffix="COLON"}]</strong>
                    <span>[{if $oPoint->d3points__d3points->value > 0}]+[{/if}][{$oPoint->d3points__d3points->value}]</span>
                </div>
                <div class="col-4">
                    <strong>[{oxmultilang ident="D3_ACCOUNT_POINTS_DATE" suffix="COLON"}]</strong>
                    <span class="note">[{$oPoint->d3points__oxtime->rawValue|date_format:"%d.%m.%Y"}]</span>
                </div>
            </div>
        </div>
        [{if $oPoint->d3points__oxtext->value}]
            <div class="card-body">
                <strong>[{oxmultilang ident="D3_ACCOUNT_POINTS_COMMENT" suffix="COLON"}]</strong>
                <span>[{$oVoucher->oxvouchers__oxvouchernr->value}]</span>
            </div>
        [{/if}]
    </div>
</li>
[{/block}]