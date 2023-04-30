<div class="firstpg">
    <div class="title">
        <b> TRIANGULAR DISTRIBUTION </b>
    </div>
    <div class="paragone">
        Triangular distribution: In a triangular distribution, the probability of an
        event occurring is highest at the most likely value, and decreases as the
        values move away from the most likely value. Triangular distributions are
        often used in scheduler calculators to represent task durations that have a
        range of possible values, but are most likely to fall within a specific range.
        <br><br>
        <!-- Usu nominavi atomorum maluisset ne. Sed ex pertinacia repudiandae, ferri lorem aeque et per. Duo exerci munere an,
        vix malorum diceret fabulas an, nam ei mutat phaedrum. Sed ea timeam suscipiantur, ad eos partem audiam
        adversarium, dicam appetere necessitatibus sed ut. -->
    </div>

</div>
<div class="container" style="overflow-x:auto;">
    <table class="responsive-table highlight centered">
        <tr>
            <td><b>Activity</b></td>
            <td><b>Description</b></td>
            <td><b>Optimistic</b></td>
            <td><b>Most Likely</b></td>
            <td><b>Pessimistic</b></td>
            <td><b>Pre-Requisites</b></td>
        </tr>
        <form action="<?php echo base_url('triangular/calculate') ?>" method="post">
            <?php
            for ($i = 1; $i <= $proj_len; $i++) {
            ?>
                <tr>
                    <td><input type="text" name="<?php echo $i; ?>" value="<?php echo $i; ?>" readonly></td>
                    <td><input type="text" name="task_desc_<?php echo $i; ?>" required></td>
                    <td><input type="number" name="task_opt_<?php echo $i; ?>" step="any" min="1" max="20" required></td>
                    <td><input type="number" name="task_ml_<?php echo $i; ?>" step="any" min="1" max="20" required></td>
                    <td><input type="number" name="task_pes_<?php echo $i; ?>" step="any" min="1" max="20" required></td>
                    <td><?php
                        if ($i == 1) {
                        ?>
                            <input type="text" name="task_prereq_<?php echo $i; ?>" value="-" readonly>
                        <?php
                        } else { ?>
                            <input type="text" name="task_prereq_<?php echo $i; ?>" required>
                        <?php } ?>
                    </td>
                </tr>
            <?php }
            ?>
    </table>
</div>
<input type="number" name="proj_len" value="<?php echo $proj_len; ?>" hidden>
<input type="text" name="choice" value="<?php echo 'cpm'; ?>" hidden>
<input type="text" name="unit" value="<?php echo $unit; ?>" hidden>
<div class="trials">
    Number of Trials: <br><br>
    <input type="number" name="N" min="1" max="10000" placeholder="Max. 1000" required>
</div>
<br>
<div class="calculate">
    <button class="btn">Calculate</button>
</div>
</form>
<style>
    .title {
        font-size: 2rem;
        text-align: center;
        margin: 1rem;
    }

    .paragone {
        font-size: 24px;
        font-style: normal;
        text-align: justify;
        margin: 2rem 5rem;
    }

    .calculate {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 2rem;
    }

    .btn:hover {
        background-color: #eeee;
        color: #B19090;

    }

    .container {
        width: 99rem;
        max-width: 100%;
        margin-left: auto;
        margin-right: auto;
        text-align: center;
    }

    .btn {
        text-decoration: none;
        text-align: center;
        font-size: 1.2rem;
        color: #eeee;
        background-color: #B19090;
        border-radius: 40px;
        display: inline-block;
        padding: 10px 20px;
        border-color: #544141;
    }

    .trials {
        margin: auto;
        min-width: 15rem;
        max-width: 15rem;
        background-color: #eeee;
        padding: 1rem;
        border-radius: 10px;
    }

    /* TABLE */

    .responsive-table {
        margin-top: 3rem;
        margin-bottom: 2rem;
        margin-left: auto;
        margin-right: auto;
        align-items: center;

    }

    table,
    th,
    td {
        border: none;
        border-collapse: collapse;
        border-style: none;
        text-align: center;
        background-color: #eeee;
        /* padding: 5px; */
    }

    td,
    th {
        padding: 8px 5px;
        display: table-cell;
        text-align: center;
        vertical-align: middle;
        border-radius: 0;
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
</style>