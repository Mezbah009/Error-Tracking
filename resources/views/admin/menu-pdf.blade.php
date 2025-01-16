<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>মিডিয়া এন্ড পাবলিক রিলেশনস</title>
    <style>
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

 
    </style>
</head>

<body>

    <section>
        <table border="0">
            <tr style="background-color: transparent;">
                <td style="border: 0px solid #f7f7f7;">
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('admin-assets/img/bangladesh-police.png'))) }}" alt="police" class="img-fluid" width="100px">
                </td>
                <td style="text-align:center; border: 0px solid #ffffff;">
                    <h1 style="margin-bottom: 10px;">মিডিয়া এন্ড পাবলিক রিলেশনস</h1>
                    <h2 style="margin-bottom: 10px;">বাংলাদেশ পুলিশ, পুলিশ হেডকোয়ার্টার্স, ঢাকা।</h2>
                    <p>প্রিন্ট ও অনলাইন মিডিয়া হাইলাইটস</p>
                    <p>{{ \Carbon\Carbon::now()->setTimezone('Asia/Dhaka')->locale('bn')->isoFormat('LLLL') }}
                    </p>
                </td>
                <td style="text-align:right; border: 0px solid #ffffff;">
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('admin-assets/img/phq.png'))) }}" alt="police" class="img-fluid" width="90px">
                </td>
            </tr>
        </table>
    </section>
    <hr style="border: 1px solid #000000;">

    @if (!empty($news))
        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th>ক্রমিক</th>
                        <th>সংবাদের শিরোনাম</th>
                        <th width=150px>পত্রিকার নাম</th>
                        <th >Download</th>
                        <!-- <th>Date Of Published</th> -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($news as $index => $item)
                    <tr>
                        <td>{{ bangla_number($index + 1) }}.</td>
                        <td><a style="color:black;" href="{{ $item['News URL'] }}" class="clickable">{{ $item['News Title'] }}</a> <br>  <p > <small style="color:#919194; marging-top: 5px" >{{ convert_to_bangla_date($item['Published Date']) }}</small> </p> </td>
                        <td>{{ $item['Newspaper Name/Source Name'] }}</td>
                        <td><a href="{{ route('admin.news_Pdf', ['url' => urlencode($item['News URL'])]) }}" target="_blank">Download</a></td>
                        
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
    function bangla_number($number) {
        $bangla_digits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
        $str = (string) $number;
        $output = '';
        for ($i = 0; $i < strlen($str); $i++) {
            $output .= isset($bangla_digits[$str[$i]]) ? $bangla_digits[$str[$i]] : $str[$i];
        }
        return $output;
    }

    function convert_to_bangla_date($englishDate) {
        $englishDateParts = explode('-', $englishDate); // Assuming date format is yyyy-mm-dd
        $day = bangla_number($englishDateParts[2]);
        $month = get_bangla_month($englishDateParts[1]);
        $year = bangla_number($englishDateParts[0]);
        return "$day $month, $year";
    }

    function get_bangla_month($monthIndex) {
        $bangla_months = [
            'জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন',
            'জুলাই', 'অগাস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর'
        ];
        return $bangla_months[(int)$monthIndex - 1];
    }
    
?>



</body>

</html>
