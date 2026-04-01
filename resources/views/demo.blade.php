<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Welcome in demo Page</h2>
    <input type="text" name="name" id="name" placeholder="enter your name..."><br><br>
    <button class="press" type="button">Press ME</button>
    <div id="hide-me">
        <h2>jadu dekhoge press buttton</h2>
    </div>
    <div id="nahi-dikha">
        <h2>ab dekho</h2>
    </div>
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $("#nahi-dikha").hide();
    
    $(document).ready(function(){
        $(".press").on('click', function(){
            $("#hide-me").hide();
            $("#nahi-dikha").show();
        });
    });
</script>
