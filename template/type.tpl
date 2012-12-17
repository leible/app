    <{include file="header.tpl"}>
        <div style="margin: 10px 0;">
            <{$module}> >> <{$title}>
        </div>
        <{if $action eq 'list'}>

        <table border="1" width="800" cellpadding="5" cellspacing="0">
            <tr bgcolor="#eee">
                <th>ID</th>
                <th>类型名称</th>
                <th>该类型设备数量</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            <{if $list}>
            <{foreach from=$list item=type}>
            <tr>
                <td><{$type.id}></td>
                <td><{$type.type_name}></td>
                <td><{$type.id|showDevCountByTypeId}> 台 </td>
                <td><{if $type.status eq 1}>正常<{else}>禁用<{/if}></td>
                <td><a href="<{$smarty.const.URL}>/type.php?action=modify&id=<{$type.id}>">编辑</a> |
                    <a onclick='javascript:return confirm("你确定要删除这条数据吗？");' href="<{$smarty.const.URL}>/type.php?action=del&id=<{$type.id}>">删除</a> |
                    <a onclick='javascript:return confirm("确定要禁用这条数据吗?");' href="<{$smarty.const.URL}>/type.php?action=forbidden&id=<{$type.id}>">禁用</a>
                </td>
            </tr>
            <{/foreach}>
            <{else}>
            <tr>
                <td colspan="4">暂无信息</td>
            </tr>
            <{/if}>
        </table>
        <{else}>
        <form action="<{$smarty.const.URL}>/type.php" method="post">
            <table border="1" width="800" cellpadding="5" cellspacing="0">
                <tr>
                    <th width=180>类型名称</th>
                    <td><input type="text" name="type_name" value="<{$info.type_name}>"></td>
                </tr>
                <tr>
                    <th>状态</th>
                    <td>
                        <select name="status">
                            <option value="1" <{if $info.status eq 1}>selected<{/if}> >正常</option>
                            <option value="-1" <{if $info.status eq -1}>selected<{/if}> >禁用</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <{if $info.id}>
                        <input type="hidden" name="id" value="<{$info.id}>" />
                        <input type="hidden" name="action" value="update" />
                        <{else}>
                        <input type="hidden" name="action" value="insert" />
                        <{/if}>
                    </td>
                    <td><input type="submit" value="提交" /></td>
                </tr>
            </table>
        </form>
        <{/if}>
    <{include file='footer.tpl'}>