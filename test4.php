<form action="test.php" method="POST">
    <table cellpadding="0" cellspacing="0" border="0">
        <tbody>
        <tr>
            <th>Resend</th>
            <th>Vol EMail</th>
            <th>Team Lead Email</th>
        </tr>
        <tr>
            <td><input type="checkbox" name="record[1]" id="record" value="abc"></td>
            <td><input type="text" name="myEmail[1]" id="myEmail" value="aa@bb.cc"></td>
            <td><input type="text" name="leadEmail[1]" id="leadEmail" value="bb@cc.dd"></td>
        <tr>
        <tr>
            <td><input type="checkbox" name="record[2]" id="record" value="efg"></td>
            <td><input type="text" name="myEmail[2]" id="myEmail" value="ee@ff.gg"></td>
            <td><input type="text" name="leadEmail[2]" id="leadEmail" value="ff@gg.hh"></td>
        <tr>
        <tr>
            <td><input type="checkbox" name="record[3]" id="record" value="ghi"></td>
            <td><input type="text" name="myEmail[3]" id="myEmail" value="gg@hh.ii"></td>
            <td><input type="text" name="leadEmail[3]" id="leadEmail" value="hh@ii.jj"></td>
        <tr>
        <tr>
            <td><input type="checkbox" name="record[4]" id="record" value="ijk"></td>
            <td><input type="text" name="myEmail[4]" id="myEmail" value="ii@jj.kk"></td>
            <td><input type="text" name="leadEmail[4]" id="leadEmail" value="jj@kk.ll"></td>
        <tr>
        <tr>
            <td><br><br><input type="submit" value="Submit"></td>
        </tr>
        </tbody>
    </table>
    <input type="hidden" name="update" id="update" value="updateTable">
</form>