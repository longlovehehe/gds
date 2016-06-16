<ul>
	{if count($list) gt 10}
		<li><a class="prev_list" href="javascript:void(0);" style="text-align: center;">▲({"上一页"|L})</a></li>
		{/if}
		{foreach name=list item=item from=$list}
			{if is_array($item.list)}
            <li><a href="#"  style="{$item.ag_number|set_title}" ag_number="{$item.ag_number}">{$item.ag_name}</a><ul>
					{foreach name=list1 item=item1 from=$item.list}
						{if count($item1.list) neq 0}
							<li><a  href="#"  style="{$item1.ag_number|set_title}" ag_number="{$item1.ag_number}">{$item1.ag_name}</a><ul>
									{foreach name=list2 item=item2 from=$item1.list}
										{if count($item2.list) neq 0}
											<li><a href="#"  style="{$item2.ag_number|set_title}" ag_number="{$item2.ag_number}">{$item2.ag_name}</a><ul>
													{foreach name=list3 item=item3 from=$item2.list}
														{if count($item3.list) neq 0}
															<li><a href="#"  style="{$item3.ag_number|set_title}" ag_number="{$item3.ag_number}">{$item3.ag_name}</a><ul>
																	{foreach name=list4 item=item4 from=$item3.list}
																		{if count($item4.list) neq 0}
																			<li><a  href="#"  style="{$item4.ag_number|set_title}" ag_number="{$item4.ag_number}">{$item4.ag_name}</a></li>
																			{else}
																			{/if}
																		{/foreach}
																</ul></li>
															{else}
															<li><a  href="#"  style="{$item3.ag_number|set_title}" ag_number="{$item3.ag_number}">{$item3.ag_name}</a></li>
															{/if}

													{/foreach}
												</ul></li>
											{else}
											<li><a  href="#"  style="{$item2.ag_number|set_title}" ag_number="{$item2.ag_number}">{$item2.ag_name}</a></li>
											{/if}
										{/foreach}
								</ul></li>
							{else}
							<li><a  href="#"  style="{$item1.ag_number|set_title}" ag_number="{$item1.ag_number}">{$item1.ag_name}</a></li>
							{/if}
						{/foreach}
				</ul></li>
			{else}
            <li><a href="#" style="{$item.ag_number|set_title}" ag_number="{$item.ag_number}">{$item.ag_name}</a></li>
			{/if}

	{/foreach}
	{if count($list) gt 10}
		<li><a class="next_list" href="javascript:void(0);" style="text-align: center;">▼({"下一页"|L})</a></li>
		{/if}
</ul>