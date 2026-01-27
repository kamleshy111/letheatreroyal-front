<nav>
    <ul>
        {foreach from=$footerNav item=item}
            {if ($item.url)}
                <li class="{$item.status} {if ($page eq $item.url)}active{/if}"><a href="{$item.url}" target="{$item.target}">{$item.title}</a></li>
            {/if}
        {/foreach}
    </ul>
</nav>