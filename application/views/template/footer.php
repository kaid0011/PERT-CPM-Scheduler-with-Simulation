<!-- Footer -->
<footer>
    <div class="footer">
        <ul>
            <li style="padding: 10px;">Privacy Policy</li>
            <li style="padding: 10px;">Cookie Policy</li>
            <li style="padding: 10px;">Terms & Conditions</li>
            <li style="padding: 10px;float: right;">Copyright © 2023 WAPS</li>
        </ul>
    </div>
</footer>

<script type="text/javascript" src="js/materialize.min.js"></script>
</body>

</html>
<style>
    html {
        font-family: sans-serif;
        background-color: #FFFFFF;
        scroll-behavior: smooth;
        -ms-overflow-style: none;
        /* IE and Edge */

    }

    body {
        margin: 0;
        padding: 0;
        padding-top: 60px;
        padding-bottom: 40px;
        border: 0;
        height: 100%;


    }


    /* .containers
{
    min-height: 100vh;
    height: auto !important;
    height: 100%;
    margin: 0 auto;
} */

    /* Navigation */
    header {
        top: 0;
        width: 100%;
        position: fixed;
        margin-left: auto;
        margin-right: auto;
    }

    .navi {
        background-color: #D9D9D9;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }


    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
    }

    li {
        float: left;
    }


    li a,
    .dropbtn {
        display: inline-block;
        color: rgb(75, 61, 38);
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    li a:hover,
    .dropdown:hover .dropbtn {
        background-color: #B19090;
        ;
    }

    li.dropdown {
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
        font-size: 1rem;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: left;
    }

    .dropdown-content a:hover {
        background-color: #f1f1f1;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    /* Footer */
    footer {
        position: absolute;
        left: 0;
        bottom: 0;
        height: auto;
        width: 100%;
    }

    .footer {
        width: 100%;
        position: fixed;
        padding: 1px 0;
        bottom: 0;
        width: 100%;
        margin: 2rem 0rem 0rem;
        background-color: #EEEEEE;
    }


    /* EXTRAS */
    ::-webkit-scrollbar {
        width: 10px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px grey;

    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #B19090;

    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #776161;
    }
</style>