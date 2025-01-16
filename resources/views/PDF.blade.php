<!DOCTYPE html>
<html>

<head>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<style>
body {
    font-family: Arial, sans-serif;
    margin: 20px;
}

h1 {
    font-size: 24px;
    text-align: center;
}

h3 {
    font-size: 20px;
    text-align: center;
}

h4 {
    font-size: 18px;
    text-align: center;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th,
td {
    border: 1px solid #000;
    padding: 5px;
    text-align: left;
}

p.color-text,
p.size-text {
    font-size: small;
    color: #212529;
    margin: 0 0;
    padding-bottom: 2px;
}

th {
    background-color: #2E3192;
}

.center-align {
    text-align: center;
}

/* Additional Styles */

.no-border {
    border: none !important;
}

.footer {
    position: absolute;
    bottom: 0;
    width: 100%;
}

.footer-link,
.footer-date {
    color: #98a3aa;
    /* Set the text color */
}

.footer-link {
    text-decoration: none;
    /* Remove underline from the link */
}

.footer table {
    width: 100%;
}

.footer td {
    padding: 0;
}

.footer-link,
.footer-date {
    color: #C2CCD3;
    /* Set the text color */
    font-size: 12px;
    /* Set the font size to be very small */
}
</style>
</head>

<body>

    <section>
        <table border="0">
            <tr>
                <td style="border: 0px solid #f7f7f7;">
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('admin-assets/img/bangladesh-police.png'))) }}" alt="police" class="img-fluid" width="100px">
                </td>
                <td style="text-align:center; border: 0px solid #ffffff;">
                    <h2 style="margin-bottom: -15px;">PHQ FORCE MESS</h2>
                    <p style="margin-bottom: -15px;">POLICE HEADQUARTERS</p>
                    <p>6,Phoenix Road,Fulbaria,Dhaka-1000</p>
                </td>
                <td style="text-align:right; border: 0px solid #ffffff;">
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('admin-assets/img/phq.png'))) }}" alt="police" class="img-fluid" width="90px">
                </td>
            </tr>
        </table>
    </section>
    <hr style="border: 1px solid #000000;">

    <p>{{ $date }}</p>

    <h1>Booking History</h1>
    <br>

    <table>
        @php
        $totalBreakfastCount = $bookings->where('breakfast', 2)->count();
        $totalLunchCount = $bookings->where('lunch', 2)->count();
        $totalDinnerCount = $bookings->where('dinner', 2)->count();
        @endphp
        <tr>
            <th style="color: #ffffff;width: 25px;">Breakfast:</th>
            <td style="width: 80px;">
                @if ($totalBreakfastCount > 0)
                    {{ $totalBreakfastCount }}
                @else
                    &nbsp; <!-- Ensures cell is not empty and keeps table layout consistent -->
                @endif
            </td>

            <td colspan="2" align="right" style="border: none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

            <th style="color: #ffffff;width: 25px;">Lunch:</th>
            <td style="width: 80px;">
                @if ($totalLunchCount > 0)
                    {{ $totalLunchCount }}
                @else
                    &nbsp; <!-- Ensures cell is not empty and keeps table layout consistent -->
                @endif
            </td>

            <td colspan="2" align="right" style="border: none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

            <th style="color: #ffffff;width: 25px;">Dinner:</th>
            <td style="width: 80px;">
                @if ($totalDinnerCount > 0)
                    {{ $totalDinnerCount }}
                @else
                    &nbsp; <!-- Ensures cell is not empty and keeps table layout consistent -->
                @endif
            </td>
        </tr>
    </table>


    <br>


    <table style="border-collapse: collapse; width: 100%;">
        <tr>
            <th style="color: #ffffff; padding: 5px; font-size: x-small; line-height: 1;text-align: center;">SL No.</th>
            <th style="color: #ffffff; padding: 5px; font-size: x-small; line-height: 1;text-align: center;">Bp number</th>
            <th style="color: #ffffff; padding: 5px; font-size: x-small; line-height: 1;text-align: center;">Name</th>
            <th style="color: #ffffff; padding: 5px; font-size: x-small; line-height: 1;text-align: center;">Breakfast</th>
            <th style="color: #ffffff; padding: 5px; font-size: x-small; line-height: 1;text-align: center;">Lunch</th>
            <th style="color: #ffffff; padding: 5px; font-size: x-small; line-height: 1;text-align: center;">Dinner</th>
        </tr>

        @foreach ($users as $user)
        <tr>
            <td style="padding: 2px; font-size: x-small; text-align: center; line-height: 1;">{{ $user->serial }}</td>
            <td style="padding: 2px; font-size: x-small; padding-left: 10px; line-height: 1;">{{ $user->bp_num }}</td>
            <td style="padding: 2px; font-size: x-small; padding-left: 10px; line-height: 1;">{{ $user->name }}</td>
            @php
            $userBooking = $bookings->where('user_id', $user->id)->first();
            @endphp
            <td style="padding: 2px; font-size: x-small; text-align: center; line-height: 1;">
                @if ($userBooking && $userBooking->breakfast == 2)
                <p style="margin: 0;">Yes</p>
                @else
                <p style="margin: 0;">&nbsp;</p> <!-- Output a non-breaking space to maintain table structure -->
                @endif
            </td>

            <td style="padding: 2px; font-size: x-small; text-align: center; line-height: 1;">
                @if ($userBooking && $userBooking->lunch == 2)
                <p style="margin: 0;">Yes</p>
                @else
                <p style="margin: 0;">&nbsp;</p> <!-- Output a non-breaking space to maintain table structure -->
                @endif
            </td>

            <td style="padding: 2px; font-size: x-small; text-align: center; line-height: 1;">
                @if ($userBooking && $userBooking->dinner == 2)
                <p style="margin: 0;">Yes</p>
                @else
                <p style="margin: 0;">&nbsp;</p> <!-- Output a non-breaking space to maintain table structure -->
                @endif
            </td>
        </tr>
        @endforeach
    </table>




{{-- footer print time --}}
<div class="footer">
    <table border="0" width="100%">
        <tr>
            <td style="border: 0px solid #f7f7f7;">
                <small><a href="https://phqmms.opusdemo.com/public/admin/login"
                        class="footer-link">phqmms.police.gov.bd</a></small>
            </td>
            <td style="text-align:right; border: 0px solid #ffffff;">
                <small class="footer-date"> Print at: {{
                    \Carbon\Carbon::now()->setTimezone('Asia/Dhaka')->format('l, F j, Y g:i A') }}</small>
            </td>
        </tr>
    </table>
</div>


</body>

</html>
