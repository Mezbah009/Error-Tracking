<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>মিডিয়া এন্ড পাবলিক রিলেশনস</title>
    <style>
        /* Define your CSS styles for the PDF content */
        body {
            font-family: 'my_custom_name', Arial, sans-serif !important;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            height: 50px;
        }

        .header h1 {
            font-size: 24px;
        }

        .header h2 {
            font-size: 20px;
        }

        .header p {
            font-size: 16px;
        }

        .content {
            margin: 0 auto;
            width: 90%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 0px;
            border: none;
        }

        th,
        td {

            text-align: left;
            padding: 8px;
            font-size: 12px;
        }

        th {
            background-color: #2E3192;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #DDDDDD;
        }

        tr:nth-child(odd) {
            background-color: #EEEEEE;
        }

        tr:hover {
            background-color: #d1e7dd;
        }

        .clickable {
            color: blue;
            text-decoration: underline;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #fff;
            padding: 10px 0;
        }

        .footer-link,
        .footer-date {
            color: #98a3aa;
            font-size: 12px;
        }

        .footer-link {
            text-decoration: none;
        }

        @page {
            footer: html_myFooter;
        }


        /* Additional styles */
        .first-page-header {
            display: block;
        }

        .subsequent-page-header {
            display: none;
        }

        @page: first {
            .first-page-header {
                display: table-header-group;
            }

            .subsequent-page-header {
                display: none;
            }
        }

        @page {
            footer: html_myFooter;
            margin-top: 50px;
            margin-bottom: 50px;
        }
    </style>
</head>

<body>
    <section>
        <table border="0">
            <tr style="background-color: transparent;">
                <td style="border: 0px solid #f7f7f7;">
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('admin-assets/img/bangladesh-police.png'))) }}"
                        alt="police" class="img-fluid" width="119px">
                </td>
                <td style="text-align:center; border: 0px solid #ffffff;">
                    <h1 style="margin-bottom: 10px;">মিডিয়া এন্ড পাবলিক রিলেশনস</h1>
                    <h2 style="margin-bottom: 10px;">বাংলাদেশ পুলিশ, পুলিশ হেডকোয়ার্টার্স, ঢাকা।</h2>
                </td>
                <td style="text-align:right; border: 0px solid #ffffff;">
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('admin-assets/img/phq.png'))) }}"
                        alt="police" class="img-fluid" width="95px">
                </td>
            </tr>
        </table>
        <table style="width: 50%; height: 100px; margin: auto;">
            <tr style="background-color: #C7C8CC; height: 100%;">
                <td style="text-align: center; vertical-align: middle;  font-size: 15px;">
                    <p>প্রিন্ট ও অনলাইন মিডিয়া হাইলাইটস</p>
                    <?php

use Carbon\Carbon;

// Set the locale to Bengali
Carbon::setLocale('bn');

// Get the current date and time in the desired format
$date = Carbon::now()->setTimezone('Asia/Dhaka')->locale('bn')->isoFormat('D MMMM');
$year = Carbon::now()->setTimezone('Asia/Dhaka')->locale('bn')->isoFormat('YYYY');
$week = Carbon::now()->setTimezone('Asia/Dhaka')->locale('bn')->isoFormat('dddd');
$time = Carbon::now()->setTimezone('Asia/Dhaka')->locale('bn')->isoFormat('h:mm A');

// Replace the English numerals with Bengali numerals
$english_to_bengali = ['0' => '০', '1' => '১', '2' => '২', '3' => '৩', '4' => '৪', '5' => '৫', '6' => '৬', '7' => '৭', '8' => '৮', '9' => '৯'];
$date_in_bengali = strtr($date, $english_to_bengali);
$year_in_bengali = strtr($year, $english_to_bengali);
$week_in_bengali = strtr($week, $english_to_bengali);
$time_in_bengali = strtr($time, $english_to_bengali);
                    ?>
                    <p>
                        <span style="color: #8E2657;">{{ $date_in_bengali }}</span>
                        <span>{{ $year_in_bengali }},</span>
                        <span style="color: #8E2657;">{{ $week_in_bengali }}</span>

                    </p>
                </td>
            </tr>
        </table>

        <table style="width: 50%; height: 100px; margin: auto;">
            <tr style="background-color: #C7C8CC; height: 100%;">
                <td style="text-align: center; vertical-align: middle;  font-size: 15px;">
                    @if(!empty($categories))
                        <p class="category-badge">
                            {{ is_array($categories) ? implode(', ', $categories) : $categories }}
                        </p>
                    @endif
                    <p style="color: #8E2657;">বিস্তারিত সংবাদ পড়তে শিরোনামে ক্লিক করুন</p>
                </td>
            </tr>
        </table>

    </section>
    <hr style="border: 1px solid #000000;">

    @if (!empty($news))
        <div class="content">
            <!-- First page only table header -->
            <table class="first-page-header" style="width: 100%;">
                <thead>
                    <tr>
                        <th>ক্রমিক</th>
                        <th>সংবাদের শিরোনাম</th>
                        <th>পত্রিকার নাম</th>
                    </tr>
                </thead>
            </table>

            <table class="subsequent-page-header">
                <!-- Header will only display on the first page -->
            </table>

            <table>
                <tbody>
                    @foreach ($news as $index => $item)
                        <tr>
                            <td>{{ bangla_number($index + 1) }}</td>
                            <td><a style="  color: black;" href="{{ $item->url }}" class="clickable">{{ $item->title }}</a></td>
                            <td>{{ $item->source_name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>No news available for the selected date range.</p>
    @endif

    <br>
    <br>
    <h3 style="text-align:center; color: #2E3192">
        - ধন্যবাদ -</h3>

    <?php
function bangla_number($number)
{
    $bangla_digits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
    $str = (string) $number;
    $output = '';
    for ($i = 0; $i < strlen($str); $i++) {
        $output .= isset($bangla_digits[$str[$i]]) ? $bangla_digits[$str[$i]] : $str[$i];
    }
    return $output;
}

function convert_to_bangla_date($englishDate)
{
    $englishDateParts = explode('-', $englishDate); // Assuming date format is yyyy-mm-dd
    $day = bangla_number($englishDateParts[2]);
    $month = get_bangla_month($englishDateParts[1]);
    $year = bangla_number($englishDateParts[0]);
    return "$day $month, $year";
}

function get_bangla_month($monthIndex)
{
    $bangla_months = [
        'জানুয়ারি',
        'ফেব্রুয়ারি',
        'মার্চ',
        'এপ্রিল',
        'মে',
        'জুন',
        'জুলাই',
        'অগাস্ট',
        'সেপ্টেম্বর',
        'অক্টোবর',
        'নভেম্বর',
        'ডিসেম্বর'
    ];
    return $bangla_months[(int) $monthIndex - 1];
}

    ?>



    {{-- footer print time --}}
    <htmlpagefooter name="myFooter" style="display:none">
        <div class="footer">
            <table border="0" width="100%">
                <tr style="background-color: transparent;">
                    <td style="border: none;">
                        <small><a href="https://phq-media.opusdemo.com/admin/login"
                                class="footer-link">phq-media.police.gov.bd</a></small>
                    </td>
                    <td style="text-align:right; border: none;">
                        <small class="footer-date">{{ $time_in_bengali }}</small>
                    </td>
                </tr>
            </table>
        </div>
    </htmlpagefooter>

</body>

</html>