<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $subject }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            padding: 30px;
        }
        .email-header {
            background-color: #ef9b46;
            color: #ffffff;
            text-align: center;
            padding: 15px;
            border-radius: 8px 8px 0 0;
            font-size: 20px;
            font-weight: bold;
        }
        .email-body {
            padding: 20px;
            font-size: 16px;
            line-height: 1.6;
        }
        .email-footer {
            background-color: #f1f1f1;
            text-align: center;
            padding: 15px;
            font-size: 14px;
            border-radius: 0 0 8px 8px;
            color: #555;
        }
        .email-footer small {
            display: block;
            margin-top: 5px;
        }
        .button {
            background-color: #007bff;
            color: #ffffff !important;
            padding: 10px 20px;
            display: inline-block;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="email-container">
    <div class="email-header">
        {{ $subject }}
    </div>

    <div class="email-body">
        <p>Dear <strong>{{ $employeeName }}</strong>,</p>
        <p>{!! nl2br($body) !!}</p>
        
        <br>
        <p>{!! nl2br($signature) !!}</p>
    </div>

    <div class="email-footer">
        <small>This is a system-generated email. Please do not reply.</small>
        <small>
            Copyright &copy;
            <script>document.write(new Date().getFullYear())</script> 
            <a href="{{ url('/') }}">Assam Power Generation Corporation Limited</a>. All Rights Reserved.
        </small>
    </div>
</div>

</body>
</html>