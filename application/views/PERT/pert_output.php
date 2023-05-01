<div class="firstpg">
    <div class="title">
        <b> Project Evaluation Review Technique (PERT)</b>
    </div>
    <div class="paragone">
    PERT uses a probabilistic approach to determine the project's critical path and the probability of 
      completing the project within a specific timeframe.
      <br><br>
      This table shows the project time completion based on the data provided using the PERT Method:
    </div>
</div>
<div class="grid-container">
      <div class="container" style="overflow-x:auto;">
      <table class="table">
            <thead>
                <tr>
                    <th>Activity</th>
                    <th>Description</th>
                    <th>Optimistic</th>
                    <th>Most Likely</th>
                    <th>Pessimistic</th>
                    <th>Estimated Duration</th>
                    <th>Pre-Requisites</th>
                    <th>Standard Deviation</th>
                    <th>Variance</th>
                    <th>ES</th>
                    <th>EF</th>
                    <th>LS</th>
                    <th>LF</th>
                    <th>Slack</th>
                    <th>Critical</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($project as $task) {
                ?>
                    <tr>
                        <td><?php echo $task['id']; ?></td>
                        <td><?php echo $task['desc']; ?></td>
                        <td><?php echo $task['opt'] . " " . $task['unit']; ?></td>
                        <td><?php echo $task['ml'] . " " . $task['unit']; ?></td>
                        <td><?php echo $task['pes'] . " " . $task['unit']; ?></td>
                        <td>
                            <?php echo round($task['time'], 2) . " " . $task['unit']; ?>
                            <input type="number" name="m" id="m_<?php echo $task['id']; ?>" value="<?php echo round($task['time'], 2); ?>" hidden>
                        </td>
                        <td><?php
                            $pre = implode(",", $task['prereq']);
                            if ($pre == '-1') {
                                $pre = '-';
                            }
                            echo $pre;
                            ?></td>
                        <td>
                            <?php echo round($task['sd'], 2); ?>
                            <input type="number" name="s" id="s_<?php echo $task['id']; ?>" value="<?php echo round($task['sd'], 2); ?>" hidden>
                        </td>
                        <td><?php echo round($task['v'], 2); ?></td>
                        <td><?php echo round($task['es'], 2); ?></td>
                        <td><?php echo round($task['ef'], 2); ?></td>
                        <td><?php echo round($task['ls'], 2); ?></td>
                        <td><?php echo round($task['lf'], 2); ?></td>
                        <td><?php echo round($task['slack'], 2); ?></td>
                        <td><?php echo $task['isCritical']; ?></td>
                    </tr>
                <?php
                }
                ?>
        </table>
        <h4>Critical Path:
            <?php
            $max = max(array_column($cp, 'id'));
            foreach ($cp as $cp) {
                if ($cp['id'] == $max) {
                    echo $cp['id'];
                } else {
                    echo $cp['id'] . "-";
                }
            }
            ?>
        </h4>
        <h4>Project Completion Time: <?php echo $finish_time; ?></h4>
        <h4>Project Variance: <?php echo round($proj_variance, 2); ?></h4>
        <h4>Project Standard Deviation: <?php echo round($proj_sd, 2); ?></h4>

        <!-- Probability of Project Completion by Given Date -->
        <h3>Compute Project Completion Probability</h3>
        <label for="pcg">Enter expected project duration: </label>
        <input type="number" name="x" id="x" required>
        <input type="number" name="m" id="m" value="<?php echo round($finish_time, 2); ?>" hidden>
        <input type="number" name="s" id="s" value="<?php echo round($proj_sd, 2); ?>" hidden>
        <button id="compute" class="compute">Calculate</button>
        <br><label for="p">Probability of completion: </label>
        <input type="textp" name="p" id="p" readonly>

        <!-- Probability of Individual Task Completion Completion by Given Date -->
        <h3>Compute Individual Task Completion Probability</h3>
        <label for="id">Enter Task ID: </label>
        <input type="number" name="tid" id="tid">
        <label for="x_indiv">Enter expected task duration: </label>
        <input type="number" name="x_indiv" id="x_indiv">
        <button id="compute_indiv" class="compute_indiv">Calculate</button>
        <br><label for="p">Probability of completion: </label>
        <input type="textp" name="p_indiv" id="p_indiv" readonly>
        </tbody>
        </table>
        <div class="calculate">
        <!-- <a class="btn" href="CPMOutput.html">Calculate</a> -->
        <button class="btn">Calculate</button>
    </div>
    </div>
    <!-- <div class="grid-item">

    </div> -->
</div>

<!-- CARDS 1 -->
<div class="containerbox">
        <div class="boxx">
            <h3>Critical Path</h3>
            <h3>Project Finish Time</h3>
        </div>

        <div class="boxx">
            <h3>Project Variance</h3>
            <h3>Project Standard Deviation</h3>
        </div>
</div>

<!-- BUTTON -->
<div class="calculate">
        <!-- <a class="btn" href="CPMOutput.html">Calculate</a> -->
        <button class="btn">Export to CSV</button>
</div>

<!-- EXPLANATION -->
<div class="paragone">
    Lorem ipsum dolor sit amet, no clita veritus maiestatis vim, est illum consetetur no. Agam modus an vel. Nibh
    feugiat pericula id eam. Sit aliquam platonem omittantur ut, eum meliore offendit at. Suas alienum at per, ad sit
    exerci vocent docendi, te sea summo feugait. At vim cibo accumsan mnesarchum.
    <br><br>
    Usu nominavi atomorum maluisset ne. Sed ex pertinacia repudiandae, ferri lorem aeque et per. Duo exerci munere an,
    vix malorum diceret fabulas an, nam ei mutat phaedrum. Sed ea timeam suscipiantur, ad eos partem audiam
    adversarium, dicam appetere necessitatibus sed ut.
</div>

<!-- CARDS 2 -->
<div class="containerbox2">
        <div class="boxx2">
            <h3 id="two">Expected Project Duration</h3>
            <!-- BUTTON -->
            <div class="calculate">
                    <!-- <a class="btn" href="CPMOutput.html">Calculate</a> -->
                    <button class="btn">Calculate</button>
            </div>
            <h3 id="two">Probability of Completion</h3>
        </div>

        <div class="boxx2">
            <h3 id="two">Task ID: </h3>
            <h3 id="two">Expected Project Duration: </h3>
            <!-- BUTTON -->
            <div class="calculate">
                    <!-- <a class="btn" href="CPMOutput.html">Calculate</a> -->
                    <button class="btn">Calculate</button>
            </div>
            <h3 id="two">Probability of Completion</h3>
        </div>
</div>

<!-- CHART -->
<div class="container" style="max-width: 100%; margin: 0 auto; padding: 50px;">
       <div class="chart" style="display: grid; border: 2px solid #000; position: relative; overflow: hidden;">

           <div class="chart-row chart-period">
               <div class="chart-row-item"></div>
               <!-- loop according to project completion time -->
               <?php
                for ($col = 1; $col <= $finish_time; $col++) { ?>
                   <span><?php echo $col; ?></span>
               <?php } ?>
           </div>

           <div class="chart-row chart-lines">
               <!-- loop according to project completion time -->
               <?php
               //$finish_time += 1;
                for ($col = 1; $col <= $finish_time; $col++) { ?>
                   <span></span>
               <?php } ?>
           </div>

           <?php
            $qty -= 1;
            foreach ($project as $task) { ?>
               <div class="chart-row">
                   <div class="chart-row-item"><?php echo "Activity " . $task['id']; ?></div>
                   <ul class="chart-row-bars">
                       <li class="" style="grid-column: <?php echo $task['es']+1; ?>/<?php echo $task['lf']+1; ?>; background-color: #588BAE;"><?php echo $task['desc']; ?></li>
                   </ul>
               </div>
           <?php } ?>
       </div>
   </div>

<style>
    .title {
        font-size: 2rem;
        text-align: center;
        margin: 1rem;
    }

    .paragone {
        font-size: 20px;
        font-style: normal;
        text-align: center;
        margin: 2rem 10rem;
    }

    .calculate {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 2rem;
    }

    .grid-container
    {
        display: grid;
        max-width: 100%;
        text-align: center;
        margin-top: -30px;
    }

    .container
    {
        width: 99rem;
        max-width: 100%;
        margin-left: auto;
        margin-right: auto;
        text-align: center;
    }


    .btn {
        text-decoration: none;
        text-align: right;
        font-size: 1.2rem;
        color: #eeee;
        background-color: #B19090;
        border-radius: 40px;
        display: inline-block;
        padding: 10px 20px;
        border-color: #544141;
    }

    .btn:hover {
        background-color: #eeee;
        color: #B19090;

    }

    /* TABLE */
    table {
        margin-top: 3rem;
        margin-bottom: 2rem;
        margin-left: auto;
        margin-right: auto;
        align-items: center;
        border-spacing: 0;
        padding: 2vh 3vh;
    }

    table,
    th,
    td 
    {
        border: none;
        border-collapse: collapse;
        border-style: none;
        text-align: center;
        background-color: transparent;
        /* padding: 5px; */
    }

    td,
    th 
    {
        padding: 8px 5px;
        display: table-cell;
        text-align: center;
        vertical-align: middle;
        border-radius: 0;
    }

    textarea
    {
        background-color: transparent;
        border: 2px solid;
        border-radius: 10px;
        padding: 3px;
        resize: none;
        margin: 5px;
    }

    input[type=text1]
    {
        border-style: none;
        text-align: center;
    }

    input[type=textp]
    {
        border-style: none;
        text-align: center;
    }

    input
    {
        background-color: transparent;
        border-radius: 10px;
        padding: 5px;
    }

    /* Cards */
    .containerbox {
        justify-content: space-evenly;
        display: flex;
        width: auto;
        height: auto;
    }

    .boxx {
        width: 30%;
        height: auto;
        padding: 3px 2px 25px 2px;
        border: 1px solid #ccc;
        margin: 5vh;
        background: white;
        border-radius: 10px;
        transition: 0.9;
    }

    .boxx:hover {
        box-shadow: 0 0 11px rgba(33, 33, 33, 0.5);
        cursor: pointer;
    }

    .containerbox2 {
        justify-content: space-evenly;
        display: flex;
        width: auto;
        height: auto;
    }

    .boxx2 {
        width: 30%;
        height: auto;
        padding: 3px 2px 25px 2px;
        border: 1px solid #ccc;
        margin: 5vh;
        background: white;
        border-radius: 10px;
        transition: 0.9;
    }

    .boxx2:hover {
        box-shadow: 0 0 11px rgba(33, 33, 33, 0.5);
        cursor: pointer;
    }

    #two
    {
        font-size: 20px;
        padding: 5px 5px;
        text-align: left;
        color: rgb(104, 92, 92);
    }

    h3 {
        font-size: 20px;
        padding: 5px 5px;
        text-align: center;
        color: rgb(104, 92, 92);
    }

    p {
        font-size: 18px;
        padding: 5px;
        text-align: center;
    }

    /* RESPONSIVE */
    @media screen {
        .form {
            background-color: #f0f0f0;
            margin: 3rem 10rem 2rem;
            border-radius: 1.2rem;
            padding: 0.25rem;
        }
    }

    .chart {
           display: grid;
           border: 2px solid #000;
           position: relative;
           overflow: hidden;
       }

       .chart-row {
           display: grid;
           grid-template-columns: 80px 1fr;
           background-color: #DCDCDC;
       }

       .chart-row:nth-child(odd) {
           background-color: #C0C0C0;
       }

       .chart-period {
           color: #fff;
           background-color: #708090 !important;
           border-bottom: 2px solid #000;
           grid-template-columns: 50px repeat(12, 1fr);
       }

       .chart-lines {
           position: absolute;
           height: 100%;
           width: 100%;
           background-color: transparent;
           grid-template-columns: 80px repeat(12, 1fr);
       }

       .chart-period>span {
           text-align: center;
           font-size: 13px;
           align-self: center;
           font-weight: bold;
           padding: 15px 0;
       }

       .chart-lines>span {
           display: block;
           border-right: 1px solid rgba(0, 0, 0, 0.3);
       }

       .chart-row-item {
           background-color: #808080;
           border: 1px solid #000;
           border-top: 0;
           border-left: 0;
           padding: 20px 0;
           font-size: 15px;
           font-weight: bold;
           text-align: center;
           width: 80px;
       }

       .chart-row-bars {
           list-style: none;
           display: grid;
           padding: 15px 0;
           margin: 0;
           grid-template-columns: repeat(12, 1fr);
           grid-gap: 10px 0;
           border-bottom: 1px solid #000;
       }

       ul .chart-li-one {
        grid-column: 1/2;
        background-color: #588BAE;
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- AJAX for Project Completion Probability -->
<script>
    $(document).ready(function() {
        $(".compute").click(function() {
            var x = $("#x").val();
            var m = $("#m").val();
            var s = $("#s").val();

            $.ajax({
                url: "<?php echo base_url(); ?>Probability/compute",
                type: "post",
                dataType: "json",
                data: {
                    x: x,
                    m: m,
                    s: s
                },
                success: function(data) {
                    if (data.response == "success") {
                        // alert(data.p);
                        $('#p').val(data.p);
                    } else {
                        alert("Calculate failed");
                    }
                }
            });
        });
    });
</script>
<!-- AJAX for Individual Task Completion Probability -->
<script>
    $(document).ready(function() {
        $(".compute_indiv").click(function() {
            var id = $("#tid").val();
            var x = $("#x_indiv").val();
            var m = $("#m_" + id).val();
            var s = $("#s_" + id).val();

            $.ajax({
                url: "<?php echo base_url(); ?>Probability/compute",
                type: "post",
                dataType: "json",
                data: {
                    x: x,
                    m: m,
                    s: s
                },
                success: function(data) {
                    if (data.response == "success") {
                        // alert(data.p);
                        $('#p_indiv').val(data.p);
                    } else {
                        alert("Calculate failed");
                    }
                }
            });
        });
    });
</script>