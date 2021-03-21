<?php


namespace App\Http\Services;


use App\Http\Interfaces\QuotableInterface;
use App\Models\TripQuotation;
use Carbon\Carbon;

class TripService implements QuotableInterface
{
    /**
     * @var array
     */
    private array $ages;

    /**
     * @var string
     */
    private string $currency;

    /**
     * @var int
     */
    private int $duration;

    private $total;

    /**
     * Trip constructor.
     * @param array $ages
     * @param string $currency
     * @param string $startDate
     * @param string $endDate
     * @throws \Exception
     */
    public function __construct(string $ages, string $currency, string $startDate, string $endDate)
    {
        $this->ages = explode(',', $ages);
        $this->currency = $currency;
        $this->duration =  (new Carbon($startDate))->diffInDays(new Carbon($endDate)) + 1;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return float|int
     * @throws \Exception
     */
    public function calculateQuotation()
    {
        $fixedRate = config('quotation.fixed_rate');
        $agesRate = config('quotation.age_rate');

        foreach ($this->ages as $age) {
            $quotationPerPassenger[] = $this->calculatePerPassenger($fixedRate, $this->getAgeRate($age, $agesRate));
        }

        return $this->total = array_sum($quotationPerPassenger);
    }

    /**
     * @param $fixedRate
     * @param $ageRate
     * @return float|int
     */
    protected function calculatePerPassenger($fixedRate, $ageRate)
    {
        return $fixedRate * $ageRate * $this->duration;
    }

    /**
     * @param $age
     * @param $agesRate
     * @return mixed
     * @throws \Exception
     */
    protected function getAgeRate($age, $agesRate)
    {
        foreach ($agesRate as $ageRate) {
            if ($age >= $ageRate['min'] && $age < $ageRate['max']) {
                return $ageRate['rate'];
            }
        }

        throw new \Exception('Age rate is not defined');
    }

    /**
     * @param $total
     * @return mixed
     */
    public function saveQuotation() : int
    {
        $trip = new TripQuotation([
            'ages' => implode(',', $this->ages),
            'currency' => $this->getCurrency(),
            'duration' => $this->duration,
            'total' => $this->total]);
        $trip->save();

        return $trip->id;
    }

}
