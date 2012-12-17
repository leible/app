    <{include file='header.tpl'}>
        <div style="margin: 10px 0;">
            <{$module}> >> <{$title}>
        </div>
    <{if $action eq 'list'}>

        <table width="800" border="1" cellspacing="0" cellpadding="5">
            <tr bgcolor="#eee">
                <th>ID</th>
                <th>用户名称</th>
                <th>角色名称</th>
                <th>操作</th>
            </tr>
            <{if $userList}>
            <{foreach from=$userList item="user"}>
            <tr>
                <td><{$user.id}></td>
                <td><{$user.user_name}></td>
                <td><{$user.role_id|showRoleNameById}></td>
                <td>
                    <a href="<{$smarty.const.URL}>/user.php?action=modify&id=<{$user.id}>">编辑</a> ｜
                    <a onclick='javascript:return confirm("确定要删除这条数据吗?");' href="<{$smarty.const.URL}>/user.php?action=del&id=<{$user.id}>">删除</a>
                </td>
            </tr>
            <{/foreach}>
            <{else}>
            <tr><td colspan="4">暂无用户</td></tr>
            <{/if}>
        </table>
    <{else}>

        <form action="<{$smarty.const.URL}>/user.php" method="post">
            <table width="800" border="1" cellpadding="10" cellspacing="0" >
                <tr>
                    <th width=180>用户名</th>
                    <td align="left"><input type="text" name="user_name" value="<{$info.user_name}>" /></td>
                </tr>
                <tr>
                    <th>密码</th>
                    <td align="left"><input type="password" name="password" value="<{$info.password}>" /></td>
                </tr>
                <tr>
                    <th>选择角色</th>
                    <td align="left">
                        <select name="role_id">
                            <option value="">
                                请选择角色名
                            </option>
                            <{foreach from=$roleList item="role"}>
                            <option value="<{$role.id}>" <{if $info.role_id eq $role.id}>selected<{/if}> >
                                <{$role.role_name}>
                            </option>
                            <{/foreach}>
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