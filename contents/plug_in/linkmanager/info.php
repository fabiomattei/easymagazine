<table class="listing form" cellpadding="0" cellspacing="0">
    <tr>
        <th class="full">Info</th>
    </tr>
    <tr>
        <td class="first" width="172">
            The "link manager" plug-in is a working example of administration of a links
            table.<br />
            The administration is complete a show an example of all CRUD operation.
            In order to use it you need to insert code like this somewhere in your template
            script:<br />
            while ($row = mysql_fetch_array(LinkPlugIn->getLinkList())) {<br />
            &nbsp;&nbsp;&nbsp;&nbsp;echo $row['id'].' - '.$row['title'].' - '.$row['text'].' - '.$row['url'].' |
            }<br />
        </td>
    </tr>
</table>
<p>&nbsp;</p>

