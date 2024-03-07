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
    body {
        padding: 0;
        height: 100vh;
        background: #aaa;
        min-height: 0;
    }

    .login-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        width: 100%;
        height: 100vh;
        background-position: center;
        background-image: url(/images/login/{{$settings['login_file_name']}});
        background-size: cover;
        opacity: 0.9;
    }

    .grid-contents {
        background: {{$settings['background_color']}}cc;
    }
}

@media (max-width: 432px) {
    .login-container {
        background-size: fill;
        height: 100%;
    }
}

</style>
