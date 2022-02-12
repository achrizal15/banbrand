<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ isset($title) ? $title : 'BANBRAND' }}</title>
    @include("template.das.head_include")

</head>

<body class="bg-light font-family-nunito-sans hold-transition register-page" >
    @yield("content")
    @include("template.das.footer_include")
</body>

</html>
