<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $subject }}</title>
</head>
<body>
    <p>Dear {{ $employeeName }},</p>
    {!! nl2br($body) !!}
    <br><br>
    {!! nl2br($signature) !!}
</body>
</html>
