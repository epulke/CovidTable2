<?php

require_once "vendor/autoload.php";

use App\CountryData;
use App\CountriesTotal;

$data = new CountriesTotal();

if (isset($_GET["valsts"], $_GET["datums"]))
{
    $dataFilter = $data->searchData($_GET["valsts"], $_GET["datums"]);
} else {
    $dataFilter = [];
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>COVID-19 Dati pa Valstīm</title>
</head>


<body>

<form name="form1" id="form1">
    Izvēlies valsti: <select name="valsts" id="valsts">
        <option name="latvija" value="Latvija" selected="selected">Latvija</option>
        <option name="zviedrija" value="Zviedrija" selected="selected">Zviedrija</option>
        <option name="spanija" value="Spānija" selected="selected">Spānija</option>
        <option name="visasvalstis" value="visasvalstis" selected="selected">Visas valstis</option>

    </select>

    Izvēlies datumu: <select name="datums" id="datums">
        <option name="2020.09.11." value="2020.09.11." selected="selected">2020.09.11.</option>
        <option name="2020.10.09." value="2020.10.09." selected="selected">2020.10.09.</option>
        <option name="2021.08.20." value="2021.08.20." selected="selected">2021.08.20.</option>
        <option name="visidatumi" value="visidatumi" selected="selected">Visi datumi</option>

    </select>
    <br>
    <input type="submit" value="Submit">
</form>

<table>
    <tr class="table">
        <th>Datums</th>
        <th>Valsts</th>
        <th>14 dienu kum. inc.</th>
        <th>Izceļošana</th>
        <th>Pašizolācija</th>
        <th>Sertif. pašizol. LV</th>
        <th>Sertif. tests pirms LV</th>
        <th>Sertif. tests pēc LV</th>
        <th>Citi pašizol LV</th>
        <th>Citi tests pirms LV</th>
        <th>Citi tests pēc LV</th>
    </tr>
        <?php foreach($dataFilter as $row):
            /** @var CountryData $row */?>
            <?php  $countryInfo = $row->getCountryDataObject();?>
            <tr>
                <th scope="row"><?= $countryInfo[0]; ?></th>
                <td><?= mb_strimwidth($countryInfo[1], 0, 15); ?></td>
                <td><?= $countryInfo[2]; ?></td>
                <td><?= mb_strimwidth($countryInfo[3], 0, 15); ?></td>
                <td><?= mb_strimwidth($countryInfo[4], 0, 15); ?></td>
                <td><?= $countryInfo[5]; ?></td>
                <td><?= $countryInfo[6]; ?></td>
                <td><?= $countryInfo[7]; ?></td>
                <td><?= mb_strimwidth($countryInfo[8], 0, 15); ?></td>
                <td><?= $countryInfo[9]; ?></td>
                <td><?= $countryInfo[10]; ?></td>
            </tr>
        <?php endforeach; ?>
</table>

</body>
</html>