
<div class="testbox">
    <form action="/">
        <div class="banner">
            <h1 id="ptop">Community Action MK  - Admin: Organisation Editor</h1>
        </div>

        <?php include 'common/nav.php';?>

        <h2 id="pkeywords">Organisations</h2>

        <div class="item">
            <p></p>
            <div class="row form-group">
                <div class="col-md-9 pull-right">
                    <div id="msg">Edit attributes directly in the table below</div>
                    <table id="theme_grid" class="table table-condensed table-hover table-striped bootgrid-table" width="60%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Organisation</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tr>

                            <td class="editable-col" contenteditable="true" col-index='0' new-entry='true' data-placeholder="New organisation name here" data-id="neworgname" id="editMe"></td>
                            <td class="editable-col" contenteditable="false" col-index='1' ><button type="button" class="btn btn-primary mb-2 btn-sm" id="btnSaveAction">Add</button></td>
                        </tr>
                        <tr>
                            <td class="editable-col" contenteditable="false" col-index='0'></td>
                            <td class="editable-col" contenteditable="false" col-index='1' ></td>
                        </tr>
                        <thead>
                        <tr>

                            <th>Organisation</th>
                            <th>External Id</th>
                        </tr>
                        </thead>
                        <tbody id="orgtable">
                        <?php
                        foreach($organisations as $res) {
                            echo '<tr data-row-id="' . $res->id. '">';
                            echo '<td class="editable-col" contenteditable="true" col-index="0" oldVal ="' . $res->name . '">' . $res->name . '</td>';
                            echo '<td class="editable-col" contenteditable="true" col-index="1" oldVal ="' . $res->external_id . '">' . $res->external_id . '</td>';
                            echo '</tr>' ;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>

    </form>
</div>


<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>

    var msg_prompt = "Edit attributes directly in the table below";

    $(document).ready(function() {

        // Manage editable fields
        $('td.editable-col').on('focusout', function() {
            data = {};
            data['val'] = $(this).text();

            var attr = $(this).parent('tr').attr('data-row-id');
            if (typeof attr === typeof undefined || attr === false)
                return false;
            data['id'] = $(this).parent('tr').attr('data-row-id');
            data['index'] = $(this).attr('col-index');
            if (data['index'] == 2) { alert ("column index: " + data['index']); }
            if($(this).attr('oldVal') === data['val'])
                return false;
            callAjax(data, "/admin/MKEditor/orgs_edit");

        });

        function callAjax(someData, actionUrl) {
            $.ajax({

                type: "POST",
                url: actionUrl,
                cache:false,
                data: someData,
                dataType: "json",
                success: function(response)
                {
                    if(response.status) {
                        $("#msg").removeClass('alert-danger');
                        $("#msg").addClass('alert-success').html(response.msg);
                        setTimeout(function(){
                            $("#msg").removeClass('alert-success');
                            $("#msg").html(msg_prompt)
                        },2000);
                    } else {
                        $("#msg").removeClass('alert-success');
                        $("#msg").addClass('alert-danger').html(response.msg);
                        setTimeout(function(){
                            $("#msg").removeClass('alert-danger');
                            $("#msg").html(msg_prompt)
                        },2000);
                    }
                }
            });
        }

        $("#btnSaveAction").on("click",function(){
            params = "";
            $("td[new-entry='true']").each(function(){
                if($(this).text() != "") {
                    if(params != "") {
                        params += "&";
                    }
                    params += $(this).data('id')+"="+$(this).text();
                }
            });

            if(params!="") {
                $.ajax({
                    url: "/admin/MKEditor/orgs_new",
                    type: "POST",
                    data:params,
                    dataType: "json",
                    success: function(response){
                        if(response.status) {
                            $("#msg").removeClass('alert-danger');
                            $("#msg").addClass('alert-success').html(response.msg);
                            setTimeout(function(){
                                $("#msg").removeClass('alert-success');
                                $("#msg").html(msg_prompt)
                            },2000);
                        } else {
                            $("#msg").removeClass('alert-success');
                            $("#msg").addClass('alert-danger').html(response.msg);
                            setTimeout(function(){
                                $("#msg").removeClass('alert-danger');
                                $("#msg").html(msg_prompt)
                            },2000);
                        }
                        $("#orgtable").append(response.block);
                        $("td[new-entry='true']").text("");
                    }
                });
            }
        });

        const ele = document.getElementById('editMe');

        // Get the placeholder attribute
        const placeholder = ele.getAttribute('data-placeholder');

        // Set the placeholder as initial content if it's empty
        (ele.innerHTML === '') && (ele.innerHTML = placeholder);

        ele.addEventListener('focus', function(e) {
            const value = e.target.innerHTML;
            value === placeholder && (e.target.innerHTML = '');
        });

        ele.addEventListener('blur', function(e) {
            const value = e.target.innerHTML;
            value === '' && (e.target.innerHTML = placeholder);
        });

    });




</script>
</body>
</html>