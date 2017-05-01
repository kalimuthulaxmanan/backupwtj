<!DOCTYPE html>
<html>
<head>
<style>
div.container {
    width: 500px;
    border: 1px solid gray;
    margin: 0 auto;
}

header, footer {
    padding: 0em;
    color: white;
    background-color: #9c63bf;
    clear: left;
    text-align: center;
}

header h1{
margin:0;
padding: 10px 0;

}

footer {
margin:0;
padding: 5px 0;

}

.forget{
    font-size: 24px;
    color: #000;
    text-align: center;
    border: 1px solid #ccc;
    margin: 0 30px;
    padding: 5px;
}


article{
    padding: 1em 3em;
    overflow: hidden;
}
</style>
</head>
<body>

<div class="container">

<header>
   <h1>Password Reset to WTJ</h1>
</header>

<article>
  <h1>Hi,</h1>
  <p>We got a request to reset your WTJ password</p>

 <div class="forget">Password : {{ $password }}</div>
  <p>if you ignore this message, your password won't be changed. </p>
  <p> if you didn't request a password reset, Please leave it</p>
</article>

<footer>Copyright &copy; Kenhike.com</footer>

</div>

</body>
</html>