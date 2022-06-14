[{d3modcfgcheck modid="d3points"}][{/d3modcfgcheck}]
[{if $mod_d3points}]
    [{assign var='notificationsCounter' value=$notificationsCounter+$oViewConf->d3getPointsTotalSum()}]
[{/if}]

[{$smarty.block.parent}]
