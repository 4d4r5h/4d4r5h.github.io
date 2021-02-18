<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Weather Forcast</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/weather-icons/2.0.9/css/weather-icons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <?php

    $temperature = array();
    $min_temp = array();
    $max_temp = array();
    $humidity = array();
    $date = array();
    $time = array();
    $wind = array();
    $weather = array();
    $cnt = 0;

    function showDate($Date)
    {
        global $date;

        $days = [
            "1st", "2nd", "3rd", "4th", "5th", "6th", "7th", "8th", "9th", "10th", "11th", "12th", "13th", "14th", "15th", "16th", "17th", "18th", "19th",
            "20th", "21st", "22nd", "23rd", "24th", "25th", "26th", "27th", "28th", "29th", "30th", "31st"
        ];

        $months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

        $day = substr($Date, 8);
        $month = substr($Date, 5, 6);
        $result = "";

        if (substr($day, 0, 0) == "0") {
            $result = $result . $days[intval(substr($day, 1)) - 1] . " ";
        } else {
            $result = $result . $days[intval($day) - 1] . " ";
        }

        if (substr($month, 0, 0) == "0") {
            $result = $result . $months[intval(substr($month, 1)) - 1];
        } else {
            $result = $result . $months[intval($month) - 1];
        }

        array_push($date, $result);
    }

    function getTime($Time)
    {
        global $time;

        switch (substr($Time, 0, 2)) {
            case "09":
                array_push($time, "9 AM");
                break;
            case "15":
                array_push($time, "3 PM");
                break;
            case "21":
                array_push($time, "9 PM");
        }
    }

    $apiKey = "5a4614167ed2e6f3a19895fb659e3422";

    $cityName = "Lucknow";

    $googleApiUrl = "http://api.openweathermap.org/data/2.5/forecast?q=" . $cityName . "&lang=en&units=metric&APPID=" . $apiKey;

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);

    curl_close($ch);
    $data = json_decode($response);

    foreach ($data->list as $list) {
        if (substr($list->dt_txt, 11) == "09:00:00" || substr($list->dt_txt, 11) == "15:00:00" || substr($list->dt_txt, 11) == "21:00:00") {
            array_push($min_temp, $list->main->temp_min);
            array_push($max_temp, $list->main->temp_max);
            array_push($humidity, $list->main->humidity);
            array_push($temperature, number_format($list->main->temp, 1));
            array_push($weather, $list->weather[0]->main);
            array_push($wind, $list->wind->speed);

            showDate(substr($list->dt_txt, 0, 10));
            getTime(substr($list->dt_txt, 11));

            $cnt++;
        }
    }

    ?>


    <style>
        body,
        html {
            height: 100%;
        }

        .parallax {
            background-image: url('../assets/images/bg101.jpg');
            height: 100%;
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .iconforweather {
            border-style: solid;
            height: 200px;
            flex: 1 100%;
            background-image: linear-gradient(120deg, #84fab0 0%, #8fd3f4 100%);
            font-family: weathericons;
            display: flex;
            align-items: center;
            justify-content: space-around;
            font-size: 100px;

        }

        .temperature {
            font-family: 'Roboto Mono', monospace;
            font-size: 50px;
            border-style: solid;
            background-image: linear-gradient(to right, #fa709a 0%, #fee140 100%);

        }

        .info {
            font-family: 'Roboto Mono', monospace;
            font-size: 50px;
            border-style: solid;
            background-image: linear-gradient(to left, #fa709a 0%, #fee140 100%);
        }

        .time {
            font-family: 'Roboto Mono', monospace;
            font-size: 30px;
            border-style: solid;
            background-image: linear-gradient(to top, #96fbc4 0%, #f9f586 100%);
        }

        .container .tooltiptext {
            visibility: hidden;
            width: 300px;
            font-size: 15px;
            background-color: black;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px 0;
            position: absolute;
            z-index: 1;
            bottom: 65%;
            left: 20%;
            margin-left: -60px;

            /* Fade in tooltip - takes 1 second to go from 0% to 100% opac: */
            opacity: 0;
            transition: opacity 1s;
        }

        .container:hover .tooltiptext {
            visibility: visible;
            opacity: 0.7;
        }
    </style>

</head>

<body>

    <?php for ($i = 0; $i < $cnt; $i++) { ?>

        <?php if ($time[$i] == "9 AM") { ?> <div class="parallax" style="background-image : url('assets/images/bg101.jpg')"> </div> <?php } ?>

        <?php if ($time[$i] == "3 PM") { ?> <div class="parallax" style="background-image : url('assets/images/bg2.jpg')"> </div> <?php } ?>

        <?php if ($time[$i] == "9 PM") { ?> <div class="parallax" style="background-image : url('assets/images/bg3.jpg')"> </div> <?php } ?>

        <div style="height:400px;font-size:36px;" data-aos="fade-down">
            <div class="container" style="box-shadow: 0 27px 55px 0 rgba(0, 0, 0, 0.3), 0 17px 17px 0 rgba(0, 0, 0, 0.15); margin-top: 100px; ">
                <div class="tooltiptext" align="center">Minimum Temperature: <?php echo $min_temp[$i]; ?>° C<br>
                    Maximum Temperature: <?php echo $max_temp[$i]; ?>° C<br>
                    Humidity: <?php echo $humidity[$i]; ?> %<br>
                    Wind Speed: <?php echo $wind[$i]; ?> kmph
                </div>
                <div class="row justify-content-md-center" data-aos="flip-down">
                    <div class="col-12 iconforweather" align="center">
                        <?php if ($weather[$i] == "Clear") { ?> <i class="wi wi-day-sunny" data-aos="zoom-in" data-aos-duration="2000"></i> <?php } ?>
                        <?php if ($weather[$i] == "Clouds") { ?> <i class="wi wi-cloudy" data-aos="zoom-in" data-aos-duration="2000"></i> <?php } ?>
                        <?php if ($weather[$i] == "Rain") { ?> <i class="wi wi-rain" data-aos="zoom-in" data-aos-duration="2000"></i> <?php } ?>
                        <?php if ($weather[$i] == "Thunderstorm") { ?> <i class="wi wi-thunderstorm" data-aos="zoom-in" data-aos-duration="2000"></i> <?php } ?>
                        <?php if ($weather[$i] == "Snow") { ?> <i class="wi wi-snow" data-aos="zoom-in" data-aos-duration="2000"></i> <?php } ?>
                        <?php if ($weather[$i] == "Fog") { ?> <i class="wi wi-fog" data-aos="zoom-in" data-aos-duration="2000"></i> <?php } ?>
                        <?php if ($weather[$i] == "Drizzle") { ?> <i class="wi wi-sprinkle" data-aos="zoom-in" data-aos-duration="2000"></i> <?php } ?>
                        <?php if ($weather[$i] == "Tornado") { ?> <i class="wi wi-tornado" data-aos="zoom-in" data-aos-duration="2000"></i> <?php } ?>
                        <?php if ($weather[$i] == "Dust") { ?> <i class="wi wi-windy" data-aos="zoom-in" data-aos-duration="2000"></i> <?php } ?>
                    </div>
                </div>
                <div class="row justify-content-md-center ">
                    <div class=" col temperature" align="center" data-aos="flip-left">
                        <?php echo $temperature[$i]; ?>&deg;C
                    </div>
                    <div class=" col info" align="center" data-aos="flip-up">
                        <?php echo $weather[$i]; ?>
                    </div>
                    <div class=" col time" data-aos="flip-right">
                        <?php echo $date[$i]; ?>,<br>
                        <?php echo $time[$i]; ?>
                    </div>
                </div>
            </div>
        </div>

    <?php } ?>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init();
    </script>

    <!-- Bootstrap -->

</body>

</html>