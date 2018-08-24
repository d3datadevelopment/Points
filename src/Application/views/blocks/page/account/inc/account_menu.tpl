[{$smarty.block.parent}]

[{d3modcfgcheck modid="d3points"}][{/d3modcfgcheck}]
[{if $mod_d3points}]
    [{if $oModCfg_d3points->isThemeIdMappedTo('azure')}]
        <li [{if $active_link == d3pointsaccount}]class="active"[{/if}]><a href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=d3_d3points_accountpoints" }]" rel="nofollow">[{ oxmultilang ident="INC_ACCOUNT_HEADER_D3MYPOINTS" }]</a></li>
    [{elseif $oModCfg_d3points->isThemeIdMappedTo('flow')}]
        <li class="list-group-item[{if $active_link == "d3pointsaccount"}] active[{/if}]">
            <a href="[{oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=d3_d3points_accountpoints"}]" title="[{oxmultilang ident="INC_ACCOUNT_HEADER_D3MYPOINTS"}]">[{oxmultilang ident="INC_ACCOUNT_HEADER_D3MYPOINTS"}]
                [{if $oViewConf->d3getPointsTotalSum() > 0}] <span class="badge">[{$oViewConf->d3getPointsTotalSum()}]</span>[{/if}]
            </a>
        </li>
    [{else}]

    [{/if}]
[{/if}]