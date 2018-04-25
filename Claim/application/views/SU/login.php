
<body>
  <marquee  direction="left" behavior="alternate">
    <h1 id="title" style = font-family:Mistral>Synergic Softek Solutions Pvt. Ltd.</h1>
  </marquee>

	 <div class="login">
			<form method="POST" id="form_login" action="<?php echo site_url("Users/index")?>">  
			    <input type="text" placeholder="Enter Username" name="user_id">
			    <input type="password" placeholder="Enter Password" name="password">
			    <button type="submit" id="cryptstr" class="btn btn-primary btn-block btn-large">Login</button>         
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
        //minlength: 3
      }
    },
    messages: {
      user_id: {
      	required:"Please provide a Username"	//Specify a custom message for required
      },
      password: {
        required: "Please provide a user Password",
        minlength: "Your password must be at least 3 characters long"
      }
    }
    //document.getElementById('pass').value = 100;
  });

var t1="#99ccff";
var t2="#ac00e6";
var t3="#809fff";
var t4="#80ff80";
var text_color = [t1,t2,t3,t4];
var count = 0;              
function changeColor(){
    document.getElementById("title").style.color = text_color[count];
    (count < 4) ? count++ : count = 0;
}
setInterval(changeColor, 250);

function validation($data){
  if($data==1)
  {
    document.getElementById('login').innerHtml='ERROR';
  }
}
</script>

