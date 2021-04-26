
<div class="testbox">
    <form action="/MKForm/submit" method="POST">
        <div class="banner">
            <h1>MK Community Data Gathering Tool</h1>
        </div>
        <div class="item">
            <p>Please fill in as much of this form as possible. Mandatory fields are indicated by <span class="mandatory">*</span>, otherwise fields are optional.</p>
        </div>
        <?php echo form_hidden( 'TS', time() ); ?>
        <h2>Your Organisation</h2>
        <div class="item">
            <p>Your organisation <span class="mandatory">*</span></p>
            <div class="city-item">
                <select id="selOrg" name="selOrg_id">
                    <option value="">Select your organisation</option>
                    <?php
                    foreach($organisations as $row)
                    {
                        echo  "<option value='" . $row->id . "'>" . $row->name ."</option>";
                    }
                    ?>
                </select>

            </div>
        </div>

        <h2>What would you like to tell us about?</h2>
        <div class="item">
            <p>What category does your information fall into? <span class="mandatory">*</span></p>
            <div class="city-item">
                <div class="row mt-2"><div class="col-sm-1"><h6>Issue</h6></div><div class="col-sm-5">A problem or concern that you are picking up e.g. Lack of access to online schooling as they do not have the technology</div></div>
                <div class="row mt-2"><div class="col-sm-1"><h6>Impact</h6></div><div class="col-sm-5">A positive impact you are hearing about</div></div>
                <div class="row mt-2"><div class="col-sm-1"><h6>Idea</h6></div><div class="col-sm-5">A possible solution to the issues and challenges you are facing, or an action that could be taken, e.g. An idea for a new project, requirements / collaborations needed?</div></div>
                <div class="row mt-2"><div class="col-sm-1"><h6>Interest</h6></div><div class="col-sm-5">An interest you, your organisation or your services users have (e.g. a new area of work you would like to explore, a new service that would be beneficial to introduce etc)</div></div>
            </div>
            <div class="city-item">
                <select id="selCat" name="selCat_id">
                    <option value="">Select one</option>
                    <?php
                    foreach($categories as $row)
                    {
                        echo  "<option value='" . $row->id . "'>" . $row->name ."</option>";
                    }
                    ?>
                </select>

            </div>
        </div>
        <div class="item">
            <p>Brief Description <span class="mandatory">*</span></p>
            <div class="city-item">
                <textarea type="text" name="briefText" rows="5" id="textBrief"/></textarea>
            </div>
        </div>
        <div class="item">
            <p>Detailed overview of the issue/ interest / idea or impact that you are sharing</p>
            <div class="city-item">
                <textarea type="text" name="detailText" rows="10" id="textFull"/></textarea>
            </div>
        </div>
        <div class="item">
            <p>Number of people affected</p>
            <div class="city-item">
                <input type="text" name="numAffected" value="" placeholder="Approximately" id="inputAffected" onkeypress="return isNumber(event)"/>
            </div>
        </div>


        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12"><p>Choose the appropriate terms that help describe this issue <span class="mandatory">*</span></p></div>
            </div>

                <?php
                foreach($themes as $row)
                {
                    echo  "<div class=\"row mt-2\"><div class=\"col-sm-3\"><h6>".$row->name."</h6></div>";

                    echo "<div class=\"col-sm-9\"><div id=\"tag_multi_select_" . $row->id . "\" class=\"keyselector\"></div></div></div>";
                }
                ?>
<!--            <div id="tag_multi_select"></div>-->

<!--            <button onclick="check_value();">show info</button>-->
                <div id="info">

                </div>

            <input type="hidden" name="keywords" id="keywordArray" />
        </div>


        <h2>Actions & Next Steps</h2>
        <div class="item">
            <p>Any actions you would like to suggest? Select from the list  <span class="mandatory">*</span></p>
            <div class="city-item">
                <select id="selAct" name="selAct_id">
                    <option value="">Select an action</option>
                    <?php
                    foreach($actions as $row)
                    {
                        echo  "<option value=" . $row->id . ">" . $row->action_name ."</option>";
                    }
                    ?>
                </select>
            </div>




        </div>
        <div class="item">
            <div class="city-item">
                <input type="text" name="actionText" placeholder="Type an alternative action here" id="inputAction"/>
            </div>
        </div>


        <h2>Location Details</h2>
        <div class="item">
            <p>Does this record relate to a particular area? <span class="mandatory">*</span></p>
            <div class="city-item">
                <!-- <select id="selLoc"> -->
                <select multiple="multiple" id="estates" name="estates[]">

                <!-- <option value="">Select an estate</option> -->
                    <?php
                    foreach($locations as $row)
                    {
                        echo  "<option value=" . $row->id . ">" . $row->location ."</option>";
                    }
                    ?>
                </select>
            </div>

        </div>

        <h2>Demographics</h2>
        <div class="item">
            <p>Age Groups</p>
            <div class="row form-group">

                <div class="col-md-9 pull-right">
                    <select multiple="multiple" id="age-groups" name="age_groups[]">
                        <?php
                        foreach($ages as $row)
                        {
                            echo  "<option value=" . $row->id . ">" . $row->range_name ."</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>

        <h2>Your Contact Details</h2>
        <div class="item">
            <div class="city-item">
                <input type="text" name="contactNameText" placeholder="Name" id="inputName"/>
                <input type="text" name="contactEmailText" placeholder="Email" id="inputEmail"/>
                <input type="text" name="contactPhoneText" placeholder="Phone" id="inputPhone"/>
            </div>
        </div>

        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" onclick="populate_preview()">Preview</button>

        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">Your submission preview</h2>
                    </div>
                    <div class="modal-body">
                        <p>Please take a moment to check the data you're supplying. It must include your organisation, the category, a brief description, at least one keyword, and some detail about the location. Please try to ensure that neither defamatory remarks nor personal identifiable information are included in any text.</p>
                        <div class="row mt-2">
                            <div class="col-sm-3"><h6>Your organisation</h6></div>
                            <div class="col-sm-9" id="previewOrg"></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-3"><h6>Information category</h6></div>
                            <div class="col-sm-9" id="previewCat"></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-3"><h6>Brief description</h6></div>
                            <div class="col-sm-9 textscroll" id="previewBrief"></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-3"><h6>Detailed overview</h6></div>
                            <div class="col-sm-9 textscroll" id="previewFull"></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-3"><h6>Number affected</h6></div>
                            <div class="col-sm-9" id="previewAffected"></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-3"><h6>Selected terms</h6></div>
                            <div class="col-sm-9" id="previewTerms"><span class='text-warning'>No terms selected.</span></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-3"><h6>Action</h6></div>
                            <div class="col-sm-9" id="previewAct"></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-3"><h6>Location</h6></div>
                            <div class="col-sm-9" id="previewLoc"></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-3"><h6>Age groups</h6></div>
                            <div class="col-sm-9" id="previewAge"></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-3"><h6>Contact Details</h6></div>
                            <div class="col-sm-9" id="previewContact"></div>
                        </div>
                        <button type="submit" class="btn btn-info btn-lg btn-disabled" id="realSubmitButton">Submit Form</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Return to form</button>
                    </div>
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
