<?php declare(strict_types=1);

namespace App;

class CountryData
{
    private string $date;
    private string $country;
    private float $cumInc14Day;
    private string $travel;
    private ?string $isolation;
    private ?string $sertifIsolationLV;
    private ?string $sertifTestBeforeLV;
    private ?string $sertifTestAfterLV;
    private ?string $otherIsolationLV;
    private ?string $otherTestBeforeLV;
    private ?string $otherTestAfterLV;


    public function __construct(string $date, string $country, float $cumInc14Day, string $travel, ?string $isolation,
    ?string $sertifIsolationLV, ?string $sertifTestBeforeLV, ?string $sertifTestAfterLV, ?string $otherIsolationLV,
    ?string $otherTestBeforeLV, ?string $otherTestAfterLV)
    {
       $this->date = $date;
       $this->country = $country;
       $this->cumInc14Day = $cumInc14Day;
       $this->travel = $travel;
       $this->isolation = $isolation;
       $this->sertifIsolationLV = $sertifIsolationLV;
       $this->sertifTestAfterLV = $sertifTestAfterLV;
       $this->sertifTestBeforeLV = $sertifTestBeforeLV;
       $this->otherIsolationLV = $otherIsolationLV;
       $this->otherTestBeforeLV = $otherTestBeforeLV;
       $this->otherTestAfterLV = $otherTestAfterLV;
    }

    public function getCountryDataObject(): array
    {
        return [
            $this->date,
            $this->country,
            $this->cumInc14Day,
            $this->travel,
            $this->isolation,
            $this->sertifIsolationLV,
            $this->sertifTestBeforeLV,
            $this->sertifTestAfterLV,
            $this->otherIsolationLV,
            $this->otherTestBeforeLV,
            $this->otherTestAfterLV
        ];
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getDate(): string
    {
        return $this->date;
    }

}