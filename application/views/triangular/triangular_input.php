<div class="inputpg">
    <div class="body-container">
        <div class="firstpg">
            <div class="title">
                <h1>Triangular Distribution</h1>
            </div>
            <div class="paragone">
                <div class="description">
                    <p>Triangular distribution: In a triangular distribution, the probability of an
                        event occurring is highest at the most likely value, and decreases as the
                        values move away from the most likely value. Triangular distributions are
                        often used in scheduler calculators to represent task durations that have a
                        range of possible values, but are most likely to fall within a specific range.
                    </p>
                </div>
                <div class="howto">
                    <h2> How To?</h2>
                    <ul>
                        <li>
                            <p>For each activity, enter the description, durations (optimistic, most likely, and pessimistic), and its
                                pre-requisite/s.</p>
                        </li>
                        <li>
                            <p>After completing the table, click 'Calculate' to schedule your project. A table will show the following
                                information for your project: <i> Activity, Description, Three Durations, Pre-Requisites, Earliest Start Time, Earliest Finish Time, Latest Start Time, Latest Finish Time, Slack, and Critical</i></p>
                        </li>
                        <li>
                            <p>After generating the results of your input, you will have a choice to download an Excel file containing all the simulation results by clicking on "Export Results" or "Export Simulation Values"</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="grid-container">
            <div class="tablecontainer" style="overflow-x:auto;">
                <table class="results">
                    <thead>
                        <tr>
                            <th>Activity</th>
                            <th title="Activity Description">Description <span class="tooltiptext">&#9432;</span></th>
                            <th title="Shortest Estimated Activity Duration">Optimistic <span class="tooltiptext">&#9432;</span></th>
                            <th title="Reasonable Estimated Activity Duration">Most Likely <span class="tooltiptext">&#9432;</span></th>
                            <th title="Maximum Estimated Activity Duration">Pessimistic <span class="tooltiptext">&#9432;</span></th>
                            <th title="Activity Number that needs to be completed first.">Pre-Requisites <span class="tooltiptext">&#9432;</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="<?php

                                        use PhpParser\Node\Expr\AssignOp\Div;

                                        echo base_url('triangular/calculate') ?>" method="post">
                            <?php
                            for ($i = 1; $i <= $_SESSION['proj_len']; $i++) {
                            ?>
                                <tr>
                                    <td><input type="text1" name="<?php echo $i; ?>" value="<?php echo $i; ?>" readonly></td>
                                    <td><input type="text" name="task_desc_<?php echo $i; ?>"></td>
                                    <td><input type="number" name="task_opt_<?php echo $i; ?>" id="task_opt_<?php echo $i; ?>" step="any" min="1" max="100" placeholder="Max. 100" onchange="check_opt(this)" required></td>
                                    <td><input type="number" name="task_ml_<?php echo $i; ?>" id="task_ml_<?php echo $i; ?>" step="any" min="1" max="100" placeholder="Max. 100" onchange="check_ml(this)" required></td>
                                    <td><input type="number" name="task_pes_<?php echo $i; ?>" id="task_pes_<?php echo $i; ?>" step="any" min="1" max="100" placeholder="Max. 100" onchange="check_pes(this)" required></td>
                                    <td><?php
                                        if ($i == 1) {
                                        ?>
                                            <input type="text" name="task_prereq_<?php echo $i; ?>" value="-" readonly>
                                            <?php
                                        } else {
                                            $x = $i - 1;
                                            if ($i <= 10) {
                                            ?>
                                                <input type="text" name="task_prereq_<?php echo $i; ?>" pattern="[1-<?php echo $x; ?>](,[1-<?php echo $x; ?>])*|^[\-]" oninvalid="this.setCustomValidity('Enter Valid Activity ID')" onchange="this.setCustomValidity('')" required>
                                            <?php
                                            } else if ($i > 10) {
                                                $y = $i - 11;
                                            ?>
                                                <input type="text" name="task_prereq_<?php echo $i; ?>" pattern="([1-9]|1[0-<?php echo $y; ?>])(,([1-9]|1[0-<?php echo $y; ?>]))*|^[\-]" oninvalid="this.setCustomValidity('Enter Valid Activity ID')" onchange="this.setCustomValidity('')" required>
                                        <?php }
                                        } ?>
                                    </td>
                                </tr>
                            <?php }
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <input type="number" name="proj_len" value="<?php echo $_SESSION['proj_len']; ?>" hidden>
        <input type="text" name="choice" value="<?php echo 'cpm'; ?>" hidden>
        <input type="text" name="unit" value="<?php echo $_SESSION['unit']; ?>" hidden>
        <div class="trials">
            <strong>Number of Trials:</strong>
            <input type="numbers" name="N" min="1" max="1000" oninput="validity.valid||(value='');" placeholder="Max. 1000" required>
        </div>
        <br>
        <div class="calculate">
            <button class="btn">Calculate</button>
        </div>
        </form>

        <div class="mustknow">
            <h2>Must Know!</h2>
            <div class="mustknow-desc">
                <h5>Activity</h5>
                <ul>
                    <li>
                        <p>The activity column is auto iterated from 1 by the system and cannot be changed.</p>
                    </li>
                </ul>
                <h5>Description</h5>
                <ul>
                    <li>
                        <p>Description of each activity with a maximum of 50 characters.</p>
                    </li>
                    <li>
                        <p>This is an optional input.</p>
                    </li>
                </ul>
                <h5>Optimistic</h5>
                <ul>
                    <li>
                        <p>The minimum amount of time required to finish a task, assuming that the progress is faster than the typical expectations.</p>
                    </li>
                    <li>
                        <p>Optimistic duration must be a positive integer.</p>
                    </li>
                    <li>
                        <p>Decimals are accepted.</p>
                    </li>
                </ul>
                <h5>Most Likely</h5>
                <ul>
                    <li>
                        <p>The expected duration for completing a task, assuming that progress is in accordance with standard expectations.</p>
                    </li>
                    <li>
                        <p>Most Likely duration must be a positive integer.</p>
                    </li>
                    <li>
                        <p>Decimals are accepted.</p>
                    </li>
                </ul>
                <h5>Pessimistic</h5>
                <ul>
                    <li>
                        <p>The maximum amount of time required to complete a task, assuming everything that could possibly go wrong, actually goes wrong.</p>
                    </li>
                    <li>
                        <p>Pessimistic duration must be a positive integer.</p>
                    </li>
                    <li>
                        <p>Decimals are accepted.</p>
                    </li>
                </ul>
                <h5>Pre-requisites</h5>
                <ul>
                    <li>
                        <p>The activity/s that must be completed before the current activity starts. </p>
                    </li>
                    <li>
                        <p>Pre-requisites of each activity must be existing activity numbers separated by commas without spaces.</p>
                    </li>
                    <li>
                        <p>If there are no pre-requisites, enter '-'. The first activity's pre-requisite is automatically set to '-'.</p>
                    </li>
                </ul>
            </div>
        </div>
        <section class="collapsible">
            <input type="checkbox" name="collapse" id="handle1" checked="checked">
            <h2 class="handle">
                <label for="handle1">How WAPS' Triangular Distribution Works:</label>
            </h2>
            <div class="content">
                <div class="triangular">
                    <p><strong>Step 1:</strong> Identifies all the activities involved in the project and arranges them in a logical sequence using their Activity IDs.</p>
                    <p><strong>Step 2:</strong> Determines the 3 durations: optimistic (a), most likely (m), and pessimistic (b), which are the estimated times
                        provided by the user for each activity that are required to complete the activities.</p>
                    <p><strong>Step 3:</strong> Assigns a random value to a variable r using the random()function that randomly selects a value which was set from 0.0 to 1.0. This value undergoes the Monte Carlo Simulation to achieve a more accurate result. The number of trials is based on the user's input.</p>
                    <center>
                        <p><i>r = random()</i></p>
                    </center>
                    <p><strong>Step 4:</strong> Determines what formula should be used based on a conditional statement:</p>
                    <div class="where1">
                        <p>If r < (m-a) / (b-a), <i>assign the following to their own variables:</i></p>
                        <div class="func-desc">
                            <p>x = 1;</p>
                            <p>y = -2a;</p>
                            <p>z = a<sup>2</sup> - r (m - a) (b - a);</p>
                            <p>Then, compute the duration (T) using the formula:</p>
                        </div>
                        <img src="<?= base_url('assets/images/tria_1.png') ?>">
                        <p>Else:</p>
                        <div class="func-desc">
                            <p>x = 1;</p>
                            <p>y = -2b;</p>
                            <p>z = b<sup>2</sup> - (1 - r) (b - a) (b - m);</p>
                            <p>Then, compute the duration (T) using the formula:</p>
                        </div>
                        <img src="<?= base_url('assets/images/tria_2.png') ?>">
                    </div>
                    <p><strong>Step 5:</strong> Identifies the pre-requisites of each activity, which must be completed before another activity starts.</p>
                    <p><strong>Step 6:</strong> Performs a Forward Pass.</p>
                    <ol type="a">
                        <li>
                            <p>Forward Pass starts with the first activity, to determine the Early Start Time (ES) and Early Finish Time (EF) for each activity.</p>
                        </li>
                        <li>
                            <p>For each activity, WAPS calculates the ES by adding the duration of the preceding activity to its ES. If an activity has more than one predecessor, the predecessor to be added is the highest one. For the first activity, the ES is equal to 0.</p>
                        </li>
                        <li>
                            <p>Then, calculates the EF by adding the duration of the activity to its ES.</p>
                        </li>
                        <center>
                            <p><i>EF = ES + T</i></p>
                        </center>
                        <li>
                            <p>This process continues until the ES and EF have been calculated for all activities.</p>
                        </li>
                        <li>
                            <p>Identifies the slack of each activity to know the critical path, which is the sequence of activities that has the longest duration and has slack equals to 0.</p>
                        </li>
                    </ol>
                    <p><strong>Step 7:</strong> Performs a Backward Pass.</p>
                    <ol type="a">
                        <li>
                            <p>Backward Pass starts with the last activity, to determine the Latest Start Time (LS) and Latest Finish Time (LF) for each activity.</p>
                        </li>
                        <li>
                            <p>For each activity, WAPS calculates the LF by subtracting the duration of the following activity from its LS. If an activity has more than one successor, the successor to be added is the lowest one. If just starting with the Backward Pass, the duration should be subtracted to the Project Completion Time (PCT).</p>
                        </li>
                        <li>
                            <p>Then, calculates the LS by subtracting the duration of the activity from its LF. This process continues until the LS and LF have been calculated for all activities in the network.</p>
                        </li>
                        <center>
                            <p><i>LS = LF - T</i></p>
                        </center>
                        <li>
                            <p>Calculates the slack (S) for each activity by subtracting the activity's EF from its LF or ES from its LS. If S isequal to zero, the activity is a critical value and completes the critical path.</p>
                        </li>
                        <li>
                            <p>Uses the ES, EF, LS, LF, and S values to identify the project's Critical Path and determine the shortest possible time required to complete the project.</p>
                        </li>
                    </ol>
                    <p><strong>Step 8:</strong> Uses the Earliest Start Time (ES) and Latest Finish Time (LF) of each activity to create a Gantt Chart. The darker colored bars represent the critical values which complete the Critical Path.</p>
                </div>
            </div>
        </section>
    </div>
</div>
<script>
    function check_opt(opt) {
        var opt = opt;
        if (!opt.validity.valid) {
            opt.value = "";
        }
    }

    function check_ml(ml) {
        var ml = ml;
        var ml_id = ml.id;
        ml_id = ml_id.substr(8);
        if (!ml.validity.valid) {
            ml.value = "";
        } else {
            var optv = document.getElementById("task_opt_" + ml_id).value;
            var mlv = Number(ml.value);
            optv = Number(optv);
            if(mlv < optv) {
                alert('Most Likely should be equal to or greater than Optimistic.');
                ml.value = "";
            }
        }
    }

    function check_pes(pes) {
        var pes = pes;
        var pes_id = pes.id;
        pes_id = pes_id.substr(9);
        if (!pes.validity.valid) {
            pes.value = "";
        } else {
            var mlv = document.getElementById("task_ml_" + pes_id).value;
            var pesv = Number(pes.value);
            mlv = Number(mlv);
            if(pesv < mlv) {
                alert('Pessimistic should be equal to or greater than Most Likely and Optimistic.');
                pes.value = "";
            }
        }
    }
</script>