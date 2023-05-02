<div class="firstpg">
    <div class="title">
        <b> CRITICAL PATH METHOD </b>
    </div>
    <div class="paragone">
        CPM is a deterministic approach to project management. 
        <br>
        It focuses on identifying the critical path of a project, which is the 
        sequence of activities that determine the project's total duration. 
        <br><br>
        Enter the number of tasks to start:
    </div>

    <center>
        <div class="form">
            <form action="<?= base_url('cpm/proj_details') ?>" method="post">
                <div class="form-group">
                    <label for="InputTask">Number of Tasks:</label>
                    <input type="number" name="proj_len" class="form-control" id="InputTask" aria-describedby="input" placeholder="Max. 20." required>
                </div>
                <div class="form-group">
                    <label for="InputTime">Unit of Time:</label>
                    <select id="InputTime" name="unit" class="form-control" required>
                        <option value="" disabled selected hidden></option>
                        <option value="Days">Days</option>
                        <option value="Weeks">Weeks</option>
                        <option value="Months">Months</option>
                    </select>
                    <!-- <input type="text" name="unit" class="form-control" id="InputTime" placeholder="(e.g. Days, Weeks, Months)" required> -->
                </div>
                <br>

        </div>
    </center>
</div>

<div class="generate">
    <!-- <a class="btn" href="CPMInput.html">Generate Table</a> -->
    <button class="btn">Generate Table</button>
</div>
</form>

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

    .generate {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 2rem;
    }

    .container {
        width: 100%;
    }

    center {
        width: 75%;
        margin-left: 12%;
    }

    .form {
        background-color: #f0f0f0;
        border-radius: 1.2rem;
    }

    .form-group {
        margin: 2rem 5rem;
        text-align: center;
        box-sizing: border-box;

    }

    input,
    select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
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

    .btn:hover {
        background-color: #eeee;
        color: #B19090;

    }

    @media screen {
        .form {
            background-color: #f0f0f0;
            margin: 3rem 10rem 2rem;
            border-radius: 1.2rem;
            padding: 0.25rem;
        }
    }
</style>