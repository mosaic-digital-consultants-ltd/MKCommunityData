</head>

<body>


<!-- Top menu -->

<nav class="navbar navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="https://communityactionmk.org">COMMUNITY ACTION: MK</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="top-navbar-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
							<span class="li-text">
								Follow us:
							</span>
                    <span class="li-social">
								<a href="https://www.facebook.com/CommunityActionMK/" target="_blank"><i class="fa fa-facebook"></i></a>
								<a href="https://twitter.com/ComActMK" target="_blank"><i class="fa fa-twitter"></i></a>
							</span>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Description -->
<div class="description-container">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 description-title">
                <h2>MK COMMUNITY DATA</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 description-text">
                <p>
                    Welcome to MK Community Data, an online space for community groups and organisations in Milton Keynes to capture the experiences of their service users.

                    This is a digital tool that aims to solve the issues identified by many voluntary and community groups across MK particularly relating to the lack of coordinated and captured insight into residents experiences, especially highlighted since the outbreak of Covid-19.

                    </p>
                <p>The purpose of collecting community intelligence is to:

                <ul>
                <li>Establish a better understanding of the real needs and experiences across MK communities</li>
                <li>Use the collective voice of the voluntary and community sector in MK to communicate needs to decision makers</li>
                <li>Enable voluntary and community sector groups to identify common issues and collaboration opportunities</li>
                </ul>

                    <p>The success of this tool will depend on the input from a range of community and voluntary groups - so we thank you so much for sharing your intelligence.

                        <a href="https://communityactionmk.org/privacy-policy/">Click here to refer to our data sharing statement</a>.</p>
                </p>
<!--                <div class="divider-1">-----</div>-->
            </div>
        </div>
    </div>
</div>

<!-- Multi Step Form -->
<div class="msf-container">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 msf-title">
<!--                <h3>A TITLE</h3>-->
                <p>Please fill in as much of this form as possible. <span required>Mandatory fields are underlined in red</span>, otherwise fields are optional.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 msf-form">

                <form role="form"   action="/MKForm/submit" method="POST" class="form-inline">

                    <fieldset>
                        <h4>About You <span class="step">(Step 1 / 5)</span></h4>
                        <?php echo form_hidden( 'TS', time() ); ?>
                        <input type="hidden" name="selOrg_id" id="selOrg_field">
                        <div class="selects-1">
                            <p><label required>Your Organisation:</label></p>
                            <div class="ui-widget">
                            <select class="form-control" id="combobox" name="oldselOrg_id">
                                <option value="">Select</option>
                                <?php
                                foreach($organisations as $row)
                                {
                                    echo  "<option value='" . $row->id . "'>" . $row->name ."</option>";
                                }
                                ?>
                            </select>

                            </div>
                        </div>
                        <p>If your group/ organisation is not listed, click <a href="http://bit.ly/MKComDataToolAddNewOrg">here</a> to be added to the list. </p>
                        <p>If there is any sensitive data that you would like to share that might not be appropriate to record using this tool, please get in touch with us on <a href="mailto:support@communityactionmk.org">support@communityactionmk.org</a>, so we can support with the best way of recording/ sharing this information.</p>
                        <br>
                        <div class="divider-1"></div>
                        <div class="form-group">
                            <label for="contactNameText">Your Name (optional):</label><br>
                            <input type="text" name="contactNameText" class="first-name form-control" id="inputName" placeholder="Name" >
                        </div>
                        <div class="form-group">
                            <label for="contactEmailText">Email Address (optional):</label><br>
                            <input type="text" name="contactEmailText" class="email form-control" id="inputEmail" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="contactPhoneText">Phone Number (optional):</label><br>
                            <input type="text" name="contactPhoneText" class="mobile-phone form-control" id="inputPhone" placeholder="Phone">
                        </div>
                        <br>

                        <button type="button" class="btn" data-toggle="modal" data-target="#myModal" onclick="populate_preview()">Preview</button>
                        <button type="button" class="btn btn-next">Next <i class="fa fa-angle-right"></i></button>
                    </fieldset>

                    <fieldset>
                        <h4>What category does your information fall into? <span class="step">(Step 2 / 5)</span></h4>
                        <?php echo form_hidden( 'TS', time() ); ?>
                        <div class="selects-1">
                            <p><label required>Select a Category:</label></p>

                                <select class="form-control"  id="selCat" name="selCat_id">
                                    <option value="">Select one</option>
                                    <?php
                                    foreach($categories as $row)
                                    {
                                        echo  "<option value='" . $row->id . "'>" . $row->name ."</option>";
                                    }
                                    ?>
                                </select>
                        </div>
                        <div class="divider-1"></div>
                        <div class="">

                            <table class="table">
                                <tbody>
                                <?php
                                foreach($categories as $row)
                                {
                                    // echo  "<tr><th><label class='radio-inline'><input type='radio' name='radio-buttons-1-options' value='" . $row->id . "'> " . $row->name . "</label></th><td>" . $row->description . "</td></tr>";
                                    echo  "<tr class=\"table-light\"><td><h4>" . $row->name . "</h4></td><td class=\"align-middle\">" . $row->description . "</td></tr>";
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>

                        <br>
                        <button type="button" class="btn btn-previous"><i class="fa fa-angle-left"></i> Previous</button>
                        <button type="button" class="btn" data-toggle="modal" data-target="#myModal" onclick="populate_preview()">Preview</button>
                        <button type="button" class="btn btn-next">Next <i class="fa fa-angle-right"></i></button>
                    </fieldset>


                    <fieldset>
                        <h4>What would you like to tell us about? <span class="step">(Step 3 / 5)</span></h4>
                        <div class="form-group">
                            <label for="briefText" required >Brief Description:</label><br>
                            <textarea name="briefText" class="about-you form-control" id="textBrief"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="detailtext" >Detailed overview of the issue/ interest / idea or impact that you are sharing (optional):</label><br>
                            <textarea name="detailText" class="about-you form-control" id="textFull"></textarea>
                        </div>
                        <div class="divider-1"></div>
                        <div class="selects-1">
                            <p><label required>Does this relate to a particular area?</label></p>

                            <select class="form-control" multiple="multiple" id="estates" name="estates[]">
                                <?php
                                foreach($locations as $row)
                                {
                                    echo  "<option value=" . $row->id . ">" . $row->location ."</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <br>
                        <button type="button" class="btn btn-previous"><i class="fa fa-angle-left"></i> Previous</button>
                        <button type="button" class="btn" data-toggle="modal" data-target="#myModal" onclick="populate_preview()">Preview</button>
                        <button type="button" class="btn btn-next">Next <i class="fa fa-angle-right"></i></button>
                    </fieldset>


                    <fieldset>
                        <h4> <span required>Choose the appropriate terms that help describe this issue:</span> <span class="step">(Step 4 / 5)</span></h4>


                        <?php
                        foreach($themes as $row)
                        {
                            echo  "<h4>".$row->name."</h4>";

                            echo "<div class=\"form-group\"><div id=\"tag_multi_select_" . $row->id . "\" class=\"keyselector\"></div></div>";
                            echo "<div class=\"divider-1\"></div>";
                        }
                        ?>
                        <!--            <div id="tag_multi_select"></div>-->

                        <!--            <button onclick="check_value();">show info</button>-->
                        <div id="info"></div>

                        <input type="hidden" name="keywords" id="keywordArray" />

                        <br>
                        <button type="button" class="btn btn-previous"><i class="fa fa-angle-left"></i> Previous</button>
                        <button type="button" class="btn" data-toggle="modal" data-target="#myModal" onclick="populate_preview()">Preview</button>
                        <button type="button" class="btn btn-next">Next <i class="fa fa-angle-right"></i></button>
                    </fieldset>

                    <fieldset>
                        <h4>Impact, Actions & Next Steps <span class="step">(Step 5 / 5)</span></h4>

                        <div class="form-group">
                            <label for="numAffected">Number of people affected (optional):</label><br>
                            <input type="text" name="numAffected" class="first-name form-control" id="inputAffected" placeholder="Approximately"  onkeypress="return isNumber(event)" >
                        </div>

                        <div class="divider-1"></div>

                        <div class="selects-1">
                            <p><label required>Any actions you would like to suggest?</label></p>
                            <select class="form-control" id="selAct" name="selAct_id">
                                <option value="">Select an action</option>
                                <?php
                                foreach($actions as $row)
                                {
                                    echo  "<option value=" . $row->id . ">" . $row->action_name ."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="divider-1"></div>
                        <div class="form-group">
                            <label for="actionText">Alternative Action (optional):</label><br>
                            <input type="text" name="actionText" class="first-name form-control" id="inputAction" placeholder="Action" >
                        </div>

                        <br>
                        <button type="button" class="btn btn-start"><i class="fa fa-angle-left"></i><i class="fa fa-angle-left"></i> Start</button>
                        <button type="button" class="btn btn-previous"><i class="fa fa-angle-left"></i> Previous</button>
                        <button type="button" class="btn" data-toggle="modal" data-target="#myModal" onclick="populate_preview()">Preview</button>

                    </fieldset>

                    <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">

                            <!-- Modal content-->
                            <div class="modal-content text-white">
                                <div class="modal-header">
                                    <h2 class="modal-title">Your submission preview</h2>
                                </div>
                                <div class="modal-body">
                                    <p>Please take a moment to check your entry. It must include your organisation, the category, a brief description, at least one keyword, and a location. Please try to ensure that neither defamatory remarks nor personal identifiable information are included in any text.</p>

                                    <table class="table no-border">
                                        <tr><td>Your organisation</td><td id="previewOrg"></td></tr>
                                        <tr><td>Information category</td><td id="previewCat"></td></tr>
                                        <tr><td>Brief description</td><td class=" textscroll" id="previewBrief"></td></tr>
                                        <tr><td>Detailed overview</td><td class=" textscroll" id="previewFull"></td></tr>
                                        <tr><td>Number affected</td><td id="previewAffected"></td></tr>
                                        <tr><td>Selected terms</td><td id="previewTerms"><span class='text-danger'>No terms selected.</span></td></tr>
                                        <tr><td>Action</td><td id="previewAct"></td></tr>
                                        <tr><td>Location</td><td id="previewLoc"></td></tr>
                                        <!--                    <tr><td>Age groups</td><td id="previewAge"></td></tr>-->
                                        <tr><td>Contact Details</td><td id="previewContact"></td></tr>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-disabled" id="realSubmitButton">Submit</button>
                                    <button type="button" class="btn" data-dismiss="modal">Close preview</button>
                                </div>
                            </div>

                        </div>
                    </div>




                </form>

            </div>
        </div>
    </div>
</div>





<!-- Javascript -->
<!--<script src="assets/js/jquery-1.11.1.min.js"></script>-->
<!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
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

        var selectedEstates = [];
        var selectedAgeGroups = [];

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

        $("#realSubmitButton").hide();

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

        if($(document.body).height() < $(window).height()){
            $('#footer').css({
                position: 'absolute',
                top:  ( $(window).scrollTop() + $(window).height()
                    - $("#footer").height() ) + "px",
                width: "100%"
            });
        } else {
            $('#footer').css({
                position: 'static'
            });
        }
    });

    </script>


