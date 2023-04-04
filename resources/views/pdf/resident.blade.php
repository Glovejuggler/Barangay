<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $resident->full_name }}</title>
</head>

<body>
    <div>
        Name: {{ $resident->full_name }}
    </div>

    <div>
        Address: {{ $resident->complete_address }}
    </div>

    <div>
        Barangay number: {{ $resident->barangay_number }}
    </div>
</body>

</html>