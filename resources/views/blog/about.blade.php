@extends('base')

@section('title', 'À propos')

@section('content')
    <h1>À propos</h1>
    <p>Un inventaire des incroyables randonnées réalisées dans nos montagnes suisses.</p>
    <?php

    $data = file_get_contents("../storage/app/gpx/leysin-chaux-de-mont.gpx");
    $data = str_replace('xmlns:schemaLocation="http://www.topografix.com/GPX/1/1/gpx.xsd https://swisstopo-app.ch/xmlschemas/SwisstopoExtensions https://prod-static.swisstopo-app.ch/xmlschemas/SwisstopoExtensions.xsd"', "", $data);
    $data1 = str_replace('swisstopo:', "", $data);
    //open gpx file
    $gpx = simplexml_load_string($data1);
    
    $eleStart = round((int) $gpx->wpt->ele,0);
    $name = $gpx->metadata->name;
    $date = date(substr($gpx->metadata->time,0,10));

    foreach ($gpx->wpt as $pt) {
        foreach ($pt->extensions as $ex) {     
        $distance = round($waypoint_stage_before = $ex->waypoint_stage_before['distance']/1000,1);
        $duration = date("H:i",$waypoint_stage_before = (int) $ex->waypoint_stage_before['duration']);
        $ascent = round($waypoint_stage_before = (int) $ex->waypoint_stage_before['ascent'],0);
        $descent = round($waypoint_stage_before = (int) $ex->waypoint_stage_before['descent'],0);    
    }}

    $arr = array();
    foreach ($gpx->trk as $trak) {
        foreach ($trak->trkseg as $trakseg) {
            foreach ($trakseg->trkpt as$trakpt) {
               $arr[] = (int) $trakpt->ele;
    }}}
    $eleMax = max($arr);

    ?>
    
    <!-- Titre : {{$name}} <br>
    Date : {{$date}} <br>
    Altitude départ : {{$eleStart}} m <br>
    Altitude maximum : {{$eleMax}} m <br>
    distance : {{$distance}} km <br>
    durée : {{$duration}} <br>
    dénivelé asc : {{$ascent}} m <br>
    dénivelé desc : {{$descent}} m <br> -->
@endsection