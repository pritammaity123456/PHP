 <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
<body>
  <nav class="navbar navbar-inverse" style="background: #595959;">
  <div class="container-fluid">
    <div class="col-md-2">
      <li>
      <a class="img-fluid align-items-center" href="">
              <img class="img-responsive" src="http://www.synergicsoftek.in/wp-content/themes/Untitled/images/15b27e558a936f5a396a0ce89553abc5_ssslogonew.png" alt="Cooperative Banking Software">
          </a>
    </li>
    </div>
    <div class="col-md-8">
      <li>
       <h1 style="text-align: center; font-family:Monotype Corsiva; color:white;">SYNERGIC SOFTEK SOLUTIONS PVT. LTD.</h1>
      <h3 style="text-align: center; font-family:Monotype Corsiva; color:white;">55 D, DESAPRAN SASHMAL ROAD</h3>
      <h3 style="text-align: center; font-family:Monotype Corsiva; color:white;">KOLKATA-33</h3>
    </li>
    </div>
  </div>
</nav>

	 <div class="login">
			<form method="post" action="<?php echo site_url("Users/index")?>">  
        <div class="group">
          <input type="text" name="user_id" required><span class="highlight"></span><span class="bar"></span>
        <label>User Id</label>
        </div>
        <div class="group">
          <input type="password" name="password" id="strex" required><span class="highlight"></span><span class="bar"></span>
          <label>Password</label>
        </div>
        <button type="submit" id="cryptstr" class="button buttonBlue"> <span class="glyphicon glyphicon-log-in"></span> Login <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div></button>
			</form> 
	 </div>
</body>

	 <script>
  $("#form_login").validate({
    rules: {
      user_id: {
      	required:true	//Adding the Rule Required
      },
      password: {
        required: true,
      }
    },
    messages: {
      user_id: {
      	required:"Please specify User id"	//Specify a custom message for required
      },
      password: {
        required: "Please provide a Password",
      }
    }
  });


</script>

