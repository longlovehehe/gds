{foreach name=list item=item from=$list}
    <label class="title1  autocheck"><div class="title1" style="min-width:80px;"><input type="checkbox" title="{$item.price}" class="allcheckbox" name="checkbox1[]" value="{$item.code}"/>{"{$item.name}"|L}</div> </label>
{/foreach}