[{$smarty.block.parent}]

[{if $oViewConf->getActiveClassName() =='d3_d3points_accountpoints'}]
    [{d3modcfgcheck modid="d3points" }][{/d3modcfgcheck}]
    [{if $mod_d3points}]
        [{if $oModCfg_d3points->isThemeIdMappedTo('azure')}]
            [{oxstyle include=$oViewConf->getModuleUrl('d3points', 'out/src/css/d3bonuspoints_azure.css')}]
        [{elseif $oModCfg_d3points->isThemeIdMappedTo('flow')}]
            [{oxstyle include=$oViewConf->getModuleUrl('d3points', 'out/src/css/d3bonuspoints_flow.css')}]
        [{else}]
        [{/if}]
    [{/if}]
[{/if}]