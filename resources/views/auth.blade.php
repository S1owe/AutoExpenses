<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
function lets(){
    axios({
        method: 'post',
        url: '/login',
        data:
            {
                name:"Andrei12",
                email:"Aleksei22",
                password:"Boba32"
            }
    })
        .then(function (response) {
            console.log(JSON.stringify(response.data));
        })
        .catch(function (error) {
            console.log(JSON.stringify(data.error))
        });
}

</script>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>login</h1>
<button id='yes' onclick="lets()">yes</button>
</body>
</html>
<?php

