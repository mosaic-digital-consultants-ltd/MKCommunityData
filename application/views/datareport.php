
<div class="testbox">
    <form action="" method="POST">
        <div class="banner">
            <h1>MK Community Data Reporting</h1>
        </div>
        <?php include 'common/nav.php';?>
        <div>
            <p>&nbsp;</p>
            <h2>
            <?php
            $time = strtotime($firstdate[0]->firstdate);
            $myFormatForView = date("jS \of F Y", $time);
            echo $reviewedcounts[0]->occurrences . ' submissions since ' . $myFormatForView ;
            ?>
            </h2>

        </div>
        <h2>Top Categories</h2>
        <div class="city-item">
            <p></p>
            <div class="row form-group">
                <div class="col-md-9 pull-right">

                    <table id="theme_grid" class="table table-condensed table-hover table-striped bootgrid-table" width="60%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Category</th>
                            <th>Total</th>
                        </tr>
                        </thead>

                        <tbody id="categorytable">
                        <?php
                        foreach($topcategories as $res) {
                            echo '<tr data-row-id="' . $res->category_id. '">';
                            echo '<td class="non-editable-col" contenteditable="false" col-index="2" >' . $res->category . '</td>';
                            echo '<td class="editable-col" contenteditable="false" col-index="0" ><a href="/admin/MKViewer">' . $res->occurrences . '</a></td>';
                            echo '</tr>' ;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <h2>Top <?php echo $maxRecords ?> Keywords</h2>
        <div class="city-item">
            <p></p>
            <div class="row form-group">
                <div class="col-md-9 pull-right">

                    <table id="theme_grid" class="table table-condensed table-hover table-striped bootgrid-table" width="60%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Keyword</th>
                            <th>Theme</th>
                            <th>Total</th>
                        </tr>
                        </thead>

                        <tbody id="keywordtable">
                        <?php
                        $count = 0;
                        foreach($topkeywords as $res) {
                            echo '<tr data-row-id="' . $res->keyword_id. '">';
                            echo '<td class="non-editable-col" contenteditable="false" col-index="2" >' . $res->keyword . '</td>';
                            echo '<td class="non-editable-col" contenteditable="false" col-index="2" >' . $res->theme . '</td>';
                            echo '<td class="editable-col" contenteditable="false" col-index="0" ><a href="/admin/MKReport/viewresults?key='  . $res->keyword_id. '">' . $res->occurrences . '</td>';
                            echo '</tr>' ;
                            $count ++;
                            if ($count == $maxRecords) {break;}
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <h2>Top <?php echo $maxRecords ?> Locations</h2>
        <div class="city-item">
            <p></p>
            <div class="row form-group">
                <div class="col-md-9 pull-right">

                    <table id="theme_grid" class="table table-condensed table-hover table-striped bootgrid-table" width="60%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Location</th>
                            <th>Parish</th>
                            <th>Total</th>
                        </tr>
                        </thead>

                        <tbody id="keywordtable">
                        <?php
                        $count = 0;
                        foreach($toplocations as $res) {
                            echo '<tr data-row-id="' . $res->location_id. '">';
                            echo '<td class="non-editable-col" contenteditable="false" col-index="2" >' . $res->location . '</td>';
                            echo '<td class="non-editable-col" contenteditable="false" col-index="2" >' . $res->parish . '</td>';
                            echo '<td class="editable-col" contenteditable="false" col-index="0" ><a href="/admin/MKReport/viewresults?loc='  . $res->location_id. '">' . $res->occurrences . '</td>';
                            echo '</tr>' ;
                            $count ++;
                            if ($count == $maxRecords) {break;}
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>



    </form>
</div>

<script>
    var selectedAgeGroups = [];
    var selectedEstates = [];


    $(document).ready(function() {

        $('#age-groups').multiSelect({
            selectableHeader: "<div class='custom-header'>Age Ranges</div>",
            selectionHeader: "<div class='custom-header'>Your Selection</div>",
        });
        $('#age-groups').multiSelect('select', selectedAgeGroups);
        $('#estates').multiSelect({
            selectableHeader: "<div class='custom-header'>Estate Names</div>",
            selectionHeader: "<div class='custom-header'>Your Selection</div>",
        });
        $('#estates').multiSelect('select', selectedEstates);

        <?php
        $count = 0;
        foreach($themes as $theme) : ?>

        $('#tag_multi_select_<?php echo $theme->id; ?>').tag_selector({
            class_prefix: 't<?php echo (($count%4)+1); ?>'
            , multi_select: true
            , unique_identifier: 'tag_multi_select_<?php echo $theme->id; ?>'
            , data: [
                <?php
                foreach($keywordsmap as $row)
                {
                    if ($theme->id == $row->theme_id) {
                        echo "{label: '" . addslashes($row->keyword_name) . "', value: " . $row->keyword_id . "},";
                    }
                }
                ?>
            ]
            , callback: function(event_name, elem, parent){
                check_value();
            }
        });
        <?php $count ++; endforeach; ?>
    });

    $(function() {
        $("[required]").after($("<span>", {class: "mandatory"}).html("* "));
    });

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
    function populate_preview() {
        var showSubmit = true;
        var selectedText = $("#selOrg").find("option:selected").text();
        document.getElementById("previewOrg").innerText = selectedText;
        selectedText = $("#selCat").find("option:selected").text();
        document.getElementById("previewCat").innerText = selectedText;
        selectedText = $("#textBrief").val();
        if (selectedText.length == 0) {
            selectedText = "<span class='text-danger'>No text supplied.</span>";
            showSubmit = false;
        }
        document.getElementById("previewBrief").innerHTML = selectedText;
        selectedText = $("#textFull").val();
        document.getElementById("previewFull").innerText = selectedText;
        selectedText = $("#inputAffected").val();
        document.getElementById("previewAffected").innerHTML = selectedText;

        selectedText = $('#age-groups option:selected').toArray().map(item => item.text).join();
        document.getElementById("previewAge").innerText = selectedText;
        selectedText = $('#estates option:selected').toArray().map(item => item.text).join();
        if ($('#estates option:selected').toArray().length == 0)
        {
            selectedText = "<span class='text-danger'>No location entered.</span>";
            showSubmit = false;
        }
        document.getElementById("previewLoc").innerHTML = selectedText;

        locText = $("#inputName").val();
        locText1 = $("#inputEmail").val();
        locText2 = $("#inputPhone").val();
        document.getElementById("previewContact").innerHTML = locText + " " + locText1 + " " + locText2;

        var locText = $("#selAct").find("option:selected").text();
        locText2 = $("#inputAction").val();
        if (($("#selAct").val() == 0) && (locText2.length == 0)) {
            locText = "<span class='text-danger'>No action specified.</span>";
            showSubmit = false;
        }
        else { locText += " : " + locText2 ; }
        document.getElementById("previewAct").innerHTML = locText;

        if ($("#selOrg").val() == 0) {
            document.getElementById("previewOrg").innerHTML = "<span class='text-danger'>No organisation selected.</span>";
            showSubmit = false;
        }
        if ($("#selCat").val() == 0) {
            document.getElementById("previewCat").innerHTML = "<span class='text-danger'>No category selected.</span>";
            showSubmit = false;
        }

        if (showSubmit)
        {
            //alert("show button");
            $("#realSubmitButton").removeClass('d-none');
        }
        else
        {
            $("#realSubmitButton").addClass('d-none');
        }
    }

    function check_value() {
        var info = $('#info');
        var termsblk = $('#previewTerms');
        var text = '';

        var labelArray = [];
        var htmlElem = '';
        var formArray = [];


        $(".keyselector").each(function(){
            //do stuff here

            var jString = $(this).data('selected');

            text += jString + '</p>';
            // if (jString.length > 2) {
            //     alert('adding ' + jString + ' -to- ' );
            // }
            var obj = JSON.parse(jString);

            $.each(obj, function(index, element) {
                if (labelArray.indexOf(element.label) === -1) {
                    labelArray.push(element.label);
                    formArray.push(element.value);
                    //alert('adding to label array ' + element.label)
                }

            });


        });

        // loop through the array of labels & make little button
        if (labelArray.length == 0) {
            htmlElem = "<span class='text-danger'>No terms selected.</span>";
        }
        else {
            for (var i = 0; i < labelArray.length; i++) {
                htmlElem += "<div class='t1_tag tag_selected'>" + labelArray[i] + "</div>";
            }
        }

        termsblk.html(htmlElem );
        document.getElementById("keywordArray").value= JSON.stringify(formArray);

    }


</script>
