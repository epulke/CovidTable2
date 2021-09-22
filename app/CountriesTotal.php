<?php declare(strict_types=1);

namespace App;
use League\Csv\Reader;
use League\Csv\Statement;

class CountriesTotal
{
    private array $countriesTotal;

    public function __construct()
    {
        $covidData = Reader::createFromPath('covid_19_valstu_saslimstibas_raditaji.csv', 'r');
        $covidData->setDelimiter(';');
        $covidData->setHeaderOffset(0);
        $stmt = Statement::create();

        $records = $stmt->process($covidData);

        foreach ($records as $item)
        {
            $this->addToList(new CountryData(
                $item["Datums"],
                $item["Valsts"],
                (float) $item["14DienuKumulativaIncidence"],
                $item["Izcelosana"],
                $item["Pasizolacija"],
                $item["PersIrVakcParslSert_PasizolacijaLatvija"],
                $item["PersIrVakcParslSert_TestsPirmsIebrauksanasLV"],
                $item["PersIrVakcParslSert_TestsPecIebrauksanasLV"],
                $item["CitasPersonas_PasizolacijaLatvija"],
                $item["CitasPersonas_TestsPirmsIebrauksanasLV"],
                $item["CitasPersonas_TestsPecIebrauksanasLV"]
            ));
        }
    }

    private function addToList(CountryData $item): void
    {
        $this->countriesTotal[] = $item;
    }

    public function getCountriesTotal(): array
    {
        return $this->countriesTotal;
    }


    public function searchCountryData($countryName): array
    {
        $countryData = [];

        foreach ($this->countriesTotal as $row)
        {
            /** @var CountryData $row */
            if ($row->getCountry() === $countryName)
            {
                $countryData[] = $row;
            }
        }
        return $countryData;
    }

    public function searchDateData($date): array
    {
        $dateData = [];
        foreach ($this->countriesTotal as $row)
        {
            /** @var CountryData $row */
            if ($row->getDate() === $date)
            {
                $dateData[] = $row;
            }
        }
        return $dateData;
    }

    public function searchData($countryName, $date): array
    {
        if ($countryName === "visasvalstis" && $date === "visidatumi")
        {
            return $this->getCountriesTotal();
        }

        if ($countryName === "visasvalstis" && $date !== "visidatumi")
        {
            return $this->searchDateData($date);
        }

        if ($countryName !== "visasvalstis" && $date === "visidatumi")
        {
            return $this->searchCountryData($countryName);
        }

        $filterData = [];
        foreach ($this->countriesTotal as $row)
        {
            /** @var CountryData $row */
            if ($row->getCountry() === $countryName && $row->getDate() === $date)
            {
                $filterData[] = $row;
            }
        }
        return $filterData;
    }
}