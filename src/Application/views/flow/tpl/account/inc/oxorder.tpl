[{* Bestellung *}]
[{block name="d3accountpoints_list_with_points_oxorder"}]

[{assign var="oOrder" value=$oPoint->d3GetOrder()}]
<li>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-4">
                    <strong>[{*oxmultilang ident="D3_ACCOUNT_POINTS_TYPE_POINT"  suffix="COLON"*}] [{oxmultilang ident="D3_ACCOUNT_POINTS_ORDERTYPE"}]</strong>
                    <span> [{$oOrder->oxorder__oxordernr->value}]
                        [{if $oPoint->d3points__d3points->value < 0}][{oxmultilang ident="D3_ACCOUNT_POINTS_POINTS_STORNO"}][{/if}]</span>
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
        [{if $oPoint->d3points__oxtext->value}]
            <div class="panel-body">
                <strong>[{oxmultilang ident="D3_ACCOUNT_POINTS_COMMENT" suffix="COLON"}]</strong>
                <span>[{$oPoint->d3points__oxtext->value}]</span>
            </div>
        [{/if}]
    </div>
</li>
[{/block}]