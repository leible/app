    <{include file='header.tpl'}>
        <div style="margin: 10px 0;">
            <{$module}> >> <{$title}>
        </div>
        <{if $action eq 'list'}>

        <table width="800" border="1" cellspacing="0" cellpadding="5">
            <tr bgcolor="#eee">
                <th width="15">ID</th>
                <th width="100">角色名称</th>
                <th>节点IDS</th>
                <th width="70">操作</th>
            </tr>
            <{if $list}>
            <{foreach from=$list item=info}>
            <tr>
                <td><{$info.id}></td>
                <td><{$info.role_name}></td>
                <td><{$info.node_ids|showNodeNameById}></td>
                <td>
                    <a href="<{$smarty.const.URL}>/role.php?action=modify&id=<{$info.id}>">编辑</a> |
                    <a onclick='javascript:return confirm("确定要删除这条数据吗?");' href="<{$smarty.const.URL}>/role.php?action=del&id=<{$info.id}>">删除</a>
                </td>
            </tr>
            <{/foreach}>
            <{else}>
            <tr>
                <td colspan="4">暂无角色</td>
            </tr>
            <{/if}>
        </table>
        <{else}>
        <form action="<{$smarty.const.URL}>/role.php" method="post">
        <table width="800" cellspacing="0" cellpadding="5" border="1">
            <tr>
                <th width=180>角色名称</th>
                <td><input type="text" name="role_name" value="<{$info.role_name}>" /></td>
            </tr>
            <tr>
                <th>节点名称</th>
                <td>
<!--                    <input type="checkbox" name="ids[]" value="" />--><{$info.node_ids|showNodeNameById}>

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
                <td>
                    <input type="submit" value=" 提交 " />
                </td>
            </tr>
        </table>
        </form>
        <{/if}>
    <{include file='footer.tpl'}>
