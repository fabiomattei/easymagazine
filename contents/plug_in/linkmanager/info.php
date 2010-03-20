<table class="listing form" cellpadding="0" cellspacing="0">
    <tr>
        <th class="full">Info</th>
    </tr>
    <tr>
        <td class="first" width="172">
            The "link manager" plug-in is a working example of administration of a links
            table.<br />
            The administration is complete a show an example of all CRUD operation.<br />
            In order to let your readers enjoy your links list, you need to insert, in your template
            script, the following code:<br /><br />
            while ($row = mysql_fetch_array(LinkPlugIn::getLinkList())) {<br />
            &nbsp;&nbsp;&nbsp;&nbsp;echo $row['id'].' - '.$row['title'].' - '.$row['text'].' - '.$row['url']; <br />
            }<br />
            <br />
            Don't foget to activate the plugin after you put the code in your template script.
        </td>
    </tr>
</table>
<p>&nbsp;</p>

