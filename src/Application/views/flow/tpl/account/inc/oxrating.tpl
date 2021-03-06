[{* Stern-Bewertung *}]
[{block name="d3accountpoints_list_with_points_oxrating"}]

[{assign var="oArticle" value=$oPoint->d3GetRatingArticle()}]
<li>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-4">
                    <strong>[{oxmultilang ident="D3_ACCOUNT_POINTS_REVIEWTYPE_STERN" suffix="COLON"}]</strong>
                    <span>[{oxmultilang ident="D3_ACCOUNT_POINTS_ARTICLE_NUMBER"}] [{$oArticle->oxarticles__oxartnum->value}]</span>
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
                <span>[{$oPoint->d3points__oxtext->rawValue}]</span>
            </div>
        [{/if}]
    </div>
</li>
[{/block}]