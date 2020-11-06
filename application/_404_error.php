<html>
<head>
    <title>404 page not found</title>
    <style>
        .container{
            text-align: center;
            position: absolute;
            top: 50%;
            left: 50%;
            margin-top: -50px;
            margin-left: -50px;
            border: 5px;border: solid 2px maroon;
            padding: 16px;
        }
        .caption{
            width: 128px;
            height: 128px;
        }

    </style>
</head>
<body>
<div class="container">
    <div class="error">
        <div class="err-img">
            <img  class="caption" src="<?= $this ->host?>assets/app/img/404.png">
            <h3>page not found</h3>
        </div>
    </div>
    <div class="action-buttons">
        <a href="<?=$this->host?>"> Home</a>
    </div>
</div>

</body>
</html>