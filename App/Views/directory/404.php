<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <style type="text/css">
       body{
    margin: 0;
    padding: 20px;
    background-color:#66e0ff;
    font-family: arial;
  height: 800px
}

.box{
    text-align: center;
    position: relative;
}

.box div{
    width: 250px;
    height: 80px;
    line-height: 80px;
    color:#ffc900;
    background-color: #fff;
    font-size: 280%;
    position: absolute;
    top:490px;
    left:40%;
    text-transform: capitalize;
    animation: moving 8s linear infinite;
  -webkit-animation: moving 8s linear infinite;
  -moz-animation: moving 8s linear infinite;
  -o-animation: moving 8s linear infinite;
  
    transform-origin: 50% -400%;
  -webkittransform-origin: 50% -400%;
  -moz-transform-origin: 50% -400%;
  -o-transform-origin: 50% -400%;
}

.box div:before{
    content: "";
    width: 25px;
    height: 25px;
    background-color:#fff;
    border-radius: 50%;
    display: block;
    position: absolute;
    left:45%;
    top:-350px;
}

.box div:after{
    content: "";
    width: 3px;
    height: 335px;
    background-color: #fff;
    display: block;
    position: absolute;
    left: 50%;
    top: -330px;
}

.box p{
    position: absolute;
    top:560px;
    left:38%;
    font-weight: 700;
    text-transform: uppercase;
  color:#fff;
  width: 300px
}

.box p span{
  display: block;
  font-size:300%
}

@keyframes moving{
    0%,100%{
        transform: rotate(0)
    }
    25%{
        transform: rotate(3deg);
    }
    50%{
        transform: rotate(-3deg)
    }
}

@-webkit-keyframes moving{
    0%,100%{
        transform: rotate(0)
    }
    25%{
        transform: rotate(3deg);
    }
    50%{
        transform: rotate(-3deg)
    }
}

@-moz-keyframes moving{
    0%,100%{
        transform: rotate(0)
    }
    25%{
        transform: rotate(3deg);
    }
    50%{
        transform: rotate(-3deg)
    }
}

@-o-keyframes moving{
    0%,100%{
        transform: rotate(0)
    }
    25%{
        transform: rotate(3deg);
    }
    50%{
        transform: rotate(-3deg)
    }
}
    </style>

<div class="box">
    <div>
         OOPS !
    </div>
    <p><span>error 404 !</span> La page que vous cherchez n'existe pas </p>
    <p style="position:relative;top:700px;left: 70%;"><a href=""><a href="<?= $url; ?>accueil">Page d'Accueil</a></p>
</div>
</body>
</html>

