[{$smarty.block.parent}]

[{d3modcfgcheck modid="d3points"}][{/d3modcfgcheck}]
[{if $mod_d3points}]
	[{if $oModCfg_d3points->isThemeIdMappedTo('azure')}]
		<li>
			<a href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=d3_d3points_accountpoints" }]" rel="nofollow"><span>[{oxmultilang ident="INC_ACCOUNT_HEADER_D3MYPOINTS"}]</span>
				[{if $oViewConf->d3getPointsTotalSum() > 0}]<span class="counter FXgradOrange">[{$oViewConf->d3getPointsTotalSum()}]</span>[{/if}]
			</a>
		</li>
	[{elseif $oModCfg_d3points->isThemeIdMappedTo('flow')}]
		<li>
			<a href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=d3_d3points_accountpoints" }]" rel="nofollow">[{ oxmultilang ident="INC_ACCOUNT_HEADER_D3MYPOINTS" }]</a>
			[{if $oViewConf->d3getPointsTotalSum() > 0}] <span class="badge">[{$oViewConf->d3getPointsTotalSum()}]</span>[{/if}]
		</li>
	[{elseif $oModCfg_d3points->isThemeIdMappedTo('wave')}]
		<li>
			<a href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=d3_d3points_accountpoints" }]" rel="nofollow">[{ oxmultilang ident="INC_ACCOUNT_HEADER_D3MYPOINTS" }]</a>
			[{if $oViewConf->d3getPointsTotalSum() > 0}] <span class="badge">[{$oViewConf->d3getPointsTotalSum()}]</span>[{/if}]
		</li>
	[{else}]
	[{/if}]
[{/if}]
