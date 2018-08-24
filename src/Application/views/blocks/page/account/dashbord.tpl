[{$smarty.block.parent}]

[{d3modcfgcheck modid="d3points"}][{/d3modcfgcheck}]
[{if $mod_d3points}]

    [{if $oModCfg_d3points->isThemeIdMappedTo('azure')}]
        <dl>
            <dt><a id="linkPoints" href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=d3_d3points_accountpoints" }]" rel="nofollow">[{ oxmultilang ident="INC_ACCOUNT_HEADER_D3MYPOINTS" }]</a></dt>
            <dd>[{ oxmultilang ident="D3_INC_ACCOUNT_HEADER_POINTS" }] [{$oViewConf->d3getPointsTotalSum()}] </dd>
        </dl>
    [{elseif $oModCfg_d3points->isThemeIdMappedTo('flow')}]
        <div class="panel panel-default">
            <div class="panel-heading">
                <a id="linkAccountOrder" href="[{oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=d3_d3points_accountpoints"}]">[{oxmultilang ident="INC_ACCOUNT_HEADER_D3MYPOINTS"}]</a>
                <a href="[{oxgetseourl ident=$oViewConf->getSslSelfLink()|cat:"cl=d3_d3points_accountpoints"}]" class="btn btn-default btn-xs pull-right">
                    <i class="fa fa-arrow-right"></i>
                </a>
            </div>
            <div class="panel-body">[{oxmultilang ident="D3_INC_ACCOUNT_HEADER_POINTS"}] [{if $oViewConf->d3getPointsTotalSum() > 0}][{$oViewConf->d3getPointsTotalSum()}][{/if}]</div>
        </div>
    [{else}]
    [{/if}]

[{/if}]



