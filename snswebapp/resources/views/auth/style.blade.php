<style>
.login-container {
    width: 638px;
    height: 100%;
    min-height: 300px;
    margin: auto auto auto auto;
    border-radius: 5px;
    background: {{$settings['background_color']}};
    border: solid 1px {{$settings['border_color']}};
}

form {
    padding: 5px 0 5px 0;
    display: grid;
}

input {
    margin: 5px;
}

.text-danger {
    margin: 0 5px 0 5px;
}

.subject {
    text-align: center;
    border: 0px;
}

input[type = "submit"] {
    margin: 10px 0 0 0;
}

.text {
    font-size: small;
}

@media (max-width: 638px) {
    .login-container {
        width: 100%;
        max-width: 430px;
        min-height: 600px;
        background-image: url(/images/login/{{$settings['login_file_name']}});
        background-repeat: no-repeat;
        background-size: cover;
        opacity: 0.9;
    }
}

@media (max-width: 432px) {
    body {
        padding: 0px;
        height: 100%;
    }
    .login-container {
        background-size: fill;
        height: 100%;
    }
}

</style>
