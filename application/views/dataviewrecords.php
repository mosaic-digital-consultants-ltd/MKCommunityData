<div class="testbox" xmlns="http://www.w3.org/1999/html">
    <form action="" method="POST">
        <div class="banner">
            <h1>Community Action MK - Admin Tools: View Records</h1>
        </div>

        <?php include 'common/nav.php';?>

        <div id="wrapper">
            <div id="msg"></div>
            <table border=1 id="table_detail" class="table" align=center cellpadding=10>

                <thead>
                <tr>
                    <th>Date</th>
                    <th>Issue</th>
                    <th>Organisation</th>
                    <th>Category</th>
                </tr>
                </thead>

                <tbody>
                <?php

                $rowCount = 1;
                foreach($issues as $row)
                {
                    echo "<tr onclick=\"showHideRow('hidden_row" . $rowCount . "');\">";
                    echo "<td>" . date( "d/m/Y", strtotime($row->submitted_date) ) ."</td>";
                    echo "<td>" . $row->brief ."</td>";
                    echo "<td>" . $row->organisation_name ."</td>";
                    echo "<td>" . $row->category_name ."</td>";

                    echo "</tr>";
                    echo "<tr id=\"hidden_row"  . $rowCount . "\" class=\"hidden_row\">";
                    echo "<td colspan='4'>";

                    echo "<table class=\"table\"><tr class=\"table-info\"><td>Detail</td><td colspan='2'>" . $row->detailed . "</td></tr>";

                    echo "<tr class=\"table-info\"><td>Keywords</td><td colspan='2'>";
                    $keyArr = explode(";", $row->keywords);
                    $keyStr = "";
                    foreach ($keyArr as $keyword) {
                        $keyStr .= "<div class='t1_tag tag_selected'>" . $keyword . "</div>";
                    }
                    echo $keyStr . "</td></tr>";
                    echo "<tr class=\"table-info\"><td>Locations</td><td colspan='2'>";
                    $locArr = explode(";", $row->locations);
                    $locStr = "";
                    foreach ($locArr as $location) {
                        $locStr .= $location . ", " ;
                    }
                    echo $locStr . "</td></tr>";
                    echo "<tr class=\"table-info\"><td>Action</td><td colspan='2'>" . $row->action_name;
                    if (strlen($row->action_alternate) > 0) { echo ", " . $row->action_alternate ;}
                    echo "</td></tr>";
                    echo "<tr class=\"table-info\"><td>Impact Number</td><td colspan='2'>" . $row->impact_number;
                    echo "</td></tr>";
                    echo "<tr class=\"table-info\"><td>Contributer</td><td>" . $row->contact_name . " (" . $row->contact_phone . ", " . $row->contact_email . ")</td>";
//                    echo "<td><div class='btn-toolbar float-right'><button type=\"button\" class=\"btn btn-primary btn-sm fn-edit mr-4\" data-issue-num=\"". $row->this_issue . "\">Edit</button>";
//                    echo " <button type=\"button\" class=\"btn btn-primary btn-sm fn-approve mr-4\" data-issue-num=\"". $row->this_issue . "\">Approve</button></div></td></tr>";
                    echo "</table>";
                    echo "</td>";
                    echo "</tr>";
                    $rowCount ++;
                }
                ?>
                </thead>


            </table>
        </div>



    </form>
</div>


<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="/assets/js/jquery.backstretch.min.js"></script>
<script src="/assets/js/scripts.js"></script>
<script src="/js/jquery.multi-select.js?version=1.1"></script>
<script src="/js/tag_selector.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<!--[if lt IE 10]>
<script src="/assets/js/placeholder.js"></script>
<![endif]-->

<script>

    $(document).ready(function() {


    });


</script>

</body>
</html>