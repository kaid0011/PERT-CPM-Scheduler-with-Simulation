<!-- Footer -->
<footer>
  <div class="footer">
      <ul>
          <li style="padding: 5px;"><a href="<?= base_url('normal') ?>">Privacy Policy</a></li>
          <li style="padding: 5px;"><a href="<?= base_url('normal') ?>">Cookie Policy</a></a></li>
          <li style="padding: 5px;"><a href="<?= base_url('normal') ?>">Terms & Conditions</a></li>
          <li style="padding: 20px; float: right;">Copyright © 2023 WAPS</li>
      </ul>
  </div>
</footer>

<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>

</body>
</html>

<style>
  /* THEME */
  html 
  {
      font-family: sans-serif;
      background-color: #FFFFFF;
      scroll-behavior: smooth;
      -ms-overflow-style: none; /* IE and Edge */
  }
  
  body{
      margin: 0;
      padding: 0;
      border: 0;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
  }

  header
  {
    top: 0;
    width: 100%;
    position: sticky;
    margin-left: auto;
    margin-right: auto;
  }
  
  img
  {
    width: 50px;
    float: left;
  }
  
  /* Navbar container */
  .navi {
    background-color: #D9D9D9;
  }
  .topnav {
    overflow: hidden;
    background-color: #D9D9D9;
    display: flex;
    justify-content: center;
  }
  
  /* Links inside the navbar */
  .topnav a {
    float: left;
    display: block;
    color: rgb(75, 61, 38);
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
  }
  
  .topnav a:hover {
    background-color: #B19090;
    color: rgb(75, 61, 38);
  }
  
  .topnav .icon {
    display: none;
  }
  
  .homes
  {
    justify-content: left;
    padding: 0 10px;
  }

  /* The dropdown container */
  .dropdown {
    float: left;
    display: block;
    overflow: hidden;
  }
  
  /* Dropdown button */
  .topnav .dropdown .dropbtn {
    font-size: 16px;
    border: none;
    text-align: center;
    justify-content: center;
    align-items: center;
    outline: none;
    color: rgb(75, 61, 38);
    padding: 14px 16px;
    background-color: inherit;
    font-family: inherit; /* Important for vertical align on mobile phones */
    margin: 0; /* Important for vertical align on mobile phones */
  }
  
  /* Add a red background color to navbar links on hover */
  a:hover, .dropdown:hover .dropbtn {
    background-color: #B19090;
  }
  
  /* Dropdown content (hidden by default) */
  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
  }
  
  /* Links inside the dropdown */
  .dropdown-content a{
    float: none;
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
  }
  
  /* Add a grey background color to dropdown links on hover */
  .dropdown-content a:hover {
    background-color: #ddd;
  }
  
  /* Show the dropdown menu on hover */
  .dropdown:hover .dropdown-content {
    display: block;
  }
  
  @media screen and (max-width: 800px) 
  {
    .topnav
    {
      overflow: hidden;
      background-color: #D9D9D9;
      justify-content: right;
    }
    .topnav a, .dropdown
    {
      display: none;
    }
    .topnav a.icon {
      float: right;
      display: flex;
    }

    .footer ul
    {
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      text-align: center;
    }

    .footer ul li
    {
      line-height: 1rem;
    }
  }
  
  @media screen and (max-width: 800px) 
  {
    .topnav.responsive
    {
      position: relative;
      display: grid;
      justify-content: center;
    }
    .topnav.responsive .icon {
      position: absolute;
      right: 0;
      top: 0;
    }
    .topnav.responsive img
    {
      position: absolute;
    }
    .topnav.responsive a, .topnav.responsive .dropdown
    {
      display: block;
      text-align: center;
      justify-content: center;
    }
    .topnav.responsive .dropdown-content
    {
      position: sticky;
      float: none;
    }

    .footer ul
    {
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      text-align: center;
    }

    .footer ul li
    {
      line-height: 1rem;
    }
  }
  
  /* FOOTER */
  footer 
  {
    width: 100%;
    background-color: #EEEEEE;
    position: absolute bottom;
    margin-top: auto;
  }
  
  footer li a
  {
    text-decoration: none;
    display: contents;
  }

  footer ul 
  {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    margin-left: auto;
    margin-right: auto;
  }

  footer li 
  {
  float: left;
  }

  footer li a,
  .dropbtn {
      display: inline-block;
      color: rgb(75, 61, 38);
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
  }

  footer li a:hover,
  .dropdown:hover .dropbtn {
      background-color: #B19090;
      
  }

  footer li .dropdown {
      display: inline-block;
  }
  
  /* EXTRAS */
  ::-webkit-scrollbar 
  {
    width: 10px;
  }
  
  /* Track */
  ::-webkit-scrollbar-track 
  {
    box-shadow: inset 0 0 5px grey;
  }
  
  /* Handle */
  ::-webkit-scrollbar-thumb 
  {
    background: #B19090;
  }
  
  /* Handle on hover */
  ::-webkit-scrollbar-thumb:hover 
  {
    background: #776161;
  }
  @media screen and (max-width: 800px) 
  {

    .footer ul
    {
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      text-align: center;
    }

    .footer ul li
    {
      line-height: .1rem;
      font-size: .8em;
    }
  }

  </style>