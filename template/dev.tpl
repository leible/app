    <{include file="header.tpl"}>
        <div style="margin: 10px 0;">
            <!--<{$lastSQL}>-->
            <{$module}> >> <{$title}>
            <!--搜索表单开始-->
            <form action="<{$smarty.const.URL}>/dev.php" method="post">
                搜索：
                <select name="searchName">
                    <option value=''>请选搜索条件</option>

                    <option value="dev_name">设备名</option>
                    <option value="sn">固定资产编码</option>
                    <option value="remark">设备描述</option>
                    <option value="config_info">配置信息</option>
                    <option value="buyer">购买者</option>
                    <option value="store_place">存放位置</option>
                </select>
                <select name="type_id">
                    <option value="">
                        请选择设备类型
                    </option>
                    <{foreach from=$typeList item="type"}>
                        <option value="<{$type.id}>" <{if $info.type_id eq $type.id}>selected<{/if}>>
                            <{$type.type_name}>
                        </option>
                    <{/foreach}>
                </select>
                <select name="status">
                    <option value=1>正常</option>
                    <option value=-1>报废</option>
                </select>
                关键字：<input type="text" name="keyWord" value="" />
                <input type="hidden" name="action" value="search" />
                <input type="submit" value="搜索">
            </form>
                <{$lastSQL}>
            <!--搜索表单结束-->
        </div>
    <{if $action eq 'list'}>

        <table border="1" width="800" cellspacing="0" cellpadding="5">
            <tr bgcolor="#eee">
                <th width="10">ID</th>
                <th width="200">设备名</th>
                <th width="130">固定资产编码</th>
                <th width="60">设备类型</th>
                <th>购买者</th>
                <th width="30">状态</th>
                <th width="100">操作</th>
            </tr>
            <{if $devList}><!--如果devList为真则显示-->
            <{foreach from=$devList item="dev"}>
            <tr>
                <td><{$dev.id}></td>
                <td><a href="<{$smarty.const.URL}>/dev.php?action=info&id=<{$dev.id}>"><{$dev.dev_name}></a></td>
                <td><{$dev.sn}></td>
                <td><{$dev.type_id|showTypeNameById}></td>
                <td><{$dev.buyer}></td>
                <td><{if $dev.status gt 0}>正常<{elseif $dev.status lt 0}>报废<{/if}></td>
                <td>
                    <a href="<{$smarty.const.URL}>/dev.php?action=modify&id=<{$dev.id}>">编辑</a> |
                    <a onclick='javascript:return confirm("确定要报废这台设备吗?");'
                       href="<{$smarty.const.URL}>/dev.php?action=scrap&id=<{$dev.id}>">报废</a> |
                    <a onclick='javascript:return confirm("确定要删除这条数据吗?");'
                       href="<{$smarty.const.URL}>/dev.php?action=del&id=<{$dev.id}>">删除</a>
                </td>
            </tr>
            <{/foreach}>
            <{else}>
            <tr>
                <td colspan="7">暂无信息</td>
            </tr>
            <{/if}>
        </table>
    <{elseif $action eq 'search'}>
    <!--这里是搜索结果开始-->
        <table border="1" width="800" cellspacing="0" cellpadding="5">
            <tr bgcolor="#eee">
                <th>ID</th>
                <th>设备名</th>
                <th>固定资产编码</th>
                <th>设备类型</th>
                <th>购买者</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            <{if $searchList}>
            <{foreach from=$searchList item="search"}>
            <tr>
                <td><{$search.id}></td>
                <td><a href="<{$smarty.const.URL}>/dev.php?action=info&id=<{$search.id}>"><{$search.dev_name}></a></td>
                <td><{$search.sn}></td>
                <td><{$search.type_id|showTypeNameById}></td>
                <td><{$search.buyer}></td>
                <td><{if $search.status gt 0}>正常<{elseif $search.status lt 0}>报废<{/if}></td>
                <td>
                    <a href="<{$smarty.const.URL}>/dev.php?action=modify&id=<{$search.id}>">编辑</a> |
                    <a onclick='javascript:return confirm("确定要报废这台设备吗?");'
                       href="<{$smarty.const.URL}>/dev.php?action=scrap&id=<{$search.id}>">报废</a> |
                    <a href="<{$smarty.const.URL}>/dev.php?action=del&id=<{$search.id}>">删除</a>
                </td>
            </tr>
            <{/foreach}>
            <{else}>
            <tr>
                <td colspan="7">没有搜索到信息</td>
            </tr>
            <{/if}>
        </table>
    <!--搜索结果结束-->
    <{elseif $action eq 'info'}>
    <!--设备详细信息-->
        <table width="800" border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th width=180>设备名称</th>
                <td align="left"><{$devInfo.dev_name}></td>
            </tr>
            <tr>
                <th>固定资产编码</th>
                <td align="left"><{$devInfo.sn}></td>
            </tr>
            <tr>
                <th>购买价格</th>
                <td><{$devInfo.price}></td>
            </tr>
            <tr>
                <th>购买时间</th>
                <td><{$devInfo.time|date_format:"%Y-%m-%d"}></td>
            </tr>
            <tr>
                <th>合同号</th>
                <td><{$devInfo.contract_sn}></td>
            </tr>
            <tr>
                <th>选择设备类型</th>
                <td align="left">
                    <{$devInfo.type_id|showTypeNameById}>
                </td>
            </tr>
            <tr>
                <th>是否报废</th>
                <td>
                    <{if $devInfo.status eq 1}>正常<{else}>报废<{/if}>
                </td>
            </tr>
            <tr>
                <th>设备描述</th>
                <td><{$devInfo.remark}></td>
            </tr>
            <tr>
                <th>设备配置明细</th>
                <td><{$devInfo.config_info}></td>
            </tr>
            <tr>
                <th>采购者</th>
                <td align="left"><{$devInfo.buyer}></td>
            </tr>
            <tr>
                <th>设备存放位置</th>
                <td><{$devInfo.store_place}></td>
            </tr>
        </table>
    <!--设备详细信息-->
    <{else}>
    <!--编辑设备页面-->
        <form action="<{$smarty.const.URL}>/dev.php" method="post">
            <table width="800" border="1" cellpadding="10" cellspacing="0">
                <tr>
                    <th  width=180>设备名称</th>
                    <td align="left"><input type="text" name="dev_name" value="<{$info.dev_name}>"></td>
                </tr>
                <tr>
                    <th>固定资产编码</th>
                    <td align="left"><input type="text" name="sn" value="<{$info.sn}>"></td>
                </tr>
                <tr>
                    <th>购买价格</th>
                    <td><input type="text" name="price" value="<{$info.price}>"></td>
                </tr>
                <tr>
                    <th>购买时间</th>
                    <td><input type="text" name="time" value="<{$info.time|date_format:"%Y-%m-%d"}>"><span>格式：2012-08-08</span></td>
                </tr>
                <tr>
                    <th>合同号</th>
                    <td><input type="text" name="contract_sn" value="<{$info.contract_sn}>"></td>
                </tr>
                <tr>
                    <th>选择设备类型</th>
                    <td align="left">
                        <select name="type_id">
                            <option value="">
                                请选择设备类型
                            </option>
                            <{foreach from=$typeList item="type"}>
                                <option value="<{$type.id}>" <{if $info.type_id eq $type.id}>selected<{/if}>>
                                    <{$type.type_name}>
                                </option>
                            <{/foreach}>
                        </select>
                    </td>
                </tr>
                <{if $action neq 'add'}>
                <tr>
                    <th>是否报废</th>
                    <td>
                        <select name="status">
                            <option value="1" <{if $info.status eq 1}>selected<{/if}> >正常</option>
                            <option value="-1" <{if $info.status eq -1}>selected<{/if}> >报废</option>
                        </select>
                    </td>
                </tr>
                <{/if}>
                <tr>
                    <th>设备描述</th>
                    <td><input type="text" name="remark" value="<{$info.remark}>"></td>
                </tr>
                <tr>
                    <th>设备配置明细</th>
                    <td><input type="text" name="config_info" value="<{$info.config_info}>"></td>
                </tr>
                <tr>
                    <th>采购者</th>
                    <td align="left"><input type="text" name="buyer" value="<{$info.buyer}>"></td>
                </tr>
                <tr>
                    <th>设备存放位置</th>
                    <td><input type="text" name="store_place" value="<{$info.store_place}>"></td>
                </tr>
                <tr>
                    <td>
                        <{if $info.id}>
                        <input type="hidden" name="id" value="<{$info.id}>">
                        <input type="hidden" name="action" value="update" />
                        <{else}>
                        <input type="hidden" name="action" value="insert" />
                        <{/if}>
                    </td>
                    <td><input type="submit" value="提交"></td>
                </tr>
            </table>
        </form>
    <!--编辑设备页面结束-->
    <{/if}>
    <{include file='footer.tpl'}>