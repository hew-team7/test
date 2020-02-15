
<?php
 
mb_language("Japanese");//文字コードの設定
mb_internal_encoding("UTF-8");
 
$apikey = "dj00aiZpPUpiQlVZd3ZoaGc5MiZzPWNvbnN1bWVyc2VjcmV0Jng9NGU-";

//住所1を入れて緯度経度を求める。
$address1 = "大阪府大阪市北区梅田３丁目１−１";
$address = urlencode($address1);
$url = "https://map.yahooapis.jp/geocode/V1/geoCoder?output=json&recursive=true&appid=" . $apikey . "&query=" . $address ;
$contents = file_get_contents($url);
$contents = json_decode($contents);
$Coordinates = $contents ->Feature[0]->Geometry->Coordinates;
$geo = explode(",", $Coordinates);
$lon1 = $geo[0];
$lat1 = $geo[1];

//住所2を入れて緯度経度を求める。
$address2 = "大阪府大阪市北区梅田３丁目３−１";
$address = urlencode($address2);
$url = "https://map.yahooapis.jp/geocode/V1/geoCoder?output=json&recursive=true&appid=" . $apikey . "&query=" . $address ;
$contents = file_get_contents($url);
$contents = json_decode($contents);
$Coordinates = $contents ->Feature[0]->Geometry->Coordinates;
$geo = explode(",", $Coordinates);
$lon2 = $geo[0];
$lat2 = $geo[1];

/* 
//住所3を入れて緯度経度を求める。
$address3 = "";
$address = urlencode($address3);
$url = "https://map.yahooapis.jp/geocode/V1/geoCoder?output=json&recursive=true&appid=" . $apikey . "&query=" . $address ;
$contents = file_get_contents($url);
$contents = json_decode($contents);
$Coordinates = $contents ->Feature[0]->Geometry->Coordinates;
$geo = explode(",", $Coordinates);
$lon3 = $geo[0];
$lat3 = $geo[1];
 */

/* 
//住所4を入れて緯度経度を求める。
$address4 = "";
$address = urlencode($address4);
$url = "https://map.yahooapis.jp/geocode/V1/geoCoder?output=json&recursive=true&appid=" . $apikey . "&query=" . $address ;
$contents = file_get_contents($url);
$contents = json_decode($contents);
$Coordinates = $contents ->Feature[0]->Geometry->Coordinates;
$geo = explode(",", $Coordinates);
$lon4 = $geo[0];
$lat4 = $geo[1];
 */ 
 
 
?><DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>map</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.0/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.3.0/dist/leaflet.js"></script>
  <script>
    function init() {
      var map = L.map('mapcontainer', { zoomControl: false });
      var mpoint = [<?php echo $lat1?>, <?php echo $lon1?>];
      map.setView(mpoint, 15);
      L.tileLayer('https://cyberjapandata.gsi.go.jp/xyz/std/{z}/{x}/{y}.png', {
        attribution: "<a href='https://maps.gsi.go.jp/development/ichiran.html' target='_blank'>地理院タイル</a>"
      }).addTo(map);
      //ポップアップオブジェクトを作成
        var popup1 = L.popup().setContent("<?php echo $address1?>");
        var popup2 = L.popup().setContent("<?php echo $address2?>");
        //var popup3 = L.popup().setContent("<?php echo $address3?>");
        //var popup4 = L.popup().setContent("<?php echo $address4?>");
      //マーカーにポップアップを紐付けする。同時にbindTooltipでツールチップも追加
        L.marker(mpoint, { draggable: true }).bindPopup(popup1).bindTooltip("大阪駅").addTo(map);
        L.marker([<?php echo $lat2?>, <?php echo $lon2?>]).bindPopup(popup2).bindTooltip("HAL大阪").addTo(map);
        //L.marker([<?php echo $lat3?>, <?php echo $lon3?>]).bindPopup(popup3).bindTooltip("HAL大阪").addTo(map);
        //L.marker([<?php echo $lat4?>, <?php echo $lon4?>]).bindPopup(popup4).bindTooltip("HAL大阪").addTo(map);
    }
  </script>
</head>
<body onload="init()">
  <div id="mapcontainer" style="margin: auto;width: 800px;height: 400px;"></div>
</body>
</html>