<ul class="rd-navbar-nav">
    {foreach from=$mainNav item=actMenu}
        {assign var="currentParent" value=$actMenu.id}
        {if ($actMenu.subMenu)}
            <li class="rd-nav-item {$parent.status} level1 {if ($page eq $parent.url)}active{/if}">
                <a href="#" class="rd-nav-link">{$actMenu.title}</a>
                <ul class="rd-menu rd-navbar-dropdown">
                    {foreach from=$actMenu.subMenu item=sub}
                        {assign var="currentParent" value=$sub.id}
                        <li class="rd-dropdown-item {$parent.status} level2"><a href="{$sub.url}" {if ($sub.target)}target="{$sub.target}"{/if}>{$sub.title}</a></li>
                    {/foreach}
                </ul>
            </li>
        {else}
            <li class="rd-nav-item {if ($page eq $actMenu.code)}active{/if}"><a class="rd-nav-link" href="{$actMenu.url}" {if ($actMenu.target)}target="{$actMenu.target}"{/if}>{$actMenu.title}</a></li>
        {/if}
    {/foreach}
</ul>